<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('search.employee');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);
        $employee['technologies'] = $employee->technologies()->get();
        $employee['projects'] = $employee->projects()->orderBy('start_date', 'asc')->get();
        $hours = $employee->projects()->sum('employee_project_hours');  

        $tasks = [];
        $links = [];

        foreach ($employee->projects as $project) {
            $duration = ($project->start_date->diff($project->end_date))->days;
            if ($project->start_date > date("Y-m-d")) {
                $progress = 0;
            } else {
                $progress = (($project->start_date->diff(date('Y-m-d')))->days)/$duration;
            }
            array_push(
                $tasks,
                [
                    "id" => $project->id,
                    "text" => $project->name,
                    "start_date" => $project->start_date->format('Y-m-d'),
                    "end_date"=>$project->end_date->format('Y-m-d'),
                    "type"=>"project",
                    "open"=>true,
                ]
            );

            $employees = $project->employees()->get();
            $employee_count = $employees->count();
            $count = 0;
            foreach ($employees as $employee) {
                $employee_start_date = clone $project->start_date; 
                $employee_start_date->modify('+' . floor($duration * $count / $employee_count) . ' days');
                $employee_duration = $duration/$employee_count;
                if ($employee_start_date < date('Y-m-d')) {
                    if ($project->end_date < date('Y-m-d')) {
                        $employee_progress = ($employee_start_date->diff(date('Y-m-d'))->days/7)/$employee_duration;
                    } else {
                        $employee_progress = 1;
                    }
                } else {
                    $employee_progress = 0;
                }


                array_push(
                    $tasks,
                    [
                        "id" => $project->id * 100 + $employee->id,
                        "text" => $employee->name,
                        "start_date" => $employee_start_date->format('Y-m-d'), 
                        "duration" => $employee_duration,
                        "parent" => $project->id,
                    ]
                );
                if ($count != 0) {
                    array_push($links,
                        [
                            "id"=>$project->id * 100 + $employee->id,
                            "source"=>$project->id * 100 + $employees[$count-1]->id,
                            "target"=>$project->id * 100 + $employee->id,
                            "type"=>0
                        ]
                    );
                } else {
                    array_push($links,
                        [
                            "id"=>$project->id * 100 + $employee->id,
                            "source"=>$project->id,
                            "target"=>$project->id * 100 + $employee->id,
                            "type"=>1,
                        ]
                    );
                }
                $count++;
                if ($count == $employee_count) {
                    array_push(
                        $links,
                        [
                            "id"=>$project->id * 1000 + $employee->id,
                            "source"=>$project->id * 100 + $employee->id,
                            "target"=>$project->id,
                            "type"=>2,
                        ]
                    );
                }
            }
        }

        $response = response()->json([
            "data" => $tasks,
            "links" => $links
        ]);

        return response()->view('employee.show', compact('employee', 'response', 'hours'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
    public function sendEmployeeInformationToChange(string $id) {
        $employee = Employee::find($id);
        return response()->view("change", compact("employee"));
    }
}
