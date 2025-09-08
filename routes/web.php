<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('/tasks');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Admin hanya bisa akses ini
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('projects', ProjectController::class);
    Route::resource('users', UserController::class);
});

// Admin & User sama-sama bisa akses Task
Route::middleware(['auth', 'role:admin,user'])->group(function () {
    Route::resource('tasks', TaskController::class);
});

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
