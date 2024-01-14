<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Project;
use App\Models\Technology;

class SearchController extends Controller
{
    public function index(Request $request) {
        $projects = Employee::overtime();
        return response()->view('search.index', compact('projects'));
    }

    public function create() {
        return response()->view('search.input');    
    }
    
    public function init() {
        return response()->view("search.see");
    }

    public function employeeSearch(Request $request) {
        $keyword = ($request->keyword === "None") ? null : $request->keyword;
        $category = ($request->category === "None") ? null : $request->category; 
        $order = ($request->order === "None") ? null : $request->order;
        $speciality = ($request->speciality === "None") ? null : $request->speciality;
        $query = Employee::query();

        if ($keyword && strlen(trim($keyword)) > 0) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        if ($speciality !== null) {
            $subQuery = Employee::selectRaw('employee_id')->distinct()
                ->join('employee_technology', 'employees.id', '=', 'employee_technology.employee_id')
                ->join('technologies', 'employee_technology.technology_id', '=', 'technologies.id')
                ->where('technologies.technology_field', $speciality);

            $query->whereIn('employees.id', $subQuery);
        }

        if ($category !== null) {
            if ($category === 'employment_start') { //就職の開始
                $query->orderBy("start_of_employment", $order);
            } else {
                switch ($category) {
                    case 'overtime': //残業
                        $query->selectRaw('employees.* , (160 - COALESCE(SUM(employee_project_hours), 0)) as remaining_hours')
                            ->leftJoin('employee_project', 'employees.id', '=', 'employee_project.employee_id')
                            ->groupBy('employees.id')
                            ->having('remaining_hours', '<=', 0);
                        if ($order === "desc") {
                            $query->orderbyDesc('remaining_hours');
                        } else {
                            $query->orderBy('remaining_hours');
                        }
                        break;
                    case "number_of_projects": //案件の数
                        $query->withCount('projects');
                        if ($order === "desc") {
                            $query->orderbyDesc('projects_count');
                        } else {
                            $query->orderBy('projects_count');
                        }   
                        break;
                    case 'free': //暇
                        $query->selectRaw('employees.* , SUM(employee_project_hours) as total_hours')
                            ->join('employee_project', 'employees.id', '=', 'employee_project.employee_id')
                            ->groupBy('employees.id');
                        if ($order === "desc") {
                            $query->orderbyDesc('total_hours');
                        } else {
                            $query->orderBy('total_hours');
                        }
                        break;
                    default:
                        break;
                }
                
            }
        }
        if ($category === null && $order !== "desc") {
            $query->orderBy("id", "desc");
        }

        $response = $query->get();
        return response()->view("search.employeeIndex", compact("response"));
    }

    public function projectSearch(Request $request) {
        $keyword = ($request->keyword === "None") ? null : $request->keyword;
        $category = ($request->category === "None") ? null : $request->category; 
        $order = ($request->order === "None") ? null : $request->order;
        $status = ($request->condition === "None") ? null : $request->condition;

        $query = Project::query();

        if ($keyword and (strlen(trim($keyword))>0)) {
            $query->where('name', 'like', '%' . $keyword . '%')
                  ->orWhere('customer_name', 'like', '%' . $keyword . '%')
                  ->orWhere('details','like', '%' . $keyword . '%');
        }

        switch ($status) {
            case 'before_creation':
                $query->whereIn('status', ['受注前']);
                break;
            case "in_creation":
                $query->whereIn('status', ['構築中']);
                break;
            case "after_creation":
                $query->whereIn('status', ['納品済み']);
                break;
            default:
                break;
        }

        switch($category) {
            case 'start_date':
                switch($order){
                    case "desc":
                        $query->orderByDesc("start_date");        
                        break;
                    default:
                        $query->orderBy("start_date");    
                        break;
                }
               break;
            case 'end_date':
                switch($order){
                    case "desc":
                        $query->orderByDesc("end_date");        
                        break;
                    default:
                        $query->orderBy("end_date");    
                        break;
                }
                break;
            case "price":
                switch($order){
                    case "desc":
                        $query->orderByDesc("cost");        
                        break;
                    default:
                        $query->orderBy('cost');
                        break;
                }
                break;
            case 'number_of_engineers':
                $query->withCount('employees');
                switch($order) {
                    case "desc":
                        $query->orderByDesc('employees_count');
                        break;
                    default:
                        $query->orderBy('employees_count');
                        break;
                }
                break;
        }

        $response = $query->get();

        return response()->view("search.projectIndex", compact("response"));
    }

    public function technologySearch(Request $request) {
        $keyword = ($request->keyword === "None") ? null : $request->keyword;
        $category = ($request->category === "None") ? null : $request->category; 

        $query = Technology::query();

        if ($keyword and (strlen(trim($keyword))>0)) {
            $query->where('name', 'like', '%' . $keyword . '%')
                  ->orWhere('technology_field', 'like', '%' . $keyword . '%');
        }
        switch($category) {
            case "backend":
               $query->whereIn('technology_field', ["backend"]);
               break;
            case "frontend":
                $query->whereIn('technology_field', ["frontend"]);
                break;
            case "server-side":
                $query->whereIn('technology_field', ["server-side"]);
                break;
            default:
                break;
        }

        $response = $query->get();

        return response()->view("search.technologyIndex", compact("response"));
    }
}
