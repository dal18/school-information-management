@extends('layouts.public')

@section('title', 'Contact Us')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Contact', 'url' => '#'],
    ['label' => 'Contact Us', 'icon' => 'fas fa-envelope']
]" />

<!-- Hero Section -->
<section class="relative py-16 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-display font-bold mb-4">
                Contact Us
            </h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                We're Here to Help - Get in Touch with Us
            </p>
        </div>
    </div>
</section>

<!-- Contact Information Cards -->
<section class="modern-section modern-section-white">
    <div class="modern-container">
        <div class="modern-grid modern-grid-3 mb-16">
            <!-- Phone -->
            <div class="modern-card hover-lift bg-gradient-to-br from-primary-50 to-white">
                <div class="modern-card-content text-center">
                    <div class="w-16 h-16 bg-primary-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone text-2xl text-white"></i>
                    </div>
                    <h3 class="modern-card-title mb-2">Phone</h3>
                    <p class="modern-card-text mb-3">Call us during office hours</p>
                    <a href="tel:+1234567890" class="text-primary-600 hover:text-primary-700 font-medium">
                        09261289492
                    </a>
                </div>
            </div>

            <!-- Email -->
            <div class="modern-card hover-lift bg-gradient-to-br from-primary-50 to-white">
                <div class="modern-card-content text-center">
                    <div class="w-16 h-16 bg-primary-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-2xl text-white"></i>
                    </div>
                    <h3 class="modern-card-title mb-2">Email</h3>
                    <p class="modern-card-text mb-3">Send us an email anytime</p>
                    <a href="mailto:info@lfhs.edu" class="text-primary-600 hover:text-primary-700 font-medium">
                        lfhssystemmanagement@gmail.com
                    </a>
                </div>
            </div>

            <!-- Location -->
            <div class="modern-card hover-lift bg-gradient-to-br from-primary-50 to-white">
                <div class="modern-card-content text-center">
                    <div class="w-16 h-16 bg-primary-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marker-alt text-2xl text-white"></i>
                    </div>
                    <h3 class="modern-card-title mb-2">Location</h3>
                    <p class="modern-card-text mb-3">Visit our campus</p>
                    <p class="text-primary-600 font-medium">
                        Poblacion<br>
                        Penarrubia
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form and Office Hours -->
<section class="modern-section modern-section-bg">
    <div class="modern-container">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Contact Form -->
            <div class="lg:col-span-2">
                <div class="modern-card shadow-modern-lg">
                    <div class="modern-card-content">
                        <h2 class="modern-heading-lg mb-2">Send us a Message</h2>
                        <p class="modern-text-lead mb-8">Fill out the form below and we'll get back to you as soon as possible.</p>

                    @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Your Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('name') border-red-500 @enderror">
                                @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('email') border-red-500 @enderror">
                                @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                Subject <span class="text-red-500">*</span>
                            </label>
                            <select name="subject" id="subject" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('subject') border-red-500 @enderror">
                                <option value="">Select a subject</option>
                                <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                                <option value="Admissions" {{ old('subject') == 'Admissions' ? 'selected' : '' }}>Admissions</option>
                                <option value="Academic Programs" {{ old('subject') == 'Academic Programs' ? 'selected' : '' }}>Academic Programs</option>
                                <option value="Facilities" {{ old('subject') == 'Facilities' ? 'selected' : '' }}>Facilities</option>
                                <option value="Activities" {{ old('subject') == 'Activities' ? 'selected' : '' }}>Activities & Events</option>
                                <option value="Feedback" {{ old('subject') == 'Feedback' ? 'selected' : '' }}>Feedback</option>
                                <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea name="message" id="message" rows="6" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                            @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between pt-4">
                            <p class="text-sm text-gray-600">
                                <span class="text-red-500">*</span> Required fields
                            </p>
                            <button type="submit" class="btn-modern-primary">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Send Message
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Office Hours -->
                <div class="modern-card shadow-modern-lg">
                    <div class="modern-card-content">
                        <h3 class="modern-card-title mb-4 flex items-center">
                            <i class="far fa-clock text-primary-600 mr-2"></i>
                            Office Hours
                        </h3>
                    <div class="space-y-3 text-gray-700">
                        <div class="flex justify-between border-b border-gray-200 pb-2">
                            <span class="font-medium">Monday - Friday</span>
                            <span>8:00 AM - 5:00 PM</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-200 pb-2">
                            <span class="font-medium">Saturday</span>
                            <span>9:00 AM - 1:00 PM</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Sunday</span>
                            <span class="text-red-600">Closed</span>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="modern-card bg-primary-600 text-white shadow-modern-lg">
                    <div class="modern-card-content">
                        <h3 class="modern-card-title text-white mb-4 flex items-center">
                            <i class="fas fa-link mr-2"></i>
                            Quick Links
                        </h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('admissions') }}" class="flex items-center hover:text-secondary-300 transition duration-300">
                                <i class="fas fa-chevron-right mr-2 text-sm"></i>
                                Admissions
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('courses') }}" class="flex items-center hover:text-secondary-300 transition duration-300">
                                <i class="fas fa-chevron-right mr-2 text-sm"></i>
                                Academic Programs
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('facilities') }}" class="flex items-center hover:text-secondary-300 transition duration-300">
                                <i class="fas fa-chevron-right mr-2 text-sm"></i>
                                Facilities
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('announcements') }}" class="flex items-center hover:text-secondary-300 transition duration-300">
                                <i class="fas fa-chevron-right mr-2 text-sm"></i>
                                Announcements
                            </a>
                        </li>
                    </ul>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="modern-card bg-red-50 border-l-4 border-red-600">
                    <div class="modern-card-content">
                        <h3 class="modern-card-title text-red-900 mb-2 flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Emergency Contact
                        </h3>
                        <p class="modern-card-text text-red-800 mb-3">
                            For urgent matters, please call our emergency hotline:
                        </p>
                        <a href="tel:+1234567999" class="text-red-600 hover:text-red-700 font-bold text-lg">
                            (123) 456-7999
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="modern-section modern-section-white">
    <div class="modern-container">
        <div class="text-center mb-8">
            <h2 class="modern-heading-lg mb-4">Visit Our Campus</h2>
            <p class="modern-text-lead max-w-2xl mx-auto">
                Come see our facilities and meet our team. We welcome visitors during office hours.
            </p>
        </div>

        <div class="bg-gray-200 rounded-lg overflow-hidden shadow-lg" style="height: 450px;">
            <!-- Google Maps Street View -->
           <iframe
    src="https://www.google.com/maps/embed?pb=!4v1734000000000!6m8!1m7!1sCAoSLEFGMVFpcE5fRGNjNHVfYmlHNEJGVTRXRkpCd0NDODBCM0FHd1JqNEY4MThS!2m2!1d17.563714010100842!2d120.65261809366585!3f0!4f0!5f0.7820865974627469"
    width="100%"
    height="100%"
    style="border:0;"
    allowfullscreen=""
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade">
</iframe>
        </div>

        <!-- Map Navigation Buttons -->
        <div class="mt-6 flex flex-wrap gap-4 justify-center">
            <a href="https://maps.app.goo.gl/zxgVcJcEwpiPW4MC6"
               target="_blank"
               rel="noopener noreferrer"
               class="btn-modern-primary">
                <i class="fas fa-directions mr-2"></i>
                Get Directions
            </a>
            <a href="https://maps.app.goo.gl/zxgVcJcEwpiPW4MC6"
               target="_blank"
               rel="noopener noreferrer"
               class="btn-modern-accent bg-green-600 hover:bg-green-700">
                <i class="fas fa-map-marked-alt mr-2"></i>
                View on Google Maps
            </a>
        </div>
    </div>
</section>

<!-- Social Media Section -->
<section class="modern-section modern-section-bg">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="modern-heading-lg mb-4">Connect With Us</h2>
        <p class="modern-text-lead mb-8">Follow us on social media to stay updated with our latest news and events</p>

        <div class="flex justify-center gap-4">
            <a href="#" class="w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center transition duration-300 transform hover:scale-110">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="w-12 h-12 bg-sky-500 hover:bg-sky-600 text-white rounded-full flex items-center justify-center transition duration-300 transform hover:scale-110">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="w-12 h-12 bg-pink-600 hover:bg-pink-700 text-white rounded-full flex items-center justify-center transition duration-300 transform hover:scale-110">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="w-12 h-12 bg-red-600 hover:bg-red-700 text-white rounded-full flex items-center justify-center transition duration-300 transform hover:scale-110">
                <i class="fab fa-youtube"></i>
            </a>
            <a href="#" class="w-12 h-12 bg-blue-700 hover:bg-blue-800 text-white rounded-full flex items-center justify-center transition duration-300 transform hover:scale-110">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </div>
    </div>
</section>
@endsection
