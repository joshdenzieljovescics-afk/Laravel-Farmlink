<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>About Us - FarmLink</title>
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
<body class="bg-white min-h-screen">
    <!-- Include Navigation -->
    @include('components.navigation-bar')

    <!-- Main Content -->
    <main class="pt-16">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 text-white py-12 mb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold mb-2">About FarmLink</h1>
                        <p class="text-green-100">Connecting farms to families with fresh, sustainable produce</p>
                    </div>
                    <div class="hidden md:block">
                        <svg class="w-24 h-24 text-green-500 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Story Section -->
        <section class="py-20 bg-gradient-to-b from-white to-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <h2 class="text-4xl font-bold text-farm-green mb-6">Our Story</h2>
                        <p class="text-lg text-gray-700 mb-6">
                            Founded in mid 2025, FarmLink was born from a simple idea: connect local farms directly with families 
                            who care about fresh, sustainable food. We believe that everyone deserves access to high-quality, 
                            locally-grown produce while supporting the hardworking farmers in our community.
                        </p>
                        <p class="text-lg text-gray-700 mb-6">
                            What started as a small partnership with three local farms has grown into a thriving network of 
                            over 50 certified organic and sustainable farms across the region. We're proud to bring you the 
                            freshest produce while maintaining fair prices for both consumers and farmers.
                        </p>
                        <div class="grid grid-cols-3 gap-8 mt-8">
                            <div class="text-center">
                                <div class="text-4xl font-bold text-farm-orange mb-2">50+</div>
                                <div class="text-sm text-gray-600">Partner Farms</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold text-farm-orange mb-2">10,000+</div>
                                <div class="text-sm text-gray-600">Happy Customers</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold text-farm-orange mb-2">100%</div>
                                <div class="text-sm text-gray-600">Organic Products</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=600" 
                             alt="Our Farm" 
                             class="rounded-lg shadow-lg w-full h-96 object-cover">
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Mission Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-farm-green mb-6">Our Mission</h2>
                    <p class="text-xl text-gray-700 max-w-3xl mx-auto leading-relaxed">
                        To create a sustainable food system that benefits farmers, consumers, and the environment
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="text-center p-8 bg-gray-50 rounded-xl hover:shadow-lg transition-shadow duration-300">
                        <div class="w-20 h-20 bg-farm-green rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-farm-green mb-4">Support Local Farmers</h3>
                        <p class="text-gray-600 leading-relaxed">
                            We partner directly with local farms, ensuring fair compensation and sustainable farming practices
                        </p>
                    </div>
                    
                    <div class="text-center p-8 bg-gray-50 rounded-xl hover:shadow-lg transition-shadow duration-300">
                        <div class="w-20 h-20 bg-farm-green rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-farm-green mb-4">Premium Quality</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Every product is carefully selected and quality-checked to ensure you receive the freshest produce
                        </p>
                    </div>
                    
                    <div class="text-center p-8 bg-gray-50 rounded-xl hover:shadow-lg transition-shadow duration-300">
                        <div class="w-20 h-20 bg-farm-green rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-farm-green mb-4">Environmental Care</h3>
                        <p class="text-gray-600 leading-relaxed">
                            We promote sustainable farming practices that protect our environment for future generations
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-farm-green mb-6">Meet Our Team</h2>
                    <p class="text-xl text-gray-700">The passionate people behind FarmLink</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-8 transform hover:-translate-y-1">
                        <img src="https://lh3.googleusercontent.com/a/ACg8ocKoM4yJA8blzgjCkFMWTTOv7TLWOIhnm5Z32II4qJv0WOA_Y8v7=s317-c-no" 
                             alt="Carlos Miguel M. Carla" 
                             class="w-32 h-32 rounded-full mx-auto mb-5 object-cover border-4 border-gray-100">
                        <h3 class="text-xl font-semibold text-farm-green mb-2">Carlos Miguel M. Carla</h3>
                        <p class="text-farm-orange font-medium mb-3">Founder & CEO</p>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Visionary leader passionate about connecting communities with fresh, sustainable food
                        </p>
                    </div>
                    
                    <div class="text-center bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-8 transform hover:-translate-y-1">
                        <img src="https://lh3.googleusercontent.com/a-/ALV-UjUzmVnwqUC8VodRTqaDuEpYCUYLLZ9G6JunGHuq5W9tlIwlhhY=s265-p-k-rw-no" 
                             alt="Lance Joshua J. Hilario" 
                             class="w-32 h-32 rounded-full mx-auto mb-5 object-cover border-4 border-gray-100">
                        <h3 class="text-xl font-semibold text-farm-green mb-2">Lance Joshua J. Hilario</h3>
                        <p class="text-farm-orange font-medium mb-3">Operations Manager</p>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Ensures seamless logistics and maintains quality standards across our supply chain
                        </p>
                    </div>
                    
                    <div class="text-center bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-8 transform hover:-translate-y-1">
                        <img src="https://lh3.googleusercontent.com/a-/ALV-UjU_aHxz5dhd5DLf2IOWkfoF4y6bdKh56kOg18JidOsNyVNZQKk=s265-p-k-rw-no" 
                             alt="Josh Denziel S. Joves" 
                             class="w-32 h-32 rounded-full mx-auto mb-5 object-cover border-4 border-gray-100">
                        <h3 class="text-xl font-semibold text-farm-green mb-2">Josh Denziel S. Joves</h3>
                        <p class="text-farm-orange font-medium mb-3">Farm Relations Director</p>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Works closely with our partner farms to maintain relationships and ensure quality
                        </p>
                    </div>
                    
                    <div class="text-center bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-8 transform hover:-translate-y-1">
                        <img src="https://lh3.googleusercontent.com/a-/ALV-UjXbQfkyzHemUKIQzCqdQmi3AcEDa3a7XdfGEhkg5bsECTlVwBI=s300-p-k-rw-no" 
                             alt="Paul Andrew Chua" 
                             class="w-32 h-32 rounded-full mx-auto mb-5 object-cover border-4 border-gray-100">
                        <h3 class="text-xl font-semibold text-farm-green mb-2">Paul Andrew Chua</h3>
                        <p class="text-farm-orange font-medium mb-3">Technology Director</p>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Develops and maintains our platform to provide the best user experience
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="py-20 bg-gradient-to-r from-farm-green to-green-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">Our Values</h2>
                <p class="text-xl text-green-100 mb-12 max-w-2xl mx-auto">The principles that guide everything we do</p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-8 hover:bg-white/20 transition-all duration-300">
                        <h3 class="text-2xl font-semibold mb-4">Sustainability</h3>
                        <p class="text-green-100 leading-relaxed">Protecting our planet through responsible farming practices</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-8 hover:bg-white/20 transition-all duration-300">
                        <h3 class="text-2xl font-semibold mb-4">Quality</h3>
                        <p class="text-green-100 leading-relaxed">Never compromising on the freshness and quality of our products</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-8 hover:bg-white/20 transition-all duration-300">
                        <h3 class="text-2xl font-semibold mb-4">Community</h3>
                        <p class="text-green-100 leading-relaxed">Building strong relationships between farmers and families</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-8 hover:bg-white/20 transition-all duration-300">
                        <h3 class="text-2xl font-semibold mb-4">Transparency</h3>
                        <p class="text-green-100 leading-relaxed">Open about our processes, sourcing, and business practices</p>
                    </div>
                </div>
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

        // Initialize cart count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
        });
    </script>
</body>
</html>