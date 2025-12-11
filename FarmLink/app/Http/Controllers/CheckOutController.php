<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page
     */
    public function index()
    {
        return view('checkout');
    }

    /**
     * Process the checkout and create order
     */
    public function process(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required',
            'items.*.name' => 'required|string',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|integer|min:1',
            'delivery_address' => 'required|string',
            'delivery_coordinates' => 'required|array',
            'delivery_coordinates.lat' => 'required|numeric',
            'delivery_coordinates.lng' => 'required|numeric',
            'delivery_notes' => 'nullable|string',
            'subtotal' => 'required|numeric|min:0',
            'delivery_fee' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0'
        ]);

        $user = Auth::user();
        $total = ceil($request->input('total'));

        // Check if user has sufficient balance
        if ($user->farm_tokens < $total) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient FarmTokens balance'
            ], 400);
        }

        try {
            DB::beginTransaction();

            // Get delivery coordinates - FIX IS HERE
            $deliveryCoords = $request->input('delivery_coordinates');

            // Deduct tokens from user
            $user->farm_tokens = $user->farm_tokens - $total;
            $user->save();

            // Create order record
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => Order::generateOrderNumber(),
                'delivery_address' => $request->input('delivery_address'),
                'delivery_latitude' => $deliveryCoords['lat'],
                'delivery_longitude' => $deliveryCoords['lng'],
                'delivery_notes' => $request->input('delivery_notes'),
                'subtotal' => $request->input('subtotal'),
                'delivery_fee' => $request->input('delivery_fee'),
                'total' => $request->input('total'),
                'status' => 'pending',
            ]);

            // Create order items and update stock
            foreach ($request->input('items') as $item) {
                // Check if product has enough stock
                $product = Product::find($item['id']);
                
                if (!$product) {
                    throw new \Exception("Product not found: {$item['name']}");
                }
                
                if ($product->stock_quantity < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$item['name']}. Only {$product->stock_quantity} available.");
                }
                
                // Create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);

                // Update product stock
                $product->decrement('stock_quantity', $item['quantity']);
            }

            // Optional: Create transaction record
            DB::table('transactions')->insert([
                'user_id' => $user->id,
                'type' => 'purchase',
                'amount' => -$total,
                'description' => "Order {$order->order_number}",
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully! Waiting for admin approval.',
                'order_id' => $order->id,
                'order_number' => $order->order_number
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Log the actual error for debugging
            \Log::error('Checkout error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to process order. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : null  // Only show in debug mode
            ], 500);
        }
    }
}