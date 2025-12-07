<!-- Image Slider Component -->
<div class="relative w-full max-w-4xl mx-auto">
    <div class="relative h-96 overflow-hidden rounded-lg shadow-lg">
        <!-- Slide 1 -->
        <div class="slider-item absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-100">
            <img src="{{ asset('images/slider/vegetables.jpg') }}" alt="Fresh Vegetables" 
                 class="w-full h-full object-cover"
                 onerror="this.style.background='linear-gradient(135deg, #22c55e, #16a34a)'; this.style.display='flex'; this.style.alignItems='center'; this.style.justifyContent='center'; this.innerHTML='🥕'; this.style.fontSize='6rem'; this.style.color='white';"
                 loading="lazy">
            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                <div class="text-center text-white">
                    <h3 class="text-3xl font-bold mb-2">Fresh Vegetables</h3>
                    <p class="text-lg opacity-90">Organic carrots, lettuce, and more from local farms</p>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="slider-item absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0">
            <img src="{{ asset('images/slider/fruits.jpg') }}" alt="Orchard Fresh Fruits" 
                 class="w-full h-full object-cover"
                 onerror="this.style.background='linear-gradient(135deg, #ef4444, #dc2626)'; this.style.display='flex'; this.style.alignItems='center'; this.style.justifyContent='center'; this.innerHTML='🍎'; this.style.fontSize='6rem'; this.style.color='white';"
                 loading="lazy">
            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                <div class="text-center text-white">
                    <h3 class="text-3xl font-bold mb-2">Orchard Fresh Fruits</h3>
                    <p class="text-lg opacity-90">Crispy apples and seasonal fruits direct from orchards</p>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="slider-item absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0">
            <img src="{{ asset('images/slider/grains.jpg') }}" alt="Farm Grains" 
                 class="w-full h-full object-cover"
                 onerror="this.style.background='linear-gradient(135deg, #f59e0b, #d97706)'; this.style.display='flex'; this.style.alignItems='center'; this.style.justifyContent='center'; this.innerHTML='🌽'; this.style.fontSize='6rem'; this.style.color='white';"
                 loading="lazy">
            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                <div class="text-center text-white">
                    <h3 class="text-3xl font-bold mb-2">Farm Grains</h3>
                    <p class="text-lg opacity-90">Fresh corn, wheat, and grains from family farms</p>
                </div>
            </div>
        </div>

        <!-- Slide 4 -->
        <div class="slider-item absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0">
            <img src="{{ asset('images/slider/berries.jpg') }}" alt="Premium Berries" 
                 class="w-full h-full object-cover"
                 onerror="this.style.background='linear-gradient(135deg, #a855f7, #9333ea)'; this.style.display='flex'; this.style.alignItems='center'; this.style.justifyContent='center'; this.innerHTML='🍇'; this.style.fontSize='6rem'; this.style.color='white';"
                 loading="lazy">
            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                <div class="text-center text-white">
                    <h3 class="text-3xl font-bold mb-2">Premium Berries</h3>
                    <p class="text-lg opacity-90">Sweet grapes, berries, and vineyard specialties</p>
                </div>
            </div>
        </div>

        <!-- Navigation Arrows -->
        <button onclick="sliderPreviousSlide()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full p-3 shadow-lg transition duration-300">
            <span class="text-gray-800 text-xl font-bold">‹</span>
        </button>
        <button onclick="sliderNextSlide()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full p-3 shadow-lg transition duration-300">
            <span class="text-gray-800 text-xl font-bold">›</span>
        </button>
    </div>

    <!-- Dot Indicators -->
    <div class="flex justify-center mt-6 space-x-2">
        <button onclick="sliderGoToSlide(0)" class="slider-dot w-3 h-3 rounded-full bg-green-600 opacity-100 transition duration-300"></button>
        <button onclick="sliderGoToSlide(1)" class="slider-dot w-3 h-3 rounded-full bg-gray-400 opacity-60 hover:opacity-80 transition duration-300"></button>
        <button onclick="sliderGoToSlide(2)" class="slider-dot w-3 h-3 rounded-full bg-gray-400 opacity-60 hover:opacity-80 transition duration-300"></button>
        <button onclick="sliderGoToSlide(3)" class="slider-dot w-3 h-3 rounded-full bg-gray-400 opacity-60 hover:opacity-80 transition duration-300"></button>
    </div>
</div>

<script>
// Image Slider functionality - wrapped in IIFE to avoid conflicts
(function() {
    let currentSlide = 0;
    let slideInterval;
    const totalSlides = 4;

    // Initialize slider
    function initializeSlider() {
        console.log('🎠 Initializing image slider...');
        updateSliderDisplay();
        startAutoSlide();
    }

    // Update slider display
    function updateSliderDisplay() {
        const slides = document.querySelectorAll('.slider-item');
        const dots = document.querySelectorAll('.slider-dot');
        
        console.log(`📊 Found ${slides.length} slides and ${dots.length} dots`);
        
        // Hide all slides
        slides.forEach((slide, index) => {
            slide.style.opacity = index === currentSlide ? '1' : '0';
        });
        
        // Update dots
        dots.forEach((dot, index) => {
            if (index === currentSlide) {
                dot.classList.remove('bg-gray-400', 'opacity-60');
                dot.classList.add('bg-green-600', 'opacity-100');
            } else {
                dot.classList.remove('bg-green-600', 'opacity-100');
                dot.classList.add('bg-gray-400', 'opacity-60');
            }
        });
    }

    // Go to specific slide
    function goToSlide(slideIndex) {
        currentSlide = slideIndex;
        updateSliderDisplay();
        resetAutoSlide();
    }

    // Go to next slide
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSliderDisplay();
        resetAutoSlide();
    }

    // Go to previous slide
    function previousSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSliderDisplay();
        resetAutoSlide();
    }

    // Start auto-slide
    function startAutoSlide() {
        slideInterval = setInterval(() => {
            nextSlide();
        }, 5000); // Reduced to 5 seconds for testing
    }

    // Reset auto-slide timer
    function resetAutoSlide() {
        clearInterval(slideInterval);
        startAutoSlide();
    }

    // Make functions globally available for onclick handlers
    window.sliderGoToSlide = goToSlide;
    window.sliderNextSlide = nextSlide;
    window.sliderPreviousSlide = previousSlide;

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        console.log('🚀 DOM loaded, initializing slider...');
        initializeSlider();
        
        // Add hover functionality
        const slider = document.querySelector('.relative.w-full.max-w-4xl');
        
        if (slider) {
            slider.addEventListener('mouseenter', () => {
                console.log('🐭 Mouse enter - pausing slider');
                clearInterval(slideInterval);
            });
            
            slider.addEventListener('mouseleave', () => {
                console.log('🐭 Mouse leave - resuming slider');
                startAutoSlide();
            });
        }
    });
})();
</script>