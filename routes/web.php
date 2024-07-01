<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');

    Route::post('/users/login', 'login');
    Route::post('/users/register', 'register');
});