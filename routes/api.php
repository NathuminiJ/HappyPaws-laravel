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

// Sanctum-protected user info (default)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API routes (accessible without login for now)
Route::apiResource('products', ProductController::class);
Route::apiResource('orders', OrderController::class)->only(['index','show']);
Route::apiResource('customers', CustomerController::class)->only(['index','show']);
Route::apiResource('brands', BrandController::class)->only(['index','show']);
Route::apiResource('admins', AdminController::class)->only(['index','show']);
Route::apiResource('payments', PaymentController::class)->only(['index','show']);
Route::apiResource('shipments', ShipmentController::class)->only(['index','show']);
Route::apiResource('subscriptions', SubscriptionController::class)->only(['index','show']);
