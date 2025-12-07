<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact Us - FarmLink</title>
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
                <h1 class="text-5xl font-bold mb-4">Contact Us</h1>
                <p class="text-xl mb-8">We'd love to hear from you! Get in touch with our team</p>
            </div>
        </section>

        <!-- Contact Form and Info Section -->
        <section class="py-16">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Contact Form -->
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h2 class="text-3xl font-bold text-farm-green mb-6">Send us a Message</h2>
                        <form id="contact-form" class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" id="name" name="name" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-farm-green focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email" id="email" name="email" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-farm-green focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" id="phone" name="phone" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-farm-green focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                                <select id="subject" name="subject" required 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-farm-green focus:border-transparent">
                                    <option value="">Select a subject</option>
                                    <option value="general">General Inquiry</option>
                                    <option value="orders">Order Support</option>
                                    <option value="partnerships">Farm Partnerships</option>
                                    <option value="feedback">Feedback</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                                <textarea id="message" name="message" rows="5" required 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-farm-green focus:border-transparent"
                                          placeholder="Tell us how we can help you..."></textarea>
                            </div>
                            
                            <button type="submit" 
                                    class="w-full bg-farm-green text-white py-3 px-6 rounded-lg hover:bg-green-700 transition-colors font-semibold">
                                Send Message
                            </button>
                        </form>
                    </div>

                    <!-- Contact Information -->
                    <div>
                        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                            <h2 class="text-3xl font-bold text-farm-green mb-6">Get in Touch</h2>
                            
                            <div class="space-y-6">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-farm-green rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-farm-green">Email</h3>
                                        <p class="text-gray-600">hello@farmlink.com</p>
                                        <p class="text-gray-600">support@farmlink.com</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-farm-green rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-farm-green">Phone</h3>
                                        <p class="text-gray-600">(555) 123-4567</p>
                                        <p class="text-gray-600">Mon-Fri: 8AM-6PM</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-farm-green rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-farm-green">Address</h3>
                                        <p class="text-gray-600">123 Farm Road</p>
                                        <p class="text-gray-600">Green Valley, CA 95451</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Section -->
                        <div class="bg-white rounded-lg shadow-lg p-8">
                            <h3 class="text-2xl font-bold text-farm-green mb-6">Frequently Asked Questions</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <h4 class="font-semibold text-farm-green mb-2">What are your delivery hours?</h4>
                                    <p class="text-gray-600 text-sm">We deliver Tuesday through Saturday, 8AM-6PM. Sunday and Monday are our harvest days.</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-farm-green mb-2">Do you offer organic certification?</h4>
                                    <p class="text-gray-600 text-sm">Yes, all our partner farms are certified organic by USDA standards.</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-farm-green mb-2">What's your return policy?</h4>
                                    <p class="text-gray-600 text-sm">We guarantee freshness. If you're not satisfied, contact us within 24 hours for a full refund.</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-farm-green mb-2">Can I visit the farms?</h4>
                                    <p class="text-gray-600 text-sm">We organize monthly farm tours! Contact us to join the next scheduled visit.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section (Placeholder) -->
        <section class="py-16 bg-gray-100">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-farm-green text-center mb-8">Find Us</h2>
                <div class="bg-gray-300 h-96 rounded-lg flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-16 h-16 text-gray-500 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-gray-600">Interactive Map Coming Soon</p>
                        <p class="text-sm text-gray-500">123 Farm Road, Green Valley, CA 95451</p>
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

        // Contact form submission
        document.getElementById('contact-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData);
            
            // Show success message
            showToast('Message sent successfully! We\'ll get back to you soon.', 'success');
            
            // Reset form
            e.target.reset();
        });

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
            }, 4000);
        }

        // Initialize cart count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
        });
    </script>
</body>
</html>