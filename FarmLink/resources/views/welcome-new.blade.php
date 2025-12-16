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
<body class="bg-gradient-to-b from-white to-gray-50 min-h-screen pt-16">
    <!-- Include Navigation -->
    @include('components.navigation-bar')
    
    <!-- Main Content -->
    <main>
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
                        <div class="bg-white border border-gray-200 rounded-xl shadow-md overflow-hidden">
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
                        <li><span class="text-green-100 cursor-default">Contact</span></li>
                        <li><span class="text-green-100 cursor-default">Developers</span></li>
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
        
        // Add item to cart - now shows quantity modal
        function addToCart(id, name, price) {
            if (typeof window.showQuantityModal === 'function') {
                window.showQuantityModal(id, name, price);
            } else {
                // Fallback to direct add
                const existingItem = window.cart.find(item => item.id === id);
                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    window.cart.push({ id: id, name: name, price: price, quantity: 1 });
                }
                saveCart();
                showToast(`${name} added to cart!`, 'success');
            }
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