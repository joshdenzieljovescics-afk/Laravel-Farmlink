<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product Details - FarmLink Admin</title>
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
                        <div class="flex items-center mb-2">
                            <a href="{{ route('admin.products.index') }}" 
                               class="text-green-100 hover:text-white mr-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Products
                            </a>
                        </div>
                        <h1 class="text-4xl font-bold mb-2">{{ $product->name }}</h1>
                        <p class="text-green-100">{{ $product->category }} • {{ $product->farm_name ?? 'Local Farm' }}</p>
                    </div>
                    <div class="hidden md:block">
                        <svg class="w-24 h-24 text-green-500 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3 mb-8">
            <a href="{{ route('admin.products.edit', $product) }}" 
               class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-5 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Product
            </a>
            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" 
                  class="inline"
                  x-data="{ formId: 'archive-form-{{ $product->id }}' }">
                @csrf
                @method('DELETE')
                <button type="button"
                        @click="$dispatch('open-confirm-modal', { title: 'Archive Product', message: 'Are you sure you want to archive this product? You can restore it later.', confirmText: 'Archive', cancelText: 'Cancel', type: 'danger', formId: formId })"
                        class="bg-orange-600 hover:bg-orange-700 text-white font-semibold py-3 px-5 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                    </svg>
                    Archive Product
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Product Image and Basic Info -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg transition-all duration-300 p-6 border border-gray-100">
                    @php
                        $images = is_array($product->image_path) ? $product->image_path : ($product->image_path ? [$product->image_path] : []);
                    @endphp
                    
                    @if(count($images) > 0)
                        <!-- Main Image -->
                        <img id="mainImage" 
                             src="{{ asset('storage/products/thumbnails/' . $images[0]) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-80 object-cover rounded-xl mb-4 border-4 border-green-100">
                        
                        <!-- Image Gallery Thumbnails -->
                        @if(count($images) > 1)
                            <div class="grid grid-cols-4 gap-2 mb-6">
                                @foreach($images as $index => $imagePath)
                                    <img src="{{ asset('storage/products/thumbnails/' . $imagePath) }}" 
                                         alt="{{ $product->name }} {{ $index + 1 }}" 
                                         onclick="changeMainImage('{{ asset('storage/products/thumbnails/' . $imagePath) }}')"
                                         class="w-full h-16 object-cover rounded-lg cursor-pointer border-2 border-gray-200 hover:border-green-500 transition-all duration-200">
                                @endforeach
                            </div>
                            <script>
                                function changeMainImage(src) {
                                    document.getElementById('mainImage').src = src;
                                }
                            </script>
                        @endif
                    @else
                        <div class="w-full h-80 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center mb-4">
                            <span class="text-8xl">🥬</span>
                        </div>
                    @endif
                    
                    <div class="space-y-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 uppercase tracking-wide mb-1">Price</p>
                                <span class="text-4xl font-bold text-green-600">
                                    ₱{{ number_format($product->price, 2) }}
                                </span>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500 uppercase tracking-wide mb-1">Per Unit</p>
                                <span class="text-xl font-semibold text-gray-700">{{ $product->unit }}</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            @if($product->is_organic)
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-green-500 to-green-600 text-white shadow-sm">
                                    🌱 Certified Organic
                                </span>
                            @endif
                        </div>

                        <!-- Stock Status Badge -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Stock Status</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $product->stock_quantity }}</p>
                                </div>
                                <div>
                                    @if($product->stock_quantity > 20)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                            ✓ In Stock
                                        </span>
                                    @elseif($product->stock_quantity > 0)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                                            ⚠ Low Stock
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                            ✕ Out of Stock
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Description -->
                <div class="bg-white rounded-2xl shadow-lg transition-all duration-300 p-6 border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Description
                    </h2>
                    <p class="text-gray-600 leading-relaxed text-lg">{{ $product->description }}</p>
                </div>

                <!-- Product Information -->
                <div class="bg-white rounded-2xl shadow-lg transition-all duration-300 p-6 border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Product Information
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4">
                            <label class="block text-sm font-semibold text-green-800 uppercase tracking-wide mb-2">Category</label>
                            <p class="text-gray-900 text-lg font-medium">{{ $product->category }}</p>
                        </div>
                        
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4">
                            <label class="block text-sm font-semibold text-blue-800 uppercase tracking-wide mb-2">Stock Quantity</label>
                            <p class="text-gray-900 text-lg font-medium">
                                {{ $product->stock_quantity }} {{ $product->unit }}{{ $product->stock_quantity !== 1 ? 's' : '' }}
                            </p>
                        </div>
                        
                        @if($product->farm_name)
                            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl p-4">
                                <label class="block text-sm font-semibold text-yellow-800 uppercase tracking-wide mb-2">Farm</label>
                                <p class="text-gray-900 text-lg font-medium">{{ $product->farm_name }}</p>
                            </div>
                        @endif
                        
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4">
                            <label class="block text-sm font-semibold text-purple-800 uppercase tracking-wide mb-2">Unit of Measure</label>
                            <p class="text-gray-900 text-lg font-medium">{{ $product->unit }}</p>
                        </div>
                        
                        <div class="bg-gradient-to-br from-pink-50 to-pink-100 rounded-xl p-4">
                            <label class="block text-sm font-semibold text-pink-800 uppercase tracking-wide mb-2">Created At</label>
                            <p class="text-gray-900 text-lg font-medium">{{ $product->created_at->format('M d, Y') }}</p>
                        </div>
                        
                        <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl p-4">
                            <label class="block text-sm font-semibold text-indigo-800 uppercase tracking-wide mb-2">Last Updated</label>
                            <p class="text-gray-900 text-lg font-medium">{{ $product->updated_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>