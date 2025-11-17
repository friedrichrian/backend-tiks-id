<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Movie\MovieController;
use App\Http\Controllers\Theater\TheaterController;
use App\Http\Controllers\Schedule\ScheduleController;
use App\Http\Controllers\Genre\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::get('/theater', [TheaterController::class, 'index']);
    Route::get('/schedule', [ScheduleController::class, 'index']);
    Route::get('/genre', [GenreController::class, 'index']);

    Route::get('/movie/{id}', [MovieController::class, 'show']);

    Route::post('/genre', [GenreController::class, 'create']);
    Route::patch('/genre/{id}', [GenreController::class, 'edit']);
    Route::delete('/genre/{id}', [GenreController::class, 'delete']);


    Route::middleware('admin')->group(function () {
        Route::post('/movie', [MovieController::class, 'create']);
        Route::patch('/movie/{id}', [MovieController::class, 'edit']);
        Route::delete('/movie/{id}', [MovieController::class, 'delete']);

        Route::post('/theater', [TheaterController::class, 'create']);
        Route::patch('/theater/{id}', [TheaterController::class, 'edit']);
        Route::delete('/theater/{id}', [TheaterController::class, 'delete']);

        Route::post('/schedule', [ScheduleController::class, 'create']);
        Route::patch('/schedule/{id}', [ScheduleController::class, 'edit']);
        Route::delete('/schedule/{id}', [ScheduleController::class, 'delete']);
    });
});
