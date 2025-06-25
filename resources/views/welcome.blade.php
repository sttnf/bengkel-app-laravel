<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Workshop Pro - Modern Automotive Workshop Management</title>
    <meta name="description"
        content="Transform your automotive workshop with our cutting-edge management solution. Streamline operations, boost efficiency, and delight customers with Workshop Pro.">
    <meta name="keywords"
        content="workshop management, automotive, service management, inventory tracking, customer management">
    <meta name="robots" content="index, follow">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Performance Optimization Script -->
    <script defer src="{{ asset('js/performance-optimization.js') }}"></script>

    <!-- Web App Manifest -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#2563eb">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Workshop Pro">
    <link rel="apple-touch-icon" href="{{ asset('icons/apple-touch-icon.png') }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Workshop Pro - Modern Automotive Workshop Management">
    <meta property="og:description"
        content="Transform your automotive workshop with our cutting-edge management solution. Streamline operations, boost efficiency, and delight customers.">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Workshop Pro - Modern Automotive Workshop Management">
    <meta name="twitter:description"
        content="Transform your automotive workshop with our cutting-edge management solution.">
    <meta name="twitter:image" content="{{ asset('images/twitter-card.jpg') }}">

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "SoftwareApplication",
        "name": "Workshop Pro",
        "description": "Modern automotive workshop management solution",
        "applicationCategory": "BusinessApplication",
        "operatingSystem": "Web, iOS, Android",
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "USD",
            "description": "Free trial available"
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.9",
            "reviewCount": "2500"
        }
    }
    </script>

    <!-- Custom Styles -->
    <style>
        [x-cloak] {
            display: none !important;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        /* Enhanced Animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .slide-in-right {
            animation: slideInRight 0.8s ease-out forwards;
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
            }

            50% {
                box-shadow: 0 0 40px rgba(59, 130, 246, 0.6);
            }
        }

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }

        /* Loading skeleton */
        @keyframes shimmer {
            0% {
                background-position: -468px 0;
            }

            100% {
                background-position: 468px 0;
            }
        }

        .shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 400% 100%;
            animation: shimmer 1.2s ease-in-out infinite;
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .auto-dark {
                filter: brightness(0.8);
            }
        }

        /* Smooth scrolling for all browsers */
        * {
            scroll-behavior: smooth;
        }

        /* Custom gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Glass morphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Hover reveal effect */
        .hover-reveal {
            position: relative;
            overflow: hidden;
        }

        .hover-reveal::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .hover-reveal:hover::before {
            left: 100%;
        }

        /* Battery and connection optimizations */
        .low-battery * {
            animation-duration: 0s !important;
            transition-duration: 0.1s !important;
        }

        .slow-connection img {
            filter: blur(1px);
            transition: filter 0.3s;
        }

        .slow-connection img.loaded {
            filter: none;
        }

        .save-data .bg-gradient-to-br,
        .save-data .bg-gradient-to-r {
            background: #3b82f6 !important;
        }

        /* Enhanced loading states */
        .lazy {
            opacity: 0;
            transition: opacity 0.3s;
        }

        .loaded {
            opacity: 1;
        }

        .error {
            opacity: 0.7;
            filter: grayscale(100%);
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {

            .bg-gradient-to-br,
            .bg-gradient-to-r {
                background: #000 !important;
                color: #fff !important;
            }

            .text-gray-600,
            .text-gray-700 {
                color: #000 !important;
            }
        }

        /* Focus visible improvements */
        .focus-visible:focus {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }

        /* Print styles */
        @media print {

            .fixed,
            .absolute {
                position: static !important;
            }

            .bg-gradient-to-br,
            .bg-gradient-to-r {
                background: #f3f4f6 !important;
                color: #000 !important;
            }

            .hidden-print {
                display: none !important;
            }
        }

        /* Animation performance optimizations */
        .animate-optimized {
            will-change: transform;
            transform: translateZ(0);
        }

        /* Scroll snap for better mobile experience */
        @media (max-width: 768px) {
            .snap-scroll {
                scroll-snap-type: y mandatory;
            }

            .snap-scroll>section {
                scroll-snap-align: start;
            }
        }
    </style>
</head>

<body class="font-inter antialiased bg-gray-50 text-gray-900" x-data="{ 
    mobileMenuOpen: false, 
    isScrolled: false,
    activeFeature: 0,
    darkMode: false,
    isLoading: true,
    init() {
        // Initialize loading state
        setTimeout(() => { this.isLoading = false; }, 500);
        
        // Detect user preference for dark mode
        this.darkMode = localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
        
        // Scroll handler for header effects
        this.$watch('isScrolled', value => {
            const header = document.querySelector('header');
            if (value) {
                header.classList.add('backdrop-blur-lg', 'bg-white/95', 'shadow-lg');
            } else {
                header.classList.remove('backdrop-blur-lg', 'bg-white/95', 'shadow-lg');
            }
        });
        
        // Intersection observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up');
                }
            });
        }, observerOptions);
        
        // Observe all animatable elements
        document.querySelectorAll('[data-animate]').forEach(el => observer.observe(el));
        
        // Performance optimization: Preload critical images
        const criticalImages = [
            'https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=800&q=80'
        ];
        criticalImages.forEach(src => {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.as = 'image';
            link.href = src;
            document.head.appendChild(link);
        });
    },
    toggleDarkMode() {
        this.darkMode = !this.darkMode;
        localStorage.theme = this.darkMode ? 'dark' : 'light';
        document.documentElement.classList.toggle('dark', this.darkMode);
    }
}" @scroll.window="isScrolled = window.pageYOffset > 50" :class="{ 'dark': darkMode }">
    <!-- Page Load Progress Bar -->
    <div id="progress-bar"
        class="fixed top-0 left-0 h-1 bg-gradient-to-r from-blue-600 to-indigo-600 transition-all duration-300 ease-out z-50"
        style="width: 0%"></div>

    <!-- Scroll Progress Indicator -->
    <div class="fixed top-0 left-0 w-full h-1 bg-gray-200 z-40">
        <div class="scroll-progress h-full bg-gradient-to-r from-blue-500 to-purple-500 transition-all duration-100"
            style="width: 0%"></div>
    </div>

    <!-- Loading Screen -->
    <div x-show="isLoading" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 bg-white flex items-center justify-center">
        <div class="text-center">
            <div
                class="w-16 h-16 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl flex items-center justify-center mb-4 pulse-glow mx-auto">
                <i class="fas fa-wrench text-white text-2xl animate-spin"></i>
            </div>
            <div class="text-lg font-semibold text-gray-900">Loading Workshop Pro...</div>
            <div class="w-32 h-1 bg-gray-200 rounded-full mt-4 overflow-hidden">
                <div class="h-full bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full animate-pulse"></div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="fixed w-full top-0 z-50 transition-all duration-300 bg-white/90 border-b border-gray-100/50"
        :class="{ 'shadow-lg backdrop-blur-lg bg-white/95': isScrolled }">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 lg:h-20">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-wrench text-white text-lg"></i>
                        </div>
                        <div
                            class="absolute -top-1 -right-1 w-4 h-4 bg-gradient-to-br from-orange-400 to-red-500 rounded-full border-2 border-white">
                        </div>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 tracking-tight">Workshop Pro</h1>
                        <p class="text-xs text-gray-500 -mt-1">Smart Management</p>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-8">
                    <a href="#features"
                        class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 relative group">
                        Features
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="#testimonials"
                        class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 relative group">
                        Testimonials
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="#contact"
                        class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 relative group">
                        Contact
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-200 group-hover:w-full"></span>
                    </a>
                </nav>

                <!-- Auth Buttons -->
                <div class="hidden lg:flex items-center space-x-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                                Sign In
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="lg:hidden p-2 text-gray-700 hover:text-blue-600 transition-colors">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2"
                class="lg:hidden border-t border-gray-100 bg-white/95 backdrop-blur-lg" x-cloak
                @click.away="mobileMenuOpen = false">
                <div class="px-4 py-6 space-y-4">
                    <a href="#features" @click="mobileMenuOpen = false"
                        class="block text-gray-700 hover:text-blue-600 font-medium py-2 transition-colors">Features</a>
                    <a href="#testimonials" @click="mobileMenuOpen = false"
                        class="block text-gray-700 hover:text-blue-600 font-medium py-2 transition-colors">Testimonials</a>
                    <a href="#contact" @click="mobileMenuOpen = false"
                        class="block text-gray-700 hover:text-blue-600 font-medium py-2 transition-colors">Contact</a>
                    <div class="pt-4 border-t border-gray-200 space-y-3">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="block w-full text-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="block w-full text-center px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:border-blue-600 transition-colors">
                                    Sign In
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="block w-full text-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg">
                                        Get Started
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="pt-16 lg:pt-20">
        <!-- Hero Section -->
        <section
            class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-20 lg:py-32">
            <!-- Background Elements -->
            <div class="absolute inset-0 opacity-30">
                <div
                    class="absolute top-10 left-10 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse">
                </div>
                <div
                    class="absolute top-0 right-0 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-2000">
                </div>
                <div
                    class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-4000">
                </div>
            </div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                    <!-- Hero Content -->
                    <div class="text-center lg:text-left" x-data="{ 
                            words: ['Efficiency', 'Innovation', 'Success', 'Growth'],
                            currentWord: 0
                         }" x-init="setInterval(() => { currentWord = (currentWord + 1) % words.length }, 3000)">
                        <div
                            class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold mb-6">
                            <i class="fas fa-star mr-2"></i>
                            #1 Workshop Management Solution
                        </div>

                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                            Transform Your Workshop with
                            <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 block"
                                x-text="words[currentWord]"></span>
                        </h1>

                        <p class="text-xl text-gray-600 mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                            Streamline operations, boost productivity, and deliver exceptional service with our
                            comprehensive workshop management platform. Join thousands of workshops already transforming
                            their business.
                        </p>

                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start mb-8">
                            <a href="{{ Route::has('register') ? route('register') : '#' }}"
                                class="group inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                                <i class="fas fa-rocket mr-2 group-hover:animate-bounce"></i>
                                Start Free Trial
                                <span class="ml-2 opacity-75">→</span>
                            </a>
                            <a href="#features"
                                class="group inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:border-blue-600 hover:text-blue-600 transition-all duration-300">
                                <i class="fas fa-play mr-2 group-hover:text-blue-600"></i>
                                Explore Features
                            </a>
                        </div>

                        <!-- Trust Indicators -->
                        <div
                            class="flex flex-wrap items-center justify-center lg:justify-start gap-6 text-sm text-gray-500">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                No Credit Card Required
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock text-blue-500 mr-2"></i>
                                Setup in 5 Minutes
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-shield-alt text-indigo-500 mr-2"></i>
                                Enterprise Security
                            </div>
                        </div>
                    </div>

                    <!-- Hero Image/Video -->
                    <div class="relative float" x-data="{ imageLoaded: false }">
                        <div
                            class="relative rounded-2xl overflow-hidden shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-500">
                            <img src="https://images.unsplash.com/photo-1625047509248-ec889cbff17f?q=80&w=1332&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Modern Workshop Dashboard Preview" class="w-full h-96 object-cover">

                            <!-- Floating Stats Cards -->
                            <div
                                class="absolute -top-4 -left-4 bg-white rounded-xl shadow-lg p-4 transform -rotate-6 hover:rotate-0 transition-transform duration-300">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                                    <div>
                                        <div class="text-sm font-semibold text-gray-900">24 Active Jobs</div>
                                        <div class="text-xs text-gray-500">+12% this week</div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="absolute -bottom-4 -right-4 bg-white rounded-xl shadow-lg p-4 transform rotate-6 hover:rotate-0 transition-transform duration-300">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-blue-400 rounded-full animate-pulse"></div>
                                    <div>
                                        <div class="text-sm font-semibold text-gray-900">98% Satisfaction</div>
                                        <div class="text-xs text-gray-500">Customer rating</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 lg:py-32 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <div
                        class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold mb-6">
                        <i class="fas fa-cogs mr-2"></i>
                        Powerful Features
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                        Everything Your Workshop Needs
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Comprehensive tools designed specifically for modern automotive workshops. Boost efficiency,
                        improve customer satisfaction, and grow your business.
                    </p>
                </div>

                <!-- Interactive Feature Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" x-data="{ hoveredFeature: null }">

                    <!-- Feature 1: Service Management -->
                    <div class="group relative p-8 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-100 hover:border-blue-300 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl"
                        @mouseenter="hoveredFeature = 1" @mouseleave="hoveredFeature = null">
                        <div class="relative z-10">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-clipboard-list text-2xl text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Smart Service Management</h3>
                            <p class="text-gray-600 mb-6">Track service requests from intake to completion. Automated
                                workflows, real-time updates, and intelligent scheduling keep your workshop running
                                smoothly.</p>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Digital service forms
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Automated status updates
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Resource scheduling
                                </li>
                            </ul>
                        </div>
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                        </div>
                    </div>

                    <!-- Feature 2: Inventory Management -->
                    <div class="group relative p-8 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border border-green-100 hover:border-green-300 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl"
                        @mouseenter="hoveredFeature = 2" @mouseleave="hoveredFeature = null">
                        <div class="relative z-10">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-boxes text-2xl text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Intelligent Inventory</h3>
                            <p class="text-gray-600 mb-6">Real-time stock monitoring with predictive analytics. Never
                                run out of essential parts and optimize your inventory investment with smart reorder
                                points.</p>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Low stock alerts
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Barcode scanning
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Supplier management
                                </li>
                            </ul>
                        </div>
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-green-600 to-emerald-700 rounded-2xl opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                        </div>
                    </div>

                    <!-- Feature 3: Customer Portal -->
                    <div class="group relative p-8 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl border border-purple-100 hover:border-purple-300 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl"
                        @mouseenter="hoveredFeature = 3" @mouseleave="hoveredFeature = null">
                        <div class="relative z-10">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-users text-2xl text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Customer Experience</h3>
                            <p class="text-gray-600 mb-6">Self-service portal for customers to book services, track
                                progress, and access vehicle history. Build trust and improve satisfaction
                                automatically.</p>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Online booking
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Progress tracking
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Digital receipts
                                </li>
                            </ul>
                        </div>
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-purple-600 to-pink-700 rounded-2xl opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                        </div>
                    </div>

                    <!-- Feature 4: Analytics -->
                    <div class="group relative p-8 bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl border border-orange-100 hover:border-orange-300 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl"
                        @mouseenter="hoveredFeature = 4" @mouseleave="hoveredFeature = null">
                        <div class="relative z-10">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-chart-line text-2xl text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Business Intelligence</h3>
                            <p class="text-gray-600 mb-6">Comprehensive analytics and reporting to understand your
                                business performance. Make data-driven decisions to grow your workshop.</p>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Revenue analytics
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Performance metrics
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Custom reports
                                </li>
                            </ul>
                        </div>
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-orange-600 to-red-700 rounded-2xl opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                        </div>
                    </div>

                    <!-- Feature 5: Mobile App -->
                    <div class="group relative p-8 bg-gradient-to-br from-teal-50 to-cyan-50 rounded-2xl border border-teal-100 hover:border-teal-300 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl"
                        @mouseenter="hoveredFeature = 5" @mouseleave="hoveredFeature = null">
                        <div class="relative z-10">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-mobile-alt text-2xl text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Mobile First</h3>
                            <p class="text-gray-600 mb-6">Native mobile apps for technicians and managers. Access
                                everything you need from anywhere in the workshop or on the road.</p>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    iOS & Android apps
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Offline capability
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Push notifications
                                </li>
                            </ul>
                        </div>
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-teal-600 to-cyan-700 rounded-2xl opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                        </div>
                    </div>

                    <!-- Feature 6: Integration -->
                    <div class="group relative p-8 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl border border-indigo-100 hover:border-indigo-300 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl"
                        @mouseenter="hoveredFeature = 6" @mouseleave="hoveredFeature = null">
                        <div class="relative z-10">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-plug text-2xl text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Seamless Integration</h3>
                            <p class="text-gray-600 mb-6">Connect with your existing tools and systems. QuickBooks,
                                payment processors, and more. No disruption to your workflow.</p>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Accounting software
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    Payment gateways
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    API access
                                </li>
                            </ul>
                        </div>
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-indigo-600 to-purple-700 rounded-2xl opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                        </div>
                    </div>
                </div>

                <!-- Feature Demo Section -->
                <div class="mt-20 text-center">
                    <div
                        class="inline-flex items-center space-x-4 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border border-blue-200">
                        <div class="flex -space-x-2">
                            <img class="w-10 h-10 rounded-full border-2 border-white"
                                src="https://randomuser.me/api/portraits/men/1.jpg" alt="">
                            <img class="w-10 h-10 rounded-full border-2 border-white"
                                src="https://randomuser.me/api/portraits/women/2.jpg" alt="">
                            <img class="w-10 h-10 rounded-full border-2 border-white"
                                src="https://randomuser.me/api/portraits/men/3.jpg" alt="">
                            <div
                                class="w-10 h-10 rounded-full border-2 border-white bg-blue-600 flex items-center justify-center text-white text-sm font-semibold">
                                +50</div>
                        </div>
                        <div class="text-left">
                            <p class="text-gray-900 font-semibold">Join 2,000+ workshop owners</p>
                            <p class="text-gray-600 text-sm">Already transforming their business</p>
                        </div>
                        <a href="{{ Route::has('register') ? route('register') : '#' }}"
                            class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200">
                            Join Them
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistics & Testimonials Section -->
        <section id="testimonials"
            class="py-20 lg:py-32 bg-gradient-to-br from-gray-900 via-blue-900 to-indigo-900 text-white relative overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute inset-0 opacity-20">
                <div
                    class="absolute top-0 left-1/4 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl">
                </div>
                <div
                    class="absolute bottom-0 right-1/4 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl">
                </div>
            </div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <!-- Statistics -->
                    <div class="text-center lg:text-left">
                        <div
                            class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-lg rounded-full text-sm font-semibold mb-6">
                            <i class="fas fa-trophy mr-2 text-yellow-400"></i>
                            Trusted Worldwide
                        </div>
                        <h2 class="text-4xl lg:text-5xl font-bold mb-8">
                            Powering Success Across
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">
                                50+ Countries
                            </span>
                        </h2>

                        <!-- Animated Statistics -->
                        <div class="grid grid-cols-2 gap-8 mb-12" x-data="{
                            workshops: 0,
                            satisfaction: 0,
                            uptime: 0,
                            support: 0,
                            init() {
                                this.animateNumbers();
                            },
                            animateNumbers() {
                                const duration = 2000;
                                const fps = 60;
                                const steps = duration / (1000 / fps);
                                
                                let step = 0;
                                const interval = setInterval(() => {
                                    step++;
                                    const progress = step / steps;
                                    const easeOut = 1 - Math.pow(1 - progress, 3);
                                    
                                    this.workshops = Math.floor(2500 * easeOut);
                                    this.satisfaction = Math.floor(99 * easeOut);
                                    this.uptime = Math.floor(99.9 * easeOut * 10) / 10;
                                    this.support = progress > 0.8 ? 24 : 0;
                                    
                                    if (step >= steps) clearInterval(interval);
                                }, 1000 / fps);
                            }
                        }">
                            <div class="text-center">
                                <div class="text-4xl lg:text-5xl font-bold mb-2"
                                    x-text="workshops.toLocaleString() + '+'"></div>
                                <div class="text-blue-200 text-sm font-medium">Active Workshops</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl lg:text-5xl font-bold mb-2" x-text="satisfaction + '%'"></div>
                                <div class="text-blue-200 text-sm font-medium">Satisfaction Rate</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl lg:text-5xl font-bold mb-2" x-text="uptime + '%'"></div>
                                <div class="text-blue-200 text-sm font-medium">Uptime Guarantee</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl lg:text-5xl font-bold mb-2">
                                    <span x-text="support"></span><span x-show="support > 0">/7</span>
                                </div>
                                <div class="text-blue-200 text-sm font-medium">Expert Support</div>
                            </div>
                        </div>

                        <a href="{{ Route::has('register') ? route('register') : '#' }}"
                            class="inline-flex items-center px-8 py-4 bg-white text-gray-900 font-bold rounded-xl hover:bg-gray-100 transition-all duration-200 transform hover:scale-105 shadow-xl">
                            <i class="fas fa-rocket mr-2"></i>
                            Start Your Success Story
                        </a>
                    </div>

                    <!-- Testimonials Carousel -->
                    <div class="relative" x-data="{ 
                        currentTestimonial: 0,
                        testimonials: [
                            {
                                quote: 'Workshop Pro transformed our business completely. We\'ve increased efficiency by 40% and our customers love the new experience!',
                                author: 'Andi Saputra',
                                role: 'Owner, Bengkel Maju Jaya',
                                image: 'https://randomuser.me/api/portraits/men/32.jpg',
                                rating: 5
                            },
                            {
                                quote: 'The inventory management and analytics features are game changers. We save 10+ hours per week and never run out of parts.',
                                author: 'Siti Rahmawati',
                                role: 'Manager, AutoCare Express',
                                image: 'https://randomuser.me/api/portraits/women/44.jpg',
                                rating: 5
                            },
                            {
                                quote: 'Implementation was seamless and the support team is exceptional. Our technicians adapted quickly and love the mobile app.',
                                author: 'Budi Santoso',
                                role: 'Operations Director, Fast Fix Auto',
                                image: 'https://randomuser.me/api/portraits/men/15.jpg',
                                rating: 5
                            }
                        ]
                    }"
                        x-init="setInterval(() => { currentTestimonial = (currentTestimonial + 1) % testimonials.length }, 5000)">

                        <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20">
                            <!-- Stars -->
                            <div class="flex justify-center mb-6">
                                <template x-for="i in 5" :key="i">
                                    <i class="fas fa-star text-yellow-400 text-xl mx-1"></i>
                                </template>
                            </div>

                            <!-- Quote -->
                            <blockquote class="text-xl lg:text-2xl text-center mb-8 italic font-light leading-relaxed"
                                x-text="'\"' + testimonials[currentTestimonial].quote + ' \"'">
                            </blockquote>

                            <!-- Author -->
                            <div class="flex items-center justify-center space-x-4">
                                <img :src="testimonials[currentTestimonial].image"
                                    :alt="testimonials[currentTestimonial].author"
                                    class="w-16 h-16 rounded-full border-4 border-white/30">
                                <div class="text-center">
                                    <div class="font-bold text-lg" x-text="testimonials[currentTestimonial].author">
                                    </div>
                                    <div class="text-blue-200 text-sm" x-text="testimonials[currentTestimonial].role">
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial Navigation -->
                            <div class="flex justify-center space-x-2 mt-8">
                                <template x-for="(testimonial, index) in testimonials" :key="index">
                                    <button @click="currentTestimonial = index"
                                        class="w-3 h-3 rounded-full transition-all duration-200"
                                        :class="currentTestimonial === index ? 'bg-white' : 'bg-white/30 hover:bg-white/50'">
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section id="contact" class="py-20 lg:py-32 bg-gradient-to-br from-blue-50 to-indigo-100">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="max-w-4xl mx-auto">
                    <div
                        class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold mb-6">
                        <i class="fas fa-rocket mr-2"></i>
                        Ready to Get Started?
                    </div>

                    <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                        Transform Your Workshop Today
                    </h2>

                    <p class="text-xl text-gray-600 mb-12 max-w-2xl mx-auto">
                        Join thousands of workshop owners who have already revolutionized their business with Workshop
                        Pro. Start your free trial today - no credit card required.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                        <a href="{{ Route::has('register') ? route('register') : '#' }}"
                            class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-xl">
                            <i class="fas fa-rocket mr-2"></i>
                            Start Free Trial
                            <span class="ml-2">→</span>
                        </a>
                        <a href="#features"
                            class="inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:border-blue-600 hover:text-blue-600 transition-all duration-300">
                            <i class="fas fa-phone mr-2"></i>
                            Book a Demo
                        </a>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-2xl mx-auto">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-shield-check text-3xl text-green-500 mb-2"></i>
                            <p class="text-sm text-gray-600 font-medium">30-Day Money Back Guarantee</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <i class="fas fa-headset text-3xl text-blue-500 mb-2"></i>
                            <p class="text-sm text-gray-600 font-medium">24/7 Expert Support</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <i class="fas fa-cloud-upload text-3xl text-purple-500 mb-2"></i>
                            <p class="text-sm text-gray-600 font-medium">Free Data Migration</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12 border-t border-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl flex items-center justify-center">
                            <i class="fas fa-wrench text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Workshop Pro</h3>
                            <p class="text-xs text-gray-400 -mt-1">Smart Management</p>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-6 max-w-md">
                        The leading workshop management solution trusted by thousands of automotive businesses
                        worldwide. Transform your operations today.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <i class="fab fa-facebook-f text-gray-300 hover:text-white"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <i class="fab fa-twitter text-gray-300 hover:text-white"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <i class="fab fa-linkedin-in text-gray-300 hover:text-white"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <i class="fab fa-instagram text-gray-300 hover:text-white"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#features" class="text-gray-400 hover:text-white transition-colors">Features</a>
                        </li>
                        <li><a href="#testimonials"
                                class="text-gray-400 hover:text-white transition-colors">Testimonials</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Support</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Documentation</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">API Reference</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">System Status</a></li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="flex flex-col md:flex-row justify-between items-center pt-8 border-t border-gray-800">
                <div class="text-sm text-gray-400 mb-4 md:mb-0">
                    &copy; {{ date('Y') }} Workshop Pro. All rights reserved.
                </div>
                <div class="flex space-x-6 text-sm">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <div x-data="{ showButton: false }" @scroll.window="showButton = window.pageYOffset > 300" x-show="showButton"
        x-transition.opacity.duration.300ms class="fixed bottom-8 right-8 z-50">
        <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 flex items-center justify-center">
            <i class="fas fa-arrow-up"></i>
        </button>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        // Page load progress bar
        window.addEventListener('load', function () {
            const progressBar = document.getElementById('progress-bar');
            progressBar.style.width = '100%';
            setTimeout(() => {
                progressBar.style.opacity = '0';
                setTimeout(() => {
                    progressBar.style.display = 'none';
                }, 300);
            }, 500);
        });

        // Scroll progress indicator
        window.addEventListener('scroll', function () {
            const scrollProgress = document.querySelector('.scroll-progress');
            if (scrollProgress) {
                const scrollTop = window.pageYOffset;
                const docHeight = document.documentElement.scrollHeight - window.innerHeight;
                const progress = (scrollTop / docHeight) * 100;
                scrollProgress.style.width = progress + '%';
            }
        }, { passive: true });

        // Enhanced image loading with better fallbacks
        document.addEventListener('DOMContentLoaded', function () {
            const images = document.querySelectorAll('img[data-src]');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const src = img.getAttribute('data-src');

                        // Create a new image to preload
                        const newImg = new Image();
                        newImg.onload = function () {
                            img.src = src;
                            img.classList.remove('lazy');
                            img.classList.add('loaded');
                        };
                        newImg.onerror = function () {
                            img.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAwIiBoZWlnaHQ9IjYwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjNmNGY2Ii8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzZiNzI4MCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkltYWdlIE5vdCBBdmFpbGFibGU8L3RleHQ+PC9zdmc+';
                            img.classList.add('error');
                        };
                        newImg.src = src;
                        observer.unobserve(img);
                    }
                });
            }, { rootMargin: '50px' });

            images.forEach(img => imageObserver.observe(img));
        });

        // Performance monitoring
        if ('performance' in window) {
            window.addEventListener('load', function () {
                setTimeout(function () {
                    const navigation = performance.getEntriesByType('navigation')[0];
                    const paint = performance.getEntriesByType('paint');

                    const metrics = {
                        'First Contentful Paint': paint.find(entry => entry.name === 'first-contentful-paint')?.startTime || 0,
                        'DOM Content Loaded': navigation.domContentLoadedEventEnd - navigation.navigationStart,
                        'Page Load Complete': navigation.loadEventEnd - navigation.navigationStart
                    };

                    console.log('Performance Metrics:', metrics);

                    // Send to analytics if needed
                    if (typeof gtag !== 'undefined') {
                        Object.entries(metrics).forEach(([name, value]) => {
                            gtag('event', 'timing_complete', {
                                name: name,
                                value: Math.round(value)
                            });
                        });
                    }
                }, 0);
            });
        }

        // Enhanced form handling with offline support
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    if (!navigator.onLine) {
                        e.preventDefault();
                        // Store form data for later submission
                        const formData = new FormData(form);
                        const data = {};
                        for (let [key, value] of formData.entries()) {
                            data[key] = value;
                        }
                        localStorage.setItem('offline_form_' + Date.now(), JSON.stringify(data));

                        // Show offline message
                        const message = document.createElement('div');
                        message.className = 'fixed top-4 right-4 bg-orange-500 text-white p-4 rounded-lg shadow-lg z-50';
                        message.textContent = 'Form saved. Will be submitted when online.';
                        document.body.appendChild(message);

                        setTimeout(() => {
                            message.remove();
                        }, 5000);
                    }
                });
            });

            // Submit offline forms when back online
            window.addEventListener('online', function () {
                const offlineForms = Object.keys(localStorage).filter(key => key.startsWith('offline_form_'));
                offlineForms.forEach(key => {
                    const data = JSON.parse(localStorage.getItem(key));
                    // Submit form data here
                    console.log('Submitting offline form:', data);
                    localStorage.removeItem(key);
                });
            });
        });

        // Battery status optimization
        if ('getBattery' in navigator) {
            navigator.getBattery().then(function (battery) {
                function updateBatteryStatus() {
                    if (battery.level < 0.2 && !battery.charging) {
                        document.documentElement.classList.add('low-battery');
                        // Reduce animations and visual effects
                    } else {
                        document.documentElement.classList.remove('low-battery');
                    }
                }

                battery.addEventListener('levelchange', updateBatteryStatus);
                battery.addEventListener('chargingchange', updateBatteryStatus);
                updateBatteryStatus();
            });
        }

        // Connection-aware optimizations
        if ('connection' in navigator) {
            function updateConnectionStatus() {
                const connection = navigator.connection;
                const body = document.body;

                if (connection.effectiveType === 'slow-2g' || connection.effectiveType === '2g') {
                    body.classList.add('slow-connection');
                } else {
                    body.classList.remove('slow-connection');
                }

                if (connection.saveData) {
                    body.classList.add('save-data');
                }
            }

            navigator.connection.addEventListener('change', updateConnectionStatus);
            updateConnectionStatus();
        }
    </script>
</body>

</html>