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
<body class="bg-farm-cream min-h-screen">
    <!-- Include Navigation -->
    @include('components.navigation-bar')

    <!-- Main Content -->
    <main class="pt-20">
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-farm-green to-green-600 text-white py-16">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-5xl font-bold mb-4">Our Products</h1>
                <p class="text-xl mb-8">Discover fresh, organic farm products delivered straight to your door</p>
                
                <!-- Search Bar -->
                <div class="mb-8 max-w-md mx-auto">
                    <form method="GET" action="{{ route('products') }}" class="flex">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Search products..." 
                               class="flex-1 px-4 py-2 rounded-l-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-farm-orange">
                        <button type="submit" class="bg-farm-orange text-white px-6 py-2 rounded-r-lg hover:bg-orange-600 transition-colors">
                            Search
                        </button>
                    </form>
                </div>
                
                <!-- Category Filter Buttons -->
                <div class="flex justify-center space-x-4 flex-wrap gap-2">
                    <a href="{{ route('products') }}" 
                       class="bg-white text-farm-green px-6 py-2 rounded-lg hover:bg-farm-cream transition-colors {{ !request('category') ? 'ring-2 ring-farm-orange' : '' }}">
                        All Products
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('products', ['category' => strtolower($category)]) }}" 
                           class="bg-farm-orange text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition-colors {{ request('category') === strtolower($category) ? 'ring-2 ring-white' : '' }}">
                            {{ $category }}
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Products Grid -->
        <section class="py-16">
            <div class="container mx-auto px-4">
                @if($products->count() > 0)
                    <div id="products-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        @foreach($products as $product)
                            <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow h-full flex flex-col" data-category="{{ strtolower($product->category) }}">
                                @if($product->image_url)
                                    <img src="{{ $product->image_url }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-48 object-cover flex-shrink-0"
                                         onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgdmlld0JveD0iMCAwIDQwMCAzMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI0MDAiIGhlaWdodD0iMzAwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNTAgMTIwSDI1MFYxODBIMTUwVjEyMFoiIGZpbGw9IiNEMUQ1REIiLz4KPGV0ZXh0IHg9IjIwMCIgeT0iMjEwIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiM2QjczODAiPk5vIEltYWdlPC90ZXh0Pgo8L3N2Zz4K'; this.classList.add('bg-gray-200', 'flex', 'items-center', 'justify-center'); this.classList.remove('object-cover');"
                                         loading="lazy">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center flex-shrink-0">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                                <div class="p-6 flex flex-col flex-grow">
                                    <div class="flex items-start justify-between mb-2">
                                        <h3 class="text-xl font-semibold text-farm-green flex-1 mr-2">{{ $product->name }}</h3>
                                        @if($product->is_organic)
                                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full flex-shrink-0">Organic</span>
                                        @endif
                                    </div>
                                    
                                    <!-- Description with fixed height -->
                                    <div class="h-12 mb-3">
                                        <p class="text-gray-600 text-sm line-clamp-2">{{ Str::limit($product->description, 80) }}</p>
                                    </div>
                                    
                                    <!-- Farm name with fixed height -->
                                    <div class="h-6 mb-4">
                                        @if($product->farm_name)
                                            <p class="text-sm text-farm-green font-medium">From {{ $product->farm_name }}</p>
                                        @endif
                                    </div>
                                    
                                    <!-- Spacer to push content to bottom -->
                                    <div class="flex-grow"></div>
                                    
                                    <!-- Stock warning -->
                                    @if($product->stock_quantity > 0 && $product->stock_quantity <= 10)
                                        <p class="text-orange-600 text-xs mb-3">Only {{ $product->stock_quantity }} left!</p>
                                    @endif
                                    
                                    <!-- Price and button section - always at bottom -->
                                    <div class="flex justify-between items-center mt-auto">
                                        <div class="flex-1">
                                            <span class="text-2xl font-bold text-farm-orange">₱{{ number_format($product->price, 2) }}</span>
                                            <span class="text-sm text-gray-500">/{{ $product->unit }}</span>
                                        </div>
                                        <div class="flex-shrink-0">
                                            @if($product->stock_quantity > 0)
                                                <button onclick="addToCart('{{ $product->id }}', {{ json_encode($product->name) }}, {{ $product->price }})" 
                                                        class="bg-farm-green text-white px-4 py-2 rounded hover:bg-green-700 transition-colors whitespace-nowrap">
                                                    Add to Cart
                                                </button>
                                            @else
                                                <span class="bg-gray-100 text-gray-500 px-4 py-2 rounded whitespace-nowrap">Out of Stock</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="text-gray-500">
                            <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <h3 class="text-2xl font-medium text-gray-900 mb-2">No products found</h3>
                            <p class="text-gray-500">
                                @if(request('search'))
                                    No products match your search "{{ request('search') }}".
                                @elseif(request('category'))
                                    No products found in the "{{ ucfirst(request('category')) }}" category.
                                @else
                                    No products are currently available.
                                @endif
                            </p>
                            @if(request('search') || request('category'))
                                <a href="{{ route('products') }}" class="inline-block mt-4 bg-farm-green text-white px-6 py-2 rounded hover:bg-green-700 transition-colors">
                                    View All Products
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>

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

        // Function to add items to cart
        window.addToCart = function(id, name, price) {
            try {
                console.log('addToCart called:', { id, name, price }); // Debug log
                
                // Ensure cart is properly initialized
                if (!window.cart || !Array.isArray(window.cart)) {
                    window.cart = JSON.parse(sessionStorage.getItem('farmLinkCart')) || [];
                }
                
                // Convert price to number to ensure proper calculation
                const numPrice = parseFloat(price);
                
                const existingItem = window.cart.find(item => item.id === id);
                if (existingItem) {
                    existingItem.quantity += 1;
                    console.log('Updated existing item:', existingItem);
                } else {
                    const newItem = { id, name, price: numPrice, quantity: 1 };
                    window.cart.push(newItem);
                    console.log('Added new item:', newItem);
                }
                
                // Save to sessionStorage
                sessionStorage.setItem('farmLinkCart', JSON.stringify(window.cart));
                console.log('Cart updated:', window.cart);
                
                // Update UI
                updateCartCount();
                if (typeof window.updateCartDisplay === 'function') {
                    window.updateCartDisplay();
                }
                
                // Show toast notification
                if (typeof window.showToast === 'function') {
                    window.showToast(`${name} added to cart!`, 'success');
                } else {
                    alert(`${name} added to cart!`); // Fallback
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