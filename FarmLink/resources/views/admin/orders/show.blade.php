<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Order Details - FarmLink Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white min-h-screen">
    @include('components.navigation-bar')

    <div class="pt-16 pb-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Hero Section -->
            <div class="w-screen relative left-1/2 right-1/2 -ml-[50vw] -mr-[50vw] bg-gradient-to-r from-green-600 to-green-700 text-white py-12 mb-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center gap-4 mb-2">
                                <h1 class="text-4xl font-bold">Order Details</h1>
                                <span class="text-2xl font-mono">{{ $order->order_number }}</span>
                            </div>
                            <p class="text-green-100">View and manage order information</p>
                        </div>
                        <div class="hidden md:block">
                            <a href="{{ route('admin.orders.index') }}" class="bg-white text-green-600 hover:bg-green-50 px-6 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Orders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="font-bold">Success!</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Order Status Card -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl mb-6 border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Order Status</h3>
                            <div class="mt-2">
                                @if($order->status === 'pending')
                                    <span class="px-4 py-2 inline-flex text-base leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        ⏳ Pending Approval
                                    </span>
                                @elseif($order->status === 'approved')
                                    <span class="px-4 py-2 inline-flex text-base leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        ✓ Approved
                                    </span>
                                @elseif($order->status === 'rejected')
                                    <span class="px-4 py-2 inline-flex text-base leading-5 font-semibold rounded-full bg-gray-600 text-white">
                                        ✗ Rejected
                                    </span>
                                @elseif($order->status === 'completed')
                                    <span class="px-4 py-2 inline-flex text-base leading-5 font-semibold rounded-full bg-green-600 text-white">
                                        ✓ Completed
                                    </span>
                                @elseif($order->status === 'cancelled')
                                    <span class="px-4 py-2 inline-flex text-base leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Cancelled
                                    </span>
                                @endif
                            </div>
                            @if($order->admin_notes)
                                <div class="mt-3">
                                    <p class="text-sm text-gray-600"><strong>Admin Notes:</strong></p>
                                    <p class="text-sm text-gray-700 mt-1">{{ $order->admin_notes }}</p>
                                </div>
                            @endif
                            @if($order->approvedBy)
                                <div class="mt-2 text-sm text-gray-600">
                                    <p>Processed by: <strong>{{ $order->approvedBy->name }}</strong></p>
                                    <p>Date: {{ $order->approved_at->format('M d, Y h:i A') }}</p>
                                </div>
                            @endif
                        </div>
                        @if($order->status === 'pending')
                            <div class="flex space-x-3">
                                <button onclick="showApproveModal()" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold shadow-md hover:shadow-lg transition-all duration-200">
                                    ✓ Approve Order
                                </button>
                                <button onclick="showRejectModal()" class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 font-semibold shadow-md hover:shadow-lg transition-all duration-200">
                                    ✗ Reject Order
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Customer Information -->
                <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Customer Information</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-600">Name</p>
                                <p class="text-sm font-medium text-gray-900">{{ $order->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Email</p>
                                <p class="text-sm font-medium text-gray-900">{{ $order->user->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Order Date</p>
                                <p class="text-sm font-medium text-gray-900">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delivery Information -->
                <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Delivery Information</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-600">Delivery Address</p>
                                <p class="text-sm font-medium text-gray-900">{{ $order->delivery_address }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Coordinates</p>
                                <p class="text-sm font-medium text-gray-900">
                                    Lat: {{ $order->delivery_latitude }}, Lng: {{ $order->delivery_longitude }}
                                </p>
                            </div>
                            @if($order->delivery_notes)
                                <div>
                                    <p class="text-sm text-gray-600">Delivery Notes</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $order->delivery_notes }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100 mt-6">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Order Items</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Product
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quantity
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($order->items as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $item->product_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            ₱{{ number_format($item->price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                            ₱{{ number_format($item->subtotal, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-sm font-medium text-gray-900 text-right">
                                        Subtotal
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                                        ₱{{ number_format($order->subtotal, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-sm font-medium text-gray-900 text-right">
                                        Delivery Fee
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                                        ₱{{ number_format($order->delivery_fee, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-sm font-bold text-gray-900 text-right">
                                        Total
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-right">
                                        ₱{{ number_format($order->total, 2) }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Approve Modal -->
    <div id="approveModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Approve Order</h3>
                <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-4">
                        <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Admin Notes (Optional)
                        </label>
                        <textarea 
                            id="admin_notes" 
                            name="admin_notes" 
                            rows="3" 
                            class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Add any notes about this approval..."></textarea>
                    </div>
                    <div class="flex space-x-3">
                        <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Confirm Approval
                        </button>
                        <button type="button" onclick="hideApproveModal()" class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Reject Order</h3>
                <form action="{{ route('admin.orders.reject', $order->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-4">
                        <label for="reject_notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Reason for Rejection <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="reject_notes" 
                            name="admin_notes" 
                            rows="3" 
                            required
                            class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Please provide a reason for rejecting this order..."></textarea>
                    </div>
                    <div class="flex space-x-3">
                        <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Confirm Rejection
                        </button>
                        <button type="button" onclick="hideRejectModal()" class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

        function showApproveModal() {
            document.getElementById('approveModal').classList.remove('hidden');
        }

        function hideApproveModal() {
            document.getElementById('approveModal').classList.add('hidden');
        }

        function showRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function hideRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const approveModal = document.getElementById('approveModal');
            const rejectModal = document.getElementById('rejectModal');
            if (event.target === approveModal) {
                hideApproveModal();
            }
            if (event.target === rejectModal) {
                hideRejectModal();
            }
        }
    </script>
</body>
</html>
