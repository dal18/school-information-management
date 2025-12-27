@extends('layouts.public')

@section('title', 'Courses & Subjects')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Academics', 'url' => '#'],
    ['label' => 'Courses & Subjects', 'icon' => 'fas fa-book-open']
]" />

<!-- Hero Section -->
<section class="relative py-20 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 overflow-hidden">
    <div class="absolute inset-0 pattern-dots opacity-30"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center text-white animate-fade-in-up max-w-3xl mx-auto">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm font-semibold tracking-wide mb-4">
                <i class="fas fa-book-open mr-2"></i>Academic Excellence
            </span>
            <h1 class="text-5xl md:text-6xl font-bold font-display mb-4">Courses & Subjects</h1>
            <p class="text-xl text-gray-200 leading-relaxed">
                Comprehensive curriculum designed to prepare students for success in higher education and beyond
            </p>
        </div>
    </div>
</section>

<!-- Courses Section -->
<section class="modern-section modern-section-bg">
    <div class="modern-container">
        @if($subjects->count() > 0)
            @foreach($subjects as $gradeLevel => $gradSubjects)
            <div class="mb-12">
                <div class="bg-gradient-to-r from-primary-600 to-primary-800 text-white px-6 py-4 rounded-t-xl">
                    <h2 class="text-2xl font-display font-bold flex items-center">
                        <i class="fas fa-graduation-cap mr-3"></i>
                        {{ $gradeLevel }}
                    </h2>
                </div>

                <div class="bg-white rounded-b-xl shadow-modern p-6">
                    <div class="modern-grid modern-grid-3">
                        @foreach($gradSubjects as $subject)
                        <div class="modern-card hover-lift">
                            @if($subject->image_path)
                            <div class="modern-card-image h-48 cursor-pointer group relative overflow-hidden"
                                 onclick="openImageModal('{{ asset('storage/' . $subject->image_path) }}', '{{ $subject->subject_name }}')">
                                <x-responsive-image
                                    :src="$subject->image_path"
                                    :alt="$subject->subject_name"
                                    :lazy="true" />
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                    <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                                </div>
                            </div>
                            @else
                            <div class="h-48 bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                                <i class="fas fa-book text-white text-6xl"></i>
                            </div>
                            @endif
                            <div class="modern-card-content">
                                <h3 class="modern-card-title mb-2">{{ $subject->subject_name }}</h3>
                                @if($subject->description)
                                    <p class="modern-card-text">{{ Str::limit($subject->description, 100) }}</p>
                                @else
                                    <p class="modern-card-text italic">No description available</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <!-- Default courses when database is empty -->
            <!-- Junior High School -->
            <div class="mb-12">
                <div class="bg-gradient-to-r from-primary-600 to-primary-800 text-white px-6 py-4 rounded-t-xl">
                    <h2 class="text-2xl font-display font-bold flex items-center">
                        <i class="fas fa-user-graduate mr-3"></i>
                        Junior High School (Grades 7-10)
                    </h2>
                </div>

                <div class="bg-white rounded-b-xl shadow-md p-6">
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach([
                            ['name' => 'English', 'icon' => 'book'],
                            ['name' => 'Mathematics', 'icon' => 'calculator'],
                            ['name' => 'Science', 'icon' => 'flask'],
                            ['name' => 'Filipino', 'icon' => 'flag'],
                            ['name' => 'Araling Panlipunan', 'icon' => 'globe'],
                            ['name' => 'MAPEH', 'icon' => 'music'],
                            ['name' => 'Edukasyon sa Pagpapakatao', 'icon' => 'heart'],
                            ['name' => 'Technology and Livelihood Education', 'icon' => 'tools'],
                            ['name' => 'Computer Education', 'icon' => 'laptop']
                        ] as $subject)
                        <div class="flex items-start p-4 bg-gray-50 rounded-lg hover:bg-primary-50 hover:border-l-4 hover:border-primary-600 transition duration-200">
                            <div class="flex-shrink-0 w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-{{ $subject['icon'] }} text-primary-600"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">{{ $subject['name'] }}</h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Senior High School - HUMSS -->
            <div class="mb-12">
                <div class="bg-gradient-to-r from-secondary-600 to-secondary-700 text-white px-6 py-4 rounded-t-xl">
                    <h2 class="text-2xl font-display font-bold flex items-center">
                        <i class="fas fa-graduation-cap mr-3"></i>
                        Senior High School - HUMSS (Grades 11-12)
                    </h2>
                    <p class="text-sm text-secondary-100 mt-1">Humanities and Social Sciences</p>
                </div>

                <div class="bg-white rounded-b-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Core Subjects</h3>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                        @foreach([
                            ['name' => 'Oral Communication', 'icon' => 'comments'],
                            ['name' => 'General Mathematics', 'icon' => 'calculator'],
                            ['name' => 'Earth and Life Science', 'icon' => 'globe-americas'],
                            ['name' => 'Personal Development', 'icon' => 'user-check'],
                            ['name' => 'Understanding Culture, Society and Politics', 'icon' => 'users'],
                            ['name' => 'Physical Education and Health', 'icon' => 'running']
                        ] as $subject)
                        <div class="flex items-start p-4 bg-gray-50 rounded-lg hover:bg-primary-50 hover:border-l-4 hover:border-primary-600 transition duration-200">
                            <div class="flex-shrink-0 w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-{{ $subject['icon'] }} text-primary-600"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">{{ $subject['name'] }}</h3>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <h3 class="text-lg font-semibold text-gray-900 mb-4 mt-8">Specialized Subjects (HUMSS)</h3>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach([
                            ['name' => 'Creative Writing', 'icon' => 'pen-fancy'],
                            ['name' => 'Introduction to World Religions', 'icon' => 'church'],
                            ['name' => 'Community Engagement', 'icon' => 'hands-helping'],
                            ['name' => 'Creative Nonfiction', 'icon' => 'book-open'],
                            ['name' => 'Trends, Networks and Critical Thinking', 'icon' => 'network-wired'],
                            ['name' => 'Philippine Politics and Governance', 'icon' => 'landmark']
                        ] as $subject)
                        <div class="flex items-start p-4 bg-gray-50 rounded-lg hover:bg-secondary-50 hover:border-l-4 hover:border-secondary-600 transition duration-200">
                            <div class="flex-shrink-0 w-10 h-10 bg-secondary-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-{{ $subject['icon'] }} text-secondary-600"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">{{ $subject['name'] }}</h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Features Section -->
<section class="modern-section modern-section-white">
    <div class="modern-container">
        <div class="modern-section-header">
            <div class="modern-section-subtitle">
                <i class="fas fa-lightbulb mr-2"></i>OUR APPROACH
            </div>
            <h2 class="modern-section-title">
                Our Academic Approach
            </h2>
            <p class="modern-section-description">
                We combine traditional values with modern teaching methods
            </p>
        </div>

        <div class="modern-grid modern-grid-4">
            <div class="modern-card hover-lift text-center">
                <div class="modern-card-content">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chalkboard-teacher text-3xl text-primary-600"></i>
                    </div>
                    <h3 class="modern-card-title mb-2">Experienced Teachers</h3>
                    <p class="modern-card-text">
                        Qualified and dedicated educators committed to student success
                    </p>
                </div>
            </div>

            <div class="modern-card hover-lift text-center">
                <div class="modern-card-content">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-laptop-code text-3xl text-primary-600"></i>
                    </div>
                    <h3 class="modern-card-title mb-2">Modern Technology</h3>
                    <p class="modern-card-text">
                        Integration of technology in teaching and learning
                    </p>
                </div>
            </div>

            <div class="modern-card hover-lift text-center">
                <div class="modern-card-content">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-3xl text-primary-600"></i>
                    </div>
                    <h3 class="modern-card-title mb-2">Small Class Sizes</h3>
                    <p class="modern-card-text">
                        Personalized attention and interactive learning environment
                    </p>
                </div>
            </div>

            <div class="modern-card hover-lift text-center">
                <div class="modern-card-content">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-award text-3xl text-primary-600"></i>
                    </div>
                    <h3 class="modern-card-title mb-2">Holistic Development</h3>
                    <p class="modern-card-text">
                        Focus on academic, social, and character development
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="modern-section bg-primary-900 text-white">
    <div class="modern-container text-center">
        <h2 class="modern-heading-lg text-white mb-4">
            Ready to Begin Your Academic Journey?
        </h2>
        <p class="modern-text-lead text-white/90 mb-8 max-w-2xl mx-auto">
            Join Little Flower High School and experience quality education with a strong academic foundation.
        </p>
        <a href="{{ route('admissions') }}" class="btn-modern-accent">
            <i class="fas fa-file-alt mr-2"></i>Apply for Admission
        </a>
    </div>
</section>

<style>
    .pattern-dots {
        background-image: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 20px 20px;
    }
</style>
@endsection
