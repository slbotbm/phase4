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
    
    public function see() {
        return response()->view("see");
    }

    public function employeeSearch() {
        echo "Connected";
    }

    public function projectSearch() {
        echo "Connected";
    }

    public function technologySearch() {
        echo "Connected";
    }
}
