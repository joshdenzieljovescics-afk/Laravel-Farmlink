@extends('admin.layout')

@section('title', 'Product Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center">
            <a href="{{ route('admin.products.index') }}" 
               class="text-gray-600 hover:text-gray-800 mr-4">
                ← Back to Products
            </a>
            <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>
        </div>
        <div class="flex space-x-4">
            <a href="{{ route('admin.products.edit', $product) }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Edit Product
            </a>
            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" 
                  class="inline" 
                  onsubmit="return confirm('Are you sure you want to archive this product?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition duration-300">
                    Archive Product
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Product Image and Basic Info -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6">
                @php
                    $images = is_array($product->image_path) ? $product->image_path : ($product->image_path ? [$product->image_path] : []);
                @endphp
                
                @if(count($images) > 0)
                    <!-- Main Image -->
                    <img id="mainImage" 
                         src="{{ asset('storage/' . $images[0]) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-64 object-cover rounded-lg mb-4">
                    
                    <!-- Image Gallery Thumbnails -->
                    @if(count($images) > 1)
                        <div class="grid grid-cols-4 gap-2 mb-4">
                            @foreach($images as $index => $imagePath)
                                <img src="{{ asset('storage/' . $imagePath) }}" 
                                     alt="{{ $product->name }} {{ $index + 1 }}" 
                                     onclick="changeMainImage('{{ asset('storage/' . $imagePath) }}')"
                                     class="w-full h-16 object-cover rounded cursor-pointer border-2 border-transparent hover:border-green-500 transition">
                            @endforeach
                        </div>
                        <script>
                            function changeMainImage(src) {
                                document.getElementById('mainImage').src = src;
                            }
                        </script>
                    @endif
                @else
                    <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-6xl">🥬</span>
                    </div>
                @endif
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-3xl font-bold text-green-600">
                            ₱{{ number_format($product->price, 2) }}
                        </span>
                        <span class="text-gray-500">per {{ $product->unit }}</span>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        @if($product->is_organic)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                🌱 Organic
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Description -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Description</h2>
                <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
            </div>

            <!-- Product Information -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Product Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Category</label>
                        <p class="text-gray-900">{{ $product->category }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Stock Quantity</label>
                        <p class="text-gray-900">
                            {{ $product->stock_quantity }} {{ $product->unit }}{{ $product->stock_quantity !== 1 ? 's' : '' }}
                            @if($product->stock_quantity < 10)
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                    Low Stock
                                </span>
                            @endif
                        </p>
                    </div>
                    
                    @if($product->farm_name)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Farm</label>
                            <p class="text-gray-900">{{ $product->farm_name }}</p>
                        </div>
                    @endif
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Unit</label>
                        <p class="text-gray-900">{{ $product->unit }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Created At</label>
                        <p class="text-gray-900">{{ $product->created_at->format('M d, Y') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                        <p class="text-gray-900">{{ $product->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Stock Management -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Stock Management</h2>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <p class="text-sm text-gray-500">Current Stock</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $product->stock_quantity }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Status</p>
                        @if($product->stock_quantity > 20)
                            <p class="text-green-600 font-semibold">In Stock</p>
                        @elseif($product->stock_quantity > 0)
                            <p class="text-yellow-600 font-semibold">Low Stock</p>
                        @else
                            <p class="text-red-600 font-semibold">Out of Stock</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection