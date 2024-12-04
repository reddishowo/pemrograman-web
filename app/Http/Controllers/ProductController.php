<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Get all products
        return Product::all();
    }

    public function show($id)
    {
        // Get a single product
        return Product::findOrFail($id);
    }

    public function store(Request $request)
    {
        // Validate and create a new product
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|url',
        ]);

        return Product::create($validated);
    }

    public function update(Request $request, $id)
    {
        // Validate and update product
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'image_url' => 'nullable|url',
        ]);

        $product->update($validated);
        return $product;
    }

    public function destroy($id)
    {
        // Delete product
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
