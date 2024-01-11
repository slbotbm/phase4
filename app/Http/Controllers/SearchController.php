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
        if ($keyword and (strlen(trim($keyword))>0)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
        if ($category === 'overtime') {
            $query->selectRaw('employees.* , (160 - COALESCE(SUM(employee_project_hours), 0)) as remaining_hours')
                  ->leftJoin('employee_project','employees.id','=','employee_project.employee_id')
                  ->groupBy('employees.id');
            if ($order === 'desc') {
                $query->orderBy('remaining_hours', 'desc');
            }
        } else if ($category === 'employment_start') {
            $query->orderBy("start_of_employment", $order);
        } else if ($category === "number_of_projects"){
            $query->withCount('projects');
            if ($order === 'desc') {
                $query->orderbyDesc('projects_count');
            }
        } else if ($category === 'free'){
            $query->selectRaw('employees.* , SUM(employee_project_hours) as total_hours')
                ->join('employee_project','employees.id','=','employee_project.employee_id')
                ->groupBy('employees.id');
            if ($order === 'desc') {
                $query->orderBy('total_hours', 'desc');
            }
        }

        $response = $query->paginate(20);
        return response()->view("search.employeeIndex", compact("response"));
    }

    public function projectSearch(Request $request) {
        $keyword = $request->keyword;
        $category = $request->category;
        $order = $request->order;
        $condition = $request->condition;

        $query = Project::query();

        if ($keyword and (strlen(trim($keyword))>0)) {
            $query->where('name', 'like', '%' . $keyword . '%')
                  ->orWhere('customer_name', 'like', '%' . $keyword . '%')
                  ->orWhere('details','like', '%' . $keyword . '%');
        }

        if ($category==='start_date') {
            $query->orderBy("start_date", $order);
        } else if ($category === 'end_date') {
            $query->orderBy("end_date", $order);
        } else if ($category === 'price') {
            $query->orderBy('cost', $order);
        } else if ($category === 'number_of_engineers') {
            $query->withCount('employees');
            if ($order === 'desc') {
                $query->orderbyDesc('employees_count');
            }
        }

        if ($condition === 'before_creation') {
            $query->whereIn('status', ['受注前']);
        } else if ($condition === 'in_creation') {
            $query->whereIn('status', ['構築中']);
        } else if ($condition === 'after_creation') {
            $query->whereIn('status', ['納品済み']);
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

        if ($category === "backend") {
            $query->whereIn('technology_field', ["backend"]);
        } else if ($category === "frontend") {
            $query->whereIn('technology_field', ["frontend"]);
        } else if ($category === "server-side") {
            $query->whereIn('technology_field', ["server-side"]);
        }

        $response = $query->paginate(20);

        return response()->view("search.technologyIndex", compact("response"));
    }
}
