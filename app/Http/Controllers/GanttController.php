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
}


