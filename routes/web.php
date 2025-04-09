<?php

use App\Models\Product;
use Illuminate\Queue\Middleware\Skip;
use Illuminate\Support\Facades\Route;

Route::get('/teste-produto', function () {
    $produto = Product::with('category')->skip(1)->take(1)->first();
    return response()->json($produto);
});


