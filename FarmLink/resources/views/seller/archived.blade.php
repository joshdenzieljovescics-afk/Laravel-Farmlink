<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Archived Products - FarmLink Seller</title>
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
    @include('navigation-menu')

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
                            <h1 class="text-4xl font-bold mb-2">Archived Products</h1>
                            <p class="text-green-100">Manage your archived products - restore or permanently delete</p>
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-24 h-24 text-green-500 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Button -->
            <div class="flex gap-3 mb-8">
                <a href="{{ route('seller.dashboard') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-5 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Dashboard
                </a>
            </div>
            <!-- Quick Stats with Modern Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Total Archived -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-6 border border-gray-100 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-500/10 to-green-600/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Archived</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $products->total() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Can Be Restored -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-6 border border-gray-100 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-600/10 to-green-700/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-green-600 to-green-700 rounded-xl p-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Can Be Restored</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $products->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl p-8 border border-gray-100">
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
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300 opacity-75">
                                @else
                                    <div class="w-full h-full flex items-center justify-center opacity-75">
                                        <svg class="h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Archived Badge -->
                                <div class="absolute top-3 left-3 bg-gray-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                    Archived
                                </div>

                                <!-- Organic Badge -->
                                @if($product->is_organic)
                                    <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                        🌿 Organic
                                    </div>
                                @endif
                            </div>

                            <!-- Product Details -->
                            <div class="p-5">
                                <div class="mb-3">
                                    <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-green-600 transition-colors">{{ $product->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $product->category }}</p>
                                    @if($product->farm_name)
                                        <p class="text-xs text-gray-400 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                            {{ $product->farm_name }}
                                        </p>
                                    @endif
                                </div>

                                
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-2xl font-bold text-green-600">₱{{ number_format($product->price, 2) }}</span>
                                        <span class="text-sm text-gray-500">/{{ $product->unit }}</span>
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        <div>Archived {{ $product->deleted_at->diffForHumans() }}</div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex gap-2">
                                    <form id="restore-form-{{ $product->id }}" 
                                          method="POST" 
                                          action="{{ route('seller.products.restore', $product->id) }}" 
                                          class="flex-1"
                                          x-data="{ restoreFormId: 'restore-form-{{ $product->id }}' }">
                                        @csrf
                                        <button type="button" 
                                                @click="$dispatch('open-confirm-modal', { title: 'Restore Product', message: 'Are you sure you want to restore this product? It will be available again in your products list.', confirmText: 'Restore', cancelText: 'Cancel', type: 'info', formId: restoreFormId })"
                                                class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white text-center py-2 px-4 rounded-lg font-semibold transition-all duration-200">
                                            Restore
                                        </button>
                                    </form>
                                    <form id="delete-form-{{ $product->id }}" 
                                          method="POST" 
                                          action="{{ route('seller.products.forceDelete', $product->id) }}" 
                                          class="flex-1"
                                          x-data="{ deleteFormId: 'delete-form-{{ $product->id }}' }">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                @click="$dispatch('open-confirm-modal', { title: 'Permanently Delete', message: 'Are you sure you want to PERMANENTLY delete this product? This action CANNOT be undone!', confirmText: 'Delete Forever', cancelText: 'Cancel', type: 'danger', formId: deleteFormId })"
                                                class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white py-2 px-4 rounded-lg font-semibold transition-all duration-200">
                                            Delete
                                        </button>
                                    </form>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-3">No Archived Products</h3>
                    <p class="text-gray-600 text-lg mb-6 max-w-md mx-auto">Products that you archive will appear here. You can restore them anytime or delete them permanently.</p>
                </div>
            @endif
            </div>
        </div>
    </div>
</body>
</html>
