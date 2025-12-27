@extends('layouts.public')

@section('title', 'Announcements')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Campus Life', 'url' => '#'],
    ['label' => 'Announcements', 'icon' => 'fas fa-bullhorn']
]" />

<!-- Hero Section -->
<section class="relative py-16 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-display font-bold mb-4">
                Announcements
            </h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                Stay Updated with Latest News and Events
            </p>
        </div>
    </div>
</section>

<!-- Announcements List -->
<section class="modern-section modern-section-bg">
    <div class="modern-container">
        <!-- Search Form -->
        <div class="mb-8">
            <form action="{{ route('announcements') }}" method="GET" class="max-w-2xl mx-auto">
                <div class="relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search announcements..."
                        class="w-full pl-12 pr-24 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 shadow-sm">
                    <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg font-semibold transition-colors duration-200">
                        Search
                    </button>
                </div>
                @if(request('search'))
                <div class="mt-2 text-center">
                    <span class="text-sm text-gray-600">
                        Showing results for "<strong>{{ request('search') }}</strong>"
                    </span>
                    <a href="{{ route('announcements') }}" class="ml-3 text-sm text-primary-600 hover:text-primary-700 font-medium">
                        Clear search
                    </a>
                </div>
                @endif
            </form>
        </div>

        @if($announcements->count() > 0)
            <div class="space-y-6">
                @foreach($announcements as $announcement)
                <div class="modern-card hover-lift">
                    <div class="modern-card-content md:p-8">
                        <!-- Header -->
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                            <div class="flex items-center text-sm text-gray-500 mb-2 md:mb-0">
                                <i class="far fa-calendar mr-2"></i>
                                <span>{{ $announcement->created_at->format('F d, Y') }}</span>
                                <span class="mx-2">•</span>
                                <i class="far fa-clock mr-2"></i>
                                <span>{{ $announcement->created_at->format('g:i A') }}</span>
                            </div>
                            @if($announcement->author)
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="far fa-user mr-2"></i>
                                <span>Posted by {{ $announcement->author->name }}</span>
                            </div>
                            @endif
                        </div>

                        <!-- Title -->
                        <h2 class="modern-heading-md mb-4">
                            {{ $announcement->title }}
                        </h2>

                        <!-- Content -->
                        <div class="modern-text-lead">
                            {!! nl2br(e($announcement->content)) !!}
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="bg-gray-50 px-6 md:px-8 py-4 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">
                                <i class="far fa-bullhorn mr-2"></i>
                                Important Announcement
                            </span>
                            <button onclick="shareAnnouncement('{{ $announcement->title }}', '{{ url()->current() }}')"
                                class="text-primary-600 hover:text-primary-700 text-sm font-medium">
                                <i class="fas fa-share-alt mr-1"></i>
                                Share
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <x-pagination-info :paginator="$announcements" class="mt-8" />
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-{{ request('search') ? 'search' : 'bullhorn' }} text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">
                    {{ request('search') ? 'No Results Found' : 'No Announcements Yet' }}
                </h3>
                <p class="text-gray-600 max-w-md mx-auto mb-6">
                    @if(request('search'))
                        We couldn't find any announcements matching "{{ request('search') }}". Try different keywords or clear your search.
                    @else
                        There are currently no announcements to display. Please check back later for updates.
                    @endif
                </p>
                @if(request('search'))
                    <a href="{{ route('announcements') }}" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                        <i class="fas fa-times mr-2"></i>Clear Search
                    </a>
                @else
                    <a href="{{ route('home') }}" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                        Return to Home
                    </a>
                @endif
            </div>
        @endif
    </div>
</section>

<!-- Subscribe Section -->
<section class="modern-section modern-section-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 rounded-xl shadow-modern-lg p-8 md:p-12 text-center text-white">
            <h2 class="modern-heading-lg text-white mb-4">Stay Informed</h2>
            <p class="modern-text-lead text-white/90 mb-8 max-w-2xl mx-auto">
                Want to receive announcements directly to your inbox? Contact our office to subscribe to our newsletter.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('contact') }}" class="btn-modern-secondary bg-white text-primary-600 border-white hover:bg-gray-100">
                    <i class="fas fa-envelope mr-2"></i>
                    Contact Us
                </a>
                <a href="{{ route('home') }}" class="btn-modern-accent">
                    <i class="fas fa-home mr-2"></i>
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
function shareAnnouncement(title, url) {
    if (navigator.share) {
        navigator.share({
            title: title,
            url: url
        }).catch((error) => console.log('Error sharing', error));
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(url).then(() => {
            alert('Link copied to clipboard!');
        });
    }
}
</script>
@endpush
