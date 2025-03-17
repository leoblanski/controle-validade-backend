<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $products = Product::create($request->all());
        return response()->json($products, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $products)
    {
        return response()->json(Product::findOrFail($products->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $products)
    {
        $products = Product::findOrFail($products);
        $products->update($request->all());
        return response()->json($products, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $products)
    {
        Product::destroy($products);
        return response()->json(['message'=> 'Produto deletado']);
    }
}
