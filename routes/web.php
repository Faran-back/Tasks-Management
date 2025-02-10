<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebhookController;
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

// CRUD APIs for tasks

Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/create', [TaskController::class, 'store']);
Route::put('/update/{id}', [TaskController::class, 'update']);
Route::delete('/delete/{id}', [TaskController::class, 'destroy']);

// Routes for tasks
Route::get('index', [GeneralController::class, 'index'])->name('index');
Route::get('all-tasks', [GeneralController::class, 'all_tasks'])->name('show.tasks');
Route::get('edit-task/{id}', [GeneralController::class, 'edit_tasks']);
Route::get('delete-task/{id}', [GeneralController::class, 'delete_task']);
Route::get('view-task/{id}', function(){
    $tasks =  Task::with('user')->get();
    $users = User::all();
    return view('tasks.view-tasks', compact(['tasks', 'users']));
});


// Routes for user redirection after registering
Route::get('/admin/dashboard', function(){
    return view('dashboards.admin-dashboard');
})->name('admin.dashboard');

Route::get('/manager/dashboard', function(){
    return view('dashboards.manager-dashboard');
})->name('manager.dashboard');

Route::get('/dashboard', function(){
    return view('dashboards.user-dashboard');
})->name('dashboard');

// Route for web hook
// routes/web.php
Route::post('/webhooks/task-updated', [WebhookController::class, 'taskUpdated'])->name('task.update');



require __DIR__.'/auth.php';
