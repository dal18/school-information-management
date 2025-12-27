@section('title', 'Register')

<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-6 sm:mb-8 header-section">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent register-title">Create Account</h2>
        <p class="text-gray-600 mt-2 sm:mt-3 text-sm sm:text-base md:text-lg register-subtitle">Join our school community today</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4 sm:space-y-5" id="register-form">
        @csrf

        <!-- General Registration Error -->
        @error('registration')
            <div class="bg-gradient-to-r from-danger-50 to-danger-100 border-l-4 border-danger-500 p-5 rounded-xl error-alert">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-danger-500 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-danger-700 font-semibold">{{ $message }}</p>
                    </div>
                </div>
            </div>
        @enderror

        <!-- Name -->
        <div class="form-group" data-index="0">
            <label for="name" class="block text-xs sm:text-sm font-bold text-gray-700 mb-2 flex items-center">
                <i class="fas fa-user mr-2 text-primary-500 text-sm sm:text-base"></i>Full Name
            </label>
            <div class="relative">
                <input id="name"
                       type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       autofocus
                       placeholder="John Doe"
                       class="w-full px-4 sm:px-5 py-3 sm:py-4 text-sm sm:text-base border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-300 @error('name') border-danger-500 @enderror hover:border-primary-300">
                <div class="input-animation"></div>
            </div>
            @error('name')
                <p class="mt-2 text-xs sm:text-sm text-danger-600 flex items-center error-message">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group" data-index="1">
            <label for="email" class="block text-xs sm:text-sm font-bold text-gray-700 mb-2 flex items-center">
                <i class="fas fa-envelope mr-2 text-primary-500 text-sm sm:text-base"></i>Email Address
            </label>
            <div class="relative">
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       placeholder="john@example.com"
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
        <div class="form-group" data-index="2">
            <label for="password" class="block text-xs sm:text-sm font-bold text-gray-700 mb-2 flex items-center">
                <i class="fas fa-lock mr-2 text-primary-500 text-sm sm:text-base"></i>Password
            </label>
            <div class="relative">
                <input id="password"
                       type="password"
                       name="password"
                       required
                       placeholder="Create a strong password"
                       class="w-full px-4 sm:px-5 py-3 sm:py-4 pr-10 sm:pr-12 text-sm sm:text-base border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-300 @error('password') border-danger-500 @enderror hover:border-primary-300">
                <button type="button"
                        onclick="togglePassword('password', 'toggleIcon1')"
                        class="absolute right-3 sm:right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-primary-600 transition-colors duration-300 p-2">
                    <i class="fas fa-eye text-lg sm:text-xl" id="toggleIcon1"></i>
                </button>
                <div class="input-animation"></div>
            </div>
            @error('password')
                <p class="mt-2 text-xs sm:text-sm text-danger-600 flex items-center error-message">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group" data-index="3">
            <label for="password_confirmation" class="block text-xs sm:text-sm font-bold text-gray-700 mb-2 flex items-center">
                <i class="fas fa-lock mr-2 text-primary-500 text-sm sm:text-base"></i>Confirm Password
            </label>
            <div class="relative">
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       required
                       placeholder="Re-enter your password"
                       class="w-full px-4 sm:px-5 py-3 sm:py-4 pr-10 sm:pr-12 text-sm sm:text-base border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-300 hover:border-primary-300">
                <button type="button"
                        onclick="togglePassword('password_confirmation', 'toggleIcon2')"
                        class="absolute right-3 sm:right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-primary-600 transition-colors duration-300 p-2">
                    <i class="fas fa-eye text-lg sm:text-xl" id="toggleIcon2"></i>
                </button>
                <div class="input-animation"></div>
            </div>
        </div>

        <!-- Terms & Conditions -->
        <div class="flex items-start terms-section">
            <input type="checkbox"
                   name="terms"
                   id="terms"
                   required
                   class="mt-1 h-4 w-4 sm:h-5 sm:w-5 text-primary-600 focus:ring-primary-500 border-gray-300 rounded transition-all duration-300 flex-shrink-0">
            <label for="terms" class="ml-2 sm:ml-3 text-xs sm:text-sm text-gray-600">
                I agree to the <a href="#" class="text-primary-600 hover:text-primary-700 font-semibold underline">Terms of Service</a> and <a href="#" class="text-primary-600 hover:text-primary-700 font-semibold underline">Privacy Policy</a>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-gradient-to-r from-primary-600 via-primary-700 to-secondary-600 hover:from-primary-700 hover:via-primary-800 hover:to-secondary-700 text-white font-bold py-3 sm:py-4 px-6 text-sm sm:text-base rounded-xl transition-all duration-300 transform hover:scale-[1.02] hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-primary-500 focus:ring-offset-2 submit-btn relative overflow-hidden active:scale-95">
                <span class="relative z-10 flex items-center justify-center">
                    <i class="fas fa-user-plus mr-2 text-sm sm:text-base"></i>Create Account
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
                <span class="px-4 sm:px-6 bg-white text-gray-500 font-semibold">Already have an account?</span>
            </div>
        </div>
    </div>

    <!-- Login Link -->
    <div class="text-center login-link-container">
        <a href="{{ route('login') }}"
           class="inline-flex items-center justify-center w-full px-6 py-3 sm:py-4 border-2 border-primary-600 text-primary-600 font-bold text-sm sm:text-base rounded-xl hover:bg-primary-50 transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl login-link active:scale-95">
            <i class="fas fa-sign-in-alt mr-2 text-sm sm:text-base"></i>Sign In Instead
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

        input:focus + .input-animation,
        input:focus ~ .input-animation {
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
        function togglePassword(fieldId, iconId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(iconId);

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
            gsap.from('.register-title', {
                y: -30,
                opacity: 0,
                duration: 0.8,
                ease: 'back.out(1.7)'
            });

            gsap.from('.register-subtitle', {
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

            // Terms section
            gsap.from('.terms-section', {
                opacity: 0,
                y: 20,
                duration: 0.6,
                delay: 1,
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
                    delay: 1.2,
                    ease: 'back.out(1.7)'
                }
            );

            // Divider
            gsap.from('.divider-section', {
                scaleX: 0,
                opacity: 0,
                duration: 0.6,
                delay: 1.4,
                ease: 'power2.out'
            });

            // Login link
            gsap.from('.login-link-container', {
                y: 30,
                opacity: 0,
                duration: 0.6,
                delay: 1.6,
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

            // Input focus animations
            const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    gsap.to(this, {
                        scale: 1.02,
                        duration: 0.3,
                        ease: 'back.out(1.7)'
                    });

                    const label = this.parentElement.previousElementSibling;
                    if (label) {
                        gsap.to(label.querySelector('i'), {
                            scale: 1.3,
                            color: '#2563eb',
                            rotation: 15,
                            duration: 0.3
                        });
                    }
                });

                input.addEventListener('blur', function() {
                    gsap.to(this, {
                        scale: 1,
                        duration: 0.3,
                        ease: 'power2.out'
                    });

                    const label = this.parentElement.previousElementSibling;
                    if (label) {
                        gsap.to(label.querySelector('i'), {
                            scale: 1,
                            rotation: 0,
                            duration: 0.3
                        });
                    }
                });
            });

            // Checkbox animation
            const termsCheckbox = document.getElementById('terms');
            termsCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    gsap.from(this, {
                        scale: 0.5,
                        duration: 0.3,
                        ease: 'back.out(1.7)'
                    });
                }
            });

            // Login link hover effect
            const loginLink = document.querySelector('.login-link');
            loginLink.addEventListener('mouseenter', function() {
                gsap.to(this.querySelector('i'), {
                    x: -10,
                    duration: 0.3,
                    ease: 'back.out(1.7)'
                });
            });

            loginLink.addEventListener('mouseleave', function() {
                gsap.to(this.querySelector('i'), {
                    x: 0,
                    duration: 0.3,
                    ease: 'back.out(1.7)'
                });
            });

            // Password strength indicator animation
            const passwordField = document.getElementById('password');
            passwordField.addEventListener('input', function() {
                const strength = this.value.length;
                const inputWrapper = this.parentElement;

                if (strength > 0 && strength < 6) {
                    gsap.to(inputWrapper.querySelector('.input-animation'), {
                        background: 'linear-gradient(90deg, #ef4444, #f97316)',
                        duration: 0.3
                    });
                } else if (strength >= 6 && strength < 10) {
                    gsap.to(inputWrapper.querySelector('.input-animation'), {
                        background: 'linear-gradient(90deg, #f59e0b, #eab308)',
                        duration: 0.3
                    });
                } else if (strength >= 10) {
                    gsap.to(inputWrapper.querySelector('.input-animation'), {
                        background: 'linear-gradient(90deg, #22c55e, #10b981)',
                        duration: 0.3
                    });
                }
            });
        });
    </script>
</x-guest-layout>
