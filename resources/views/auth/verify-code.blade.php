@section('title', 'Verify Email')

<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
            <i class="fas fa-envelope-circle-check text-2xl text-blue-600"></i>
        </div>
        <h2 class="text-3xl font-bold text-gray-900">Verify Your Email</h2>
        <p class="text-gray-600 mt-2">Enter the 6-digit code we sent to your email</p>
        <p class="text-sm font-semibold text-blue-600 mt-1">{{ auth()->user()->email }}</p>
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
            Check your email inbox for the verification code. The code will expire in 15 minutes.
        </p>
    </div>

    <!-- Verification Code Form -->
    <form method="POST" action="{{ route('verification.verify') }}" class="space-y-6">
        @csrf

        <!-- Code Input -->
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
                Enter the 6-digit code without spaces
            </p>
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            <i class="fas fa-check-circle mr-2"></i>Verify Email
        </button>
    </form>

    <!-- Resend Code -->
    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600 mb-3">Didn't receive the code?</p>
        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit"
                    class="text-blue-600 hover:text-blue-700 font-semibold text-sm transition">
                <i class="fas fa-redo mr-2"></i>Resend Verification Code
            </button>
        </form>
    </div>

    <!-- Logout Option -->
    <div class="mt-6 text-center pt-6 border-t border-gray-200">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 transition">
                <i class="fas fa-sign-out-alt mr-2"></i>Log Out
            </button>
        </form>
    </div>

    <script>
        // Auto-format and validate code input
        const codeInput = document.getElementById('code');

        codeInput.addEventListener('input', function(e) {
            // Remove non-numeric characters
            this.value = this.value.replace(/[^0-9]/g, '');

            // Auto-submit when 6 digits are entered
            if (this.value.length === 6) {
                // Optional: auto-submit the form
                // this.form.submit();
            }
        });

        // Prevent paste of non-numeric content
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
