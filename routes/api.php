<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AuthController;

// -------------------
// AUTH ROUTES
// -------------------
Route::post('/register', [AuthController::class, 'registerCustomer']);
Route::post('/login', [AuthController::class, 'loginCustomer']);
Route::post('/admin/login', [AuthController::class, 'loginAdmin']);

// -------------------
// Default Sanctum-protected route
// -------------------
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// -------------------
// PUBLIC ROUTES (accessible without login)
// -------------------
Route::apiResource('products', ProductController::class)->only(['index', 'show']);
Route::apiResource('brands', BrandController::class)->only(['index', 'show']);
Route::apiResource('subscriptions', SubscriptionController::class)->only(['index', 'show']);

// -------------------
// CUSTOMER ROUTES (requires Sanctum login)
// -------------------
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('orders', OrderController::class)->only(['index','show','store']);
    Route::apiResource('customers', CustomerController::class)->only(['show','update']);
});

// -------------------
// ADMIN ROUTES (requires Sanctum login + is_admin middleware)
// -------------------
Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::apiResource('products', ProductController::class)->except(['index', 'show']);
    Route::apiResource('brands', BrandController::class)->except(['index', 'show']);
    Route::apiResource('admins', AdminController::class);
    Route::apiResource('payments', PaymentController::class);
    Route::apiResource('shipments', ShipmentController::class);
});
