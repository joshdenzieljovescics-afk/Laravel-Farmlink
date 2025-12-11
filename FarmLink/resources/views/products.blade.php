<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Products - FarmLink</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'farm-green': '#2d5016',
                        'farm-cream': '#f5f5dc',
                        'farm-brown': '#8b4513',
                        'farm-orange': '#ff6b35'
                    }
                }
            }
        }
    </script>
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-white min-h-screen">
    <!-- Include Navigation -->
    @include('components.navigation-bar')

    <!-- Main Content -->
    <main class="pt-16">
        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-gradient-to-r from-green-600 to-green-700 text-white py-16">
            <!-- Decorative background elements -->
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-60 h-60 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            
            <div class="container mx-auto px-4 relative z-10">
                <div class="text-center max-w-4xl mx-auto">
                    <h1 class="text-5xl font-bold mb-4">🌾 Our Fresh Products</h1>
                    <p class="text-xl text-green-100 mb-8">Discover farm-fresh, organic produce delivered straight from local farmers to your door</p>
                    
                    <!-- Search Bar -->
                    <div class="mb-8 max-w-2xl mx-auto">
                        <form method="GET" action="{{ route('products') }}" class="flex shadow-2xl">
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Search for fresh vegetables, fruits, herbs..." 
                                       class="w-full pl-12 pr-4 py-4 rounded-l-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500 text-lg">
                            </div>
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-r-xl font-semibold transition-all duration-200 transform hover:scale-105">
                                Search
                            </button>
                        </form>
                    </div>
                    
                    <!-- Category Filter Buttons -->
                    <div class="flex justify-center flex-wrap gap-3">
                        <a href="{{ route('products') }}" 
                           class="px-6 py-3 rounded-xl font-semibold transition-all duration-200 transform hover:scale-105 {{ !request('category') ? 'bg-white text-green-600 shadow-lg' : 'bg-white/20 text-white hover:bg-white/30' }}">
                            All Products
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('products', ['category' => strtolower($category)]) }}" 
                               class="px-6 py-3 rounded-xl font-semibold transition-all duration-200 transform hover:scale-105 {{ request('category') === strtolower($category) ? 'bg-white text-green-600 shadow-lg' : 'bg-white/20 text-white hover:bg-white/30' }}">
                                {{ $category }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Products Grid -->
        <section class="py-12 bg-gradient-to-br from-green-50 via-white to-blue-50">
            <div class="container mx-auto px-4 max-w-7xl">
                @if($products->count() > 0)
                    <!-- Results Count -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900">
                            @if(request('search'))
                                Search Results for "{{ request('search') }}"
                            @elseif(request('category'))
                                {{ ucfirst(request('category')) }} Products
                            @else
                                All Products
                            @endif
                        </h2>
                        <p class="text-gray-600 mt-1">Showing {{ $products->count() }} product(s)</p>
                    </div>

                    <div id="products-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($products as $product)
                            <div class="bg-white border border-gray-200 rounded-xl shadow-md overflow-hidden" data-category="{{ strtolower($product->category) }}">
                                <!-- Product Image -->
                                <div class="relative h-48 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                                    @if($product->image_path && is_array($product->image_path) && count($product->image_path) > 0)
                                        <img src="{{ asset('storage/products/thumbnails/' . $product->image_path[0]) }}" 
                                             alt="{{ $product->name }}" 
                                             class="w-full h-full object-cover"
                                             loading="lazy">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    @if($product->is_organic)
                                        <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                            🌿 Organic
                                        </div>
                                    @endif
                                    @if($product->stock_quantity <= 10 && $product->stock_quantity > 0)
                                        <div class="absolute top-3 left-3 bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                            ⚡ Low Stock
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Product Details -->
                                <div class="p-5">
                                    <div class="mb-3">
                                        <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $product->name }}</h3>
                                        <p class="text-sm text-gray-500">{{ $product->category }}</p>
                                    </div>
                                    
                                    <div class="space-y-2 mb-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-2xl font-bold text-green-600">₱{{ number_format($product->price, 2) }}</span>
                                            <span class="text-sm text-gray-500">/{{ $product->unit }}</span>
                                        </div>
                                        <div class="flex items-center text-sm">
                                            @if($product->stock_quantity > 0)
                                                <svg class="w-4 h-4 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="text-gray-600">{{ $product->stock_quantity }} {{ $product->unit }} available</span>
                                            @else
                                                <svg class="w-4 h-4 text-red-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="text-red-600 font-medium">Out of Stock</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    @if($product->stock_quantity > 0)
                                        <button onclick="addToCart('{{ $product->id }}', {{ json_encode($product->name) }}, {{ $product->price }})" 
                                                class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-3 px-4 rounded-lg shadow-md transition-colors duration-200 flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            Add to Cart
                                        </button>
                                    @else
                                        <button disabled 
                                                class="w-full bg-gray-300 text-gray-500 py-3 px-4 rounded-lg font-semibold cursor-not-allowed">
                                            Out of Stock
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-20 bg-white rounded-2xl shadow-lg">
                        <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full mb-6">
                            <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-3">No Products Found</h3>
                        <p class="text-gray-600 text-lg mb-6 max-w-md mx-auto">
                            @if(request('search'))
                                We couldn't find any products matching "{{ request('search') }}". Try different keywords or browse all products.
                            @elseif(request('category'))
                                No products available in the "{{ ucfirst(request('category')) }}" category at the moment.
                            @else
                                No products are currently available. Check back soon for fresh produce!
                            @endif
                        </p>
                        @if(request('search') || request('category'))
                            <a href="{{ route('products') }}" class="inline-flex items-center bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                View All Products
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-green-800 to-green-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About Section -->
                <div>
                    <div class="flex items-center mb-4">
                        <span class="text-3xl mr-2">🌱</span>
                        <h3 class="text-2xl font-bold">FarmLink</h3>
                    </div>
                    <p class="text-green-100 mb-4">Connecting local farmers with fresh food lovers. Supporting sustainable agriculture and healthy living.</p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-green-100 hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ route('products') }}" class="text-green-100 hover:text-white transition-colors">Products</a></li>
                        <li><a href="{{ route('about') }}" class="text-green-100 hover:text-white transition-colors">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="text-green-100 hover:text-white transition-colors">Contact</a></li>
                        <li><a href="{{ route('developers') }}" class="text-green-100 hover:text-white transition-colors">Developers</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Categories</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-green-100 hover:text-white transition-colors">Vegetables</a></li>
                        <li><a href="#" class="text-green-100 hover:text-white transition-colors">Fruits</a></li>
                        <li><a href="#" class="text-green-100 hover:text-white transition-colors">Grains</a></li>
                        <li><a href="#" class="text-green-100 hover:text-white transition-colors">Dairy</a></li>
                        <li><a href="#" class="text-green-100 hover:text-white transition-colors">Meat</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Contact Us</h4>
                    <ul class="space-y-3 text-green-100">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Metro Manila, Philippines</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>support@farmlink.com</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>+63 123 456 7890</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-green-700 mt-8 pt-8 text-center text-green-100">
                <p>&copy; {{ date('Y') }} FarmLink. All rights reserved. Made with 💚 for local farmers.</p>
            </div>
        </div>
    </footer>

    <!-- Include Cart -->
    @include('components.cart')

    <script>
        // Initialize global cart variable if not exists
        if (typeof window.cart === 'undefined') {
            window.cart = JSON.parse(sessionStorage.getItem('farmLinkCart')) || [];
        }
        // Use reference to global cart, don't redeclare
        let cartCount = 0;

        // Function to update cart count
        window.updateCartCount = function() {
            try {
                // Always use global cart reference
                const cart = window.cart || [];
                cartCount = cart.reduce((total, item) => total + item.quantity, 0);
                const cartCountElement = document.getElementById('cart-count');
                if (cartCountElement) {
                    cartCountElement.textContent = cartCount;
                    cartCountElement.style.display = cartCount > 0 ? 'flex' : 'none';
                }
            } catch (error) {
                console.error('Error updating cart count:', error);
            }
        }

        // Function to add items to cart - now shows quantity modal
        window.addToCart = function(id, name, price) {
            try {
                console.log('addToCart called:', { id, name, price }); // Debug log
                
                // Show quantity modal instead of adding directly
                if (typeof window.showQuantityModal === 'function') {
                    window.showQuantityModal(id, name, price);
                } else {
                    // Fallback to direct add if modal not available
                    if (!window.cart || !Array.isArray(window.cart)) {
                        window.cart = JSON.parse(sessionStorage.getItem('farmLinkCart')) || [];
                    }
                    
                    const numPrice = parseFloat(price);
                    const existingItem = window.cart.find(item => item.id === id);
                    if (existingItem) {
                        existingItem.quantity += 1;
                    } else {
                        window.cart.push({ id, name, price: numPrice, quantity: 1 });
                    }
                    
                    sessionStorage.setItem('farmLinkCart', JSON.stringify(window.cart));
                    updateCartCount();
                    if (typeof window.updateCartDisplay === 'function') {
                        window.updateCartDisplay();
                    }
                    if (typeof window.showToast === 'function') {
                        window.showToast(`${name} added to cart!`, 'success');
                    }
                }
                
                return true;
            } catch (error) {
                console.error('Error in addToCart:', error);
                alert('Error adding item to cart. Please try again.');
                return false;
            }
        }

        // Initialize cart count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
            updateCartDisplay(); // Initialize cart display
        });
    </script>
</body>
</html>