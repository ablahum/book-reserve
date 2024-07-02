<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PesananController;

Route::get('/', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/users', 'index');
    Route::get('/users/{id}', 'getById');

    Route::post('/auth/register', 'register');
    Route::post('/auth/login', 'login');
    Route::post('/auth/logout', 'logout');
});

Route::controller(LayananController::class)->group(function () {
    Route::get('/layanan', 'index');

    Route::post('/layanan', 'store');
    Route::put('/layanan/{id}', 'update');
    Route::delete('/layanan/{id}', 'destroy');
});

Route::controller(PesananController::class)->group(function () {
    Route::get('/pesanan', 'index');

    Route::post('/layanan', 'store');
    // Route::put('/layanan/{id}', 'update');
    // Route::delete('/layanan/{id}', 'destroy');
});