@extends('layouts.public')

@section('title', 'Share Your Testimonial')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Testimonials', 'url' => route('testimonials.index')],
    ['label' => 'Share Your Story', 'icon' => 'fas fa-quote-left']
]" />

<!-- Page Header -->
<section class="relative py-16 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Share Your Testimonial</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                We'd love to hear about your experience at Little Flower High School!
            </p>
        </div>
    </div>
</section>

<!-- Testimonial Form Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-2xl mr-3"></i>
                    <div>
                        <p class="font-semibold">{{ session('success') }}</p>
                        <p class="text-sm">Your testimonial is now pending approval.</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="{{ route('testimonials.store') }}" method="POST">
                @csrf

                <!-- Name -->
                <div class="mb-6">
                    <label for="student_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Your Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="student_name"
                           name="student_name"
                           value="{{ old('student_name') }}"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('student_name') border-red-500 @enderror"
                           placeholder="Juan Dela Cruz">
                    @error('student_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Grade Level -->
                <div class="mb-6">
                    <label for="grade_level" class="block text-sm font-medium text-gray-700 mb-2">
                        Grade Level / Year Graduated <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="grade_level"
                           name="grade_level"
                           value="{{ old('grade_level') }}"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('grade_level') border-red-500 @enderror"
                           placeholder="e.g., Grade 10, Class of 2020, Grade 12">
                    @error('grade_level')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Message -->
                <div class="mb-6">
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                        Your Testimonial <span class="text-red-500">*</span>
                    </label>
                    <textarea id="message"
                              name="message"
                              rows="8"
                              required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('message') border-red-500 @enderror"
                              placeholder="Share your experience, what you learned, how LFHS helped shape your future, or what makes this school special to you...">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Minimum 20 characters, maximum 1000 characters</p>
                </div>

                <!-- Info Box -->
                <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 p-4">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-500 text-xl mr-3 mt-0.5"></i>
                        <div class="text-sm text-blue-700">
                            <p class="font-semibold mb-1">Please note:</p>
                            <ul class="list-disc list-inside space-y-1">
                                <li>All testimonials will be reviewed before being published</li>
                                <li>Please keep your message respectful and honest</li>
                                <li>Share specific experiences or details that highlight what makes LFHS special</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('testimonials.index') }}"
                       class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-300">
                        Cancel
                    </a>
                    <button type="submit"
                            class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-300 shadow-md hover:shadow-lg">
                        <i class="fas fa-paper-plane mr-2"></i>Submit Testimonial
                    </button>
                </div>
            </form>
        </div>

        <!-- Why Share Your Testimonial -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 text-blue-600 mb-4">
                    <i class="fas fa-heart text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Inspire Others</h3>
                <p class="text-gray-600">
                    Your story can motivate future students
                </p>
            </div>
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 text-green-600 mb-4">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Build Community</h3>
                <p class="text-gray-600">
                    Connect with fellow students and alumni
                </p>
            </div>
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-purple-100 text-purple-600 mb-4">
                    <i class="fas fa-star text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Celebrate Success</h3>
                <p class="text-gray-600">
                    Highlight the positive impact of LFHS
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
