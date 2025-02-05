<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//auth protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('/', 'index');
        Route::get('/me', 'showCurrentUser');
        Route::get('/{id}', 'show');
    });
    Route::controller(AuthController::class)->prefix('auth')->group(function () {
        Route::post('/logout', 'logout');
    });
});

//auth unprotected routes
Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('/register', 'register');
});
