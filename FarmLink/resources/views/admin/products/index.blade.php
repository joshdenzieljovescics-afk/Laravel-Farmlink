@extends('admin.layout')

@section('title', 'Products Management')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Product Management</h1>
    <a href="{{ route('admin.products.create') }}" 
       class="bg-admin-accent text-white px-6 py-2 rounded-lg hover:bg-green-600 transition duration-300">
        Add New Product
    </a>
</div>

<!-- Products Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                📦
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-700">Total Products</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $products->total() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                ✅
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-700">Active Products</h3>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Product::where('is_active', true)->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                📊
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-700">Low Stock</h3>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Product::where('stock_quantity', '<', 10)->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                🌱
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-700">Organic Products</h3>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Product::where('is_organic', true)->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Products Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">All Products</h2>
    </div>
    
    @if($products->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @php
                                        $firstImage = is_array($product->image_path) ? ($product->image_path[0] ?? null) : $product->image_path;
                                    @endphp
                                    @if($firstImage)
                                        <img src="{{ asset('storage/' . $firstImage) }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-lg object-cover mr-4">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center mr-4">
                                            🥬
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($product->description, 40) }}</div>
                                        @if($product->is_organic)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Organic
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $product->category }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                ₱{{ number_format($product->price, 2) }}/{{ $product->unit }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900">{{ $product->stock_quantity }}</span>
                                @if($product->stock_quantity < 10)
                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Low Stock
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($product->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.products.show', $product) }}" 
                                       class="text-blue-600 hover:text-blue-900">View</a>
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" 
                                          class="inline" 
                                          onsubmit="return confirm('Are you sure you want to archive this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-orange-600 hover:text-orange-900">Archive</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $products->links() }}
        </div>
    @else
        <div class="px-6 py-12 text-center">
            <div class="text-gray-500 text-lg mb-4">📦</div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No products yet</h3>
            <p class="text-gray-500 mb-4">Get started by adding your first product.</p>
            <a href="{{ route('admin.products.create') }}" 
               class="bg-admin-accent text-white px-6 py-2 rounded-lg hover:bg-green-600 transition duration-300">
                Add First Product
            </a>
        </div>
    @endif
</div>
@endsection