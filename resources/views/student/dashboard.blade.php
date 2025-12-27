@extends('layouts.admin')

@section('title', 'Student Dashboard')

@section('header')
<div class="mb-6 sm:mb-8 fade-in-down">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex-1">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">
                Welcome Back! <span class="wave inline-block">👋</span>
            </h1>
            <p class="text-dark-600 mt-2 text-sm sm:text-base md:text-lg">Here's what's happening with your account today.</p>
        </div>
        <div class="flex items-center">
            <div class="modern-card bg-white rounded-xl shadow-soft px-4 sm:px-5 py-2 sm:py-3 border border-dark-200">
                <div class="text-xs sm:text-sm text-dark-600 flex items-center">
                    <i class="fas fa-clock mr-2 text-primary-600"></i>
                    <span id="current-time" class="font-semibold text-dark-900"></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Student Profile Card -->
<div class="modern-card bg-gradient-to-r from-primary-600 via-primary-700 to-secondary-600 rounded-xl sm:rounded-2xl shadow-strong p-4 sm:p-6 md:p-8 mb-6 sm:mb-8 text-white hover-lift relative overflow-hidden fade-in-up">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10 bg-pattern-dots"></div>

    <div class="relative z-10 flex flex-col md:flex-row items-center md:items-start justify-between gap-4 sm:gap-6">
        <div class="flex flex-col md:flex-row items-center md:items-start space-y-3 sm:space-y-4 md:space-y-0 md:space-x-6 w-full md:w-auto">
            <div class="relative flex-shrink-0">
                @if($user->profile_image)
                    <img src="{{ asset('storage/' . $user->profile_image) }}"
                         alt="{{ $user->first_name }}"
                         class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 rounded-full object-cover border-4 border-white/30 shadow-2xl">
                @else
                    <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center border-4 border-white/30 shadow-2xl">
                        <span class="text-2xl sm:text-3xl md:text-4xl font-bold">
                            {{ strtoupper(substr($user->first_name, 0, 1))}}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                        </span>
                    </div>
                @endif
                <div class="absolute -bottom-1 -right-1 sm:-bottom-2 sm:-right-2 w-6 h-6 sm:w-8 sm:h-8 bg-success-500 rounded-full border-2 sm:border-4 border-white shadow-lg flex items-center justify-center">
                    <i class="fas fa-check text-white text-xs"></i>
                </div>
            </div>
            <div class="text-center md:text-left flex-1">
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold mb-2">{{ $user->first_name }} {{ $user->last_name }}</h2>
                <div class="space-y-1 text-primary-100 text-xs sm:text-sm">
                    <p class="flex items-center justify-center md:justify-start">
                        <i class="fas fa-id-badge mr-2"></i>
                        Student ID: #{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}
                    </p>
                    <p class="flex items-center justify-center md:justify-start break-all">
                        <i class="fas fa-envelope mr-2 flex-shrink-0"></i>
                        <span class="truncate">{{ $user->email }}</span>
                    </p>
                    @if($user->phone_number)
                    <p class="flex items-center justify-center md:justify-start">
                        <i class="fas fa-phone mr-2"></i>
                        {{ $user->phone_number }}
                    </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="flex flex-col space-y-3 w-full md:w-auto">
            <a href="{{ route('profile.edit') }}" class="btn-modern-outline border-white text-white hover:bg-white hover:text-primary-600 text-sm sm:text-base px-4 sm:px-6 py-2 sm:py-3 text-center active:scale-95">
                <i class="fas fa-user-edit mr-2"></i>Edit Profile
            </a>
        </div>
    </div>
</div>

<!-- Statistics Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
    <!-- Today's Classes -->
    <div class="modern-card hover-lift bg-white rounded-xl sm:rounded-2xl shadow-soft p-4 sm:p-6 border border-dark-200 group active:scale-95 transition-all">
        <div class="flex items-start justify-between mb-3 sm:mb-4">
            <div class="flex-1">
                <p class="text-xs sm:text-sm font-semibold text-dark-500 uppercase tracking-wide mb-1 sm:mb-2">Today's Classes</p>
                <p class="text-3xl sm:text-4xl font-bold text-dark-900" data-counter="{{ $stats['today_classes'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg sm:rounded-xl p-3 sm:p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-chalkboard-teacher text-white text-xl sm:text-2xl"></i>
            </div>
        </div>
        <div class="flex items-center text-xs sm:text-sm text-primary-600 font-medium">
            <i class="fas fa-calendar-day mr-2"></i>
            <span>{{ now()->format('l') }}</span>
        </div>
    </div>

    <!-- Available Courses -->
    <div class="modern-card hover-lift bg-white rounded-xl sm:rounded-2xl shadow-soft p-4 sm:p-6 border border-dark-200 group active:scale-95 transition-all">
        <div class="flex items-start justify-between mb-3 sm:mb-4">
            <div class="flex-1">
                <p class="text-xs sm:text-sm font-semibold text-dark-500 uppercase tracking-wide mb-1 sm:mb-2">Available Courses</p>
                <p class="text-3xl sm:text-4xl font-bold text-dark-900" data-counter="{{ $stats['total_courses'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-secondary-500 to-secondary-600 rounded-lg sm:rounded-xl p-3 sm:p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-book text-white text-xl sm:text-2xl"></i>
            </div>
        </div>
        <div class="flex items-center text-xs sm:text-sm text-secondary-600 font-medium">
            <i class="fas fa-graduation-cap mr-2"></i>
            <span>All Grade Levels</span>
        </div>
    </div>

    <!-- Announcements -->
    <div class="modern-card hover-lift bg-white rounded-xl sm:rounded-2xl shadow-soft p-4 sm:p-6 border border-dark-200 group active:scale-95 transition-all">
        <div class="flex items-start justify-between mb-3 sm:mb-4">
            <div class="flex-1">
                <p class="text-xs sm:text-sm font-semibold text-dark-500 uppercase tracking-wide mb-1 sm:mb-2">Announcements</p>
                <p class="text-3xl sm:text-4xl font-bold text-dark-900" data-counter="{{ $stats['total_announcements'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-success-500 to-success-600 rounded-lg sm:rounded-xl p-3 sm:p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-bullhorn text-white text-xl sm:text-2xl"></i>
            </div>
        </div>
        <div class="flex items-center text-xs sm:text-sm text-success-600 font-medium">
            <i class="fas fa-bell mr-2"></i>
            <span>Stay Updated</span>
        </div>
    </div>

    <!-- Blog Posts -->
    <div class="modern-card hover-lift bg-white rounded-xl sm:rounded-2xl shadow-soft p-4 sm:p-6 border border-dark-200 group active:scale-95 transition-all">
        <div class="flex items-start justify-between mb-3 sm:mb-4">
            <div class="flex-1">
                <p class="text-xs sm:text-sm font-semibold text-dark-500 uppercase tracking-wide mb-1 sm:mb-2">Blog Posts</p>
                <p class="text-3xl sm:text-4xl font-bold text-dark-900" data-counter="{{ $stats['total_posts'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-accent-500 to-accent-600 rounded-lg sm:rounded-xl p-3 sm:p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-blog text-white text-xl sm:text-2xl"></i>
            </div>
        </div>
        <div class="flex items-center text-xs sm:text-sm text-accent-600 font-medium">
            <i class="fas fa-newspaper mr-2"></i>
            <span>Latest Updates</span>
        </div>
    </div>
</div>

<!-- Quick Actions & Stats Row -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Activities -->
    <div class="modern-card hover-lift bg-white rounded-2xl shadow-soft p-6 border border-dark-200 group">
        <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
                <p class="text-sm font-semibold text-dark-500 uppercase tracking-wide mb-2">Activities</p>
                <p class="text-4xl font-bold text-dark-900" data-counter="{{ $stats['total_activities'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-warning-500 to-warning-600 rounded-xl p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-calendar-alt text-white text-2xl"></i>
            </div>
        </div>
        <div class="flex items-center text-sm text-warning-600 font-medium">
            <i class="fas fa-sparkles mr-2"></i>
            <span>Upcoming Events</span>
        </div>
    </div>

    <!-- Facilities -->
    <div class="modern-card hover-lift bg-white rounded-2xl shadow-soft p-6 border border-dark-200 group">
        <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
                <p class="text-sm font-semibold text-dark-500 uppercase tracking-wide mb-2">Facilities</p>
                <p class="text-4xl font-bold text-dark-900" data-counter="{{ $stats['total_facilities'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-primary-500 to-secondary-500 rounded-xl p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-building text-white text-2xl"></i>
            </div>
        </div>
        <div class="flex items-center text-sm text-primary-600 font-medium">
            <i class="fas fa-map-marked-alt mr-2"></i>
            <span>Campus Tour</span>
        </div>
    </div>

    <!-- Success Stories -->
    <div class="modern-card hover-lift bg-white rounded-2xl shadow-soft p-6 border border-dark-200 group">
        <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
                <p class="text-sm font-semibold text-dark-500 uppercase tracking-wide mb-2">Stories</p>
                <p class="text-4xl font-bold text-dark-900" data-counter="{{ $stats['total_stories'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-accent-500 to-danger-500 rounded-xl p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-star text-white text-2xl"></i>
            </div>
        </div>
        <div class="flex items-center text-sm text-accent-600 font-medium">
            <i class="fas fa-trophy mr-2"></i>
            <span>Student Achievements</span>
        </div>
    </div>

    <!-- My Testimonials -->
    <div class="modern-card hover-lift bg-white rounded-2xl shadow-soft p-6 border border-dark-200 group">
        <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
                <p class="text-sm font-semibold text-dark-500 uppercase tracking-wide mb-2">My Testimonials</p>
                <p class="text-4xl font-bold text-dark-900" data-counter="{{ $stats['my_testimonials'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-secondary-500 to-primary-600 rounded-xl p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-quote-left text-white text-2xl"></i>
            </div>
        </div>
        <div class="flex items-center justify-between text-sm">
            <span class="text-warning-600 font-medium">
                <i class="fas fa-clock mr-1"></i>{{ $stats['pending_testimonials'] }} Pending
            </span>
            <a href="{{ route('testimonials.create') }}" class="text-primary-600 hover:text-primary-700 font-semibold">
                + Add
            </a>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <!-- Today's Schedule (Spans 2 columns) -->
    <div class="lg:col-span-2 modern-card bg-white rounded-2xl shadow-soft border border-dark-200">
        <div class="p-6 border-b border-dark-200 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-t-2xl">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-clock mr-3"></i>
                    Today's Schedule
                </h3>
                <a href="{{ route('schedules') }}" class="btn-modern-outline border-white text-white hover:bg-white hover:text-primary-600 text-sm py-2 px-4">
                    Full Week <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <p class="text-primary-100 mt-1 text-sm">{{ now()->format('l, F d, Y') }}</p>
        </div>
        <div class="p-6">
            @if($todaySchedule->count() > 0)
                <div class="space-y-4">
                    @foreach($todaySchedule as $schedule)
                    <div class="modern-card hover-lift border-l-4 border-primary-500 bg-gradient-to-r from-primary-50 to-white p-5 rounded-r-xl">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4 flex-1">
                                <div class="bg-primary-100 rounded-xl p-3 flex-shrink-0">
                                    <i class="fas fa-book text-primary-600 text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-dark-900 text-lg mb-1">
                                        {{ $schedule->subject ? $schedule->subject->subject_name : 'N/A' }}
                                    </h4>
                                    <p class="text-sm text-dark-600 mb-2">
                                        <i class="fas fa-user-tie mr-2"></i>
                                        {{ $schedule->teacher ? $schedule->teacher->first_name . ' ' . $schedule->teacher->last_name : 'TBA' }}
                                    </p>
                                    <div class="flex flex-wrap gap-3 text-sm">
                                        <span class="text-primary-700 font-semibold">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ date('g:i A', strtotime($schedule->start_time)) }} - {{ date('g:i A', strtotime($schedule->end_time)) }}
                                        </span>
                                        @if($schedule->room)
                                        <span class="text-dark-600">
                                            <i class="fas fa-door-open mr-1"></i>
                                            Room: {{ $schedule->room }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-dark-100 text-dark-400 mb-4">
                        <i class="fas fa-calendar-times text-4xl"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-dark-900 mb-2">No Classes Today</h4>
                    <p class="text-dark-600">Enjoy your day off!</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Links -->
    <div class="modern-card bg-white rounded-2xl shadow-soft border border-dark-200">
        <div class="p-6 border-b border-dark-200">
            <h3 class="text-xl font-bold text-dark-900 flex items-center">
                <i class="fas fa-link mr-3 text-primary-600"></i>
                Quick Links
            </h3>
        </div>
        <div class="p-6">
            <div class="space-y-3">
                <a href="{{ route('schedules') }}" class="modern-feature flex items-center p-4 bg-dark-50 rounded-xl hover:bg-primary-50 hover:border-primary-200 border border-transparent transition-all group">
                    <div class="modern-feature-icon bg-gradient-to-br from-primary-500 to-primary-600">
                        <i class="fas fa-calendar-week"></i>
                    </div>
                    <span class="ml-4 text-dark-900 font-semibold group-hover:text-primary-600">Class Schedule</span>
                    <i class="fas fa-chevron-right ml-auto text-dark-400 group-hover:text-primary-600"></i>
                </a>
                <a href="{{ route('courses') }}" class="modern-feature flex items-center p-4 bg-dark-50 rounded-xl hover:bg-secondary-50 hover:border-secondary-200 border border-transparent transition-all group">
                    <div class="modern-feature-icon bg-gradient-to-br from-secondary-500 to-secondary-600 secondary">
                        <i class="fas fa-book"></i>
                    </div>
                    <span class="ml-4 text-dark-900 font-semibold group-hover:text-secondary-600">View Courses</span>
                    <i class="fas fa-chevron-right ml-auto text-dark-400 group-hover:text-secondary-600"></i>
                </a>
                <a href="{{ route('announcements') }}" class="modern-feature flex items-center p-4 bg-dark-50 rounded-xl hover:bg-success-50 hover:border-success-200 border border-transparent transition-all group">
                    <div class="modern-feature-icon bg-gradient-to-br from-success-500 to-success-600">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <span class="ml-4 text-dark-900 font-semibold group-hover:text-success-600">Announcements</span>
                    <i class="fas fa-chevron-right ml-auto text-dark-400 group-hover:text-success-600"></i>
                </a>
                <a href="{{ route('blog') }}" class="modern-feature flex items-center p-4 bg-dark-50 rounded-xl hover:bg-accent-50 hover:border-accent-200 border border-transparent transition-all group">
                    <div class="modern-feature-icon bg-gradient-to-br from-accent-500 to-accent-600 accent">
                        <i class="fas fa-blog"></i>
                    </div>
                    <span class="ml-4 text-dark-900 font-semibold group-hover:text-accent-600">Read Blog</span>
                    <i class="fas fa-chevron-right ml-auto text-dark-400 group-hover:text-accent-600"></i>
                </a>
                <a href="{{ route('activities') }}" class="modern-feature flex items-center p-4 bg-dark-50 rounded-xl hover:bg-warning-50 hover:border-warning-200 border border-transparent transition-all group">
                    <div class="modern-feature-icon bg-gradient-to-br from-warning-500 to-warning-600">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <span class="ml-4 text-dark-900 font-semibold group-hover:text-warning-600">Activities</span>
                    <i class="fas fa-chevron-right ml-auto text-dark-400 group-hover:text-warning-600"></i>
                </a>
                <a href="{{ route('feedback') }}" class="modern-feature flex items-center p-4 bg-dark-50 rounded-xl hover:bg-primary-50 hover:border-primary-200 border border-transparent transition-all group">
                    <div class="modern-feature-icon bg-gradient-to-br from-primary-500 to-secondary-600">
                        <i class="fas fa-comments"></i>
                    </div>
                    <span class="ml-4 text-dark-900 font-semibold group-hover:text-primary-600">Send Feedback</span>
                    <i class="fas fa-chevron-right ml-auto text-dark-400 group-hover:text-primary-600"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Latest Announcements & Recent Blog Posts -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Latest Announcements -->
    <div class="modern-card bg-white rounded-2xl shadow-soft border border-dark-200">
        <div class="p-6 border-b border-dark-200">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-dark-900 flex items-center">
                    <i class="fas fa-bullhorn mr-3 text-success-600"></i>
                    Latest Announcements
                </h3>
                <a href="{{ route('announcements') }}" class="text-sm text-primary-600 hover:text-primary-700 font-semibold">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        <div class="p-6">
            @if($announcements->count() > 0)
                <div class="space-y-4">
                    @foreach($announcements->take(3) as $announcement)
                    <div class="border-l-4 border-success-500 bg-gradient-to-r from-success-50 to-white pl-5 pr-4 py-4 rounded-r-xl hover:shadow-md transition-all">
                        <h4 class="font-bold text-dark-900 mb-2">{{ $announcement->title }}</h4>
                        <p class="text-sm text-dark-600 mb-3 line-clamp-2">
                            {{ Str::limit(strip_tags($announcement->content), 120) }}
                        </p>
                        <div class="flex items-center text-xs text-dark-500">
                            <i class="fas fa-calendar mr-1"></i>
                            {{ $announcement->created_at ? $announcement->created_at->format('M d, Y') : 'N/A' }}
                            @if($announcement->author)
                                <span class="mx-2">•</span>
                                <i class="fas fa-user mr-1"></i>
                                {{ $announcement->author->first_name }} {{ $announcement->author->last_name }}
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-dark-100 text-dark-400 mb-4">
                        <i class="fas fa-bullhorn text-3xl"></i>
                    </div>
                    <p class="text-dark-600">No announcements yet</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Latest Blog Posts -->
    <div class="modern-card bg-white rounded-2xl shadow-soft border border-dark-200">
        <div class="p-6 border-b border-dark-200">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-dark-900 flex items-center">
                    <i class="fas fa-blog mr-3 text-accent-600"></i>
                    Latest Blog Posts
                </h3>
                <a href="{{ route('blog') }}" class="text-sm text-primary-600 hover:text-primary-700 font-semibold">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        <div class="p-6">
            @if($posts->count() > 0)
                <div class="space-y-4">
                    @foreach($posts->take(3) as $post)
                    <div class="flex items-start space-x-4 p-4 bg-dark-50 rounded-xl hover:shadow-md hover:bg-accent-50 transition-all">
                        @if($post->image_path)
                        <img src="{{ Storage::disk('public')->url($post->image_path) }}"
                             alt="{{ $post->title }}"
                             class="w-20 h-20 rounded-xl object-cover flex-shrink-0">
                        @else
                        <div class="w-20 h-20 bg-accent-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-blog text-accent-600 text-2xl"></i>
                        </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-dark-900 line-clamp-1 mb-1">{{ $post->title }}</h4>
                            <p class="text-sm text-dark-600 line-clamp-2 mb-2">
                                {{ Str::limit(strip_tags($post->content), 80) }}
                            </p>
                            <div class="flex items-center text-xs text-dark-500">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ $post->created_at ? $post->created_at->format('M d, Y') : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-dark-100 text-dark-400 mb-4">
                        <i class="fas fa-blog text-3xl"></i>
                    </div>
                    <p class="text-dark-600">No blog posts yet</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Live Clock
function updateClock() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
    const dateString = now.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    const clockElement = document.getElementById('current-time');
    if (clockElement) {
        clockElement.textContent = `${timeString} • ${dateString}`;
    }
}

updateClock();
setInterval(updateClock, 1000);

// Counter Animation
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('[data-counter]');

    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-counter'));
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;

        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    updateCounter();
                    observer.unobserve(entry.target);
                }
            });
        });

        observer.observe(counter);
    });
});
</script>

<style>
/* Waving Hand Animation */
.wave {
    animation: wave 2.5s ease-in-out infinite;
    transform-origin: 70% 70%;
    display: inline-block;
}

@keyframes wave {
    0%, 100% { transform: rotate(0deg); }
    10%, 30% { transform: rotate(14deg); }
    20% { transform: rotate(-8deg); }
    40% { transform: rotate(-4deg); }
    50% { transform: rotate(10deg); }
    60% { transform: rotate(0deg); }
}

/* Fade in animations */
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-down {
    animation: fadeInDown 0.6s ease-out forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-up {
    animation: fadeInUp 0.6s ease-out forwards;
}
</style>
@endpush
