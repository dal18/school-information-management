@extends('layouts.public')

@section('title', 'Activities & Events')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Campus Life', 'url' => '#'],
    ['label' => 'Activities & Events', 'icon' => 'fas fa-running']
]" />

<!-- Hero Section -->
<section class="relative py-20 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 overflow-hidden">
    <div class="absolute inset-0 pattern-dots opacity-30"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center text-white animate-fade-in-up max-w-3xl mx-auto">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm font-semibold tracking-wide mb-4">
                <i class="fas fa-calendar-star mr-2"></i>Campus Life
            </span>
            <h1 class="text-5xl md:text-6xl font-bold font-display mb-4">Activities & Events</h1>
            <p class="text-xl text-gray-200 leading-relaxed">
                Enriching student life through diverse activities, events, and programs beyond the classroom
            </p>
        </div>
    </div>
</section>

<!-- Search & Filter Section -->
<section class="modern-section modern-section-bg">
    <div class="modern-container">
        <div class="bg-white rounded-xl shadow-modern p-6 mb-8">
            <form method="GET" action="{{ route('activities') }}" class="space-y-4">
                <div class="grid md:grid-cols-3 gap-4">
                    <!-- Search Input -->
                    <div class="md:col-span-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-search mr-2"></i>Search
                        </label>
                        <input type="text"
                               id="search"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search activities, descriptions, or locations..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>

                    <!-- Date From -->
                    <div class="md:col-span-1">
                        <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar mr-2"></i>From Date
                        </label>
                        <input type="date"
                               id="date_from"
                               name="date_from"
                               value="{{ request('date_from') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>

                    <!-- Date To -->
                    <div class="md:col-span-1">
                        <label for="date_to" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar mr-2"></i>To Date
                        </label>
                        <input type="date"
                               id="date_to"
                               name="date_to"
                               value="{{ request('date_to') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3">
                    <button type="submit" class="btn-modern-primary">
                        <i class="fas fa-search mr-2"></i>Search Activities
                    </button>
                    @if(request()->hasAny(['search', 'date_from', 'date_to']))
                        <a href="{{ route('activities') }}" class="btn-modern-secondary">
                            <i class="fas fa-times mr-2"></i>Clear Filters
                        </a>
                    @endif
                </div>
            </form>
        </div>

        @if($activities->count() > 0)
            @php
                // Group activities by post_type
                $regularPosts = $activities->where('post_type', 'regular');
                $youtubePosts = $activities->where('post_type', 'youtube');
                $facebookPosts = $activities->where('post_type', 'facebook');
            @endphp

            {{-- REGULAR POSTS SECTION --}}
            @if($regularPosts->count() > 0)
            <div class="mb-12">
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-1 w-12 bg-gray-600 rounded"></div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        <i class="fas fa-image text-gray-600 mr-2"></i> Photo Posts
                    </h2>
                    <div class="h-1 flex-1 bg-gray-200 rounded"></div>
                </div>
                <div class="modern-grid modern-grid-3">
                    @foreach($regularPosts as $activity)
                    <div class="modern-card hover-lift overflow-hidden">
                        @if($activity->link_image)
                            <div class="h-64 bg-gradient-to-br from-primary-100 to-primary-50 overflow-hidden cursor-pointer group relative"
                                 onclick="openImageModal('{{ asset('storage/' . $activity->link_image) }}', '{{ $activity->activity_name }}')">
                                <x-responsive-image
                                    :src="$activity->link_image"
                                    :alt="$activity->activity_name"
                                    class="w-full h-full object-cover hover:scale-110 transition duration-500"
                                    :lazy="true" />
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                    <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                                </div>
                            </div>
                        @else
                            <div class="h-64 bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center">
                                <i class="fas fa-calendar-check text-6xl text-primary-300"></i>
                            </div>
                        @endif

                        <div class="modern-card-content">
                            <div class="flex items-center modern-text-muted mb-2">
                                <i class="far fa-calendar mr-2"></i>
                                {{ \Carbon\Carbon::parse($activity->activity_date)->format('F d, Y') }}
                            </div>
                            <h3 class="modern-card-title mb-2">{{ $activity->activity_name }}</h3>
                            <p class="modern-card-text mb-4 line-clamp-3">{{ $activity->description }}</p>

                            @if($activity->location)
                            <div class="flex items-center modern-text-muted">
                                <i class="fas fa-map-marker-alt mr-2 text-primary-600"></i>
                                <span>{{ $activity->location }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- YOUTUBE POSTS SECTION --}}
            @if($youtubePosts->count() > 0)
            <div class="mb-12">
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-1 w-12 bg-red-600 rounded"></div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        <i class="fab fa-youtube text-red-600 mr-2"></i> Video Posts
                    </h2>
                    <div class="h-1 flex-1 bg-gray-200 rounded"></div>
                </div>
                <div class="space-y-6">
                    @foreach($youtubePosts as $activity)
                    @if($activity->getYoutubeEmbedUrl())
                    <div class="modern-card hover-lift overflow-hidden border-l-4 border-red-600">
                        <div class="modern-card-content">
                            <div class="flex items-center justify-between modern-text-muted mb-3">
                                <div class="flex items-center">
                                    <i class="far fa-calendar mr-2"></i>
                                    {{ \Carbon\Carbon::parse($activity->activity_date)->format('F d, Y') }}
                                </div>
                            </div>
                            <h3 class="modern-card-title mb-4 text-2xl">{{ $activity->activity_name }}</h3>

                            <div class="rounded-lg overflow-hidden bg-black">
                                <iframe
                                    src="{{ $activity->getYoutubeEmbedUrl() }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                    class="w-full aspect-video"></iframe>
                            </div>

                            @if($activity->description)
                            <p class="modern-card-text mt-4">{{ $activity->description }}</p>
                            @endif

                            @if($activity->location)
                            <div class="flex items-center modern-text-muted mt-4">
                                <i class="fas fa-map-marker-alt mr-2 text-primary-600"></i>
                                <span>{{ $activity->location }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif

            {{-- FACEBOOK POSTS SECTION --}}
            @if($facebookPosts->count() > 0)
            <div class="mb-12">
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-1 w-12 bg-blue-600 rounded"></div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        <i class="fab fa-facebook text-blue-600 mr-2"></i> Facebook Posts
                    </h2>
                    <div class="h-1 flex-1 bg-gray-200 rounded"></div>
                </div>
                <div class="modern-grid modern-grid-3">
                    @foreach($facebookPosts as $activity)
                    @if($activity->getFacebookEmbedUrl())
                    <div class="modern-card hover-lift overflow-hidden border-l-4 border-blue-600">
                        <div class="bg-gray-50 p-4">
                            <div class="rounded-lg overflow-hidden bg-white">
                                <iframe
                                    src="{{ $activity->getFacebookEmbedUrl() }}"
                                    width="100%"
                                    height="600"
                                    style="border:none;overflow:hidden"
                                    scrolling="no"
                                    frameborder="0"
                                    allowfullscreen="true"
                                    allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                            </div>
                        </div>

                        <div class="modern-card-content">
                            <div class="flex items-center modern-text-muted mb-2">
                                <i class="far fa-calendar mr-2"></i>
                                {{ \Carbon\Carbon::parse($activity->activity_date)->format('F d, Y') }}
                            </div>
                            <h3 class="modern-card-title mb-2">{{ $activity->activity_name }}</h3>

                            @if($activity->description)
                            <p class="modern-card-text mb-4 line-clamp-3">{{ $activity->description }}</p>
                            @endif

                            @if($activity->location)
                            <div class="flex items-center modern-text-muted">
                                <i class="fas fa-map-marker-alt mr-2 text-primary-600"></i>
                                <span>{{ $activity->location }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Pagination -->
            <x-pagination-info :paginator="$activities" class="mt-8" />
        @else
            <!-- Default activities when database is empty -->
            <div class="modern-grid modern-grid-3">
                <!-- Sports Fest -->
                <div class="modern-card hover-lift overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center">
                        <i class="fas fa-trophy text-6xl text-primary-300"></i>
                    </div>
                    <div class="modern-card-content">
                        <div class="flex items-center modern-text-muted mb-2">
                            <i class="far fa-calendar mr-2"></i>
                            Annual Event
                        </div>
                        <h3 class="modern-card-title mb-2">Sports Fest</h3>
                        <p class="modern-card-text mb-4">
                            Annual sports festival featuring various athletic competitions and team-building activities.
                        </p>
                        <div class="flex items-center modern-text-muted">
                            <i class="fas fa-map-marker-alt mr-2 text-primary-600"></i>
                            <span>School Gymnasium</span>
                        </div>
                    </div>
                </div>

                <!-- Foundation Day -->
                <div class="modern-card hover-lift overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-secondary-100 to-secondary-50 flex items-center justify-center">
                        <i class="fas fa-birthday-cake text-6xl text-secondary-300"></i>
                    </div>
                    <div class="modern-card-content">
                        <div class="flex items-center modern-text-muted mb-2">
                            <i class="far fa-calendar mr-2"></i>
                            Annual Celebration
                        </div>
                        <h3 class="modern-card-title mb-2">Foundation Day</h3>
                        <p class="modern-card-text mb-4">
                            Celebrating the school's founding with cultural performances, exhibits, and alumni gatherings.
                        </p>
                        <div class="flex items-center modern-text-muted">
                            <i class="fas fa-map-marker-alt mr-2 text-primary-600"></i>
                            <span>School Campus</span>
                        </div>
                    </div>
                </div>

                <!-- Science Fair -->
                <div class="modern-card hover-lift overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-green-100 to-green-50 flex items-center justify-center">
                        <i class="fas fa-flask text-6xl text-green-300"></i>
                    </div>
                    <div class="modern-card-content">
                        <div class="flex items-center modern-text-muted mb-2">
                            <i class="far fa-calendar mr-2"></i>
                            Yearly Competition
                        </div>
                        <h3 class="modern-card-title mb-2">Science Fair</h3>
                        <p class="modern-card-text mb-4">
                            Student-led science projects and experiments showcasing innovation and scientific inquiry.
                        </p>
                        <div class="flex items-center modern-text-muted">
                            <i class="fas fa-map-marker-alt mr-2 text-primary-600"></i>
                            <span>Science Laboratory</span>
                        </div>
                    </div>
                </div>

                <!-- Cultural Show -->
                <div class="modern-card hover-lift overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center">
                        <i class="fas fa-masks-theater text-6xl text-purple-300"></i>
                    </div>
                    <div class="modern-card-content">
                        <div class="flex items-center modern-text-muted mb-2">
                            <i class="far fa-calendar mr-2"></i>
                            Quarterly Event
                        </div>
                        <h3 class="modern-card-title mb-2">Cultural Show</h3>
                        <p class="modern-card-text mb-4">
                            Showcasing Filipino culture through traditional dances, music, and theatrical performances.
                        </p>
                        <div class="flex items-center modern-text-muted">
                            <i class="fas fa-map-marker-alt mr-2 text-primary-600"></i>
                            <span>School Auditorium</span>
                        </div>
                    </div>
                </div>

                <!-- Community Service -->
                <div class="modern-card hover-lift overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center">
                        <i class="fas fa-hands-helping text-6xl text-red-300"></i>
                    </div>
                    <div class="modern-card-content">
                        <div class="flex items-center modern-text-muted mb-2">
                            <i class="far fa-calendar mr-2"></i>
                            Monthly Activity
                        </div>
                        <h3 class="modern-card-title mb-2">Community Service</h3>
                        <p class="modern-card-text mb-4">
                            Regular outreach programs engaging students in community development and service learning.
                        </p>
                        <div class="flex items-center modern-text-muted">
                            <i class="fas fa-map-marker-alt mr-2 text-primary-600"></i>
                            <span>Various Locations</span>
                        </div>
                    </div>
                </div>

                <!-- Academic Quiz Bee -->
                <div class="modern-card hover-lift overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center">
                        <i class="fas fa-brain text-6xl text-blue-300"></i>
                    </div>
                    <div class="modern-card-content">
                        <div class="flex items-center modern-text-muted mb-2">
                            <i class="far fa-calendar mr-2"></i>
                            Semestral Competition
                        </div>
                        <h3 class="modern-card-title mb-2">Academic Quiz Bee</h3>
                        <p class="modern-card-text mb-4">
                            Inter-class academic competitions testing knowledge across various subject areas.
                        </p>
                        <div class="flex items-center modern-text-muted">
                            <i class="fas fa-map-marker-alt mr-2 text-primary-600"></i>
                            <span>School Auditorium</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Activity Types Section -->
<section class="modern-section modern-section-white">
    <div class="modern-container">
        <div class="text-center mb-12">
            <h2 class="modern-heading-lg mb-4">
                Types of Activities
            </h2>
            <p class="modern-text-lead max-w-3xl mx-auto">
                We offer a wide range of activities to support holistic student development
            </p>
        </div>

        <div class="modern-grid modern-grid-4">
            <div class="modern-card hover-lift">
                <div class="modern-card-content text-center">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-running text-3xl text-primary-600"></i>
                    </div>
                    <h3 class="modern-card-title mb-2">Sports & Athletics</h3>
                    <p class="modern-card-text">
                        Basketball, volleyball, track and field, and other sports programs
                    </p>
                </div>
            </div>

            <div class="modern-card hover-lift">
                <div class="modern-card-content text-center">
                    <div class="w-16 h-16 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-music text-3xl text-secondary-600"></i>
                    </div>
                    <h3 class="modern-card-title mb-2">Arts & Culture</h3>
                    <p class="modern-card-text">
                        Music, dance, theater, and visual arts programs
                    </p>
                </div>
            </div>

            <div class="modern-card hover-lift">
                <div class="modern-card-content text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-book-reader text-3xl text-green-600"></i>
                    </div>
                    <h3 class="modern-card-title mb-2">Academic Clubs</h3>
                    <p class="modern-card-text">
                        Science club, math club, debate team, and other academic organizations
                    </p>
                </div>
            </div>

            <div class="modern-card hover-lift">
                <div class="modern-card-content text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="modern-card-title mb-2">Social Activities</h3>
                    <p class="modern-card-text">
                        Student council, clubs, and community service programs
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
            Be Part of Our Community
        </h2>
        <p class="modern-text-lead text-primary-100 mb-8 max-w-2xl mx-auto">
            Join LFHS and participate in our vibrant campus life filled with exciting activities and events.
        </p>
        <a href="{{ route('admissions') }}" class="btn-modern-accent bg-secondary-500 hover:bg-secondary-600">
            <i class="fas fa-file-alt mr-2"></i>Apply Now
        </a>
    </div>
</section>

<style>
    .pattern-dots {
        background-image: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 20px 20px;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
