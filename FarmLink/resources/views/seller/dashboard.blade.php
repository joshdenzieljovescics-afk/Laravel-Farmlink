@extends('seller.layout')

@section('title', 'My Products')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">My Products</h2>
        <a href="{{ route('seller.products.create') }}" class="bg-seller-primary hover:bg-seller-secondary text-white px-6 py-2 rounded-lg transition duration-300">
            + Add New Product
        </a>
    </div>

    @if($products->isEmpty())
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <div class="text-gray-400 text-6xl mb-4">📦</div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No Products Yet</h3>
            <p class="text-gray-500 mb-4">Start selling your farm produce by adding your first product!</p>
            <a href="{{ route('seller.products.create') }}" class="inline-block bg-seller-primary hover:bg-seller-secondary text-white px-6 py-3 rounded-lg transition duration-300">
                Add Your First Product
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                    <!-- Product Image -->
                    <div class="h-48 bg-gray-200 overflow-hidden">
                        @if($product->image_path && is_array($product->image_path) && count($product->image_path) > 0)
                            <img src="{{ asset('storage/products/thumbnails/' . $product->image_path[0]) }}" 
                                 alt="{{ $product->product_name }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-4xl">
                                🌾
                            </div>
                        @endif
                    </div>

                    <!-- Product Details -->
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $product->product_name }}</h3>
                        
                        <div class="space-y-1 text-sm text-gray-600 mb-3">
                            <p><span class="font-medium">Category:</span> {{ $product->product_category }}</p>
                            <p><span class="font-medium">Price:</span> ₱{{ number_format($product->price, 2) }}/{{ $product->unit_measure }}</p>
                            <p><span class="font-medium">Available:</span> {{ $product->avail_qty }} {{ $product->unit_measure }}</p>
                            @if($product->farm_name)
                                <p><span class="font-medium">Farm:</span> {{ $product->farm_name }}</p>
                            @endif
                            @if($product->is_organic)
                                <p class="text-green-600 font-medium">🌱 Organic</p>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2 mt-4">
                            <a href="{{ route('seller.products.edit', $product) }}" 
                               class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center py-2 rounded transition duration-300">
                                Edit
                            </a>
                            <form action="{{ route('seller.products.destroy', $product) }}" 
                                  method="POST" 
                                  class="flex-1"
                                  onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded transition duration-300">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
