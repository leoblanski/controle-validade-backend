<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Product::with('category')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'manufacturing_date' => 'required',
            'expiration_date' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $expirationDate = Carbon::createFromFormat('Y-m-d', $data['expiration_date']);
        $manufacturingDate = Carbon::createFromFormat('Y-m-d', $data['manufacturing_date']);

        if ($expirationDate->isBefore($manufacturingDate)) {
            return response()->json(['error' => 'A data de validade não pode ser anterior à data de fabricação.'], 422);
        }

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($product->load('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product) // Mudança no parâmetro $products para $product para deletar um único item.
    {
        if (!$product) {  //Mudança para verificação se o produto existe ou não e após isso deletamos ele caso seja encontrado.
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }

        $product->delete();

        return response()->json(['success' => 'Produto excluído com sucesso'], 200);
    }
}
