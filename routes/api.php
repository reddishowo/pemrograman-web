<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// User Routes
Route::apiResource('users', UserController::class);

// Product Routes
Route::apiResource('products', ProductController::class);

// Order Routes
Route::apiResource('orders', OrderController::class);