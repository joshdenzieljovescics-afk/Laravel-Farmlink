<!DOCTYPE html>
<html lang="en">
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
                <h1 class="text-5xl font-bold mb-4">Welcome to FarmLink</h1>
                <p class="text-xl mb-8">Connect directly with local farmers for the freshest produce. Farm to table, simplified.</p>
                <div class="space-x-4">
                    <a href="{{ route('products') }}" class="bg-white text-farm-green px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 inline-block">
                        Shop Now
                    </a>
                    <a href="#about" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-farm-green transition duration-300 inline-block">
                        Learn More
                    </a>
                </div>
            </div>
        </section>

    <!-- Image Slider Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-farm-green">Fresh from the Farm</h2>
            @include('components.image-slider')
        </div>
    </section>

    <!-- Featured Products Section -->
    <section id="products" class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-farm-green">Featured Products</h2>
            
            @if($featuredProducts->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($featuredProducts as $product)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                            <!-- Product Image -->
                            <div class="h-48 bg-gray-200 relative overflow-hidden">
                                @if($product->image_path && is_array($product->image_path) && count($product->image_path) > 0)
                                    <img src="{{ asset('storage/' . $product->image_path[0]) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                                        <svg class="w-20 h-20 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Organic Badge -->
                                @if($product->is_organic)
                                    <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">
                                        ORGANIC
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Product Info -->
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-2 line-clamp-1">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ Str::limit($product->description, 60) }}</p>
                                <p class="text-xs text-gray-500 mb-3">
                                    <span class="font-medium">From:</span> {{ $product->farm_name ?? $product->seller->name ?? 'Local Farm' }}
                                </p>
                                <div class="flex justify-between items-center">
                                    <span class="text-2xl font-bold text-farm-green">₱{{ number_format($product->price, 2) }}/{{ $product->unit }}</span>
                                    <button onclick="addToCart('{{ $product->id }}', '{{ $product->name }}', {{ $product->price }})" 
                                            class="bg-farm-green text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300 text-sm">
                                        Add to Cart
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">
                                    <span class="font-medium">Stock:</span> {{ $product->stock_quantity }} {{ $product->unit }}{{ $product->stock_quantity > 1 ? 's' : '' }} available
                                </p>
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
        
        // Initialize cart from session storage
        let cart = JSON.parse(sessionStorage.getItem('farmlink_cart')) || {};
        
        // Save cart to session storage
        function saveCart() {
            sessionStorage.setItem('farmlink_cart', JSON.stringify(cart));
            updateCartDisplay();
        }
        
        // Add item to cart
        function addToCart(id, name, price) {
            if (cart[id]) {
                cart[id].quantity += 1;
            } else {
                cart[id] = { name: name, price: price, quantity: 1 };
            }
            saveCart();
            showToast(`${name} added to cart!`, 'success');
        }
        
        // Update cart display
        function updateCartDisplay() {
            const cartCount = document.getElementById('cart-count');
            const cartItems = document.getElementById('cart-items');
            const cartTotal = document.getElementById('cart-total');
            
            const totalItems = Object.values(cart).reduce((sum, item) => sum + item.quantity, 0);
            const totalPrice = Object.values(cart).reduce((sum, item) => sum + (item.price * item.quantity), 0);
            
            if (cartCount) cartCount.textContent = totalItems;
            if (cartTotal) cartTotal.textContent = `$${totalPrice.toFixed(2)}`;
            
            if (cartItems) {
                cartItems.innerHTML = '';
                Object.entries(cart).forEach(([id, item]) => {
                    const cartItem = document.createElement('div');
                    cartItem.className = 'flex justify-between items-center p-3 border-b';
                    cartItem.innerHTML = `
                        <div>
                            <h4 class="font-semibold">${item.name}</h4>
                            <p class="text-sm text-gray-600">$${item.price} x ${item.quantity}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button onclick="decreaseQuantity('${id}')" class="px-2 py-1 bg-gray-200 rounded">-</button>
                            <span>${item.quantity}</span>
                            <button onclick="addToCart('${id}', '${item.name}', ${item.price})" class="px-2 py-1 bg-gray-200 rounded">+</button>
                            <button onclick="removeFromCart('${id}')" class="text-red-500 ml-2">×</button>
                        </div>
                    `;
                    cartItems.appendChild(cartItem);
                });
            }
        }
        
        // Remove item from cart
        function removeFromCart(id) {
            delete cart[id];
            saveCart();
        }
        
        // Decrease quantity
        function decreaseQuantity(id) {
            if (cart[id] && cart[id].quantity > 1) {
                cart[id].quantity -= 1;
            } else {
                delete cart[id];
            }
            saveCart();
        }
        
        // Clear cart
        function clearCart() {
            cart = {};
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