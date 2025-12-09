<x-app-layout>
    <div class="pt-20 pb-12 bg-gradient-to-br from-green-50 via-white to-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Section with Gradient -->
            <div class="relative overflow-hidden bg-gradient-to-r from-green-600 to-green-700 rounded-2xl shadow-2xl mb-8 p-8">
                <!-- Decorative background elements -->
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-60 h-60 bg-white/10 rounded-full blur-3xl"></div>
                
                <div class="relative flex flex-col md:flex-row items-center justify-between">
                    <div class="mb-6 md:mb-0">
                        <h1 class="text-4xl font-bold text-white mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-green-100 text-lg">Discover fresh, organic produce from local farmers</p>
                        <div class="flex items-center mt-4 space-x-4">
                            <div class="flex items-center text-white/90">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm">100% Organic</span>
                            </div>
                            <div class="flex items-center text-white/90">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                                </svg>
                                <span class="text-sm">Fast Delivery</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('products') }}" 
                       class="group relative bg-white text-green-600 font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">
                        <span class="flex items-center">
                            Browse All Products
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>

            <!-- Quick Stats with Modern Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Stat Card 1 -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-6 border border-gray-100 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-500/10 to-green-600/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Available Products</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $featuredProducts->count() }}+</p>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-6 border border-gray-100 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-blue-600/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Categories</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $categories->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 3 -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-6 border border-gray-100 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-yellow-500/10 to-orange-500/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl p-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Fresh Daily</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">24/7</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Products -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl p-8 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Featured Products</h3>
                        <p class="text-gray-500 mt-1">Fresh picks from local farmers</p>
                    </div>
                    <a href="{{ route('products') }}" class="text-green-600 hover:text-green-700 font-semibold flex items-center group">
                        View All
                        <svg class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>

                @if($featuredProducts->isEmpty())
                    <div class="text-center py-16 bg-gray-50 rounded-xl">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                            <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">No products available</h3>
                        <p class="text-gray-500">Check back soon for fresh produce!</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($featuredProducts as $product)
                            <div class="group bg-white border border-gray-200 rounded-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                                <!-- Product Image -->
                                <div class="relative h-48 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                                    @if($product->image_path && is_array($product->image_path) && count($product->image_path) > 0)
                                        <img src="{{ asset('storage/products/thumbnails/' . $product->image_path[0]) }}" 
                                             alt="{{ $product->product_name }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    @if($product->is_organic)
                                        <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg backdrop-blur-sm">
                                            🌿 Organic
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Details -->
                                <div class="p-5">
                                    <h4 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">{{ $product->name }}</h4>
                                    <div class="space-y-2 mb-4">
                                        <div class="flex items-center justify-between text-sm">
                                            <span class="text-gray-500">Category</span>
                                            <span class="font-medium text-gray-700">{{ $product->category }}</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-2xl font-bold text-green-600">₱{{ number_format($product->price, 2) }}</span>
                                            <span class="text-sm text-gray-500">/{{ $product->unit }}</span>
                                        </div>
                                        <div class="flex items-center text-sm">
                                            <svg class="w-4 h-4 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-gray-600">{{ $product->stock_quantity }} {{ $product->unit }} available</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('products') }}" 
                                       class="block w-full text-center bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transform transition-all duration-200 group-hover:scale-105">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
