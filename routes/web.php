<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Default Jetstream dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ✅ Admin-only dashboard
    Route::middleware('is_admin')->group(function () {
        Route::get('/admin-dashboard', function () {
            return view('admin-dashboard');
        })->name('admin.dashboard');
    });
});
