<?php

use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/tasks', [TaskController::class, 'index'])->name('show');
    Route::post('/create', [TaskController::class, 'store'])->name('store');
    Route::put('/update/{id}', [TaskController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [TaskController::class, 'destroy'])->name('destroy');
});

Route::get('index', [GeneralController::class, 'index'])->name('index');


require __DIR__.'/auth.php';
