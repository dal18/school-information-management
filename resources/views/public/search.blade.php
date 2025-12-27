@extends('layouts.public')

@section('title', 'Search Results: ' . $query)

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Search Results']
]" />

<!-- Search Results Hero -->
<section class="relative py-16 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl md:text-4xl font-display font-bold mb-4">
            Search Results
        </h1>
        <p class="text-xl text-gray-200 mb-6">
            Found <span class="font-bold text-secondary-300">{{ $totalResults }}</span> results for
            "<span class="font-semibold">{{ $query }}</span>"
        </p>

        <!-- Search Again Form -->
        <form action="{{ route('search') }}" method="GET" class="mt-6 max-w-2xl">
            <div class="relative">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input
                    type="text"
                    name="q"
                    value="{{ $query }}"
                    placeholder="Search again..."
                    class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-white text-primary-600 hover:bg-gray-100 px-6 py-2 rounded-lg font-semibold transition-colors duration-200">
                    Search
                </button>
            </div>
        </form>
    </div>
</section>

@if($totalResults > 0)
<!-- Results Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Results -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Blog Posts -->
                @if($posts->count() > 0)
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-newspaper text-primary-600 mr-3"></i>
                        Blog Posts ({{ $posts->count() }})
                    </h2>
                    <div class="space-y-4">
                        @foreach($posts as $post)
                        <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
                            <a href="{{ route('blog.show', $post->id) }}" class="block">
                                <h3 class="text-xl font-semibold text-gray-900 hover:text-primary-600 mb-2">
                                    {{ $post->title }}
                                </h3>
                                <p class="text-gray-600 mb-3 line-clamp-2">
                                    {{ Str::limit(strip_tags($post->content), 200) }}
                                </p>
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="far fa-calendar mr-2"></i>
                                    {{ $post->created_at->format('M d, Y') }}
                                    <i class="fas fa-arrow-right ml-auto text-primary-600"></i>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Announcements -->
                @if($announcements->count() > 0)
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-bullhorn text-secondary-600 mr-3"></i>
                        Announcements ({{ $announcements->count() }})
                    </h2>
                    <div class="space-y-4">
                        @foreach($announcements as $announcement)
                        <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-secondary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-bullhorn text-secondary-600"></i>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                        {{ $announcement->title }}
                                    </h3>
                                    <p class="text-gray-600 mb-2 line-clamp-2">
                                        {{ Str::limit(strip_tags($announcement->content), 150) }}
                                    </p>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="far fa-calendar mr-2"></i>
                                        {{ $announcement->created_at->format('M d, Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Stories -->
                @if($stories->count() > 0)
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-heart text-accent-600 mr-3"></i>
                        Student Stories ({{ $stories->count() }})
                    </h2>
                    <div class="space-y-4">
                        @foreach($stories as $story)
                        <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
                            <a href="{{ route('stories') }}" class="block">
                                <h3 class="text-xl font-semibold text-gray-900 hover:text-accent-600 mb-2">
                                    {{ $story->title }}
                                </h3>
                                <p class="text-sm text-gray-500 mb-2">
                                    by {{ $story->student_name }}
                                </p>
                                <p class="text-gray-600 line-clamp-2">
                                    {{ Str::limit(strip_tags($story->content), 150) }}
                                </p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Subjects/Courses -->
                @if($subjects->count() > 0)
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-book text-primary-600 mr-3"></i>
                        Courses ({{ $subjects->count() }})
                    </h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        @foreach($subjects as $subject)
                        <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-shadow duration-300">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                {{ $subject->subject_name }}
                            </h3>
                            @if($subject->description)
                            <p class="text-gray-600 text-sm line-clamp-2">
                                {{ $subject->description }}
                            </p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Facilities -->
                @if($facilities->count() > 0)
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-building text-secondary-600 mr-3"></i>
                        Facilities ({{ $facilities->count() }})
                    </h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        @foreach($facilities as $facility)
                        <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-shadow duration-300">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                {{ $facility->caption }}
                            </h3>
                            @if($facility->detail)
                            <p class="text-gray-600 text-sm line-clamp-2">
                                {{ $facility->detail }}
                            </p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-4 space-y-6">
                    <!-- Quick Links -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="font-bold text-gray-900 mb-4">Quick Links</h3>
                        <div class="space-y-2">
                            <a href="{{ route('admissions') }}" class="block text-primary-600 hover:text-primary-700 font-medium">
                                <i class="fas fa-graduation-cap mr-2"></i>Admissions
                            </a>
                            <a href="{{ route('courses') }}" class="block text-primary-600 hover:text-primary-700 font-medium">
                                <i class="fas fa-book mr-2"></i>Courses
                            </a>
                            <a href="{{ route('activities') }}" class="block text-primary-600 hover:text-primary-700 font-medium">
                                <i class="fas fa-running mr-2"></i>Activities
                            </a>
                            <a href="{{ route('contact') }}" class="block text-primary-600 hover:text-primary-700 font-medium">
                                <i class="fas fa-envelope mr-2"></i>Contact Us
                            </a>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="font-bold text-gray-900 mb-4">Results By Category</h3>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm">
                                <span class="flex items-center text-gray-700">
                                    <i class="fas fa-newspaper mr-2 text-primary-600"></i>
                                    Blog Posts
                                </span>
                                <span class="font-bold text-primary-600">{{ $posts->count() }}</span>
                            </div>
                            <div class="flex items-center justify-between px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm">
                                <span class="flex items-center text-gray-700">
                                    <i class="fas fa-bullhorn mr-2 text-secondary-600"></i>
                                    Announcements
                                </span>
                                <span class="font-bold text-secondary-600">{{ $announcements->count() }}</span>
                            </div>
                            <div class="flex items-center justify-between px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm">
                                <span class="flex items-center text-gray-700">
                                    <i class="fas fa-heart mr-2 text-accent-600"></i>
                                    Stories
                                </span>
                                <span class="font-bold text-accent-600">{{ $stories->count() }}</span>
                            </div>
                            <div class="flex items-center justify-between px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm">
                                <span class="flex items-center text-gray-700">
                                    <i class="fas fa-book mr-2 text-primary-600"></i>
                                    Courses
                                </span>
                                <span class="font-bold text-primary-600">{{ $subjects->count() }}</span>
                            </div>
                            <div class="flex items-center justify-between px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm">
                                <span class="flex items-center text-gray-700">
                                    <i class="fas fa-building mr-2 text-secondary-600"></i>
                                    Facilities
                                </span>
                                <span class="font-bold text-secondary-600">{{ $facilities->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@else
<!-- No Results -->
<section class="py-20 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <i class="fas fa-search text-gray-300 text-6xl mb-6"></i>
        <h2 class="text-3xl font-bold text-gray-900 mb-4">No Results Found</h2>
        <p class="text-xl text-gray-600 mb-8">
            We couldn't find any results for "<span class="font-semibold">{{ $query }}</span>"
        </p>

        <div class="bg-gray-50 rounded-lg p-6 text-left">
            <h3 class="font-bold text-gray-900 mb-3">Try these suggestions:</h3>
            <ul class="space-y-2 text-gray-700">
                <li class="flex items-start">
                    <i class="fas fa-check text-accent-600 mt-1 mr-3"></i>
                    <span>Check your spelling</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-accent-600 mt-1 mr-3"></i>
                    <span>Try more general keywords</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-accent-600 mt-1 mr-3"></i>
                    <span>Try different keywords</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check text-accent-600 mt-1 mr-3"></i>
                    <span>Browse our categories below</span>
                </li>
            </ul>
        </div>

        <div class="grid md:grid-cols-2 gap-4 mt-8">
            <a href="{{ route('courses') }}" class="p-6 border border-gray-200 rounded-lg hover:border-primary-300 hover:shadow-lg transition-all duration-200">
                <i class="fas fa-book text-primary-600 text-3xl mb-3"></i>
                <h4 class="font-bold text-gray-900 mb-2">Browse Courses</h4>
                <p class="text-gray-600 text-sm">Explore our academic programs</p>
            </a>
            <a href="{{ route('announcements') }}" class="p-6 border border-gray-200 rounded-lg hover:border-primary-300 hover:shadow-lg transition-all duration-200">
                <i class="fas fa-bullhorn text-secondary-600 text-3xl mb-3"></i>
                <h4 class="font-bold text-gray-900 mb-2">Latest Announcements</h4>
                <p class="text-gray-600 text-sm">Stay updated with school news</p>
            </a>
        </div>
    </div>
</section>
@endif

@endsection
