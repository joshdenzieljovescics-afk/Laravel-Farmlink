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
                <div id="products-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    <!-- Product Cards -->
                    <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow" data-category="fruits">
                        <img src="https://images.unsplash.com/photo-1560806887-1e4cd0b6cbd6?w=300" alt="Fresh Apples" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-farm-green mb-2">Fresh Apples</h3>
                            <p class="text-gray-600 mb-4">Crispy, sweet organic apples from our orchard</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-farm-orange">$4.99/lb</span>
                                <button onclick="addToCart('Fresh Apples', 4.99)" class="bg-farm-green text-white px-4 py-2 rounded hover:bg-green-700 transition-colors">Add to Cart</button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow" data-category="vegetables">
                        <img src="https://images.unsplash.com/photo-1540420773420-3366772f4999?w=300" alt="Organic Carrots" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-farm-green mb-2">Organic Carrots</h3>
                            <p class="text-gray-600 mb-4">Fresh, crunchy carrots rich in vitamins</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-farm-orange">$2.99/lb</span>
                                <button onclick="addToCart('Organic Carrots', 2.99)" class="bg-farm-green text-white px-4 py-2 rounded hover:bg-green-700 transition-colors">Add to Cart</button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow" data-category="dairy">
                        <img src="https://images.unsplash.com/photo-1563636619-e9143da7973b?w=300" alt="Fresh Milk" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-farm-green mb-2">Fresh Milk</h3>
                            <p class="text-gray-600 mb-4">Pure, fresh milk from grass-fed cows</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-farm-orange">$5.99/gal</span>
                                <button onclick="addToCart('Fresh Milk', 5.99)" class="bg-farm-green text-white px-4 py-2 rounded hover:bg-green-700 transition-colors">Add to Cart</button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow" data-category="fruits">
                        <img src="https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?w=300" alt="Strawberries" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-farm-green mb-2">Fresh Strawberries</h3>
                            <p class="text-gray-600 mb-4">Sweet, juicy strawberries picked fresh</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-farm-orange">$6.99/lb</span>
                                <button onclick="addToCart('Fresh Strawberries', 6.99)" class="bg-farm-green text-white px-4 py-2 rounded hover:bg-green-700 transition-colors">Add to Cart</button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow" data-category="vegetables">
                        <img src="https://images.unsplash.com/photo-1574316071802-0d684efa7bf5?w=300" alt="Lettuce" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-farm-green mb-2">Fresh Lettuce</h3>
                            <p class="text-gray-600 mb-4">Crisp, organic lettuce perfect for salads</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-farm-orange">$3.49/head</span>
                                <button onclick="addToCart('Fresh Lettuce', 3.49)" class="bg-farm-green text-white px-4 py-2 rounded hover:bg-green-700 transition-colors">Add to Cart</button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow" data-category="dairy">
                        <img src="https://images.unsplash.com/photo-1486297678162-eb2a19b0a32d?w=300" alt="Farm Cheese" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-farm-green mb-2">Artisan Cheese</h3>
                            <p class="text-gray-600 mb-4">Handcrafted cheese made with local milk</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-farm-orange">$8.99/lb</span>
                                <button onclick="addToCart('Artisan Cheese', 8.99)" class="bg-farm-green text-white px-4 py-2 rounded hover:bg-green-700 transition-colors">Add to Cart</button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow" data-category="fruits">
                        <img src="https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=300" alt="Oranges" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-farm-green mb-2">Fresh Oranges</h3>
                            <p class="text-gray-600 mb-4">Juicy, vitamin-rich oranges</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-farm-orange">$3.99/lb</span>
                                <button onclick="addToCart('Fresh Oranges', 3.99)" class="bg-farm-green text-white px-4 py-2 rounded hover:bg-green-700 transition-colors">Add to Cart</button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow" data-category="vegetables">
                        <img src="https://images.unsplash.com/photo-1582284540020-8acbe03f4924?w=300" alt="Tomatoes" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-farm-green mb-2">Vine Tomatoes</h3>
                            <p class="text-gray-600 mb-4">Perfectly ripened vine tomatoes</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-farm-orange">$4.49/lb</span>
                                <button onclick="addToCart('Vine Tomatoes', 4.49)" class="bg-farm-green text-white px-4 py-2 rounded hover:bg-green-700 transition-colors">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Include Cart -->
    @include('components.cart')

    <script>
        // Initialize cart from session storage
        let cart = JSON.parse(sessionStorage.getItem('farmLinkCart')) || [];
        let cartCount = 0;

        // Function to update cart count
        function updateCartCount() {
            cartCount = cart.reduce((total, item) => total + item.quantity, 0);
            const cartCountElement = document.getElementById('cart-count');
            if (cartCountElement) {
                cartCountElement.textContent = cartCount;
                cartCountElement.style.display = cartCount > 0 ? 'block' : 'none';
            }
        }

        // Function to add items to cart
        function addToCart(name, price) {
            const existingItem = cart.find(item => item.name === name);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ name, price, quantity: 1 });
            }
            sessionStorage.setItem('farmLinkCart', JSON.stringify(cart));
            updateCartCount();
            
            // Show toast notification
            showToast(`${name} added to cart!`, 'success');
        }

        // Function to filter products
        function filterProducts(category) {
            const products = document.querySelectorAll('.product-card');
            products.forEach(product => {
                if (category === 'all' || product.dataset.category === category) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
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

        // Initialize cart count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
        });
    </script>
</body>
</html>