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
<body class="bg-farm-cream min-h-screen">
    <!-- Include Navigation -->
    @include('components.navigation-bar')

    <!-- Main Content -->
    <main class="pt-20">
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-farm-green to-green-600 text-white py-16">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-5xl font-bold mb-4">About FarmLink</h1>
                <p class="text-xl mb-8">Connecting farms to families with fresh, sustainable produce</p>
            </div>
        </section>

        <!-- Our Story Section -->
        <section class="py-16">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-4xl font-bold text-farm-green mb-6">Our Story</h2>
                        <p class="text-lg text-gray-700 mb-6">
                            Founded in 2020, FarmLink was born from a simple idea: connect local farms directly with families 
                            who care about fresh, sustainable food. We believe that everyone deserves access to high-quality, 
                            locally-grown produce while supporting the hardworking farmers in our community.
                        </p>
                        <p class="text-lg text-gray-700 mb-6">
                            What started as a small partnership with three local farms has grown into a thriving network of 
                            over 50 certified organic and sustainable farms across the region. We're proud to bring you the 
                            freshest produce while maintaining fair prices for both consumers and farmers.
                        </p>
                        <div class="flex space-x-4">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-farm-orange">50+</div>
                                <div class="text-sm text-gray-600">Partner Farms</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-farm-orange">10,000+</div>
                                <div class="text-sm text-gray-600">Happy Customers</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-farm-orange">100%</div>
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
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-farm-green mb-4">Our Mission</h2>
                    <p class="text-xl text-gray-700 max-w-3xl mx-auto">
                        To create a sustainable food system that benefits farmers, consumers, and the environment
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-farm-green rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-farm-green mb-3">Support Local Farmers</h3>
                        <p class="text-gray-600">
                            We partner directly with local farms, ensuring fair compensation and sustainable farming practices
                        </p>
                    </div>
                    
                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-farm-green rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-farm-green mb-3">Premium Quality</h3>
                        <p class="text-gray-600">
                            Every product is carefully selected and quality-checked to ensure you receive the freshest produce
                        </p>
                    </div>
                    
                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-farm-green rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-farm-green mb-3">Environmental Care</h3>
                        <p class="text-gray-600">
                            We promote sustainable farming practices that protect our environment for future generations
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="py-16">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-farm-green mb-4">Meet Our Team</h2>
                    <p class="text-xl text-gray-700">The passionate people behind FarmLink</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center bg-white rounded-lg shadow-lg p-6">
                        <img src="https://lh3.googleusercontent.com/a/ACg8ocKoM4yJA8blzgjCkFMWTTOv7TLWOIhnm5Z32II4qJv0WOA_Y8v7=s317-c-no" 
                             alt="Carlos Miguel M. Carla" 
                             class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                        <h3 class="text-xl font-semibold text-farm-green mb-2">Carlos Miguel M. Carla</h3>
                        <p class="text-farm-orange mb-2">Founder & CEO</p>
                        <p class="text-gray-600 text-sm">
                            Visionary leader passionate about connecting communities with fresh, sustainable food
                        </p>
                    </div>
                    
                    <div class="text-center bg-white rounded-lg shadow-lg p-6">
                        <img src="https://lh3.googleusercontent.com/a-/ALV-UjUzmVnwqUC8VodRTqaDuEpYCUYLLZ9G6JunGHuq5W9tlIwlhhY=s265-p-k-rw-no" 
                             alt="Lance Joshua J. Hilario" 
                             class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                        <h3 class="text-xl font-semibold text-farm-green mb-2">Lance Joshua J. Hilario</h3>
                        <p class="text-farm-orange mb-2">Operations Manager</p>
                        <p class="text-gray-600 text-sm">
                            Ensures seamless logistics and maintains quality standards across our supply chain
                        </p>
                    </div>
                    
                    <div class="text-center bg-white rounded-lg shadow-lg p-6">
                        <img src="https://lh3.googleusercontent.com/a-/ALV-UjU_aHxz5dhd5DLf2IOWkfoF4y6bdKh56kOg18JidOsNyVNZQKk=s265-p-k-rw-no" 
                             alt="Josh Denziel S. Joves" 
                             class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                        <h3 class="text-xl font-semibold text-farm-green mb-2">Josh Denziel S. Joves</h3>
                        <p class="text-farm-orange mb-2">Farm Relations Director</p>
                        <p class="text-gray-600 text-sm">
                            Works closely with our partner farms to maintain relationships and ensure quality
                        </p>
                    </div>
                    
                    <div class="text-center bg-white rounded-lg shadow-lg p-6">
                        <img src="https://lh3.googleusercontent.com/a-/ALV-UjXA1eRkvTj_g5j8_d7TbmX9Y1Yr7YDBUT98NClLgrJyDfqbOPM=s265-p-k-rw-no" 
                             alt="Paul Andrew Chua" 
                             class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                        <h3 class="text-xl font-semibold text-farm-green mb-2">Paul Andrew Chua</h3>
                        <p class="text-farm-orange mb-2">Technology Director</p>
                        <p class="text-gray-600 text-sm">
                            Develops and maintains our platform to provide the best user experience
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="py-16 bg-farm-green text-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-4xl font-bold mb-8">Our Values</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-xl font-semibold mb-3">Sustainability</h3>
                        <p class="text-green-100">Protecting our planet through responsible farming practices</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-3">Quality</h3>
                        <p class="text-green-100">Never compromising on the freshness and quality of our products</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-3">Community</h3>
                        <p class="text-green-100">Building strong relationships between farmers and families</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-3">Transparency</h3>
                        <p class="text-green-100">Open about our processes, sourcing, and business practices</p>
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

        // Initialize cart count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
        });
    </script>
</body>
</html>