<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GanttController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function() {
    Route::get('/search/input', [SearchController::class, 'create'])->name('search.input');
    Route::get('/search/result', [SearchController::class, 'index'])->name('search.result');
    Route::resource('employee', EmployeeController::class);
    Route::resource('technology', TechnologyController::class);
    Route::resource('project', ProjectController::class);
    Route::resource('search', SearchController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/looking', function () {
    return view('looking');
})->name('looking.page');

Route::get('/change', function () {
    return view('change');
})->name('change.page');

Route::get('/sample/dhtmlx/gantt',[GanttController::class, 'view_gantt'])->name('sample.dhtmlx.gant');


require __DIR__.'/auth.php';
