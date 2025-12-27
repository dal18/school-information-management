@extends('layouts.public')

@section('title', 'About Us')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'About Us']
]" />

<!-- Hero Section -->
<section class="relative py-20 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 overflow-hidden">
    <div class="absolute inset-0 pattern-dots opacity-30"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center text-white animate-fade-in-up max-w-3xl mx-auto">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm font-semibold tracking-wide mb-4">
                Truth in Love • Excellence Since 1961
            </span>
            <h1 class="text-5xl md:text-6xl font-bold font-display mb-4">About LFHS</h1>
            <p class="text-xl text-gray-200 leading-relaxed">
                Little Flower High School is a progressive educational institution committed to academic excellence and character development.
            </p>
        </div>
    </div>
</section>

<!-- Mission Section -->
<section class="modern-section modern-section-white">
    <div class="modern-container">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <div class="modern-section-subtitle text-left">
                    <i class="fas fa-bullseye mr-2"></i>OUR MISSION
                </div>
                <h2 class="modern-heading-lg">
                    Excellence in Education
                </h2>
                <p class="modern-text-lead">
                    To provide quality education that develops critical thinking, creativity, and moral values in our students. We strive to nurture well-rounded individuals who are prepared to face the challenges of the modern world with confidence and integrity.
                </p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="modern-stat-card">
                        <div class="modern-stat-number text-primary-600">60+</div>
                        <div class="modern-stat-label">Years of Excellence</div>
                    </div>
                    <div class="modern-stat-card">
                        <div class="modern-stat-number text-primary-600">1000+</div>
                        <div class="modern-stat-label">Successful Graduates</div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="modern-image-wrapper h-96 bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center">
                   <img src="images/hero/1.jpg" width="full" height="full" alt="logo" class="object-contain">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Programs Section -->
<section class="modern-section modern-section-bg">
    <div class="modern-container">
        <div class="modern-section-header">
            <div class="modern-section-subtitle">
                <i class="fas fa-book mr-2"></i>WHAT WE OFFER
            </div>
            <h2 class="modern-section-title">
                Our Programs
            </h2>
            <p class="modern-section-description">
                Comprehensive educational programs designed to prepare students for success
            </p>
        </div>

        <div class="modern-grid modern-grid-3">
            <!-- Program 1 -->
            <div class="modern-card hover-lift">
                <div class="modern-card-content">
                    <div class="modern-feature-icon mb-4" style="background: linear-gradient(135deg, #1d4e8f 0%, #2563eb 100%);">
                        <i class="fas fa-graduation-cap text-white"></i>
                    </div>
                    <h3 class="modern-card-title mb-3">Academic Excellence Programs</h3>
                    <p class="modern-card-text">
                        Rigorous academic curriculum designed to challenge and inspire students to achieve their highest potential.
                    </p>
                </div>
            </div>

            <!-- Program 2 -->
            <div class="modern-card hover-lift">
                <div class="modern-card-content">
                    <div class="modern-feature-icon mb-4" style="background: linear-gradient(135deg, #d4a574 0%, #c89960 100%);">
                        <i class="fas fa-palette text-white"></i>
                    </div>
                    <h3 class="modern-card-title mb-3">Arts and Culture Integration</h3>
                    <p class="modern-card-text">
                        Fostering creativity and cultural appreciation through various artistic and cultural programs.
                    </p>
                </div>
            </div>

            <!-- Program 3 -->
            <div class="modern-card hover-lift">
                <div class="modern-card-content">
                    <div class="modern-feature-icon mb-4" style="background: linear-gradient(135deg, #1d4e8f 0%, #2563eb 100%);">
                        <i class="fas fa-flask text-white"></i>
                    </div>
                    <h3 class="modern-card-title mb-3">Science and Technology Focus</h3>
                    <p class="modern-card-text">
                        Hands-on learning experiences in science and technology to prepare students for the digital age.
                    </p>
                </div>
            </div>

            <!-- Program 4 -->
            <div class="modern-card hover-lift">
                <div class="modern-card-content">
                    <div class="modern-feature-icon mb-4" style="background: linear-gradient(135deg, #1d4e8f 0%, #2563eb 100%);">
                        <i class="fas fa-hands-helping text-white"></i>
                    </div>
                    <h3 class="modern-card-title mb-3">Community Service Learning</h3>
                    <p class="modern-card-text">
                        Building character and social responsibility through active community engagement and service.
                    </p>
                </div>
            </div>

            <!-- Program 5 -->
            <div class="modern-card hover-lift">
                <div class="modern-card-content">
                    <div class="modern-feature-icon mb-4" style="background: linear-gradient(135deg, #d4a574 0%, #c89960 100%);">
                        <i class="fas fa-user-tie text-white"></i>
                    </div>
                    <h3 class="modern-card-title mb-3">Leadership Development</h3>
                    <p class="modern-card-text">
                        Cultivating future leaders through mentorship, training, and leadership opportunities.
                    </p>
                </div>
            </div>

            <!-- Program 6 -->
            <div class="modern-card hover-lift">
                <div class="modern-card-content">
                    <div class="modern-feature-icon mb-4" style="background: linear-gradient(135deg, #1d4e8f 0%, #2563eb 100%);">
                        <i class="fas fa-heartbeat text-white"></i>
                    </div>
                    <h3 class="modern-card-title mb-3">Values Formation</h3>
                    <p class="modern-card-text">
                        Nurturing moral and spiritual development grounded in Christian values and principles.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- School Highlights Section -->
<section class="modern-section modern-section-white">
    <div class="modern-container">
        <div class="modern-section-header">
            <div class="modern-section-subtitle">
                <i class="fas fa-star mr-2"></i>SCHOOL HIGHLIGHTS
            </div>
            <h2 class="modern-section-title">
                Our Community in Action
            </h2>
            <p class="modern-section-description">
                Stay connected with the latest updates and events from our school community
            </p>
        </div>

        <!-- All 3 in One Row (Side by Side) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <!-- The Teachers 2025-2026 -->
            <div>
                <div class="text-center mb-2">
                    <h3 class="text-lg font-bold text-primary-900 font-serif">
                        <i class="fas fa-chalkboard-teacher mr-1 text-secondary-500"></i>
                        Teachers 2025-2026
                    </h3>
                </div>
                <div class="flex justify-center">
                    <iframe
                        src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2FLFHSPAI%2Fposts%2Fpfbid031WQcpcipDbZpP3u4s4vphDnnysiUypGL2T2urzygdo3LwDFUg5rFgf1XgGtwZaKtl&show_text=true&width=350"
                        width="350"
                        height="500"
                        style="border:none;overflow:hidden"
                        scrolling="no"
                        frameborder="0"
                        allowfullscreen="true"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                    </iframe>
                </div>
            </div>

            <!-- Parish Fiesta -->
            <div>
                <div class="text-center mb-2">
                    <h3 class="text-lg font-bold text-primary-900 font-serif">
                        <i class="fas fa-church mr-1 text-secondary-500"></i>
                        Parish Fiesta
                    </h3>
                    <p class="text-gray-600 text-xs">Every October 1st</p>
                </div>
                <div class="flex justify-center">
                    <iframe
                        src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2FLFHSPAI%2Fposts%2Fpfbid0NiZ379Ve5M8pKWtUr7dLWEfWcA8fe1U9rPiqbVgvKhxuWdjV7JkoEysLxULfVyJAl&show_text=true&width=350"
                        width="350"
                        height="500"
                        style="border:none;overflow:hidden"
                        scrolling="no"
                        frameborder="0"
                        allowfullscreen="true"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                    </iframe>
                </div>
            </div>

            <!-- Students Orientation -->
            <div>
                <div class="text-center mb-2">
                    <h3 class="text-lg font-bold text-primary-900 font-serif">
                        <i class="fas fa-user-graduate mr-1 text-secondary-500"></i>
                        Students Orientation
                    </h3>
                    <p class="text-gray-600 text-xs">Every School Year</p>
                </div>
                <div class="flex justify-center">
                    <iframe
                        src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2FLFHSPAI%2Fposts%2Fpfbid02pVrdZcna3TQPK78YkeL7ELx49dohPtLzvvncdZEPLctaj5sVfqSy3oeKUi7RjuVfl&show_text=true&width=350"
                        width="350"
                        height="500"
                        style="border:none;overflow:hidden"
                        scrolling="no"
                        frameborder="0"
                        allowfullscreen="true"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA Section -->
<section class="modern-section bg-primary-900 text-white">
    <div class="modern-container text-center">
        <h2 class="modern-heading-lg text-white mb-4">
            Want to Learn More?
        </h2>
        <p class="modern-text-lead text-white/90 mb-8 max-w-2xl mx-auto">
            Contact our main office or visit our campus to discover how LFHS can be the right choice for your child's education.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('contact') }}" class="btn-modern-accent">
                <i class="fas fa-envelope mr-2"></i>Contact Us
            </a>
            <a href="{{ route('admissions') }}" class="btn-modern-secondary bg-white text-primary-900 border-white hover:bg-gray-100">
                <i class="fas fa-file-alt mr-2"></i>Apply Now
            </a>
        </div>
    </div>
</section>

<style>
    .pattern-dots {
        background-image: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 20px 20px;
    }
</style>
@endsection
