<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gantt;
use App\Models\Task;
use App\Models\Link;

class GanttController extends Controller
{
  public function view_gantt()
  {
    return view('sample.dhtmlx.gantt');
  }

  public function get_json()
  {
    $tasks = Task::get()->all();
    $links = Link::get()->all();

    return response()->json([
      "data" => $tasks,
      "links" => $links,
    ]);
  }

}


