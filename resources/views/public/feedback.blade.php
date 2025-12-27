@extends('layouts.public')

@section('title', 'Send Us Your Feedback')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Contact', 'url' => '#'],
    ['label' => 'Send Feedback', 'icon' => 'fas fa-comment-dots']
]" />

<!-- Page Header -->
<section class="relative py-16 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Send Us Your Feedback</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                We value your opinion! Share your thoughts, suggestions, or compliments with us.
            </p>
        </div>
    </div>
</section>

<!-- Feedback Form Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-2xl mr-3"></i>
                    <div>
                        <p class="font-semibold">{{ session('success') }}</p>
                        <p class="text-sm">Salamat sa inyong feedback!</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="{{ route('feedback.submit') }}" method="POST">
                @csrf

                <!-- Name -->
                <div class="mb-6">
                    <label for="feedback_by" class="block text-sm font-medium text-gray-700 mb-2">
                        Your Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="feedback_by"
                           name="feedback_by"
                           value="{{ old('feedback_by') }}"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('feedback_by') border-red-500 @enderror"
                           placeholder="Juan Dela Cruz">
                    @error('feedback_by')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Feedback Type -->
                <div class="mb-6">
                    <label for="Concern" class="block text-sm font-medium text-gray-700 mb-2">
                        Feedback Type <span class="text-red-500">*</span>
                    </label>
                    <select id="Concern"
                            name="Concern"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('Concern') border-red-500 @enderror">
                        <option value="">Select Type</option>
                        <option value="Compliment" {{ old('Concern') == 'Compliment' ? 'selected' : '' }}>
                            👍 Compliment - Share something positive
                        </option>
                        <option value="Suggestion" {{ old('Concern') == 'Suggestion' ? 'selected' : '' }}>
                            💡 Suggestion - Share your ideas for improvement
                        </option>
                        <option value="Complaint" {{ old('Concern') == 'Complaint' ? 'selected' : '' }}>
                            ⚠️ Complaint - Report an issue or concern
                        </option>
                    </select>
                    @error('Concern')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Message -->
                <div class="mb-6">
                    <label for="about" class="block text-sm font-medium text-gray-700 mb-2">
                        Your Feedback <span class="text-red-500">*</span>
                    </label>
                    <textarea id="about"
                              name="about"
                              rows="6"
                              required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('about') border-red-500 @enderror"
                              placeholder="Please share your feedback in detail...">{{ old('about') }}</textarea>
                    @error('about')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Minimum 10 characters</p>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('home') }}"
                       class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-300">
                        Cancel
                    </a>
                    <button type="submit"
                            class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-300 shadow-md hover:shadow-lg">
                        <i class="fas fa-paper-plane mr-2"></i>Send Feedback
                    </button>
                </div>
            </form>
        </div>

        <!-- Why Share Feedback -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 text-green-600 mb-4">
                    <i class="fas fa-thumbs-up text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Share Compliments</h3>
                <p class="text-gray-600">
                    Recognize outstanding work and positive experiences
                </p>
            </div>
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 text-blue-600 mb-4">
                    <i class="fas fa-lightbulb text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Give Suggestions</h3>
                <p class="text-gray-600">
                    Help us improve with your valuable ideas and insights
                </p>
            </div>
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-100 text-red-600 mb-4">
                    <i class="fas fa-exclamation-circle text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Report Concerns</h3>
                <p class="text-gray-600">
                    Let us know about issues so we can address them promptly
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
