<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function() {
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/create', [TaskController::class, 'store']);
    Route::put('/update/{id}', [TaskController::class, 'update']);
    Route::delete('/delete/{id}', [TaskController::class, 'destroy']);
});

Route::view('/tasks/index', 'index');
