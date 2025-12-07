<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    /**
     * Display the products page with all active products
     */
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);
        
        // Filter by category if provided
        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('farm_name', 'like', '%' . $request->search . '%');
            });
        }
        
        $products = $query->orderBy('created_at', 'desc')->get();
        
        // Get unique categories for filter buttons
        $categories = Product::where('is_active', true)
            ->distinct()
            ->pluck('category')
            ->sort();
        
        return view('products', compact('products', 'categories'));
    }
}