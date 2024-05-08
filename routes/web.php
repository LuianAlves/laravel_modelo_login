<?php

use Illuminate\Support\Facades\Route;

// Common
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\WEB\UserController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Users
    Route::get('/usuario', [UserController::class, 'index'])->name('usuario-web.index');
    Route::apiResource('/api/usuario', UserController::class);
});
