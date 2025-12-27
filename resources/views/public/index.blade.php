@extends('layouts.public')

@section('title', 'Home')

@section('content')
<!-- Hero Carousel Section -->
<section class="relative h-screen max-h-[900px] overflow-hidden bg-gradient-to-br from-dark-900 to-primary-950">
    <!-- Progress Bar -->
    <div class="absolute top-0 left-0 w-full h-1.5 bg-white/10 z-50">
        <div class="carousel-progress h-full bg-gradient-to-r from-secondary-400 via-accent-500 to-accent-600 transition-all duration-300 shadow-lg" style="width: 0%"></div>
    </div>

    <div class="carousel-container relative w-full h-full">
        <!-- Carousel Slides -->
        <div class="carousel-slides relative w-full h-full">
            <!-- Slide 1 - Welcome -->
            <div class="carousel-slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                <div class="absolute inset-0 overflow-hidden">
                    <img src="{{ asset('images/hero/1.jpg') }}" alt="Campus View" class="w-full h-full object-cover transform scale-100 transition-transform duration-[8000ms] ease-out carousel-image">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/55 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                        <div class="max-w-3xl">
                            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 slide-in-left">
                                Welcome to<br>
                                <span class="bg-gradient-to-r from-secondary-400 to-accent-500 bg-clip-text text-transparent">Little Flower High School</span>
                            </h1>
                            <p class="text-xl md:text-2xl text-white mb-8 slide-in-left" style="animation-delay: 0.2s;">
                                Nurturing Minds, Building Character, Shaping Future Leaders
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 slide-in-left" style="animation-delay: 0.4s;">
                                <a href="{{ route('admissions') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white font-bold px-8 py-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl shadow-xl">
                                    <i class="fas fa-file-alt mr-2"></i>Apply Now
                                </a>
                                <a href="{{ route('about') }}" class="inline-flex items-center justify-center bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white font-bold px-8 py-4 rounded-lg transition-all duration-300 border-2 border-white">
                                    <i class="fas fa-info-circle mr-2"></i>Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 - Academic Excellence -->
            <div class="carousel-slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                <div class="absolute inset-0 overflow-hidden">
                    <img src="{{ asset('images/hero/2.jpg') }}" alt="Students Learning" class="w-full h-full object-cover transform scale-100 transition-transform duration-[8000ms] ease-out carousel-image">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/45 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/20 to-transparent"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center">
                        <h2 class="text-5xl md:text-7xl font-bold text-white mb-6 zoom-in">
                            Academic <span class="bg-gradient-to-r from-secondary-400 to-accent-500 bg-clip-text text-transparent">Excellence</span>
                        </h2>
                        <p class="text-xl md:text-2xl text-white mb-8 max-w-3xl mx-auto zoom-in" style="animation-delay: 0.2s;">
                            Rigorous curriculum designed to challenge and inspire students to reach their full potential
                        </p>
                        <a href="{{ route('courses') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white font-bold px-8 py-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl shadow-xl zoom-in" style="animation-delay: 0.4s;">
                            <i class="fas fa-book mr-2"></i>Explore Courses
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 3 - Modern Facilities -->
            <div class="carousel-slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                <div class="absolute inset-0 overflow-hidden">
                    <img src="{{ asset('images/hero/3.png') }}" alt="School Facilities" class="w-full h-full object-cover transform scale-100 transition-transform duration-[8000ms] ease-out carousel-image">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-black/40 to-black/75"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                <div class="absolute inset-0 flex items-center justify-end">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                        <div class="max-w-2xl ml-auto text-right">
                            <h2 class="text-5xl md:text-7xl font-bold text-white mb-6 slide-in-right">
                                World-Class <br><span class="bg-gradient-to-r from-secondary-400 to-accent-500 bg-clip-text text-transparent">Facilities</span>
                            </h2>
                            <p class="text-xl md:text-2xl text-white mb-8 slide-in-right" style="animation-delay: 0.2s;">
                                State-of-the-art classrooms, laboratories, sports complex, and more
                            </p>
                            <a href="{{ route('facilities') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white font-bold px-8 py-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl shadow-xl slide-in-right" style="animation-delay: 0.4s;">
                                <i class="fas fa-building mr-2"></i>View Facilities
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 4 - Sports & Activities -->
            <div class="carousel-slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                <div class="absolute inset-0 overflow-hidden">
                    <img src="{{ asset('images/hero/12.jpg') }}" alt="Sports Activities" class="w-full h-full object-cover transform scale-100 transition-transform duration-[8000ms] ease-out carousel-image">
                </div>
                <div class="absolute inset-0 bg-gradient-to-b from-black/65 via-transparent to-black/85"></div>
                <div class="absolute inset-0 flex items-end">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pb-20">
                        <div class="text-center">
                            <h2 class="text-5xl md:text-7xl font-bold text-white mb-6 slide-up">
                                Sports & <span class="bg-gradient-to-r from-secondary-400 to-accent-500 bg-clip-text text-transparent">Activities</span>
                            </h2>
                            <p class="text-xl md:text-2xl text-white mb-8 max-w-3xl mx-auto slide-up" style="animation-delay: 0.2s;">
                                Comprehensive extracurricular programs for holistic development
                            </p>
                            <a href="{{ route('activities') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white font-bold px-8 py-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl shadow-xl slide-up" style="animation-delay: 0.4s;">
                                <i class="fas fa-trophy mr-2"></i>View Activities
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 5 - Expert Faculty -->
            <div class="carousel-slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                <div class="absolute inset-0 overflow-hidden">
                    <img src="{{ asset('images/hero/2.png') }}" alt="Teachers" class="w-full h-full object-cover transform scale-100 transition-transform duration-[8000ms] ease-out carousel-image">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/55 to-black/85"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center">
                        <h2 class="text-5xl md:text-7xl font-bold text-white mb-6 fade-in">
                            Expert <span class="bg-gradient-to-r from-secondary-400 to-accent-500 bg-clip-text text-transparent">Faculty</span>
                        </h2>
                        <p class="text-xl md:text-2xl text-white mb-8 max-w-3xl mx-auto fade-in" style="animation-delay: 0.2s;">
                            Dedicated teachers committed to student success and personal growth
                        </p>
                        <a href="{{ route('administration') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white font-bold px-8 py-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl shadow-xl fade-in" style="animation-delay: 0.4s;">
                            <i class="fas fa-users mr-2"></i>Meet Our Team
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 6 - Join Us -->
            <div class="carousel-slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                <div class="absolute inset-0 overflow-hidden">
                    <img src="{{ asset('images/hero/13.jpg') }}" alt="Graduation" class="w-full h-full object-cover transform scale-100 transition-transform duration-[8000ms] ease-out carousel-image">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/55 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/20 to-black/20"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center">
                        <h2 class="text-5xl md:text-7xl font-bold text-white mb-6 bounce-in">
                            Begin Your <span class="bg-gradient-to-r from-secondary-400 to-accent-500 bg-clip-text text-transparent">Journey</span>
                        </h2>
                        <p class="text-xl md:text-2xl text-white mb-8 max-w-3xl mx-auto bounce-in" style="animation-delay: 0.2s;">
                            Join our community of achievers and unlock your true potential
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center bounce-in" style="animation-delay: 0.4s;">
                            <a href="{{ route('admissions') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white font-bold px-8 py-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl shadow-xl">
                                <i class="fas fa-graduation-cap mr-2"></i>Apply Today
                            </a>
                            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white font-bold px-8 py-4 rounded-lg transition-all duration-300 border-2 border-white">
                                <i class="fas fa-envelope mr-2"></i>Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Arrows -->
        <button class="carousel-prev absolute left-4 md:left-8 top-1/2 -translate-y-1/2 w-16 h-16 bg-gradient-to-br from-secondary-500/30 to-secondary-600/30 backdrop-blur-md hover:from-secondary-500/50 hover:to-secondary-600/50 rounded-full flex items-center justify-center transition-all duration-300 group z-40 border border-white/30 shadow-xl hover:scale-110 hover:shadow-2xl">
            <i class="fas fa-chevron-left text-white text-2xl group-hover:scale-125 transition-transform drop-shadow-lg"></i>
        </button>
        <button class="carousel-next absolute right-4 md:right-8 top-1/2 -translate-y-1/2 w-16 h-16 bg-gradient-to-br from-secondary-500/30 to-secondary-600/30 backdrop-blur-md hover:from-secondary-500/50 hover:to-secondary-600/50 rounded-full flex items-center justify-center transition-all duration-300 group z-40 border border-white/30 shadow-xl hover:scale-110 hover:shadow-2xl">
            <i class="fas fa-chevron-right text-white text-2xl group-hover:scale-125 transition-transform drop-shadow-lg"></i>
        </button>

        <!-- Indicator Dots -->
        <div class="absolute bottom-12 left-1/2 -translate-x-1/2 flex gap-4 z-40 bg-black/20 backdrop-blur-md px-6 py-4 rounded-full border border-white/20">
            <button class="carousel-dot group relative" data-slide="0">
                <div class="w-2.5 h-2.5 rounded-full bg-white/50 group-hover:bg-white transition-all duration-300"></div>
                <div class="absolute -inset-2 rounded-full border-2 border-transparent group-hover:border-white/50 transition-all duration-300"></div>
            </button>
            <button class="carousel-dot group relative" data-slide="1">
                <div class="w-2.5 h-2.5 rounded-full bg-white/50 group-hover:bg-white transition-all duration-300"></div>
                <div class="absolute -inset-2 rounded-full border-2 border-transparent group-hover:border-white/50 transition-all duration-300"></div>
            </button>
            <button class="carousel-dot group relative" data-slide="2">
                <div class="w-2.5 h-2.5 rounded-full bg-white/50 group-hover:bg-white transition-all duration-300"></div>
                <div class="absolute -inset-2 rounded-full border-2 border-transparent group-hover:border-white/50 transition-all duration-300"></div>
            </button>
            <button class="carousel-dot group relative" data-slide="3">
                <div class="w-2.5 h-2.5 rounded-full bg-white/50 group-hover:bg-white transition-all duration-300"></div>
                <div class="absolute -inset-2 rounded-full border-2 border-transparent group-hover:border-white/50 transition-all duration-300"></div>
            </button>
            <button class="carousel-dot group relative" data-slide="4">
                <div class="w-2.5 h-2.5 rounded-full bg-white/50 group-hover:bg-white transition-all duration-300"></div>
                <div class="absolute -inset-2 rounded-full border-2 border-transparent group-hover:border-white/50 transition-all duration-300"></div>
            </button>
            <button class="carousel-dot group relative" data-slide="5">
                <div class="w-2.5 h-2.5 rounded-full bg-white/50 group-hover:bg-white transition-all duration-300"></div>
                <div class="absolute -inset-2 rounded-full border-2 border-transparent group-hover:border-white/50 transition-all duration-300"></div>
            </button>
        </div>

        <!-- Slide Counter -->
        <div class="absolute bottom-12 right-8 z-40 bg-black/30 backdrop-blur-md px-4 py-2 rounded-full border border-white/20 text-white font-semibold text-sm">
            <span class="carousel-current">1</span> / <span class="carousel-total">6</span>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-28 left-1/2 -translate-x-1/2 z-30 animate-bounce">
            <div class="flex flex-col items-center gap-2">
                <i class="fas fa-chevron-down text-white text-2xl opacity-70 drop-shadow-lg"></i>
                <span class="text-white text-xs opacity-70 uppercase tracking-wider">Scroll Down</span>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="modern-section modern-section-bg">
    <div class="modern-container">
        <div class="modern-section-header" data-animate>
            <div class="modern-section-subtitle">
                <i class="fas fa-star mr-2"></i>OUR STRENGTHS
            </div>
            <h2 class="modern-section-title">
                Why Choose LFHS?
            </h2>
            <p class="modern-section-description">
                We provide comprehensive education that prepares students for success in college and beyond
            </p>
        </div>

        <div class="modern-grid modern-grid-3">
            <!-- Feature 1 -->
            <div class="modern-card hover-lift" data-animate data-stagger>
                <div class="modern-card-content text-center">
                    <div class="modern-feature-icon mx-auto mb-6" style="background: linear-gradient(135deg, #1d4e8f 0%, #2563eb 100%);">
                        <i class="fas fa-book text-white"></i>
                    </div>
                    <h3 class="modern-card-title">Academic Excellence</h3>
                    <p class="modern-card-text mb-4">
                        Rigorous curriculum designed to challenge and inspire students to reach their full potential
                    </p>
                    <a href="{{ route('courses') }}" class="text-primary-600 font-semibold inline-flex items-center hover:text-primary-700 transition-colors">
                        Explore Courses <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="modern-card hover-lift" data-animate data-stagger>
                <div class="modern-card-content text-center">
                    <div class="modern-feature-icon mx-auto mb-6" style="background: linear-gradient(135deg, #d4a574 0%, #c89960 100%);">
                        <i class="fas fa-users text-white"></i>
                    </div>
                    <h3 class="modern-card-title">Experienced Faculty</h3>
                    <p class="modern-card-text mb-4">
                        Dedicated teachers committed to student success and personal growth
                    </p>
                    <a href="{{ route('administration') }}" class="text-primary-600 font-semibold inline-flex items-center hover:text-primary-700 transition-colors">
                        Meet Our Team <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="modern-card hover-lift" data-animate data-stagger>
                <div class="modern-card-content text-center">
                    <div class="modern-feature-icon mx-auto mb-6" style="background: linear-gradient(135deg, #1d4e8f 0%, #2563eb 100%);">
                        <i class="fas fa-building text-white"></i>
                    </div>
                    <h3 class="modern-card-title">Modern Facilities</h3>
                    <p class="modern-card-text mb-4">
                        State-of-the-art classrooms, laboratories, and recreational facilities
                    </p>
                    <a href="{{ route('facilities') }}" class="text-primary-600 font-semibold inline-flex items-center hover:text-primary-700 transition-colors">
                        View Facilities <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Enhanced Stats Section -->
        <div class="mt-20 bg-gradient-to-br from-primary-600 to-primary-800 rounded-xl p-8 md:p-12 shadow-modern-lg" data-animate>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl mb-4 hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-award text-3xl text-white"></i>
                    </div>
                    <div class="modern-stat-number text-white" data-counter="60">0</div>
                    <div class="modern-stat-label text-white/90">Years of Excellence</div>
                </div>
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl mb-4 hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-user-graduate text-3xl text-white"></i>
                    </div>
                    <div class="modern-stat-number text-white" data-counter="1000">0</div>
                    <div class="modern-stat-label text-white/90">Successful Graduates</div>
                </div>
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl mb-4 hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-chalkboard-teacher text-3xl text-white"></i>
                    </div>
                    <div class="modern-stat-number text-white" data-counter="50">0</div>
                    <div class="modern-stat-label text-white/90">Expert Faculty</div>
                </div>
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl mb-4 hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-chart-line text-3xl text-white"></i>
                    </div>
                    <div class="modern-stat-number text-white">
                        <span data-counter="95">0</span><span class="text-3xl">%</span>
                    </div>
                    <div class="modern-stat-label text-white/90">Success Rate</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Announcements Section -->
@if($announcements->count() > 0)
<section class="modern-section modern-section-white">
    <div class="modern-container">
        <div class="flex justify-between items-center mb-12">
            <div>
                <div class="modern-section-subtitle text-left mb-2">
                    <i class="fas fa-bullhorn mr-2"></i>LATEST NEWS
                </div>
                <h2 class="modern-heading-lg">Latest Announcements</h2>
            </div>
            <a href="{{ route('announcements') }}" class="btn-modern-secondary text-sm px-6 py-3">
                View All <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <div class="modern-grid modern-grid-3">
            @foreach($announcements as $announcement)
            <div class="modern-card hover-lift">
                <div class="modern-card-content">
                    <div class="modern-badge modern-badge-primary mb-4">
                        <i class="far fa-calendar mr-2"></i>
                        {{ $announcement->created_at->format('M d, Y') }}
                    </div>
                    <h3 class="modern-card-title mb-3">{{ $announcement->title }}</h3>
                    <p class="modern-card-text line-clamp-3">{{ Str::limit($announcement->content, 150) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Alma Mater Section -->
<section class="relative overflow-hidden py-16 md:py-24 bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/40">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-[0.03]">
        <svg width="100%" height="100%">
            <defs>
                <pattern id="music-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <circle cx="20" cy="20" r="1" fill="#1e40af"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#music-pattern)"/>
        </svg>
    </div>

    <!-- Subtle Background Blobs -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -left-40 w-80 h-80 bg-blue-200/20 rounded-full filter blur-3xl"></div>
        <div class="absolute -bottom-40 -right-40 w-80 h-80 bg-indigo-200/20 rounded-full filter blur-3xl"></div>
    </div>

    <div class="modern-container relative z-10">
        <div class="text-center mb-12">
            <div class="inline-flex items-center px-4 py-2 bg-blue-100/60 rounded-full text-blue-800 text-sm font-semibold mb-4 backdrop-blur-sm">
                <i class="fas fa-music mr-2"></i>OUR ALMA MATER
            </div>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-4">
                Little Flower High School Hymn
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Watch and sing along with our cherished school anthem
            </p>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl border border-blue-100/50">
                <div class="p-8 md:p-12">
                    <!-- YouTube Video Embed -->
                    <div class="mb-8">
                        <div class="relative w-full" style="padding-bottom: 56.25%; /* 16:9 aspect ratio */">
                            <iframe
                                class="absolute top-0 left-0 w-full h-full rounded-xl shadow-2xl"
                                src="https://www.youtube.com/embed/yRhJqnnyKoY"
                                title="Little Flower High School Alma Mater"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>

                    <!-- Lyrics Display -->
                    <div class="lyrics-container bg-gradient-to-br from-slate-50 to-blue-50/30 rounded-2xl p-8 md:p-10 shadow-inner border border-blue-100/30 max-h-96 overflow-y-auto">
                        <div class="text-center space-y-5">
                            <div class="text-xl md:text-2xl text-gray-800 leading-relaxed font-bold">
                                🎵 Little Flower High School Alma Mater 🎵
                            </div>

                            <div class="text-lg md:text-xl text-gray-700 leading-relaxed py-2">
                                In the heart of our fair land so bright,
                            </div>

                            <div class="text-lg md:text-xl text-gray-700 leading-relaxed py-2">
                                Stands our school, a beacon of light,
                            </div>

                            <div class="text-lg md:text-xl text-gray-700 leading-relaxed py-2">
                                Little Flower, dear to our hearts,
                            </div>

                            <div class="text-lg md:text-xl text-gray-700 leading-relaxed py-2">
                                Where knowledge and wisdom imparts.
                            </div>

                            <div class="text-lg md:text-xl text-indigo-700 font-bold mt-8 py-2">
                                <em>♫ Chorus ♫</em>
                            </div>

                            <div class="text-lg md:text-xl text-gray-700 leading-relaxed py-2">
                                Hail to thee, our Alma Mater dear,
                            </div>

                            <div class="text-lg md:text-xl text-gray-700 leading-relaxed py-2">
                                Guiding us through each passing year,
                            </div>

                            <div class="text-lg md:text-xl text-gray-700 leading-relaxed py-2">
                                With honor, truth, and pride we stand,
                            </div>

                            <div class="text-lg md:text-xl text-gray-700 leading-relaxed py-2">
                                United as one, hand in hand.
                            </div>

                            <div class="text-lg md:text-xl text-gray-700 leading-relaxed mt-8 py-2">
                                Through trials and triumphs we grow strong,
                            </div>

                            <div class="text-lg md:text-xl text-gray-700 leading-relaxed py-2">
                                With faith and courage, we belong,
                            </div>

                            <div class="text-lg md:text-xl text-gray-700 leading-relaxed py-2">
                                To this family, forever true,
                            </div>

                            <div class="text-lg md:text-xl text-gray-700 leading-relaxed py-2">
                                Little Flower, we honor you!
                            </div>

                            <div class="text-2xl md:text-3xl text-blue-700 font-bold mt-10 py-3">
                                🌸 Little Flower High School Forever! 🌸
                            </div>
                        </div>
                    </div>

                    <!-- Note -->
                    <div class="mt-8 text-center">
                        <div class="inline-flex items-center px-6 py-3 bg-blue-50 border border-blue-200 rounded-full text-gray-700">
                            <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                            <span class="text-sm font-medium">Watch the video and sing along with our Alma Mater hymn</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Testimonials Carousel Section -->
@if($testimonials->count() > 0)
<section class="modern-section modern-section-bg">
    <div class="modern-container">
        <div class="modern-section-header">
            <div class="modern-section-subtitle">
                <i class="fas fa-quote-left mr-2"></i>TESTIMONIALS
            </div>
            <h2 class="modern-section-title">
                What Our Community Says
            </h2>
            <p class="modern-section-description">
                Hear from students, parents, and alumni about their experiences at LFHS
            </p>
        </div>

        <!-- Testimonials Carousel -->
        <div class="relative" x-data="testimonialCarousel()">
            <div class="overflow-hidden">
                <div class="flex transition-transform duration-500 ease-in-out" :style="`transform: translateX(-${currentSlide * 100}%)`">
                    @foreach($testimonials as $index => $testimonial)
                    <div class="w-full flex-shrink-0 px-4">
                        <div class="modern-card shadow-modern-lg p-8 md:p-12 max-w-4xl mx-auto">
                            <div class="flex items-center justify-center mb-6">
                                <div class="text-primary-300 text-6xl opacity-20">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                            </div>
                            <p class="modern-text-lead text-center italic leading-relaxed mb-8">
                                "{{ $testimonial->message }}"
                            </p>
                            <div class="flex items-center justify-center">
                                <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-700 rounded-full flex items-center justify-center text-white font-bold text-2xl shadow-modern">
                                    {{ substr($testimonial->student_name, 0, 1) }}
                                </div>
                                <div class="ml-4 text-left">
                                    <h4 class="font-bold text-gray-900 text-lg">{{ $testimonial->student_name }}</h4>
                                    <p class="modern-text-muted text-sm font-medium">{{ $testimonial->grade_level }}</p>
                                    <div class="flex items-center mt-1">
                                        @for($i = 0; $i < 5; $i++)
                                        <i class="fas fa-star text-secondary-500 text-xs"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Navigation Arrows -->
            @if($testimonials->count() > 1)
            <button @click="prevSlide()" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 md:-translate-x-12 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-primary-600 hover:text-white transition-all duration-300 group">
                <i class="fas fa-chevron-left text-gray-600 group-hover:text-white"></i>
            </button>
            <button @click="nextSlide()" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 md:translate-x-12 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-primary-600 hover:text-white transition-all duration-300 group">
                <i class="fas fa-chevron-right text-gray-600 group-hover:text-white"></i>
            </button>

            <!-- Indicators -->
            <div class="flex justify-center mt-8 gap-2">
                @foreach($testimonials as $index => $testimonial)
                <button @click="currentSlide = {{ $index }}"
                        :class="currentSlide === {{ $index }} ? 'w-8 bg-primary-600' : 'w-2 bg-gray-300'"
                        class="h-2 rounded-full transition-all duration-300 hover:bg-primary-400"></button>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>

<script>
function testimonialCarousel() {
    return {
        currentSlide: 0,
        totalSlides: {{ $testimonials->count() }},
        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
        },
        prevSlide() {
            this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        },
        init() {
            setInterval(() => {
                this.nextSlide();
            }, 5000);
        }
    }
}
</script>
@endif

<!-- Social Proof & Live Stats Widget -->
<x-social-proof :recentActivities="$recentActivities" :activeStudentsCount="$activeStudentsCount" />

<!-- Quick Facts About LFHS -->
<x-quick-facts />

<!-- School Achievements & Recognition -->
<x-school-achievements />

<!-- Photo Gallery -->
<x-photo-gallery />

<!-- Virtual Campus Tour Section -->
<x-virtual-tour />

<!-- Facebook Feed -->
<x-facebook-feed />

<!-- Google Maps and Reviews -->
<x-google-section />

<!-- Enhanced CTA Section -->
<section class="modern-section bg-gradient-to-br from-primary-900 via-primary-800 to-primary-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 pattern-dots opacity-10"></div>
    <div class="modern-container text-center relative z-10">
        <h2 class="modern-heading-xl text-white mb-6">
            Ready to Join Our Community?
        </h2>
        <p class="modern-text-lead text-white/90 mb-10 max-w-3xl mx-auto">
            Take the first step towards an excellent education. Apply now for the upcoming school year and become part of our legacy.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('admissions') }}" class="btn-modern-accent">
                <i class="fas fa-graduation-cap mr-3 text-xl"></i>
                Start Your Application
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white font-semibold rounded-lg transition-all duration-300 border-2 border-white/50 hover:border-white">
                <i class="fas fa-calendar-alt mr-3 text-xl"></i>
                Schedule a Visit
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Carousel Animations */
@keyframes slide-in-left {
    from {
        opacity: 0;
        transform: translateX(-100px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slide-in-right {
    from {
        opacity: 0;
        transform: translateX(100px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slide-up {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes zoom-in {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes bounce-in {
    0% {
        opacity: 0;
        transform: scale(0.3);
    }
    50% {
        opacity: 1;
        transform: scale(1.05);
    }
    70% {
        transform: scale(0.9);
    }
    100% {
        transform: scale(1);
    }
}

.carousel-slide.active .slide-in-left {
    animation: slide-in-left 0.8s ease-out forwards;
}

.carousel-slide.active .slide-in-right {
    animation: slide-in-right 0.8s ease-out forwards;
}

.carousel-slide.active .slide-up {
    animation: slide-up 0.8s ease-out forwards;
}

.carousel-slide.active .zoom-in {
    animation: zoom-in 0.8s ease-out forwards;
}

.carousel-slide.active .fade-in {
    animation: fade-in 0.8s ease-out forwards;
}

.carousel-slide.active .bounce-in {
    animation: bounce-in 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
}

.carousel-slide.active {
    opacity: 1 !important;
}

.carousel-dot.active {
    background-color: white;
    width: 2rem;
}

/* Smooth ken burns effect for images */
@keyframes ken-burns {
    0% {
        transform: scale(1);
    }
    100% {
        transform: scale(1.1);
    }
}

.carousel-slide.active img {
    animation: ken-burns 10s ease-out forwards;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    const prevBtn = document.querySelector('.carousel-prev');
    const nextBtn = document.querySelector('.carousel-next');

    let currentSlide = 0;
    const slideCount = slides.length;
    let slideInterval;

    // Initialize first slide
    function initCarousel() {
        slides[0].classList.add('active');
        slides[0].style.opacity = '1';

        // Initialize first dot as active
        const firstDot = dots[0].querySelector('div');
        if (firstDot) {
            firstDot.classList.remove('bg-white/50', 'w-2.5');
            firstDot.classList.add('bg-white', 'w-8');
        }
        dots[0].classList.add('active');

        // Start Ken Burns effect on first slide
        const firstImg = slides[0].querySelector('.carousel-image');
        if (firstImg) {
            setTimeout(() => {
                firstImg.style.transform = 'scale(1.1)';
            }, 100);
        }

        startAutoPlay();
        updateProgressBar();
    }

    // Show specific slide
    function showSlide(index) {
        // Remove active class from all slides
        slides.forEach((slide, i) => {
            slide.classList.remove('active');
            slide.style.opacity = '0';

            // Reset Ken Burns effect
            const img = slide.querySelector('.carousel-image');
            if (img) {
                img.style.transform = 'scale(1)';
            }
        });

        dots.forEach(dot => {
            dot.classList.remove('active');
            const inner = dot.querySelector('div');
            if (inner) {
                inner.classList.remove('bg-white', 'w-8');
                inner.classList.add('bg-white/50', 'w-2.5');
            }
        });

        // Add active class to current slide
        slides[index].classList.add('active');
        slides[index].style.opacity = '1';

        // Apply Ken Burns effect (zoom in)
        const activeImg = slides[index].querySelector('.carousel-image');
        if (activeImg) {
            setTimeout(() => {
                activeImg.style.transform = 'scale(1.1)';
            }, 100);
        }

        // Update dot
        const activeDot = dots[index].querySelector('div');
        if (activeDot) {
            activeDot.classList.remove('bg-white/50', 'w-2.5');
            activeDot.classList.add('bg-white', 'w-8');
        }
        dots[index].classList.add('active');

        // Update slide counter
        const currentCounter = document.querySelector('.carousel-current');
        if (currentCounter) {
            currentCounter.textContent = index + 1;
        }

        currentSlide = index;
        updateProgressBar();
    }

    // Update progress bar
    function updateProgressBar() {
        const progressBar = document.querySelector('.carousel-progress');
        if (progressBar) {
            progressBar.style.width = '0%';
            setTimeout(() => {
                progressBar.style.transition = 'width 5000ms linear';
                progressBar.style.width = '100%';
            }, 50);
        }
    }

    // Next slide
    function nextSlide() {
        const next = (currentSlide + 1) % slideCount;
        showSlide(next);
    }

    // Previous slide
    function prevSlide() {
        const prev = (currentSlide - 1 + slideCount) % slideCount;
        showSlide(prev);
    }

    // Auto play
    function startAutoPlay() {
        slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
    }

    function stopAutoPlay() {
        clearInterval(slideInterval);
    }

    function resetAutoPlay() {
        stopAutoPlay();
        startAutoPlay();
    }

    // Event listeners
    prevBtn.addEventListener('click', () => {
        prevSlide();
        resetAutoPlay();
    });

    nextBtn.addEventListener('click', () => {
        nextSlide();
        resetAutoPlay();
    });

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
            resetAutoPlay();
        });
    });

    // Pause on hover
    const carouselContainer = document.querySelector('.carousel-container');
    carouselContainer.addEventListener('mouseenter', stopAutoPlay);
    carouselContainer.addEventListener('mouseleave', startAutoPlay);

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            prevSlide();
            resetAutoPlay();
        } else if (e.key === 'ArrowRight') {
            nextSlide();
            resetAutoPlay();
        }
    });

    // Touch/swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;

    carouselContainer.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    });

    carouselContainer.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });

    function handleSwipe() {
        if (touchEndX < touchStartX - 50) {
            nextSlide();
            resetAutoPlay();
        }
        if (touchEndX > touchStartX + 50) {
            prevSlide();
            resetAutoPlay();
        }
    }

    // Initialize
    initCarousel();
});
</script>
@endpush
