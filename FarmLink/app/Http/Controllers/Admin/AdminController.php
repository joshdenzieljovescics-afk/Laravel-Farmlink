<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'low_stock' => Product::where('stock_quantity', '<=', 10)->count(),
            'total_users' => User::count(),
        ];
        $recent_products = Product::latest()->take(5)->get();

        $low_stock_products = Product::where('stock_quantity', '<=', 10)
            ->where('is_active', true)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_products', 'low_stock_products'));
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }
}