@extends('layouts.public')

@section('title', 'Facilities')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Campus Life', 'url' => '#'],
    ['label' => 'Facilities', 'icon' => 'fas fa-building']
]" />

<!-- Hero Section -->
<section class="relative py-20 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 overflow-hidden">
    <div class="absolute inset-0 pattern-dots opacity-30"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center text-white animate-fade-in-up max-w-3xl mx-auto">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm font-semibold tracking-wide mb-4">
                <i class="fas fa-building mr-2"></i>World-Class Learning Environment
            </span>
            <h1 class="text-5xl md:text-6xl font-bold font-display mb-4">Our Facilities</h1>
            <p class="text-xl text-gray-200 leading-relaxed">
                State-of-the-art facilities designed to enhance learning and student development
            </p>
        </div>
    </div>
</section>

<!-- Facilities Grid Section -->
<section class="modern-section modern-section-bg">
    <div class="modern-container">
        @if($facilities->count() > 0)
            <div class="modern-grid modern-grid-3">
                @foreach($facilities as $facility)
                <div class="modern-card hover-lift overflow-hidden">
                    @if($facility->image_path)
                        <div class="h-48 bg-gradient-to-br from-primary-100 to-primary-50 overflow-hidden cursor-pointer group relative"
                             onclick="openImageModal('{{ Storage::url($facility->image_path) }}', '{{ $facility->name }}')">
                            <x-responsive-image
                                :src="$facility->image_path"
                                :alt="$facility->name"
                                class="w-full h-full object-cover hover:scale-110 transition duration-500"
                                :lazy="true" />
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                            </div>
                        </div>
                    @else
                        <div class="h-48 bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center">
                            <i class="fas fa-building text-6xl text-primary-300"></i>
                        </div>
                    @endif

                    <div class="modern-card-content">
                        <h3 class="modern-card-title mb-2">{{ $facility->name }}</h3>
                        <p class="modern-card-text mb-4">{{ $facility->description }}</p>

                        @if($facility->capacity)
                        <div class="flex items-center modern-text-muted">
                            <i class="fas fa-users mr-2 text-primary-600"></i>
                            <span>Capacity: {{ $facility->capacity }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- Default facilities when database is empty -->
            <div class="modern-grid modern-grid-3">
                <!-- Science Laboratory -->
                <div class="modern-card hover-lift overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center">
                        <i class="fas fa-flask text-6xl text-primary-300"></i>
                    </div>
                    <div class="modern-card-content">
                        <h3 class="modern-card-title mb-2">Science Laboratory</h3>
                        <p class="modern-card-text mb-4">
                            Modern laboratory equipped with the latest scientific instruments for hands-on experiments and research.
                        </p>
                        <div class="flex items-center modern-text-muted">
                            <i class="fas fa-users mr-2 text-primary-600"></i>
                            <span>Capacity: 40 students</span>
                        </div>
                    </div>
                </div>

                <!-- Computer Laboratory -->
                <div class="modern-card hover-lift overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center">
                        <i class="fas fa-desktop text-6xl text-primary-300"></i>
                    </div>
                    <div class="modern-card-content">
                        <h3 class="modern-card-title mb-2">Computer Laboratory</h3>
                        <p class="modern-card-text mb-4">
                            Air-conditioned computer labs with high-speed internet and modern computers for digital learning.
                        </p>
                        <div class="flex items-center modern-text-muted">
                            <i class="fas fa-users mr-2 text-primary-600"></i>
                            <span>Capacity: 50 students</span>
                        </div>
                    </div>
                </div>

                <!-- Library -->
                <div class="modern-card hover-lift overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center">
                        <i class="fas fa-book text-6xl text-primary-300"></i>
                    </div>
                    <div class="modern-card-content">
                        <h3 class="modern-card-title mb-2">Library</h3>
                        <p class="modern-card-text mb-4">
                            Extensive collection of books, journals, and digital resources to support academic research and reading.
                        </p>
                        <div class="flex items-center modern-text-muted">
                            <i class="fas fa-users mr-2 text-primary-600"></i>
                            <span>Capacity: 100 students</span>
                        </div>
                    </div>
                </div>

                <!-- Gymnasium -->
                <div class="modern-card hover-lift overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center">
                        <i class="fas fa-dumbbell text-6xl text-primary-300"></i>
                    </div>
                    <div class="modern-card-content">
                        <h3 class="modern-card-title mb-2">Gymnasium</h3>
                        <p class="modern-card-text mb-4">
                            Multi-purpose gymnasium for sports, physical education, and school events.
                        </p>
                        <div class="flex items-center modern-text-muted">
                            <i class="fas fa-users mr-2 text-primary-600"></i>
                            <span>Capacity: 200 people</span>
                        </div>
                    </div>
                </div>

                <!-- Audio Visual Room -->
                <div class="modern-card hover-lift overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center">
                        <i class="fas fa-video text-6xl text-primary-300"></i>
                    </div>
                    <div class="modern-card-content">
                        <h3 class="modern-card-title mb-2">Audio Visual Room</h3>
                        <p class="modern-card-text mb-4">
                            Equipped with modern presentation technology for interactive learning and multimedia education.
                        </p>
                        <div class="flex items-center modern-text-muted">
                            <i class="fas fa-users mr-2 text-primary-600"></i>
                            <span>Capacity: 60 students</span>
                        </div>
                    </div>
                </div>

                <!-- Cafeteria -->
                <div class="modern-card hover-lift overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center">
                        <i class="fas fa-utensils text-6xl text-primary-300"></i>
                    </div>
                    <div class="modern-card-content">
                        <h3 class="modern-card-title mb-2">Cafeteria</h3>
                        <p class="modern-card-text mb-4">
                            Clean and spacious dining area serving nutritious meals and snacks for students and staff.
                        </p>
                        <div class="flex items-center modern-text-muted">
                            <i class="fas fa-users mr-2 text-primary-600"></i>
                            <span>Capacity: 150 people</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Interactive Campus Map -->
<x-campus-map />

<!-- Features Section -->
<section class="modern-section modern-section-white">
    <div class="modern-container">
        <div class="text-center mb-12">
            <h2 class="modern-heading-lg mb-4">
                Why Our Facilities Matter
            </h2>
            <p class="modern-text-lead max-w-3xl mx-auto">
                We invest in our facilities to provide the best possible learning environment for our students
            </p>
        </div>

        <div class="modern-grid modern-grid-3">
            <div class="modern-card hover-lift">
                <div class="modern-card-content text-center">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-3xl text-primary-600"></i>
                    </div>
                    <h3 class="modern-card-title mb-3">Safe & Secure</h3>
                    <p class="modern-card-text">
                        All facilities are maintained to the highest safety standards with 24/7 security monitoring.
                    </p>
                </div>
            </div>

            <div class="modern-card hover-lift">
                <div class="modern-card-content text-center">
                    <div class="w-16 h-16 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-lightbulb text-3xl text-secondary-600"></i>
                    </div>
                    <h3 class="modern-card-title mb-3">Modern Equipment</h3>
                    <p class="modern-card-text">
                        Equipped with the latest technology and learning tools to support 21st-century education.
                    </p>
                </div>
            </div>

            <div class="modern-card hover-lift">
                <div class="modern-card-content text-center">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-hand-holding-heart text-3xl text-primary-600"></i>
                    </div>
                    <h3 class="modern-card-title mb-3">Well-Maintained</h3>
                    <p class="modern-card-text">
                        Regular maintenance and upgrades ensure our facilities remain in excellent condition year-round.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="modern-section bg-gradient-to-r from-primary-600 to-primary-800 text-white">
    <div class="modern-container text-center">
        <h2 class="modern-heading-lg text-white mb-4">
            Experience Our Campus
        </h2>
        <p class="modern-text-lead text-primary-100 mb-8 max-w-2xl mx-auto">
            Schedule a campus tour and see our world-class facilities firsthand.
        </p>
        <a href="{{ route('contact') }}" class="btn-modern-accent bg-secondary-500 hover:bg-secondary-600">
            <i class="fas fa-calendar-alt mr-2"></i>Schedule a Tour
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
