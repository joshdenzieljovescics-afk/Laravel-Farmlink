<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Product API routes
Route::get('/trending-products', [ProductController::class, 'getTrendingProducts']);
Route::get('/newly-arrived-products', [ProductController::class, 'getNewlyArrivedProducts']);
Route::get('/products', [ProductController::class, 'getAllProducts']);
Route::get('/products/{id}', [ProductController::class, 'getProduct']);
Route::get('/test-connection', [ProductController::class, 'testConnection']);
