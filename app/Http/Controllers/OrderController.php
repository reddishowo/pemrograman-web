<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Get all orders with user and product relations
        return Order::with(['user', 'product'])->get();
    }

    public function show($id)
    {
        // Get a single order by ID
        return Order::with(['user', 'product'])->findOrFail($id);
    }

    public function store(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Fetch product
        $product = Product::findOrFail($validated['product_id']);

        // Check stock availability
        if ($product->stock < $validated['quantity']) {
            return response()->json(['error' => 'Insufficient stock'], 400);
        }

        // Calculate total price
        $validated['total_price'] = $product->price * $validated['quantity'];

        // Create order
        $order = Order::create($validated);

        // Update product stock
        $product->decrement('stock', $validated['quantity']);

        return response()->json($order, 201);
    }

    public function update(Request $request, $id)
    {
        // Find the order
        $order = Order::findOrFail($id);
    
        // Validate request
        $validated = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'product_id' => 'sometimes|required|exists:products,id',
            'quantity' => 'sometimes|required|integer|min:1',
        ]);
    
        // Check if quantity is being updated
        if (isset($validated['quantity'])) {
            // Get the associated product
            $product = $order->product;
    
            // Calculate the difference in quantity
            $quantityDifference = $validated['quantity'] - $order->quantity;
    
            // Check if there is enough stock for the quantity adjustment
            if ($product->stock < $quantityDifference) {
                return response()->json(['error' => 'Insufficient stock for this update'], 400);
            }
    
            // Update total price
            $validated['total_price'] = $product->price * $validated['quantity'];
    
            // Adjust the product stock
            $product->decrement('stock', $quantityDifference);
        }
    
        // Update order
        $order->update($validated);
    
        return response()->json($order);
    }
    

    public function destroy($id)
    {
        // Find and delete order
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully']);
    }
}
