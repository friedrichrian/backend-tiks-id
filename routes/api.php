<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Movie\MovieController;

// Public routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    Route::get('/movie', [MovieController::class, 'index']);
    Route::post('/movie', [MovieController::class, 'create']);
    Route::patch('/movie/{id}', [MovieController::class, 'edit']);
    Route::delete('/movie/{id}', [MovieController::class, 'delete']);
});
