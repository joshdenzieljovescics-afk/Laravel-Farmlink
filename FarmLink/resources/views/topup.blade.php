<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Top Up FarmTokens - FarmLink</title>
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
    @include('components.navigation-bar')

    <main class="pt-20 pb-16">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-farm-green to-green-600 text-white rounded-lg shadow-lg p-8 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold mb-2">Top Up FarmTokens</h1>
                        <p class="text-lg opacity-90">Add tokens to your account for seamless shopping</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg p-6 text-center">
                        <p class="text-sm opacity-80 mb-1">Current Balance</p>
                        <p class="text-3xl font-bold">{{ number_format(auth()->user()->farm_tokens ?? 0) }} <span class="text-xl">FT</span></p>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Left Column - Preset Amounts -->
                <div class="md:col-span-2">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h2 class="text-2xl font-bold text-farm-green mb-6">Quick Top Up Deals</h2>
                        
                        <div class="grid sm:grid-cols-2 gap-4 mb-8">
                            <!-- ₱50 Deal -->
                            <div class="deal-card border-2 border-gray-200 rounded-lg p-6 hover:border-farm-orange hover:shadow-md transition-all cursor-pointer" onclick="selectDeal(50)">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Starter Pack</p>
                                        <p class="text-3xl font-bold text-farm-green">₱50</p>
                                    </div>
                                    <svg class="w-6 h-6 text-farm-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-lg font-semibold text-farm-orange">50 FarmTokens</p>
                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">1:1 Rate</span>
                                </div>
                            </div>

                            <!-- ₱100 Deal -->
                            <div class="deal-card border-2 border-gray-200 rounded-lg p-6 hover:border-farm-orange hover:shadow-md transition-all cursor-pointer" onclick="selectDeal(100)">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Basic Pack</p>
                                        <p class="text-3xl font-bold text-farm-green">₱100</p>
                                    </div>
                                    <svg class="w-6 h-6 text-farm-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-lg font-semibold text-farm-orange">100 FarmTokens</p>
                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">1:1 Rate</span>
                                </div>
                            </div>

                            <!-- ₱250 Deal -->
                            <div class="deal-card border-2 border-gray-200 rounded-lg p-6 hover:border-farm-orange hover:shadow-md transition-all cursor-pointer" onclick="selectDeal(250)">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Popular</p>
                                        <p class="text-3xl font-bold text-farm-green">₱250</p>
                                    </div>
                                    <svg class="w-6 h-6 text-farm-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-lg font-semibold text-farm-orange">250 FarmTokens</p>
                                    <span class="text-xs bg-orange-100 text-orange-800 px-2 py-1 rounded-full">Best Value</span>
                                </div>
                            </div>

                            <!-- ₱500 Deal -->
                            <div class="deal-card border-2 border-gray-200 rounded-lg p-6 hover:border-farm-orange hover:shadow-md transition-all cursor-pointer" onclick="selectDeal(500)">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Premium Pack</p>
                                        <p class="text-3xl font-bold text-farm-green">₱500</p>
                                    </div>
                                    <svg class="w-6 h-6 text-farm-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                    </svg>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-lg font-semibold text-farm-orange">500 FarmTokens</p>
                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">1:1 Rate</span>
                                </div>
                            </div>

                            <!-- ₱1000 Deal -->
                            <div class="deal-card border-2 border-gray-200 rounded-lg p-6 hover:border-farm-orange hover:shadow-md transition-all cursor-pointer sm:col-span-2" onclick="selectDeal(1000)">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Ultimate Pack</p>
                                        <p class="text-3xl font-bold text-farm-green">₱1,000</p>
                                    </div>
                                    <svg class="w-8 h-8 text-farm-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                                    </svg>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-xl font-semibold text-farm-orange">1,000 FarmTokens</p>
                                    <span class="text-xs bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full">👑 VIP</span>
                                </div>
                            </div>
                        </div>

                        <!-- Custom Amount Section -->
                        <div class="border-t pt-6">
                            <h3 class="text-lg font-semibold text-farm-green mb-4">Custom Amount</h3>
                            <div class="flex gap-3">
                                <div class="flex-1">
                                    <label class="block text-sm text-gray-600 mb-2">Enter FarmTokens Amount</label>
                                    <input type="number" 
                                           id="customAmount" 
                                           min="1" 
                                           placeholder="Enter amount (min. 1 FT)"
                                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-farm-orange">
                                </div>
                                <div class="flex items-end">
                                    <button onclick="selectCustomAmount()" 
                                            class="bg-farm-green text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors whitespace-nowrap">
                                        Select
                                    </button>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">💡 1 FarmToken = ₱1 Philippine Peso</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Summary -->
                <div>
                    <div class="bg-white rounded-lg shadow-lg p-6 sticky top-24">
                        <h3 class="text-xl font-bold text-farm-green mb-6">Order Summary</h3>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Amount</span>
                                <span class="font-semibold" id="summaryAmount">₱0.00</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">You'll receive</span>
                                <span class="font-semibold text-farm-orange" id="summaryTokens">0 FT</span>
                            </div>
                            <div class="border-t pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-gray-800">Total</span>
                                    <span class="text-2xl font-bold text-farm-green" id="summaryTotal">₱0.00</span>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('topup.process') }}" id="topupForm">
                            @csrf
                            <input type="hidden" name="amount" id="selectedAmount" value="0">
                            
                            <button type="submit" 
                                    id="buyButton"
                                    disabled
                                    class="w-full bg-farm-orange text-white py-3 rounded-lg font-semibold hover:bg-orange-600 transition-colors disabled:bg-gray-300 disabled:cursor-not-allowed">
                                Buy FarmTokens
                            </button>
                        </form>

                        <div class="mt-6 p-4 bg-green-50 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="text-sm text-green-800">
                                    <p class="font-semibold mb-1">Instant Top Up</p>
                                    <p class="text-xs">FarmTokens will be added to your account immediately after purchase.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('components.cart')

    <script>
        let selectedAmountValue = 0;

        function selectDeal(amount) {
            selectedAmountValue = amount;
            updateSummary();
            
            // Visual feedback
            document.querySelectorAll('.deal-card').forEach(card => {
                card.classList.remove('border-farm-orange', 'bg-orange-50');
            });
            event.currentTarget.classList.add('border-farm-orange', 'bg-orange-50');
        }

        function selectCustomAmount() {
            const customInput = document.getElementById('customAmount');
            const amount = parseInt(customInput.value);
            
            if (!amount || amount < 1) {
                alert('Please enter a valid amount (minimum 1 FarmToken)');
                return;
            }
            
            selectedAmountValue = amount;
            updateSummary();
            
            // Remove highlight from deal cards
            document.querySelectorAll('.deal-card').forEach(card => {
                card.classList.remove('border-farm-orange', 'bg-orange-50');
            });
        }

        function updateSummary() {
            document.getElementById('summaryAmount').textContent = '₱' + selectedAmountValue.toLocaleString('en-PH', {minimumFractionDigits: 2});
            document.getElementById('summaryTokens').textContent = selectedAmountValue.toLocaleString() + ' FT';
            document.getElementById('summaryTotal').textContent = '₱' + selectedAmountValue.toLocaleString('en-PH', {minimumFractionDigits: 2});
            document.getElementById('selectedAmount').value = selectedAmountValue;
            
            const buyButton = document.getElementById('buyButton');
            if (selectedAmountValue > 0) {
                buyButton.disabled = false;
            } else {
                buyButton.disabled = true;
            }
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            updateSummary();
        });
    </script>
</body>
</html>