<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    /**
     * Display the buyer dashboard with featured/recent products
     */
    public function dashboard()
    {
        // Get featured products (active, with stock)
        $featuredProducts = Product::where('status', 'Y')
            ->where('is_active', true)
            ->where('stock_quantity', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        // Get category breakdown
        $categories = Product::where('status', 'Y')
            ->where('is_active', true)
            ->select('category')
            ->distinct()
            ->get();

        return view('buyer.dashboard', compact('featuredProducts', 'categories'));
    }
}
