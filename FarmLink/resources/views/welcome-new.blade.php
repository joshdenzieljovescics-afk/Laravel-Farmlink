<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FarmLink - Fresh Produce Marketplace</title>
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
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s ease-out',
                        'fade-in': 'fadeIn 0.8s ease-out',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .gradient-text {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gradient-to-b from-white to-gray-50 min-h-screen">
    <!-- Include Navigation -->
    @include('components.navigation-bar')
    
    <!-- Main Content -->
    <main class="pt-20">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-green-600 via-green-500 to-emerald-600 text-white py-24 md:py-32 overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"1\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>
            
            <div class="container mx-auto px-6 relative z-10">
                <div class="max-w-4xl mx-auto text-center animate-fade-in-up">
                    <div class="inline-block bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                        <span class="text-sm font-semibold">🌾 Farm Fresh, Delivered to You</span>
                    </div>
                    <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                        Welcome to <span class="text-yellow-300">FarmLink</span>
                    </h1>
                    <p class="text-xl md:text-2xl mb-10 text-green-50 leading-relaxed max-w-3xl mx-auto">
                        Connect directly with local farmers for the freshest organic produce. From farm to table, simplified and sustainable.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="{{ route('products') }}" class="group bg-white text-green-600 px-8 py-4 rounded-xl font-bold text-lg hover:bg-yellow-300 hover:text-green-700 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            Shop Now
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        <a href="#about" class="group border-2 border-white/30 backdrop-blur-sm bg-white/10 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white hover:text-green-600 transition-all duration-300 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Learn More
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="mt-16 grid grid-cols-3 gap-8 max-w-2xl mx-auto">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-yellow-300 mb-2">500+</div>
                            <div class="text-sm text-green-100">Local Farmers</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-yellow-300 mb-2">10k+</div>
                            <div class="text-sm text-green-100">Happy Customers</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-yellow-300 mb-2">100%</div>
                            <div class="text-sm text-green-100">Organic Products</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Wave Shape -->
            <div class="absolute bottom-0 left-0 right-0">
                <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                    <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
                </svg>
            </div>
        </section>

    <!-- Image Slider Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    <span class="gradient-text">Fresh from the Farm</span>
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Discover our handpicked selection of farm-fresh produce, delivered straight to your doorstep
                </p>
            </div>
            @include('components.image-slider')
        </div>
    </section>

    <!-- Featured Products Section -->
    <section id="products" class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <div class="inline-block bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    ⭐ Featured Collection
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    <span class="gradient-text">Trending Products</span>
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Explore our most popular fresh produce, sourced from local sustainable farms
                </p>
            </div>
            
            @if($featuredProducts->count() > 0)
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($featuredProducts as $product)
                        <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 transform hover:-translate-y-2">
                            <!-- Product Image -->
                            <div class="relative h-56 overflow-hidden bg-gradient-to-br from-green-50 to-emerald-50">
                                @if($product->image_path && is_array($product->image_path) && count($product->image_path) > 0)
                                    <img src="{{ asset('storage/' . $product->image_path[0]) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-green-100 to-emerald-100 flex items-center justify-center">
                                        <svg class="w-24 h-24 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Organic Badge -->
                                @if($product->is_organic)
                                    <div class="absolute top-3 right-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg flex items-center space-x-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span>ORGANIC</span>
                                    </div>
                                @endif
                                
                                <!-- Quick View Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            
                            <!-- Product Info -->
                            <div class="p-5">
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="text-lg font-bold text-gray-800 line-clamp-1 flex-1">{{ $product->name }}</h3>
                                    <div class="flex items-center space-x-1 text-yellow-400">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span class="text-xs text-gray-600 font-medium">4.8</span>
                                    </div>
                                </div>
                                
                                <p class="text-gray-500 text-sm mb-3 line-clamp-2 leading-relaxed">{{ Str::limit($product->description, 70) }}</p>
                                
                                <div class="flex items-center text-xs text-gray-500 mb-4">
                                    <svg class="w-4 h-4 mr-1 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="font-medium">{{ $product->farm_name ?? $product->seller->name ?? 'Local Farm' }}</span>
                                </div>
                                
                                <div class="flex items-end justify-between pt-3 border-t border-gray-100">
                                    <div>
                                        <div class="text-2xl font-bold text-green-600">₱{{ number_format($product->price, 2) }}</div>
                                        <div class="text-xs text-gray-500">per {{ $product->unit }}</div>
                                    </div>
                                    <button onclick="addToCart('{{ $product->id }}', '{{ $product->name }}', {{ $product->price }})" 
                                            class="group/btn bg-gradient-to-r from-green-600 to-emerald-600 text-white px-5 py-2.5 rounded-xl hover:shadow-lg transition-all duration-300 text-sm font-semibold flex items-center space-x-2 hover:scale-105">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        <span>Add</span>
                                    </button>
                                </div>
                                
                                <div class="mt-3 flex items-center justify-between text-xs">
                                    <span class="text-gray-500">
                                        <span class="font-semibold text-green-600">{{ $product->stock_quantity }}</span> {{ $product->unit }}{{ $product->stock_quantity > 1 ? 's' : '' }} left
                                    </span>
                                    @if($product->stock_quantity < 10)
                                        <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full font-medium">Low Stock!</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <h3 class="mt-4 text-xl font-medium text-gray-900">No products available yet</h3>
                    <p class="mt-2 text-gray-500">Check back soon for fresh produce from local farmers!</p>
                </div>
            @endif
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl font-bold mb-8 text-farm-green">About FarmLink</h2>
                <p class="text-lg text-gray-600 mb-8">
                    FarmLink bridges the gap between local farmers and consumers, ensuring you get the freshest produce 
                    while supporting your local agricultural community. Our platform makes it easy to discover, order, 
                    and receive farm-fresh products directly from the source.
                </p>
                <div class="grid md:grid-cols-3 gap-8 mt-12">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-farm-green rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-2xl">🌱</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Fresh & Local</h3>
                        <p class="text-gray-600">Directly from local farms to your table</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-farm-green rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-2xl">🚚</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Fast Delivery</h3>
                        <p class="text-gray-600">Quick and reliable delivery service</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-farm-green rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-2xl">💚</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Support Local</h3>
                        <p class="text-gray-600">Help your community farmers thrive</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-4xl font-bold text-center mb-12 text-farm-green">Get In Touch</h2>
                <div class="grid md:grid-cols-2 gap-12">
                    <div>
                        <h3 class="text-2xl font-semibold mb-6">Contact Information</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <span class="text-farm-green text-xl mr-3">📍</span>
                                <span>123 Farm Street, Agriculture City, AC 12345</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-farm-green text-xl mr-3">📞</span>
                                <span>(555) 123-FARM</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-farm-green text-xl mr-3">✉️</span>
                                <span>hello@farmlink.com</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <form class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-farm-green focus:border-farm-green">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-farm-green focus:border-farm-green">
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                                <textarea id="message" name="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-farm-green focus:border-farm-green"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-farm-green text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">FarmLink</h3>
                    <p class="text-gray-300">Connecting farms to families for fresher, healthier communities.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white transition duration-300">Home</a></li>
                        <li><a href="#products" class="hover:text-white transition duration-300">Products</a></li>
                        <li><a href="#about" class="hover:text-white transition duration-300">About</a></li>
                        <li><a href="#contact" class="hover:text-white transition duration-300">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white transition duration-300">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Shipping Info</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Returns</a></li>
                        <li><a href="/developers" class="hover:text-white transition duration-300">Developers</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition duration-300">Facebook</a>
                        <a href="#" class="text-gray-300 hover:text-white transition duration-300">Twitter</a>
                        <a href="#" class="text-gray-300 hover:text-white transition duration-300">Instagram</a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; 2025 FarmLink. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Include Cart Component -->
    @include('components.cart')

    <script>
        // Initialize CSRF token for JavaScript
        window.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Use the same cart format as cart.blade.php
        if (typeof window.cart === 'undefined') {
            window.cart = JSON.parse(sessionStorage.getItem('farmLinkCart')) || [];
        }
        
        // Save cart to session storage
        function saveCart() {
            sessionStorage.setItem('farmLinkCart', JSON.stringify(window.cart));
            updateCartDisplay();
            // Update cart count if function exists
            if (typeof window.updateCartCount === 'function') {
                window.updateCartCount();
            }
        }
        
        // Add item to cart
        function addToCart(id, name, price) {
            const existingItem = window.cart.find(item => item.id === id);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                window.cart.push({ id: id, name: name, price: price, quantity: 1 });
            }
            saveCart();
            showToast(`${name} added to cart!`, 'success');
        }
        
        // Update cart display
        function updateCartDisplay() {
            const cartCount = document.getElementById('cart-count');
            const cartItems = document.getElementById('cart-items');
            const cartTotal = document.getElementById('cart-total');
            
            const totalItems = window.cart.reduce((sum, item) => sum + item.quantity, 0);
            const totalPrice = window.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            
            if (cartCount) cartCount.textContent = totalItems;
            if (cartTotal) cartTotal.textContent = `₱${totalPrice.toFixed(2)}`;
            
            if (cartItems) {
                cartItems.innerHTML = '';
                window.cart.forEach((item) => {
                    const cartItem = document.createElement('div');
                    cartItem.className = 'flex justify-between items-center p-3 border-b';
                    cartItem.innerHTML = `
                        <div>
                            <h4 class="font-semibold">${item.name}</h4>
                            <p class="text-sm text-gray-600">₱${item.price} x ${item.quantity}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button onclick="decreaseQuantity('${item.id}')" class="px-2 py-1 bg-gray-200 rounded">-</button>
                            <span>${item.quantity}</span>
                            <button onclick="addToCart('${item.id}', '${item.name}', ${item.price})" class="px-2 py-1 bg-gray-200 rounded">+</button>
                            <button onclick="removeFromCart('${item.id}')" class="text-red-500 ml-2">×</button>
                        </div>
                    `;
                    cartItems.appendChild(cartItem);
                });
            }
        }
        
        // Remove item from cart
        function removeFromCart(id) {
            window.cart = window.cart.filter(item => item.id !== id);
            saveCart();
        }
        
        // Decrease quantity
        function decreaseQuantity(id) {
            const item = window.cart.find(item => item.id === id);
            if (item && item.quantity > 1) {
                item.quantity -= 1;
            } else {
                removeFromCart(id);
            }
            saveCart();
        }
        
        // Clear cart
        function clearCart() {
            window.cart = [];
            saveCart();
        }
        
        // Toast notification function
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 transition-all transform translate-x-0 opacity-100 shadow-lg ${
                type === 'success' ? 'bg-green-500' : 
                type === 'error' ? 'bg-red-500' : 
                'bg-blue-500'
            }`;
            
            const icon = type === 'success' ? '✓' : type === 'error' ? '✕' : 'ℹ';
            toast.innerHTML = `<span class="font-bold mr-2">${icon}</span>${message}`;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.transform = 'translateX(100%)';
                toast.style.opacity = '0';
                setTimeout(() => {
                    if (document.body.contains(toast)) {
                        document.body.removeChild(toast);
                    }
                }, 300);
            }, 3000);
        }
        
        // Initialize cart display on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartDisplay();
        });
    </script>
</body>
</html>