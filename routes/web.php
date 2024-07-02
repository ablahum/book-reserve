<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/users', 'index');

    Route::post('/auth/register', 'register');
    Route::post('/auth/login', 'login');
    Route::post('/auth/logout', 'logout');
});