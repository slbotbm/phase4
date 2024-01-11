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
        $keyword = $request->keyword;
        $category = $request->category; 
        $order = $request->order;
        $query = Employee::query();

        if ($keyword && strlen(trim($keyword)) > 0) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
        if ($category === 'employment_start') {
            $query->orderBy("start_of_employment", $order);
        } else {
            switch ($category) {
                case 'overtime':
                    $query->selectRaw('employees.* , (160 - COALESCE(SUM(employee_project_hours), 0)) as remaining_hours')
                        ->leftJoin('employee_project', 'employees.id', '=', 'employee_project.employee_id')
                        ->groupBy('employees.id');
                    if ($order === "desc") {
                        $query->orderbyDesc('remaining_hours');
                    }
                    break;
                case "number_of_projects":
                    $query->withCount('projects');
                    if ($order === "desc") {
                        $query->orderbyDesc('projects_count');
                    }
                    break;
                case 'free':
                    $query->selectRaw('employees.* , SUM(employee_project_hours) as total_hours')
                        ->join('employee_project', 'employees.id', '=', 'employee_project.employee_id')
                        ->groupBy('employees.id');
                    if ($order === "desc") {
                        $query->orderbyDesc('total_hours');
                    }
                    break;
                default:
                    break;
            }
            
        }

        $response = $query->paginate(20);
        return response()->view("search.employeeIndex", compact("response"));
    }

    public function projectSearch(Request $request) {
        $keyword = $request->keyword;
        $category = $request->category;
        $order = $request->order;
        $status = $request->condition;

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
               $query->orderBy("start_date", $order);
               break;
            case 'end_date':
                $query->orderBy("end_date", $order);
                break;
            case "price":
                $query->orderBy('cost', $order);
                break;
            case 'number_of_engineers':
                $query->withCount('employees');
                if ($order === 'desc') {
                    $query->orderbyDesc('employees_count');
                }
                break;
            default:
                break;
        }

        $response = $query->paginate(20);

        return response()->view("search.projectIndex", compact("response"));
    }

    public function technologySearch(Request $request) {
        $keyword = $request->keyword;
        $category = $request->category;

        $query = Technology::query();

        if ($keyword and (strlen(trim($keyword))>0)) {
            $query->where('name', 'like', '%' . $keyword . '%');
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

        $response = $query->paginate(20);

        return response()->view("search.technologyIndex", compact("response"));
    }
}
