<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Developers - FarmLink Team</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS CDN with Custom Farm Colors -->
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
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-farm-cream min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <span class="text-2xl">🌱</span>
                    <a href="/" class="text-2xl font-bold text-farm-green">FarmLink</a>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="/" class="text-gray-600 hover:text-farm-green transition duration-300">Home</a>
                    <a href="#team" class="text-gray-600 hover:text-farm-green transition duration-300">Team</a>
                    <a href="#contact" class="text-gray-600 hover:text-farm-green transition duration-300">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-farm-green to-green-600 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-4">Meet Our Development Team</h1>
            <p class="text-xl mb-8 max-w-3xl mx-auto">
                We're passionate developers dedicated to connecting farmers with consumers through innovative technology.
                Our team combines agricultural knowledge with cutting-edge web development.
            </p>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-farm-green">Our Team</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                
                <!-- Team Member 1 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="h-64 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                        <img src="/images/team/alex-johnson.jpg" alt="Alex Johnson" class="w-full h-full object-cover" 
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-full h-full flex items-center justify-center" style="display: none;">
                            <span class="text-6xl text-white">👨‍💻</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-gray-800">Alex Johnson</h3>
                        <p class="text-farm-green font-semibold mb-3">Lead Developer</p>
                        <p class="text-gray-600 mb-4">
                            Full-stack developer with 8+ years of experience in Laravel and React. 
                            Passionate about sustainable agriculture and clean code.
                        </p>
                        <div class="flex space-x-3">
                            <a href="#" class="text-blue-500 hover:text-blue-700">LinkedIn</a>
                            <a href="#" class="text-gray-700 hover:text-gray-900">GitHub</a>
                            <a href="mailto:alex@farmlink.com" class="text-farm-green hover:text-green-700">Email</a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="h-64 bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                        <img src="/images/team/sarah-chen.jpg" alt="Sarah Chen" class="w-full h-full object-cover" 
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-full h-full flex items-center justify-center" style="display: none;">
                            <span class="text-6xl text-white">👩‍💻</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-gray-800">Sarah Chen</h3>
                        <p class="text-farm-green font-semibold mb-3">Frontend Specialist</p>
                        <p class="text-gray-600 mb-4">
                            UI/UX expert specializing in responsive design and user experience. 
                            Creates beautiful, accessible interfaces that farmers love to use.
                        </p>
                        <div class="flex space-x-3">
                            <a href="#" class="text-blue-500 hover:text-blue-700">LinkedIn</a>
                            <a href="#" class="text-gray-700 hover:text-gray-900">GitHub</a>
                            <a href="mailto:sarah@farmlink.com" class="text-farm-green hover:text-green-700">Email</a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="h-64 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                        <img src="/images/team/mike-rodriguez.jpg" alt="Mike Rodriguez" class="w-full h-full object-cover" 
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-full h-full flex items-center justify-center" style="display: none;">
                            <span class="text-6xl text-white">👨‍💻</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-gray-800">Mike Rodriguez</h3>
                        <p class="text-farm-green font-semibold mb-3">Backend Engineer</p>
                        <p class="text-gray-600 mb-4">
                            Database and API specialist ensuring secure, scalable infrastructure. 
                            Expert in payment processing and agricultural data management.
                        </p>
                        <div class="flex space-x-3">
                            <a href="#" class="text-blue-500 hover:text-blue-700">LinkedIn</a>
                            <a href="#" class="text-gray-700 hover:text-gray-900">GitHub</a>
                            <a href="mailto:mike@farmlink.com" class="text-farm-green hover:text-green-700">Email</a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="h-64 bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                        <img src="/images/team/emma-thompson.jpg" alt="Emma Thompson" class="w-full h-full object-cover" 
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-full h-full flex items-center justify-center" style="display: none;">
                            <span class="text-6xl text-white">👩‍💻</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-gray-800">Emma Thompson</h3>
                        <p class="text-farm-green font-semibold mb-3">DevOps Engineer</p>
                        <p class="text-gray-600 mb-4">
                            Cloud infrastructure and deployment specialist. Ensures 99.9% uptime 
                            so farmers can always access their orders and customers.
                        </p>
                        <div class="flex space-x-3">
                            <a href="#" class="text-blue-500 hover:text-blue-700">LinkedIn</a>
                            <a href="#" class="text-gray-700 hover:text-gray-900">GitHub</a>
                            <a href="mailto:emma@farmlink.com" class="text-farm-green hover:text-green-700">Email</a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 5 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="h-64 bg-gradient-to-br from-red-400 to-pink-500 flex items-center justify-center">
                        <img src="/images/team/david-park.jpg" alt="David Park" class="w-full h-full object-cover" 
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-full h-full flex items-center justify-center" style="display: none;">
                            <span class="text-6xl text-white">👨‍💻</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-gray-800">David Park</h3>
                        <p class="text-farm-green font-semibold mb-3">Mobile Developer</p>
                        <p class="text-gray-600 mb-4">
                            iOS and Android app developer creating mobile solutions for farmers 
                            and customers on the go. React Native and Flutter expert.
                        </p>
                        <div class="flex space-x-3">
                            <a href="#" class="text-blue-500 hover:text-blue-700">LinkedIn</a>
                            <a href="#" class="text-gray-700 hover:text-gray-900">GitHub</a>
                            <a href="mailto:david@farmlink.com" class="text-farm-green hover:text-green-700">Email</a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 6 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="h-64 bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center">
                        <img src="/images/team/lisa-wang.jpg" alt="Lisa Wang" class="w-full h-full object-cover" 
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-full h-full flex items-center justify-center" style="display: none;">
                            <span class="text-6xl text-white">👩‍💻</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-gray-800">Lisa Wang</h3>
                        <p class="text-farm-green font-semibold mb-3">QA Engineer</p>
                        <p class="text-gray-600 mb-4">
                            Quality assurance specialist ensuring every feature works perfectly. 
                            Automated testing expert with a keen eye for user experience details.
                        </p>
                        <div class="flex space-x-3">
                            <a href="#" class="text-blue-500 hover:text-blue-700">LinkedIn</a>
                            <a href="#" class="text-gray-700 hover:text-gray-900">GitHub</a>
                            <a href="mailto:lisa@farmlink.com" class="text-farm-green hover:text-green-700">Email</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technology Stack Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-farm-green">Our Technology Stack</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-4xl mx-auto">
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-500 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-2xl font-bold">L</span>
                    </div>
                    <h3 class="text-lg font-semibold">Laravel</h3>
                    <p class="text-gray-600 text-sm">PHP Framework</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-500 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-2xl font-bold">R</span>
                    </div>
                    <h3 class="text-lg font-semibold">React</h3>
                    <p class="text-gray-600 text-sm">Frontend Library</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-2xl font-bold">T</span>
                    </div>
                    <h3 class="text-lg font-semibold">Tailwind</h3>
                    <p class="text-gray-600 text-sm">CSS Framework</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-500 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-2xl font-bold">M</span>
                    </div>
                    <h3 class="text-lg font-semibold">MySQL</h3>
                    <p class="text-gray-600 text-sm">Database</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-farm-cream">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl font-bold mb-8 text-farm-green">Work With Us</h2>
                <p class="text-lg text-gray-600 mb-8">
                    Interested in joining our team or have a project idea? We'd love to hear from you!
                </p>
                
                <div class="grid md:grid-cols-2 gap-8 mb-12">
                    <div class="bg-white p-8 rounded-lg shadow-lg">
                        <h3 class="text-2xl font-semibold mb-4 text-gray-800">Join Our Team</h3>
                        <p class="text-gray-600 mb-6">
                            We're always looking for talented developers who share our passion for agriculture and technology.
                        </p>
                        <a href="mailto:careers@farmlink.com" class="bg-farm-green text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300 inline-block">
                            View Open Positions
                        </a>
                    </div>
                    
                    <div class="bg-white p-8 rounded-lg shadow-lg">
                        <h3 class="text-2xl font-semibold mb-4 text-gray-800">Project Inquiry</h3>
                        <p class="text-gray-600 mb-6">
                            Have a custom development project or need technical consultation? Let's discuss your needs.
                        </p>
                        <a href="mailto:hello@farmlink.com" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 inline-block">
                            Start a Project
                        </a>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-semibold mb-6 text-gray-800">Development Contact</h3>
                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <span class="text-farm-green text-2xl">📧</span>
                            <h4 class="font-semibold mt-2">Email</h4>
                            <p class="text-gray-600">dev@farmlink.com</p>
                        </div>
                        <div>
                            <span class="text-farm-green text-2xl">💬</span>
                            <h4 class="font-semibold mt-2">Slack</h4>
                            <p class="text-gray-600">farmlink-dev.slack.com</p>
                        </div>
                        <div>
                            <span class="text-farm-green text-2xl">🐙</span>
                            <h4 class="font-semibold mt-2">GitHub</h4>
                            <p class="text-gray-600">github.com/farmlink</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">FarmLink</h3>
                    <p class="text-gray-300">Connecting farms to families through innovative technology.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Development</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white transition duration-300">API Documentation</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">GitHub Repository</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Contributing</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Changelog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white transition duration-300">Tech Blog</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Case Studies</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Best Practices</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Tutorials</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Connect</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition duration-300">LinkedIn</a>
                        <a href="#" class="text-gray-300 hover:text-white transition duration-300">Twitter</a>
                        <a href="/" class="text-gray-300 hover:text-white transition duration-300">Main Site</a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; 2025 FarmLink Development Team. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>