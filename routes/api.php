<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('products', ProductController::class);

Route::get('products', [ProductController::class, 'index']);

Route::get('categories', [CategoryController::class, 'index']);

Route::post('categories', [CategoryController::class, 'store']);

Route::put('categories/{id}', [CategoryController::class, 'update']);

Route::get('categories/{id}', [CategoryController::class, 'show']);
