<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Products Management - FarmLink Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'farm-green': '#2d5016',
                        'farm-cream': '#f5f5dc',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-green-50 via-white to-green-50 min-h-screen">
    @include('components.navigation-bar')

    <!-- Modals -->
    @include('components.success-modal')
    @include('components.error-modal')
    @include('components.confirm-modal')

    <div class="pt-16 pb-12 bg-gradient-to-br from-green-50 via-white to-green-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Hero Section -->
            <div class="w-screen relative left-1/2 right-1/2 -ml-[50vw] -mr-[50vw] bg-gradient-to-r from-green-600 to-green-700 text-white py-12 mb-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-4xl font-bold mb-2">Manage Products</h1>
                            <p class="text-green-100">Manage all products in the FarmLink marketplace</p>
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-24 h-24 text-green-500 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats with Modern Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Products -->
                <div class="group relative bg-white rounded-2xl shadow-lg transition-all duration-300 p-6 border border-gray-100 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-500/10 to-green-600/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Products</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $products->total() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Active Products -->
                <div class="group relative bg-white rounded-2xl shadow-lg transition-all duration-300 p-6 border border-gray-100 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-500/10 to-green-600/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Active Products</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ \App\Models\Product::where('is_active', true)->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Low Stock -->
                <div class="group relative bg-white rounded-2xl shadow-lg transition-all duration-300 p-6 border border-gray-100 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-400/10 to-green-500/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-green-400 to-green-500 rounded-xl p-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Low Stock</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ \App\Models\Product::where('stock_quantity', '<', 10)->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Organic Products -->
                <div class="group relative bg-white rounded-2xl shadow-lg transition-all duration-300 p-6 border border-gray-100 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-600/10 to-green-700/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-green-600 to-green-700 rounded-xl p-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Organic</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ \App\Models\Product::where('is_organic', true)->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl p-8 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">All Products</h3>
                        <p class="text-gray-500 mt-1">Manage products across the marketplace</p>
                    </div>
                </div>

                    @if($products->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($products as $product)
                            <div class="group bg-white border border-gray-200 rounded-xl shadow-md transition-all duration-300 overflow-hidden">
                                <!-- Product Image -->
                                <div class="relative h-48 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                                    @php
                                        $firstImage = is_array($product->image_path) ? ($product->image_path[0] ?? null) : $product->image_path;
                                    @endphp
                                    @if($firstImage)
                                        <img src="{{ asset('storage/products/thumbnails/' . $firstImage) }}" 
                                             alt="{{ $product->name }}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <!-- Badges -->
                                    @if($product->is_organic)
                                        <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                            🌿 Organic
                                        </div>
                                    @endif
                                    @if($product->stock_quantity < 10)
                                        <div class="absolute bottom-3 left-3 bg-green-400 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                            ⚠️ Low Stock
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Details -->
                                <div class="p-5">
                                    <div class="mb-3">
                                        <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-green-600 transition-colors">{{ $product->name }}</h3>
                                        <p class="text-sm text-gray-500">{{ $product->category }}</p>
                                    </div>
                                    
                                    <div class="space-y-2 mb-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-2xl font-bold text-green-600">₱{{ number_format($product->price, 2) }}</span>
                                            <span class="text-sm text-gray-500">/{{ $product->unit }}</span>
                                        </div>
                                        <div class="flex items-center text-sm">
                                            <svg class="w-4 h-4 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-gray-600">{{ $product->stock_quantity }} {{ $product->unit }} in stock</span>
                                        </div>
                                        @if($product->user)
                                            <div class="flex items-center text-sm">
                                                <svg class="w-4 h-4 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                                                </svg>
                                                <span class="text-gray-600">Seller: {{ $product->user->name }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Actions -->
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.products.show', $product) }}" 
                                           class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white text-center py-2 px-4 rounded-lg font-semibold transition-all duration-200">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($products->hasPages())
                        <div class="mt-8">
                            {{ $products->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-20 bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl">
                        <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-green-100 to-green-200 rounded-full mb-6">
                            <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-3">No Products Yet</h3>
                        <p class="text-gray-600 text-lg mb-6 max-w-md mx-auto">Get started by adding your first product to the marketplace!</p>
                        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add Your First Product
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>