<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- GSAP -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .floating-shape {
                position: absolute;
                border-radius: 50%;
                filter: blur(60px);
                opacity: 0.3;
            }

            .particle {
                position: absolute;
                background: white;
                border-radius: 50%;
                pointer-events: none;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex">
            <!-- Left Side - Branding -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-primary-600 via-primary-700 to-secondary-600 relative overflow-hidden">
                <!-- Animated Background Shapes -->
                <div class="floating-shape bg-white w-96 h-96" id="shape1" style="top: -10%; left: -10%;"></div>
                <div class="floating-shape bg-secondary-400 w-80 h-80" id="shape2" style="bottom: -15%; right: -15%;"></div>
                <div class="floating-shape bg-accent-400 w-64 h-64" id="shape3" style="top: 40%; right: 20%;"></div>

                <!-- Floating Particles -->
                <div id="particles-container"></div>

                <!-- Animated Grid Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                                <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#grid)" class="animated-grid"/>
                    </svg>
                </div>

                <!-- Content -->
                <div class="relative z-10 flex flex-col justify-center items-center w-full p-12 text-white">
                    <!-- Logo -->
                    <div class="mb-8 text-center" id="logo-container">
                        <div class="logo-wrapper inline-block">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-28 w-28 mb-4 mx-auto drop-shadow-2xl" id="auth-logo">
                        </div>
                        <h1 class="text-5xl font-bold mb-2 auth-title">Little Flower High School</h1>
                        <p class="text-secondary-100 text-xl auth-subtitle">Nurturing Excellence Since 1961</p>
                    </div>

                    <!-- Features -->
                    <div class="mt-12 space-y-6 max-w-md">
                        <div class="flex items-start space-x-4 feature-item" data-index="0">
                            <div class="bg-white/20 rounded-xl p-4 backdrop-blur feature-icon">
                                <i class="fas fa-graduation-cap text-3xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-xl mb-1">Quality Education</h3>
                                <p class="text-primary-100 text-sm">Providing excellent education for over 60 years</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 feature-item" data-index="1">
                            <div class="bg-white/20 rounded-xl p-4 backdrop-blur feature-icon">
                                <i class="fas fa-users text-3xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-xl mb-1">Strong Community</h3>
                                <p class="text-primary-100 text-sm">Building character and fostering growth</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 feature-item" data-index="2">
                            <div class="bg-white/20 rounded-xl p-4 backdrop-blur feature-icon">
                                <i class="fas fa-trophy text-3xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-xl mb-1">Excellence in All</h3>
                                <p class="text-primary-100 text-sm">Academic, sports, and cultural achievements</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="flex-1 flex items-center justify-center p-4 sm:p-6 md:p-8 bg-gradient-to-br from-gray-50 to-gray-100 relative overflow-hidden">
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 w-48 h-48 sm:w-64 sm:h-64 bg-primary-200/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 sm:w-96 sm:h-96 bg-secondary-200/20 rounded-full blur-3xl"></div>

                <div class="w-full max-w-md relative z-10">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden text-center mb-6 sm:mb-8" id="mobile-logo">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-16 sm:h-20 sm:w-20 mx-auto mb-3">
                        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent px-4">Little Flower High School</h2>
                    </div>

                    <!-- Form Card -->
                    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-2xl p-6 sm:p-8 md:p-10 form-card relative overflow-hidden">
                        <!-- Animated Border -->
                        <div class="absolute inset-0 rounded-2xl sm:rounded-3xl opacity-0 animated-border" style="background: linear-gradient(45deg, #2563eb, #06b6d4, #f97316, #2563eb); background-size: 300% 300%;"></div>
                        <div class="relative z-10">
                            {{ $slot }}
                        </div>
                    </div>

                    <!-- Footer Links -->
                    <div class="mt-6 sm:mt-8 text-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-xs sm:text-sm text-gray-600 hover:text-primary-600 transition group back-link">
                            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Floating shapes animation
                gsap.to('#shape1', {
                    x: '+=100',
                    y: '+=50',
                    duration: 8,
                    repeat: -1,
                    yoyo: true,
                    ease: 'sine.inOut'
                });

                gsap.to('#shape2', {
                    x: '-=80',
                    y: '-=60',
                    duration: 10,
                    repeat: -1,
                    yoyo: true,
                    ease: 'sine.inOut'
                });

                gsap.to('#shape3', {
                    x: '+=60',
                    y: '-=80',
                    duration: 12,
                    repeat: -1,
                    yoyo: true,
                    ease: 'sine.inOut'
                });

                // Create floating particles
                const particlesContainer = document.getElementById('particles-container');
                for (let i = 0; i < 30; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    particle.style.width = Math.random() * 4 + 2 + 'px';
                    particle.style.height = particle.style.width;
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.top = Math.random() * 100 + '%';
                    particle.style.opacity = Math.random() * 0.5 + 0.2;
                    particlesContainer.appendChild(particle);

                    gsap.to(particle, {
                        y: '-=' + (Math.random() * 200 + 100),
                        x: '+=' + (Math.random() * 100 - 50),
                        duration: Math.random() * 10 + 15,
                        repeat: -1,
                        yoyo: true,
                        ease: 'sine.inOut'
                    });
                }

                // Logo animations
                gsap.to('#auth-logo', {
                    y: -10,
                    duration: 2,
                    repeat: -1,
                    yoyo: true,
                    ease: 'sine.inOut'
                });

                gsap.to('#auth-logo', {
                    rotation: 5,
                    duration: 3,
                    repeat: -1,
                    yoyo: true,
                    ease: 'sine.inOut'
                });

                // Title wave animation
                const title = document.querySelector('.auth-title');
                if (title) {
                    const text = title.textContent;
                    title.innerHTML = text.split('').map((char, i) =>
                        `<span style="display:inline-block" class="char-${i}">${char === ' ' ? '&nbsp;' : char}</span>`
                    ).join('');

                    gsap.to(title.querySelectorAll('span'), {
                        y: -5,
                        duration: 0.5,
                        stagger: {
                            each: 0.1,
                            repeat: -1,
                            yoyo: true
                        },
                        ease: 'sine.inOut'
                    });
                }

                // Feature items stagger animation
                const featureItems = document.querySelectorAll('.feature-item');
                featureItems.forEach((item, index) => {
                    gsap.from(item, {
                        x: -50,
                        opacity: 0,
                        duration: 1,
                        delay: index * 0.2
                    });

                    const icon = item.querySelector('.feature-icon');
                    gsap.to(icon, {
                        scale: 1.1,
                        duration: 1.5,
                        repeat: -1,
                        yoyo: true,
                        ease: 'sine.inOut',
                        delay: index * 0.3
                    });
                });

                // Form card entrance
                gsap.from('.form-card', {
                    scale: 0.9,
                    opacity: 0,
                    duration: 0.8,
                    ease: 'back.out(1.7)'
                });

                // Animated border pulsing
                gsap.to('.animated-border', {
                    opacity: 0.5,
                    duration: 2,
                    repeat: -1,
                    yoyo: true,
                    ease: 'sine.inOut'
                });

                gsap.to('.animated-border', {
                    backgroundPosition: '300% 50%',
                    duration: 4,
                    repeat: -1,
                    ease: 'linear'
                });

                // Mobile logo animation
                if (document.getElementById('mobile-logo')) {
                    gsap.from('#mobile-logo', {
                        y: -30,
                        opacity: 0,
                        duration: 1,
                        ease: 'back.out(1.7)'
                    });
                }

                // Back link hover pulse
                gsap.to('.back-link i', {
                    scale: 1.2,
                    duration: 1,
                    repeat: -1,
                    yoyo: true,
                    ease: 'sine.inOut'
                });
            });
        </script>
    </body>
</html>
