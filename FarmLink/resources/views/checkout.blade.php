<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout - FarmLink</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWBjk56uFxZLBLL4UE2prGQp7aOBKu37k&libraries=places&loading=async&callback=initMap" async defer></script>
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
    @include('components.navigation-bar')

    <main class="pt-20 pb-16">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-farm-green mb-2">Checkout</h1>
                <p class="text-gray-600">Review your order and confirm delivery details</p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Left Column - Delivery Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Delivery Address Section -->
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <div class="flex items-center mb-4">
                            <span class="text-2xl mr-3">📍</span>
                            <h2 class="text-2xl font-bold text-farm-green">Delivery Address</h2>
                        </div>

                        <!-- Address Input -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search Address</label>
                            <input type="text" 
                                   id="address-input" 
                                   placeholder="Enter your delivery address..."
                                   class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500">
                        </div>

                        <!-- Map Container -->
                        <div class="mb-4">
                            <div id="map" class="w-full h-96 rounded-lg border-2 border-gray-300"></div>
                        </div>

                        <!-- Selected Address Display -->
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <p class="text-sm font-medium text-gray-700 mb-1">Selected Address:</p>
                            <p id="selected-address" class="text-gray-800 font-semibold">Please select your delivery location on the map</p>
                            <div id="coordinates" class="text-xs text-gray-600 mt-2"></div>
                        </div>

                        <!-- Additional Delivery Notes -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Delivery Instructions (Optional)</label>
                            <textarea id="delivery-notes" 
                                      rows="3" 
                                      placeholder="e.g., Leave at the front door, Ring doorbell twice..."
                                      class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500"></textarea>
                        </div>
                    </div>

                    <!-- Order Items Section -->
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <div class="flex items-center mb-4">
                            <span class="text-2xl mr-3">🛒</span>
                            <h2 class="text-2xl font-bold text-farm-green">Order Items</h2>
                        </div>

                        <div id="checkout-items" class="space-y-3">
                            <!-- Items will be dynamically loaded here -->
                        </div>
                    </div>
                </div>

                <!-- Right Column - Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-lg p-6 sticky top-24">
                        <h2 class="text-2xl font-bold text-farm-green mb-6">Order Summary</h2>

                        <!-- User Balance -->
                        <div class="bg-gradient-to-r from-green-50 to-green-100 border border-green-300 rounded-lg p-4 mb-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="text-2xl mr-2">🪙</span>
                                    <span class="text-sm text-gray-600">Your Balance</span>
                                </div>
                                <span class="text-2xl font-bold text-green-600">{{ number_format(auth()->user()->farm_tokens ?? 0) }} FT</span>
                            </div>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-700">
                                <span>Subtotal</span>
                                <span id="subtotal">₱0.00</span>
                            </div>
                            <div class="flex justify-between text-gray-700">
                                <span>Delivery Fee</span>
                                <span id="delivery-fee">₱50.00</span>
                            </div>
                            <div class="border-t pt-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-gray-800">Total</span>
                                    <span id="total" class="text-2xl font-bold text-green-600">₱0.00</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1 text-right">= <span id="total-tokens">0</span> FarmTokens</p>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Payment Method</span>
                                <div class="flex items-center">
                                    <span class="text-lg mr-2">🪙</span>
                                    <span class="font-semibold text-green-600">FarmTokens</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-3">
                            <button onclick="confirmOrder()" 
                                    class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300 flex items-center justify-center">
                                <span class="mr-2">✓</span>
                                Confirm Order
                            </button>
                            <button onclick="cancelCheckout()" 
                                    class="w-full border-2 border-gray-300 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-50 transition duration-300">
                                Cancel
                            </button>
                        </div>

                        <!-- Info Notice -->
                        <div class="mt-6 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-xs text-blue-800">
                                <span class="font-semibold">💡 Note:</span> Your items will remain in cart if you cancel
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Insufficient Balance Modal -->
    <div id="insufficient-balance-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all">
            <div class="p-6">
                <div class="text-center mb-4">
                    <span class="text-6xl mb-4 block">⚠️</span>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Insufficient Balance</h3>
                    <p class="text-gray-600">You don't have enough FarmTokens to complete this purchase.</p>
                </div>

                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-700">Order Total:</span>
                        <span id="modal-total" class="font-bold text-gray-800">0 FT</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700">Your Balance:</span>
                        <span id="modal-balance" class="font-bold text-green-600">{{ number_format(auth()->user()->farm_tokens ?? 0) }} FT</span>
                    </div>
                    <div class="border-t mt-2 pt-2">
                        <div class="flex justify-between">
                            <span class="text-gray-700">Need:</span>
                            <span id="modal-needed" class="font-bold text-red-600">0 FT</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('topup') }}" 
                       class="block w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300 text-center">
                        <span class="mr-2">🪙</span>
                        Top Up FarmTokens
                    </a>
                    <button onclick="closeInsufficientBalanceModal()" 
                            class="w-full border-2 border-gray-300 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-50 transition duration-300">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let map;
        let marker;
        let selectedLocation = null;
        let selectedAddress = '';
        let cart = JSON.parse(sessionStorage.getItem('farmLinkCart')) || [];
        const DELIVERY_FEE = 50;
        const userBalance = {{ auth()->user()->farm_tokens ?? 0 }};

        // Initialize Google Map
        function initMap() {
            // Default location (Manila, Philippines)
            const defaultLocation = { lat: 14.5995, lng: 120.9842 };
            
            map = new google.maps.Map(document.getElementById('map'), {
                center: defaultLocation,
                zoom: 13,
                mapTypeControl: false,
                streetViewControl: false,
            });

            // Create draggable marker
            marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true,
                title: 'Delivery Location'
            });

            // Update address when marker is dragged
            marker.addListener('dragend', function() {
                updateAddress(marker.getPosition());
            });

            // Add click listener to map
            map.addListener('click', function(event) {
                marker.setPosition(event.latLng);
                updateAddress(event.latLng);
            });

            // Setup autocomplete
            const input = document.getElementById('address-input');
            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    return;
                }

                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }

                marker.setPosition(place.geometry.location);
                updateAddress(place.geometry.location);
            });
        }

        // Update address from coordinates
        function updateAddress(location) {
            selectedLocation = {
                lat: location.lat(),
                lng: location.lng()
            };

            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({ location: location }, function(results, status) {
                if (status === 'OK' && results[0]) {
                    selectedAddress = results[0].formatted_address;
                    document.getElementById('selected-address').textContent = selectedAddress;
                    document.getElementById('coordinates').textContent = 
                        `Lat: ${selectedLocation.lat.toFixed(6)}, Lng: ${selectedLocation.lng.toFixed(6)}`;
                }
            });
        }

        // Load checkout items
        function loadCheckoutItems() {
            const container = document.getElementById('checkout-items');
            
            if (cart.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-8 text-gray-500">
                        <span class="text-4xl mb-2 block">🛒</span>
                        <p>Your cart is empty</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = cart.map(item => `
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-green-300 transition-colors">
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800">${item.name}</h4>
                        <p class="text-sm text-gray-600">₱${item.price.toFixed(2)} × ${item.quantity}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-green-600">₱${(item.price * item.quantity).toFixed(2)}</p>
                    </div>
                </div>
            `).join('');

            updateOrderSummary();
        }

        // Update order summary
        function updateOrderSummary() {
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const total = subtotal + DELIVERY_FEE;

            document.getElementById('subtotal').textContent = `₱${subtotal.toFixed(2)}`;
            document.getElementById('total').textContent = `₱${total.toFixed(2)}`;
            document.getElementById('total-tokens').textContent = Math.ceil(total);
        }

        // Confirm order
        async function confirmOrder() {
            // Validate address
            if (!selectedLocation || !selectedAddress) {
                showToast('Please select a delivery address on the map', 'error');
                return;
            }

            // Calculate total
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const total = Math.ceil(subtotal + DELIVERY_FEE);

            // Check balance
            if (userBalance < total) {
                showInsufficientBalanceModal(total);
                return;
            }

            // Prepare order data
            const orderData = {
                items: cart,
                delivery_address: selectedAddress,
                delivery_coordinates: selectedLocation,
                delivery_notes: document.getElementById('delivery-notes').value,
                subtotal: subtotal,
                delivery_fee: DELIVERY_FEE,
                total: total
            };

            // Submit order
            try {
                const response = await fetch('{{ route("checkout.process") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(orderData)
                });

                const result = await response.json();

                if (result.success) {
                    // Clear cart
                    sessionStorage.removeItem('farmLinkCart');
                    showToast('Order placed successfully!', 'success');
                    
                    // Redirect after delay
                    setTimeout(() => {
                        window.location.href = '{{ route("dashboard") }}';
                    }, 1500);
                } else {
                    showToast(result.message || 'Failed to place order', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('An error occurred. Please try again.', 'error');
            }
        }

        // Show insufficient balance modal
        function showInsufficientBalanceModal(totalNeeded) {
            const modal = document.getElementById('insufficient-balance-modal');
            const needed = totalNeeded - userBalance;
            
            document.getElementById('modal-total').textContent = `${totalNeeded} FT`;
            document.getElementById('modal-needed').textContent = `${needed} FT`;
            
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Close insufficient balance modal
        function closeInsufficientBalanceModal() {
            const modal = document.getElementById('insufficient-balance-modal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Cancel checkout
        function cancelCheckout() {
            if (confirm('Are you sure you want to cancel? Your items will remain in the cart.')) {
                window.location.href = '{{ route("products") }}';
            }
        }

        // Show toast notification
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            const bgColor = type === 'error' ? 'bg-red-500' : type === 'info' ? 'bg-blue-500' : 'bg-green-600';
            toast.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
            toast.textContent = message;
            document.body.appendChild(toast);
            
            setTimeout(() => toast.classList.remove('translate-x-full'), 100);
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => document.body.contains(toast) && document.body.removeChild(toast), 300);
            }, 3000);
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            initMap();
            loadCheckoutItems();
        });
    </script>
</body>
</html>