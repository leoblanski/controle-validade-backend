<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller


{

    public function index() 
    {

        return response()->json(Category::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json($category, 201); 

    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Categoria não encontrada'], 404);
        }
        
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        
        return response()->json($category, 200); 
    }

    public function show($id)
    {
        $category = Category::find($id);

        if(!$category) {
            return response()->json(['message' => 'Categoria não encontrada'], 404);
        }
        return response()->json($category, 200);
        
    }

}
