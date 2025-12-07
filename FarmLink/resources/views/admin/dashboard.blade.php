@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Dashboard Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
            <p class="mt-2 text-gray-600">Welcome to the FarmLink administration panel</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Products -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Products</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['total_products'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Products -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Active Products</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['active_products']  }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Low Stock Items -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Low Stock</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['low_stock'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['total_users'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Recent Products -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Recent Products</h3>
                    @if(isset($recent_products) && $recent_products->count() > 0)
                        <div class="space-y-3">
                            @foreach($recent_products as $product)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $product->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $product->farm_name }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium text-gray-900">₱{{ number_format($product->price, 2) }}</p>
                                        <p class="text-sm text-gray-500">Stock: {{ $product->stock_quantity }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No products found.</p>
                    @endif
                    <div class="mt-4">
                        <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:text-blue-500 font-medium">
                            View all products →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-4">
                        <a href="{{ route('admin.products.create') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-md font-medium transition duration-150 ease-in-out">
                            Add New Product
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="block w-full bg-green-600 hover:bg-green-700 text-white text-center py-3 px-4 rounded-md font-medium transition duration-150 ease-in-out">
                            Manage Products
                        </a>
                        <a href="{{ route('admin.users') }}" class="block w-full bg-purple-600 hover:bg-purple-700 text-white text-center py-3 px-4 rounded-md font-medium transition duration-150 ease-in-out">
                            Manage Users
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert -->
        @if(isset($low_stock_products) && $low_stock_products->count() > 0)
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">Low Stock Alert</h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <p>The following products are running low on stock:</p>
                        <ul class="mt-2 space-y-1">
                            @foreach($low_stock_products as $product)
                                <li>• {{ $product->name }} ({{ $product->stock_quantity }} remaining)</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection