@section('title', 'Login')

<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-6 sm:mb-8 header-section">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent login-title">Welcome Back!</h2>
        <p class="text-gray-600 mt-2 sm:mt-3 text-sm sm:text-base md:text-lg login-subtitle">Sign in to your account to continue</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 bg-gradient-to-r from-success-50 to-success-100 border-l-4 border-success-500 text-success-700 px-5 py-4 rounded-xl session-status">
            <i class="fas fa-check-circle mr-2"></i>{{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4 sm:space-y-6" id="login-form">
        @csrf

        <!-- Email Address -->
        <div class="form-group" data-index="0">
            <label for="email" class="block text-xs sm:text-sm font-bold text-gray-700 mb-2 flex items-center">
                <i class="fas fa-envelope mr-2 text-primary-500 text-sm sm:text-base"></i>Email Address
            </label>
            <div class="relative">
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       autocomplete="username"
                       placeholder="you@example.com"
                       class="w-full px-4 sm:px-5 py-3 sm:py-4 text-sm sm:text-base border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-300 @error('email') border-danger-500 @enderror hover:border-primary-300">
                <div class="input-animation"></div>
            </div>
            @error('email')
                <p class="mt-2 text-xs sm:text-sm text-danger-600 flex items-center error-message">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group" data-index="1">
            <label for="password" class="block text-xs sm:text-sm font-bold text-gray-700 mb-2 flex items-center">
                <i class="fas fa-lock mr-2 text-primary-500 text-sm sm:text-base"></i>Password
            </label>
            <div class="relative">
                <input id="password"
                       type="password"
                       name="password"
                       required
                       autocomplete="current-password"
                       placeholder="Enter your password"
                       class="w-full px-4 sm:px-5 py-3 sm:py-4 pr-10 sm:pr-12 text-sm sm:text-base border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-300 @error('password') border-danger-500 @enderror hover:border-primary-300">
                <button type="button"
                        onclick="togglePassword()"
                        class="absolute right-3 sm:right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-primary-600 transition-colors duration-300 p-2">
                    <i class="fas fa-eye text-lg sm:text-xl" id="toggleIcon"></i>
                </button>
                <div class="input-animation"></div>
            </div>
            @error('password')
                <p class="mt-2 text-xs sm:text-sm text-danger-600 flex items-center error-message">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 sm:gap-0 remember-forgot">
            <label class="flex items-center group cursor-pointer">
                <input type="checkbox"
                       name="remember"
                       id="remember_me"
                       class="h-4 w-4 sm:h-5 sm:w-5 text-primary-600 focus:ring-primary-500 border-gray-300 rounded transition-all duration-300 cursor-pointer">
                <span class="ml-2 sm:ml-3 text-xs sm:text-sm text-gray-600 group-hover:text-primary-600 transition-colors">Remember me</span>
            </label>

            @if (Route::has('password.code.request'))
                <a href="{{ route('password.code.request') }}"
                   class="text-xs sm:text-sm font-semibold text-primary-600 hover:text-primary-700 transition-all duration-300 forgot-link flex items-center">
                    Forgot password?
                    <i class="fas fa-arrow-right ml-1 text-xs"></i>
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-gradient-to-r from-primary-600 via-primary-700 to-secondary-600 hover:from-primary-700 hover:via-primary-800 hover:to-secondary-700 text-white font-bold py-3 sm:py-4 px-6 text-sm sm:text-base rounded-xl transition-all duration-300 transform hover:scale-[1.02] hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-primary-500 focus:ring-offset-2 submit-btn relative overflow-hidden active:scale-95">
                <span class="relative z-10 flex items-center justify-center">
                    <i class="fas fa-sign-in-alt mr-2 text-sm sm:text-base"></i>Sign In
                </span>
                <div class="btn-shine"></div>
        </button>
    </form>

    <!-- Divider -->
    <div class="mt-6 sm:mt-10 mb-6 sm:mb-10 divider-section">
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t-2 border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-xs sm:text-sm">
                <span class="px-4 sm:px-6 bg-white text-gray-500 font-semibold">Don't have an account?</span>
            </div>
        </div>
    </div>

    <!-- Register Link -->
    <div class="text-center register-link-container">
        <a href="{{ route('register') }}"
           class="inline-flex items-center justify-center w-full px-6 py-3 sm:py-4 border-2 border-primary-600 text-primary-600 font-bold text-sm sm:text-base rounded-xl hover:bg-primary-50 transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl register-link active:scale-95">
            <i class="fas fa-user-plus mr-2 text-sm sm:text-base"></i>Create New Account
        </a>
    </div>

    <style>
        .input-animation {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #2563eb, #06b6d4);
            transition: width 0.3s ease;
        }

        input:focus + .input-animation {
            width: 100%;
        }

        .btn-shine {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        }

        .submit-btn:hover .btn-shine {
            animation: shine 1.5s infinite;
        }

        @keyframes shine {
            to {
                left: 100%;
            }
        }
    </style>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');

                // Animate icon
                gsap.from(toggleIcon, {
                    rotation: 180,
                    duration: 0.3,
                    ease: 'back.out(1.7)'
                });
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');

                // Animate icon
                gsap.from(toggleIcon, {
                    rotation: -180,
                    duration: 0.3,
                    ease: 'back.out(1.7)'
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Header animations
            gsap.from('.login-title', {
                y: -30,
                opacity: 0,
                duration: 0.8,
                ease: 'back.out(1.7)'
            });

            gsap.from('.login-subtitle', {
                y: -20,
                opacity: 0,
                duration: 0.8,
                delay: 0.2,
                ease: 'back.out(1.7)'
            });

            // Form groups stagger animation
            gsap.from('.form-group', {
                x: -50,
                opacity: 0,
                duration: 0.6,
                stagger: 0.15,
                ease: 'back.out(1.7)',
                delay: 0.3
            });

            // Remember/Forgot section
            gsap.from('.remember-forgot', {
                opacity: 0,
                y: 20,
                duration: 0.6,
                delay: 0.8,
                ease: 'back.out(1.7)'
            });

            // Submit button
            gsap.fromTo('.submit-btn',
                {
                    scale: 0.8,
                    opacity: 0
                },
                {
                    scale: 1,
                    opacity: 1,
                    duration: 0.6,
                    delay: 1,
                    ease: 'back.out(1.7)'
                }
            );

            // Divider
            gsap.from('.divider-section', {
                scaleX: 0,
                opacity: 0,
                duration: 0.6,
                delay: 1.2,
                ease: 'power2.out'
            });

            // Register link
            gsap.from('.register-link-container', {
                y: 30,
                opacity: 0,
                duration: 0.6,
                delay: 1.4,
                ease: 'back.out(1.7)'
            });

            // Continuous animations
            // Icon pulse animations
            const icons = document.querySelectorAll('.form-group i');
            icons.forEach((icon, index) => {
                gsap.to(icon, {
                    scale: 1.2,
                    duration: 1.5,
                    repeat: -1,
                    yoyo: true,
                    ease: 'sine.inOut',
                    delay: index * 0.3
                });
            });

            // Forgot link hover animation
            const forgotLink = document.querySelector('.forgot-link i');
            if (forgotLink) {
                gsap.to(forgotLink, {
                    x: 5,
                    duration: 0.8,
                    repeat: -1,
                    yoyo: true,
                    ease: 'sine.inOut'
                });
            }

            // Input focus animations
            const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    gsap.to(this, {
                        scale: 1.02,
                        duration: 0.3,
                        ease: 'back.out(1.7)'
                    });

                    gsap.to(this.previousElementSibling, {
                        scale: 1.1,
                        color: '#2563eb',
                        duration: 0.3
                    });
                });

                input.addEventListener('blur', function() {
                    gsap.to(this, {
                        scale: 1,
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                });
            });

            // Register link hover effect
            const registerLink = document.querySelector('.register-link');
            registerLink.addEventListener('mouseenter', function() {
                gsap.to(this.querySelector('i'), {
                    rotation: 360,
                    duration: 0.6,
                    ease: 'back.out(1.7)'
                });
            });
        });
    </script>
</x-guest-layout>
