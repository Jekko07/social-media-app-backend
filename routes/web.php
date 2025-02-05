<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'welcome to my api';
});

Route::post('/api/login', [AuthController::class, 'login']);
