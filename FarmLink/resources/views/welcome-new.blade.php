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
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Product 1 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="h-48 bg-gradient-to-br from-red-400 to-red-600"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Fresh Tomatoes</h3>
                        <p class="text-gray-600 mb-4">Organic vine-ripened tomatoes from Johnson Farm</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-farm-green">₱4.99/lb</span>
                            <button onclick="addToCart('tomatoes', 'Fresh Tomatoes', 4.99)" class="bg-farm-green text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="h-48 bg-gradient-to-br from-orange-400 to-orange-600"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Sweet Carrots</h3>
                        <p class="text-gray-600 mb-4">Crispy fresh carrots perfect for any meal</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-farm-green">₱2.99/lb</span>
                            <button onclick="addToCart('carrots', 'Sweet Carrots', 2.99)" class="bg-farm-green text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="h-48 bg-gradient-to-br from-green-400 to-green-600"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Fresh Lettuce</h3>
                        <p class="text-gray-600 mb-4">Crisp organic lettuce leaves for salads</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-farm-green">₱3.49/head</span>
                            <button onclick="addToCart('lettuce', 'Fresh Lettuce', 3.49)" class="bg-farm-green text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="h-48 bg-gradient-to-br from-purple-400 to-purple-600"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Farm Apples</h3>
                        <p class="text-gray-600 mb-4">Sweet and juicy apples from local orchards</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-farm-green">₱5.99/lb</span>
                            <button onclick="addToCart('apples', 'Farm Apples', 5.99)" class="bg-farm-green text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
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