<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with featured products
     */
    public function index()
    {
        // Get featured products based on multiple criteria:
        // 1. Active and in stock
        // 2. Prioritize organic products
        // 3. Recently added (latest first)
        // 4. Diverse categories

        $featuredProducts = Product::where('status', 'Y')
            ->where('is_active', true)
            ->where('stock_quantity', '>', 0)
            ->with('seller')  // Load seller information
            ->orderByDesc('is_organic')  // Organic products first
            ->latest()  // Then by newest
            ->take(8)  // Limit to 8 featured products
            ->get();

        // Get product categories for diversity
        $categories = Product::where('status', 'Y')
            ->where('is_active', true)
            ->select('category')
            ->distinct()
            ->get()
            ->pluck('category');

        // Get stats for the home page
        $stats = [
            'total_products' => Product::where('status', 'Y')
                ->where('is_active', true)
                ->where('stock_quantity', '>', 0)
                ->count(),
            'total_categories' => $categories->count(),
            'organic_products' => Product::where('status', 'Y')
                ->where('is_active', true)
                ->where('is_organic', true)
                ->count(),
        ];

        return view('welcome-new', compact('featuredProducts', 'stats', 'categories'));
    }
}
