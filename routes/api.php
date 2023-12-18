<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/data', [GanttController::class, 'get_json']);
Route::resources([
  'task' => TaskController::class,
  'link' => LinkController::class,
]);

// または

Route::resource('task', TaskController::class);
Route::resource('link', LinkController::class);

