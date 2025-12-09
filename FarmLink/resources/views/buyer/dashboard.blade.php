<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buyer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Welcome back, {{ Auth::user()->name }}! 👋</h3>
                        <p class="text-gray-600 mt-2">Discover fresh produce from local farmers</p>
                    </div>
                    <a href="{{ route('products') }}" 
                       class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition duration-150">
                        Browse All Products
                    </a>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-lg rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm text-gray-500">Available Products</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $featuredProducts->count() }}+</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm text-gray-500">Categories</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $categories->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm text-gray-500">Fresh Daily</p>
                            <p class="text-2xl font-semibold text-gray-800">24/7</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Products -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Featured Products</h3>

                @if($featuredProducts->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No products available</h3>
                        <p class="mt-1 text-sm text-gray-500">Check back soon for fresh produce!</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($featuredProducts as $product)
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition duration-200">
                                <!-- Product Image -->
                                <div class="h-48 bg-gray-200 overflow-hidden">
                                    @if($product->image_path && is_array($product->image_path) && count($product->image_path) > 0)
                                        <img src="{{ asset('storage/products/thumbnails/' . $product->image_path[0]) }}" 
                                             alt="{{ $product->name }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                            <svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Details -->
                                <div class="p-4">
                                    <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ $product->name }}</h4>
                                    <div class="space-y-1 text-sm text-gray-600 mb-3">
                                        <p><span class="font-medium">Category:</span> {{ $product->category }}</p>
                                        <p><span class="font-medium">Price:</span> ₱{{ number_format($product->price, 2) }}/{{ $product->unit }}</p>
                                        <p><span class="font-medium">Available:</span> {{ $product->stock_quantity }} {{ $product->unit }}</p>
                                        @if($product->is_organic)
                                            <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">🌿 Organic</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('products') }}" 
                                       class="block w-full text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition duration-150">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 text-center">
                        <a href="{{ route('products') }}" 
                           class="text-green-600 hover:text-green-700 font-semibold">
                            View All Products →
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
