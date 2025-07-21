<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController; // kalau kamu punya

// ✅ Route Login
Route::post('/login', [AuthController::class, 'login']);

// ✅ Route dengan token
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index']); // contoh
});
