<?php

use Illuminate\Support\Facades\Route;

// Common
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Users
    Route::get('/usuario', [App\Http\Controllers\WEB\UserController::class, 'index'])->name('usuario-web.index');
    Route::resource('/api/usuario', App\Http\Controllers\API\UserController::class)->except('create', 'edit');
});
