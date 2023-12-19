<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gantt;
use App\Models\Task;
use App\Models\Link;

class GanttController extends Controller
{
  // ガントチャートのページを表示
  public function view_gantt()
  {
    return view('sample.dhtmlx.gantt');
  }

  public function get_json()
  {
    $tasks = new Task();
    $links = new Link();

    return response()->json([
      "data" => $tasks->all(),
      "links" => $links->all(),
    ]);
  }

}


