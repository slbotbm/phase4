<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    public function getProjectDataforGantt()
    {
        $projects = Project::orderBy('start_date', 'asc')->get();
        $tasks = [];
        $links = [];
        $currentDateTime = new \DateTime();

        foreach ($projects as $project) {
            $duration = ($project->start_date->diff($project->end_date))->days;
            if ($project->start_date > $currentDateTime) {
                $progress = 0;
            } else {
                $progress = (($project->start_date->diff(date('Y-m-d')))->days)/$duration;
            }
            if ($progress === 0 || $progress >= 1) {
                $open = false;
            } else {
                $open = true;
            }
            array_push(
                $tasks,
                [
                    "id" => $project->id,
                    "text" => $project->name,
                    "start_date" => $project->start_date->format('Y-m-d'),
                    "end_date"=>$project->end_date->format('Y-m-d'),
                    "type"=>"project",
                    "progress"=>$progress,
                    "open"=>$open,
                ]
            );

            $employees = $project->employees()->get();
            $employee_count = $employees->count();
            $count = 0;
            foreach ($employees as $employee) { 
                $employee_start_date = $project->start_date->modify('+' . floor($duration * $count / $employee_count) . ' days');
                $employee_duration = $duration/$employee_count;
                if ($employee_start_date < $currentDateTime) {
                    if ($project->end_date > $currentDateTime) {
                        $employee_progress = ($employee_start_date->diff($project->end_date)->days/7)/$employee_duration;
                    } else {
                        $employee_progress = 1;
                    }
                } else {
                    $employee_progress = 0;
                }
                $temp = $employee->technologies()->inRandomOrder()->first()->technology_field;
                if ($temp == "frontend") {
                    $text = "フロントエンド";
                } elseif ($temp == "backend") {
                    $text = "バックエンド";
                } else {
                    $text = "サーバーサイド";
                }

                array_push(
                    $tasks,
                    [
                        "id" => $project->id * 100 + $employee->id,
                        "text" => $text,
                        "owner"=>$employee->name,
                        "start_date" => $employee_start_date->format('Y-m-d'), 
                        "duration" => $employee_duration,
                        "progress"=>$employee_progress,
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

        return response()->view('dashboard', compact('response'));
    }

    public function index() {
        return redirect()->route('search.project');
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
    public function store(StoreProjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project['technologies'] = $project->technologies()->get();
        $project['employees'] = $project->employees()->get();
        return response()->view('project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
