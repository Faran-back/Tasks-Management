<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/tasks', [TaskController::class, 'index'])->name('show');
    Route::post('/create', [TaskController::class, 'store'])->name('store');
    Route::put('/update/{id}', [TaskController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [TaskController::class, 'destroy'])->name('destroy');
});



