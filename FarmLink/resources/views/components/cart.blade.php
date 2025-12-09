<!-- Cart Sidebar -->
<div id="cart-sidebar" class="fixed top-0 right-0 h-full w-80 bg-white shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-50">
    <div class="flex flex-col h-full">
        <!-- Cart Header -->
        <div class="flex items-center justify-between p-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Shopping Cart</h2>
            <button onclick="toggleCart()" class="text-gray-600 hover:text-gray-800">
                <span class="text-xl">×</span>
            </button>
        </div>

        <!-- Cart Items -->
        <div class="flex-1 overflow-y-auto">
            <div id="cart-items" class="p-4">
                <!-- Cart items will be dynamically inserted here -->
                <div id="empty-cart" class="text-center py-8 text-gray-500">
                    <span class="text-4xl mb-4 block">🛒</span>
                    <p>Your cart is empty</p>
                    <p class="text-sm">Add some fresh produce to get started!</p>
                </div>
            </div>
        </div>

        <!-- Cart Footer -->
        <div class="border-t p-4">
            <div class="flex justify-between items-center mb-4">
                <span class="text-lg font-semibold">Total:</span>
                <span id="cart-total" class="text-xl font-bold text-green-600">₱0.00</span>
            </div>
            <div class="space-y-2">
                <button onclick="goToCheckout()" class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300">
                    Checkout
                </button>
                <button onclick="clearCart()" class="w-full border border-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-50 transition duration-300">
                    Clear Cart
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Cart Overlay -->
<div id="cart-overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40" onclick="toggleCart()"></div>

<script>
// Initialize global cart variable
if (typeof window.cart === 'undefined') {
    window.cart = JSON.parse(sessionStorage.getItem('farmLinkCart')) || [];
}

// Cart functionality
let isCartOpen = false;

// Toggle cart sidebar - make it globally available
window.toggleCart = function() {
    const cartSidebar = document.getElementById('cart-sidebar');
    const cartOverlay = document.getElementById('cart-overlay');
    
    if (!cartSidebar || !cartOverlay) {
        console.error('Cart elements not found');
        return;
    }
    
    isCartOpen = !isCartOpen;
    
    if (isCartOpen) {
        cartSidebar.classList.remove('translate-x-full');
        cartOverlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        updateCartDisplay(); // Update display when opening cart
    } else {
        cartSidebar.classList.add('translate-x-full');
        cartOverlay.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
}

// Update cart display
window.updateCartDisplay = function() {
    // Always use global cart reference
    const cart = window.cart || [];
    
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const emptyCart = document.getElementById('empty-cart');
    
    // Ensure cart is an array
    if (!Array.isArray(cart)) {
        window.cart = [];
        return;
    }
    
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    
    // Update total price with Peso sign
    if (cartTotal) {
        cartTotal.textContent = `₱${totalPrice.toFixed(2)}`;
    }
    
    // Update cart items
    if (cartItems) {
        // Clear existing items except empty cart message
        const items = cartItems.querySelectorAll('.cart-item');
        items.forEach(item => item.remove());
        
        if (cart.length === 0) {
            emptyCart.style.display = 'block';
        } else {
            emptyCart.style.display = 'none';
            
            cart.forEach((item) => {
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item flex justify-between items-center p-3 border-b border-gray-200 last:border-b-0';
                cartItem.innerHTML = `
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800">${item.name}</h4>
                        <p class="text-sm text-gray-600">₱${item.price.toFixed(2)} each</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button onclick="decreaseQuantity('${item.id}')" class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-full hover:bg-gray-300 transition duration-200">
                            <span class="text-sm font-semibold">−</span>
                        </button>
                        <span class="w-8 text-center font-semibold">${item.quantity}</span>
                        <button onclick="increaseQuantity('${item.id}')" class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-full hover:bg-gray-300 transition duration-200">
                            <span class="text-sm font-semibold">+</span>
                        </button>
                        <button onclick="removeFromCart('${item.id}')" class="w-8 h-8 flex items-center justify-center text-red-500 hover:bg-red-50 rounded-full transition duration-200 ml-2">
                            <span class="font-semibold">×</span>
                        </button>
                    </div>
                `;
                cartItems.appendChild(cartItem);
            });
        }
    }
}

// Save cart to sessionStorage
window.saveCart = function() {
    // Always use global cart reference
    sessionStorage.setItem('farmLinkCart', JSON.stringify(window.cart));
    updateCartCount();
    updateCartDisplay();
}

// Increase quantity
window.increaseQuantity = function(id) {
    const item = window.cart.find(item => item.id === id);
    if (item) {
        item.quantity += 1;
        saveCart();
        showToast(`${item.name} quantity increased`, 'success');
    }
}

// Decrease quantity
window.decreaseQuantity = function(id) {
    const item = window.cart.find(item => item.id === id);
    if (item) {
        if (item.quantity > 1) {
            item.quantity -= 1;
            saveCart();
            showToast(`${item.name} quantity decreased`, 'info');
        } else {
            // Remove item if quantity becomes 0
            removeFromCart(id);
        }
    }
}

// Remove item from cart
window.removeFromCart = function(id) {
    const item = window.cart.find(item => item.id === id);
    const itemName = item ? item.name : 'Item';
    
    window.cart = window.cart.filter(item => item.id !== id);
    saveCart();
    showToast(`${itemName} removed from cart`, 'info');
}

// Clear entire cart
window.clearCart = function() {
    if (window.cart.length === 0) {
        showToast('Cart is already empty', 'info');
        return;
    }
    
    if (confirm('Are you sure you want to clear your cart?')) {
        window.cart = [];
        saveCart();
        showToast('Cart cleared', 'info');
    }
}

// Go to checkout page
window.goToCheckout = function() {
    if (window.cart.length === 0) {
        showToast('Your cart is empty', 'error');
        return;
    }
    
    // Close cart and navigate to checkout
    toggleCart();
    window.location.href = '{{ route("checkout") }}';
}

// Checkout function (legacy - kept for compatibility)
window.checkout = function() {
    goToCheckout();
}

// Show toast notification function (if not defined elsewhere)
window.showToast = function(message, type = 'success') {
    const toast = document.createElement('div');
    const bgColor = type === 'error' ? 'bg-red-500' : type === 'info' ? 'bg-blue-500' : 'bg-green-600';
    toast.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
    toast.textContent = message;
    document.body.appendChild(toast);
    
    // Slide in
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);
    
    // Slide out and remove
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            if (document.body.contains(toast)) {
                document.body.removeChild(toast);
            }
        }, 300);
    }, 3000);
}

// Initialize cart display when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize cart from sessionStorage if not already done
    if (typeof window.cart === 'undefined') {
        window.cart = JSON.parse(sessionStorage.getItem('farmLinkCart')) || [];
    }
    
    updateCartDisplay();
    
    // Update cart count if function exists
    if (typeof window.updateCartCount === 'function') {
        window.updateCartCount();
    }
});
</script>