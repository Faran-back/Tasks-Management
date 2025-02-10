<?php

use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksAuth\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/create', [TaskController::class, 'store']);
Route::put('/update/{id}', [TaskController::class, 'update']);
Route::delete('/delete/{id}', [TaskController::class, 'destroy']);


Route::get('index', [GeneralController::class, 'index'])->name('index');
Route::get('all-tasks', [GeneralController::class, 'all_tasks'])->name('show.tasks');
Route::get('edit-task/{id}', [GeneralController::class, 'edit_tasks']);

Route::get('/admin/dashboard', function(){
    return view('dashboards.admin-dashboard');
})->name('admin_dashboard');

Route::get('/manager/dashboard', function(){
    return view('dashboards.manager-dashboard');
})->name('manager.dashboard');

Route::get('/dashboard', function(){
    return view('dashboards.user-dashboard');
})->name('dashboard');

require __DIR__.'/auth.php';
