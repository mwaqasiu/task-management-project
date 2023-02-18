<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
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


Route::get('/', [TaskController::class, 'index'])->name('task.index');
Route::get('task/create', [TaskController::class, 'create'])->name('task.create');
Route::post('task/store', [TaskController::class, 'store'])->name('task.store');
Route::get('task/edit/{task}', [TaskController::class, 'edit'])->name('task.edit');
Route::post('task/update/{task}', [TaskController::class, 'update'])->name('task.update');
Route::get('task/destroy/{task}', [TaskController::class, 'destroy'])->name('task.destroy');
Route::post('task/sortable', [TaskController::class, 'taskSortable'])->name('task.sortable');

