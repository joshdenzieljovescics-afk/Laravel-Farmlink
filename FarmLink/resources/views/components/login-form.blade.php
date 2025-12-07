<!-- Login/Signup Forms Component -->
<div id="auth-forms">
    <!-- Login Form -->
    <div id="login-form">
        <form id="login-form-element" class="space-y-4">
            @csrf
            <div>
                <label for="login-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input 
                    type="email" 
                    id="login-email" 
                    name="email" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    placeholder="Enter your email"
                >
            </div>
            
            <div>
                <label for="login-password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input 
                    type="password" 
                    id="login-password" 
                    name="password" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    placeholder="Enter your password"
                >
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
                <a href="#" class="text-sm text-green-600 hover:text-green-700">Forgot password?</a>
            </div>

            <button 
                type="submit" 
                class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300"
            >
                Login
            </button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Don't have an account? 
                <button onclick="switchToSignup()" class="text-green-600 hover:text-green-700 font-medium">
                    Sign up here
                </button>
            </p>
        </div>
    </div>

    <!-- Signup Form -->
    <div id="signup-form" class="hidden">
        <form id="signup-form-element" class="space-y-4">
            @csrf
            <div>
                <label for="signup-name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input 
                    type="text" 
                    id="signup-name" 
                    name="name" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    placeholder="Enter your full name"
                >
            </div>

            <div>
                <label for="signup-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input 
                    type="email" 
                    id="signup-email" 
                    name="email" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    placeholder="Enter your email"
                >
            </div>
            
            <div>
                <label for="signup-password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input 
                    type="password" 
                    id="signup-password" 
                    name="password" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    placeholder="Create a password"
                >
            </div>

            <div>
                <label for="signup-password-confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input 
                    type="password" 
                    id="signup-password-confirmation" 
                    name="password_confirmation" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    placeholder="Confirm your password"
                >
            </div>

            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    id="terms" 
                    name="terms" 
                    required
                    class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500"
                >
                <label for="terms" class="ml-2 text-sm text-gray-600">
                    I agree to the <a href="#" class="text-green-600 hover:text-green-700">Terms and Conditions</a>
                </label>
            </div>

            <button 
                type="submit" 
                class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300"
            >
                Create Account
            </button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Already have an account? 
                <button onclick="switchToLogin()" class="text-green-600 hover:text-green-700 font-medium">
                    Login here
                </button>
            </p>
        </div>
    </div>
</div>

<script>
let currentAuthMode = 'login';

// Switch to signup form
function switchToSignup() {
    currentAuthMode = 'signup';
    document.getElementById('modal-title').textContent = 'Sign Up';
    document.getElementById('login-form').classList.add('hidden');
    document.getElementById('signup-form').classList.remove('hidden');
}

// Switch to login form
function switchToLogin() {
    currentAuthMode = 'login';
    document.getElementById('modal-title').textContent = 'Login';
    document.getElementById('signup-form').classList.add('hidden');
    document.getElementById('login-form').classList.remove('hidden');
}

// Handle form submissions
document.addEventListener('DOMContentLoaded', function() {
    // Login form submission
    const loginForm = document.getElementById('login-form-element');
    loginForm?.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const email = formData.get('email');
        const password = formData.get('password');
        
        // For now, just show a success message
        showToast('Login functionality will be implemented with Laravel Fortify', 'info');
        
        // Close modal
        document.getElementById('auth-modal').classList.add('hidden');
        document.getElementById('auth-modal').classList.remove('flex');
    });

    // Signup form submission
    const signupForm = document.getElementById('signup-form-element');
    signupForm?.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const name = formData.get('name');
        const email = formData.get('email');
        const password = formData.get('password');
        const passwordConfirmation = formData.get('password_confirmation');
        
        // Basic validation
        if (password !== passwordConfirmation) {
            showToast('Passwords do not match', 'error');
            return;
        }
        
        // For now, just show a success message
        showToast('Signup functionality will be implemented with Laravel Fortify', 'info');
        
        // Close modal
        document.getElementById('auth-modal').classList.add('hidden');
        document.getElementById('auth-modal').classList.remove('flex');
    });
});

// Update modal content when auth modal is opened
document.addEventListener('DOMContentLoaded', function() {
    const originalOpenAuthModal = window.openAuthModal;
    
    window.openAuthModal = function(mode) {
        const modalContent = document.getElementById('modal-content');
        const authForms = document.getElementById('auth-forms');
        
        // Replace modal content with auth forms
        modalContent.innerHTML = authForms.outerHTML;
        
        // Set the correct form
        if (mode === 'signup') {
            switchToSignup();
        } else {
            switchToLogin();
        }
        
        // Show modal
        const authModal = document.getElementById('auth-modal');
        authModal.classList.remove('hidden');
        authModal.classList.add('flex');
    };
});
</script>