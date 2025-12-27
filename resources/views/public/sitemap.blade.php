@extends('layouts.public')

@section('title', 'Sitemap')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Sitemap']
]" />

<!-- Hero Section -->
<section class="relative py-20 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 overflow-hidden">
    <div class="absolute inset-0 pattern-dots opacity-30"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center text-white animate-fade-in-up max-w-3xl mx-auto">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm font-semibold tracking-wide mb-4">
                <i class="fas fa-sitemap mr-2"></i>Navigation Guide
            </span>
            <h1 class="text-5xl md:text-6xl font-bold font-display mb-4">Sitemap</h1>
            <p class="text-xl text-gray-200 leading-relaxed">
                Find all the pages and resources available on our website.
            </p>
        </div>
    </div>
</section>

<!-- Sitemap Content -->
<section class="modern-section modern-section-white">
    <div class="modern-container">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Main Pages -->
            <div class="modern-card p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-home text-primary-600 text-xl"></i>
                    </div>
                    <h2 class="modern-heading-sm">Main Pages</h2>
                </div>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>About Us</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mission-vision') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Mission & Vision</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('history') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>History</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('alma-mater') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Alma Mater</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('administration') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Administration</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Academic -->
            <div class="modern-card p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-accent-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-accent-600 text-xl"></i>
                    </div>
                    <h2 class="modern-heading-sm">Academic</h2>
                </div>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('courses') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Courses & Subjects</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('schedules') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Class Schedules</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admissions') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Admissions</span>
                        </a>
                    </li>
                    @auth
                    <li>
                        <a href="{{ route('calendar.index') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Academic Calendar</span>
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>

            <!-- Campus Life -->
            <div class="modern-card p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-secondary-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-school text-secondary-600 text-xl"></i>
                    </div>
                    <h2 class="modern-heading-sm">Campus Life</h2>
                </div>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('facilities') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Facilities</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('activities') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Activities & Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('stories') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Success Stories</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- News & Updates -->
            <div class="modern-card p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-newspaper text-blue-600 text-xl"></i>
                    </div>
                    <h2 class="modern-heading-sm">News & Updates</h2>
                </div>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('announcements') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Announcements</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Blog</span>
                        </a>
                    </li>
                    @auth
                    <li>
                        <a href="{{ route('notifications.index') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Notifications</span>
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>

            <!-- Contact & Support -->
            <div class="modern-card p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-headset text-green-600 text-xl"></i>
                    </div>
                    <h2 class="modern-heading-sm">Contact & Support</h2>
                </div>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('contact') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Contact Us</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('feedback') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Send Feedback</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- User Account -->
            <div class="modern-card p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-circle text-purple-600 text-xl"></i>
                    </div>
                    <h2 class="modern-heading-sm">User Account</h2>
                </div>
                <ul class="space-y-3">
                    @guest
                    <li>
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Login</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Register</span>
                        </a>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    @endguest
                </ul>
            </div>

            <!-- Legal & Policies -->
            <div class="modern-card p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-file-alt text-gray-600 text-xl"></i>
                    </div>
                    <h2 class="modern-heading-sm">Legal & Policies</h2>
                </div>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('privacy') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Privacy Policy</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('terms') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Terms of Service</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sitemap') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Sitemap</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Search & Explore -->
            <div class="modern-card p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-search text-yellow-600 text-xl"></i>
                    </div>
                    <h2 class="modern-heading-sm">Search & Explore</h2>
                </div>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('search') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Search Website</span>
                        </a>
                    </li>
                </ul>
            </div>

            @auth
            @if(auth()->user()->access_rights === 'Admin' || auth()->user()->access_rights === 'Teacher')
            <!-- Admin Section -->
            <div class="modern-card p-6 border-2 border-primary-200">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-shield text-primary-600 text-xl"></i>
                    </div>
                    <h2 class="modern-heading-sm">Admin Panel</h2>
                </div>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Admin Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.admissions.index') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Manage Admissions</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-primary-600 transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-primary-400"></i>
                            <span>Manage Users</span>
                        </a>
                    </li>
                </ul>
            </div>
            @endif
            @endauth
        </div>

        <!-- Contact Box -->
        <div class="mt-12 max-w-3xl mx-auto">
            <div class="modern-card p-8 bg-gradient-to-br from-primary-50 to-secondary-50 border border-primary-100">
                <div class="text-center space-y-4">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-600 rounded-full">
                        <i class="fas fa-question-circle text-white text-2xl"></i>
                    </div>
                    <h3 class="modern-heading-md">Can't Find What You're Looking For?</h3>
                    <p class="modern-text">
                        If you need help finding specific information or have any questions, please don't hesitate to contact us.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('contact') }}" class="modern-btn-primary">
                            <i class="fas fa-envelope mr-2"></i>Contact Us
                        </a>
                        <a href="{{ route('search') }}" class="modern-btn-secondary">
                            <i class="fas fa-search mr-2"></i>Search Website
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
