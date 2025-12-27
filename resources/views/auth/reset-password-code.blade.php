@section('title', 'Reset Password')

<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
            <i class="fas fa-lock-open text-2xl text-green-600"></i>
        </div>
        <h2 class="text-3xl font-bold text-gray-900">Reset Password</h2>
        <p class="text-gray-600 mt-2">Enter the code and your new password</p>
    </div>

    <!-- Success/Status Message -->
    @if (session('status'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-start">
            <i class="fas fa-check-circle text-green-600 mt-0.5 mr-3"></i>
            <span class="text-sm">{{ session('status') }}</span>
        </div>
    @endif

    <!-- Info Message -->
    <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <p class="text-sm text-blue-800">
            <i class="fas fa-info-circle mr-2"></i>
            Enter the 6-digit code sent to your email and create a new password.
        </p>
    </div>

    <form method="POST" action="{{ route('password.code.reset') }}" class="space-y-6">
        @csrf

        <!-- Email Address (Hidden or Display) -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-envelope mr-2 text-gray-400"></i>Email Address
            </label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email', session('email')) }}"
                   required
                   readonly
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('email') border-red-500 @enderror">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Verification Code -->
        <div>
            <label for="code" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-key mr-2 text-gray-400"></i>Verification Code
            </label>
            <input id="code"
                   type="text"
                   name="code"
                   maxlength="6"
                   pattern="[0-9]{6}"
                   placeholder="000000"
                   required
                   autofocus
                   autocomplete="one-time-code"
                   class="w-full px-4 py-3 text-center text-2xl font-bold tracking-widest border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('code') border-red-500 @enderror">
            @error('code')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                </p>
            @enderror
            <p class="mt-2 text-xs text-gray-500">
                <i class="fas fa-info-circle mr-1"></i>
                Enter the 6-digit code from your email
            </p>
        </div>

        <!-- New Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-lock mr-2 text-gray-400"></i>New Password
            </label>
            <div class="relative">
                <input id="password"
                       type="password"
                       name="password"
                       required
                       autocomplete="new-password"
                       placeholder="Create a strong password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('password') border-red-500 @enderror">
                <button type="button"
                        onclick="togglePassword('password', 'toggleIcon1')"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <i class="fas fa-eye" id="toggleIcon1"></i>
                </button>
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-1 text-xs text-gray-500">
                <i class="fas fa-info-circle mr-1"></i>
                Password must be at least 8 characters long
            </p>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-lock mr-2 text-gray-400"></i>Confirm New Password
            </label>
            <div class="relative">
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       required
                       autocomplete="new-password"
                       placeholder="Re-enter your new password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                <button type="button"
                        onclick="togglePassword('password_confirmation', 'toggleIcon2')"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <i class="fas fa-eye" id="toggleIcon2"></i>
                </button>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
            <i class="fas fa-check-circle mr-2"></i>Reset Password
        </button>
    </form>

    <!-- Resend Code -->
    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600 mb-3">Didn't receive the code?</p>
        <form method="POST" action="{{ route('password.code.resend') }}">
            @csrf
            <input type="hidden" name="email" value="{{ old('email', session('email')) }}">
            <button type="submit"
                    class="text-blue-600 hover:text-blue-700 font-semibold text-sm transition">
                <i class="fas fa-redo mr-2"></i>Resend Reset Code
            </button>
        </form>
    </div>

    <!-- Back to Login -->
    <div class="mt-6 text-center pt-6 border-t border-gray-200">
        <a href="{{ route('login') }}"
           class="text-sm text-gray-600 hover:text-gray-900 transition">
            <i class="fas fa-arrow-left mr-2"></i>Back to Login
        </a>
    </div>

    <script>
        function togglePassword(fieldId, iconId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(iconId);

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Auto-format and validate code input
        const codeInput = document.getElementById('code');

        codeInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        codeInput.addEventListener('paste', function(e) {
            const pastedData = e.clipboardData.getData('text');
            const numericOnly = pastedData.replace(/[^0-9]/g, '');

            if (numericOnly.length > 0) {
                e.preventDefault();
                this.value = numericOnly.substring(0, 6);
            }
        });
    </script>
</x-guest-layout>
