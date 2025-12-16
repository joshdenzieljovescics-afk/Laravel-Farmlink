<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items.product']);

        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.product', 'approvedBy'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $order = Order::findOrFail($id);
        
        $order->update([
            'status' => 'approved',
            'admin_notes' => $request->admin_notes,
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Order approved successfully!');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            $order = Order::with('user')->findOrFail($id);
            
            // Refund the money to the buyer
            $buyer = $order->user;
            $refundAmount = $order->total;
            
            // Add the refund to buyer's farm_tokens
            $buyer->farm_tokens = $buyer->farm_tokens + $refundAmount;
            $buyer->save();
            
            // Create a refund transaction record
            Transaction::create([
                'user_id' => $buyer->id,
                'type' => 'refund',
                'amount' => $refundAmount,
                'description' => "Refund for rejected order #{$order->order_number}",
            ]);
            
            // Update order status
            $order->update([
                'status' => 'rejected',
                'admin_notes' => $request->admin_notes,
                'approved_by' => auth()->id(),
                'approved_at' => now(),
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Order rejected and ' . number_format($refundAmount, 2) . ' FarmTokens refunded to buyer.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to reject order: ' . $e->getMessage());
        }
    }
}
