@section('title', 'Forgot Password')

<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
            <i class="fas fa-key text-2xl text-blue-600"></i>
        </div>
        <h2 class="text-3xl font-bold text-gray-900">Forgot Password?</h2>
        <p class="text-gray-600 mt-2">No worries! We'll send you reset instructions.</p>
    </div>

    <!-- Info Message -->
    <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <p class="text-sm text-blue-800">
            <i class="fas fa-info-circle mr-2"></i>
            Enter your email address and we'll send you a password reset link that will allow you to choose a new one.
        </p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-start">
            <i class="fas fa-check-circle text-green-600 mt-0.5 mr-3"></i>
            <span class="text-sm">{{ session('status') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-envelope mr-2 text-gray-400"></i>Email Address
            </label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   placeholder="Enter your registered email"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('email') border-red-500 @enderror">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            <i class="fas fa-paper-plane mr-2"></i>Send Reset Link
        </button>
    </form>

    <!-- Back to Login -->
    <div class="mt-8">
        <a href="{{ route('login') }}"
           class="flex items-center justify-center text-sm font-medium text-blue-600 hover:text-blue-700 transition">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Login
        </a>
    </div>
</x-guest-layout>
