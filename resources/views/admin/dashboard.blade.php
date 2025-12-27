@extends('layouts.admin')

@section('title', 'Dashboard')

@section('header')
<div class="mb-6 sm:mb-8 fade-in-down">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex-1">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">
                Admin Dashboard <span class="wave inline-block">👋</span>
            </h1>
            <p class="text-dark-600 mt-2 text-sm sm:text-base md:text-lg">Welcome back, <span class="font-bold text-primary-600">{{ auth()->user()->name }}</span>!</p>
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
<!-- Admin Profile Card -->
<div class="modern-card bg-gradient-to-r from-primary-600 via-primary-700 to-secondary-600 rounded-xl sm:rounded-2xl shadow-strong p-4 sm:p-6 md:p-8 mb-6 sm:mb-8 text-white hover-lift relative overflow-hidden fade-in-up">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10 bg-pattern-dots"></div>

    <div class="relative z-10 flex flex-col md:flex-row items-center md:items-start justify-between gap-4 sm:gap-6">
        <div class="flex flex-col md:flex-row items-center md:items-start space-y-3 sm:space-y-4 md:space-y-0 md:space-x-6 w-full md:w-auto">
            <div class="relative flex-shrink-0">
                @if(auth()->user()->profile_image)
                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                         alt="{{ auth()->user()->name }}"
                         class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 rounded-full object-cover border-4 border-white/30 shadow-2xl">
                @else
                    <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center border-4 border-white/30 shadow-2xl">
                        <span class="text-2xl sm:text-3xl md:text-4xl font-bold">
                            {{ strtoupper(substr(auth()->user()->first_name ?? auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?? '', 0, 1)) }}
                        </span>
                    </div>
                @endif
                <div class="absolute -bottom-1 -right-1 sm:-bottom-2 sm:-right-2 w-6 h-6 sm:w-8 sm:h-8 bg-success-500 rounded-full border-2 sm:border-4 border-white shadow-lg flex items-center justify-center">
                    <i class="fas fa-check text-white text-xs"></i>
                </div>
            </div>
            <div class="text-center md:text-left flex-1">
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold mb-2">{{ auth()->user()->name }}</h2>
                <div class="space-y-1 text-primary-100 text-xs sm:text-sm">
                    <p class="flex items-center justify-center md:justify-start">
                        <i class="fas fa-shield-alt mr-2"></i>
                        {{ auth()->user()->access_rights ?? 'Administrator' }}
                    </p>
                    <p class="flex items-center justify-center md:justify-start break-all">
                        <i class="fas fa-envelope mr-2 flex-shrink-0"></i>
                        <span class="truncate">{{ auth()->user()->email }}</span>
                    </p>
                    @if(auth()->user()->phone_number)
                    <p class="flex items-center justify-center md:justify-start">
                        <i class="fas fa-phone mr-2"></i>
                        {{ auth()->user()->phone_number }}
                    </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2 sm:gap-3 w-full md:w-auto">
            <a href="{{ route('profile.edit') }}" class="btn-modern-outline border-white text-white hover:bg-white hover:text-primary-600 text-sm sm:text-base px-4 sm:px-6 py-2 sm:py-3 text-center active:scale-95">
                <i class="fas fa-user-edit mr-2"></i>Edit Profile
            </a>
            <a href="{{ route('admin.contact-messages.index') }}" class="btn-modern-outline border-white text-white hover:bg-white hover:text-primary-600 relative text-sm sm:text-base px-4 sm:px-6 py-2 sm:py-3 text-center active:scale-95">
                <i class="fas fa-envelope mr-2"></i>Messages
                @php
                    $unreadCount = \App\Models\ContactMessage::where('status', 'unread')->count();
                @endphp
                @if($unreadCount > 0)
                    <span class="absolute -top-1 -right-1 sm:-top-2 sm:-right-2 px-1.5 sm:px-2 py-0.5 text-xs font-bold bg-danger-500 text-white rounded-full">{{ $unreadCount }}</span>
                @endif
            </a>
        </div>
    </div>
</div>

<!-- Main Statistics Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
    <!-- Total Admissions -->
    <div class="modern-card hover-lift bg-white rounded-xl sm:rounded-2xl shadow-soft p-4 sm:p-6 border border-dark-200 group active:scale-95 transition-all">
        <div class="flex items-start justify-between mb-3 sm:mb-4">
            <div class="flex-1">
                <p class="text-xs sm:text-sm font-semibold text-dark-500 uppercase tracking-wide mb-1 sm:mb-2">Total Admissions</p>
                <p class="text-3xl sm:text-4xl font-bold text-dark-900" data-counter="{{ $stats['total_admissions'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg sm:rounded-xl p-3 sm:p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-user-graduate text-white text-xl sm:text-2xl"></i>
            </div>
        </div>
        <div class="flex items-center text-xs sm:text-sm text-warning-600 font-medium">
            <i class="fas fa-clock mr-2"></i>
            <span>{{ $stats['pending_admissions'] }} pending review</span>
        </div>
    </div>

    <!-- Approved Admissions -->
    <div class="modern-card hover-lift bg-white rounded-xl sm:rounded-2xl shadow-soft p-4 sm:p-6 border border-dark-200 group active:scale-95 transition-all">
        <div class="flex items-start justify-between mb-3 sm:mb-4">
            <div class="flex-1">
                <p class="text-xs sm:text-sm font-semibold text-dark-500 uppercase tracking-wide mb-1 sm:mb-2">Approved</p>
                <p class="text-3xl sm:text-4xl font-bold text-dark-900" data-counter="{{ $stats['approved_admissions'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-success-500 to-success-600 rounded-lg sm:rounded-xl p-3 sm:p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-check-circle text-white text-xl sm:text-2xl"></i>
            </div>
        </div>
        <div class="flex items-center text-xs sm:text-sm text-success-600 font-medium">
            <i class="fas fa-calendar mr-2"></i>
            <span>This academic year</span>
        </div>
    </div>

    <!-- Total Users -->
    <div class="modern-card hover-lift bg-white rounded-xl sm:rounded-2xl shadow-soft p-4 sm:p-6 border border-dark-200 group active:scale-95 transition-all">
        <div class="flex items-start justify-between mb-3 sm:mb-4">
            <div class="flex-1">
                <p class="text-xs sm:text-sm font-semibold text-dark-500 uppercase tracking-wide mb-1 sm:mb-2">Total Users</p>
                <p class="text-3xl sm:text-4xl font-bold text-dark-900" data-counter="{{ $stats['total_users'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-secondary-500 to-secondary-600 rounded-lg sm:rounded-xl p-3 sm:p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-users text-white text-xl sm:text-2xl"></i>
            </div>
        </div>
        <div class="flex items-center text-xs sm:text-sm text-secondary-600 font-medium">
            <i class="fas fa-check mr-2"></i>
            <span>Active accounts</span>
        </div>
    </div>

    <!-- Unread Messages -->
    <div class="modern-card hover-lift bg-white rounded-xl sm:rounded-2xl shadow-soft p-4 sm:p-6 border border-dark-200 group active:scale-95 transition-all">
        <div class="flex items-start justify-between mb-3 sm:mb-4">
            <div class="flex-1">
                <p class="text-xs sm:text-sm font-semibold text-dark-500 uppercase tracking-wide mb-1 sm:mb-2">Unread Messages</p>
                <p class="text-3xl sm:text-4xl font-bold text-dark-900" data-counter="{{ $stats['unread_messages'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-danger-500 to-danger-600 rounded-lg sm:rounded-xl p-3 sm:p-4 group-hover:scale-110 transition-transform duration-300 {{ $stats['unread_messages'] > 0 ? 'pulse' : '' }}">
                <i class="fas fa-envelope text-white text-xl sm:text-2xl"></i>
            </div>
        </div>
        <div class="flex items-center text-sm text-danger-600 font-medium">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <span>Requires attention</span>
        </div>
    </div>
</div>

<!-- Secondary Statistics Row -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Courses -->
    <div class="modern-card hover-lift bg-white rounded-2xl shadow-soft p-6 border border-dark-200 group">
        <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
                <p class="text-sm font-semibold text-dark-500 uppercase tracking-wide mb-2">Courses</p>
                <p class="text-3xl font-bold text-dark-900" data-counter="{{ $stats['total_courses'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-book text-white text-xl"></i>
            </div>
        </div>
        <a href="{{ route('admin.courses.index') }}" class="text-xs text-primary-600 hover:text-primary-700 font-semibold">
            Manage Courses <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <!-- Schedules -->
    <div class="modern-card hover-lift bg-white rounded-2xl shadow-soft p-6 border border-dark-200 group">
        <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
                <p class="text-sm font-semibold text-dark-500 uppercase tracking-wide mb-2">Schedules</p>
                <p class="text-3xl font-bold text-dark-900" data-counter="{{ $stats['total_schedules'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-secondary-500 to-secondary-600 rounded-xl p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-calendar-week text-white text-xl"></i>
            </div>
        </div>
        <a href="{{ route('admin.schedules.index') }}" class="text-xs text-secondary-600 hover:text-secondary-700 font-semibold">
            Manage Schedules <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <!-- Blog Posts -->
    <div class="modern-card hover-lift bg-white rounded-2xl shadow-soft p-6 border border-dark-200 group">
        <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
                <p class="text-sm font-semibold text-dark-500 uppercase tracking-wide mb-2">Blog Posts</p>
                <p class="text-3xl font-bold text-dark-900" data-counter="{{ $stats['total_posts'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-accent-500 to-accent-600 rounded-xl p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-blog text-white text-xl"></i>
            </div>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="text-xs text-accent-600 hover:text-accent-700 font-semibold">
            Manage Posts <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <!-- Stories -->
    <div class="modern-card hover-lift bg-white rounded-2xl shadow-soft p-6 border border-dark-200 group">
        <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
                <p class="text-sm font-semibold text-dark-500 uppercase tracking-wide mb-2">Stories</p>
                <p class="text-3xl font-bold text-dark-900" data-counter="{{ $stats['total_stories'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-accent-600 to-danger-500 rounded-xl p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-star text-white text-xl"></i>
            </div>
        </div>
        <a href="{{ route('admin.stories.index') }}" class="text-xs text-accent-600 hover:text-accent-700 font-semibold">
            Manage Stories <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
</div>

<!-- Third Statistics Row -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Activities -->
    <div class="modern-card hover-lift bg-white rounded-2xl shadow-soft p-6 border border-dark-200 group">
        <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
                <p class="text-sm font-semibold text-dark-500 uppercase tracking-wide mb-2">Activities</p>
                <p class="text-3xl font-bold text-dark-900" data-counter="{{ $stats['total_activities'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-warning-500 to-warning-600 rounded-xl p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-calendar-alt text-white text-xl"></i>
            </div>
        </div>
        <a href="{{ route('admin.activities.index') }}" class="text-xs text-warning-600 hover:text-warning-700 font-semibold">
            Manage Activities <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <!-- Facilities -->
    <div class="modern-card hover-lift bg-white rounded-2xl shadow-soft p-6 border border-dark-200 group">
        <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
                <p class="text-sm font-semibold text-dark-500 uppercase tracking-wide mb-2">Facilities</p>
                <p class="text-3xl font-bold text-dark-900" data-counter="{{ $stats['total_facilities'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-primary-500 to-secondary-500 rounded-xl p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-building text-white text-xl"></i>
            </div>
        </div>
        <a href="{{ route('admin.facilities.index') }}" class="text-xs text-primary-600 hover:text-primary-700 font-semibold">
            Manage Facilities <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <!-- Feedback -->
    <div class="modern-card hover-lift bg-white rounded-2xl shadow-soft p-6 border border-dark-200 group">
        <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
                <p class="text-sm font-semibold text-dark-500 uppercase tracking-wide mb-2">Feedback</p>
                <p class="text-3xl font-bold text-dark-900" data-counter="{{ $stats['total_feedback'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-secondary-500 to-primary-600 rounded-xl p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-comments text-white text-xl"></i>
            </div>
        </div>
        <a href="{{ route('admin.feedback.index') }}" class="text-xs text-secondary-600 hover:text-secondary-700 font-semibold">
            View Feedback <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <!-- Announcements -->
    <div class="modern-card hover-lift bg-white rounded-2xl shadow-soft p-6 border border-dark-200 group">
        <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
                <p class="text-sm font-semibold text-dark-500 uppercase tracking-wide mb-2">Announcements</p>
                <p class="text-3xl font-bold text-dark-900" data-counter="{{ $stats['total_announcements'] }}">0</p>
            </div>
            <div class="bg-gradient-to-br from-success-500 to-success-600 rounded-xl p-4 group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-bullhorn text-white text-xl"></i>
            </div>
        </div>
        <a href="{{ route('admin.announcements.index') }}" class="text-xs text-success-600 hover:text-success-700 font-semibold">
            Manage Announcements <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <!-- User Roles Breakdown -->
    <div class="modern-card bg-white rounded-2xl shadow-soft p-6 border border-dark-200">
        <h3 class="text-xl font-bold text-dark-900 mb-6 flex items-center">
            <i class="fas fa-users-cog mr-3 text-primary-600"></i>
            User Roles
        </h3>
        <div class="space-y-5">
            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-dark-700 flex items-center">
                        <i class="fas fa-user-shield text-danger-600 mr-2 w-4"></i>
                        Admins
                    </span>
                    <span class="text-sm font-bold text-dark-900">{{ $user_roles['admins'] }}</span>
                </div>
                <div class="w-full bg-dark-100 rounded-full h-2.5">
                    <div class="bg-gradient-to-r from-danger-500 to-danger-600 h-2.5 rounded-full transition-all duration-500" style="width: {{ $stats['active_users'] > 0 ? ($user_roles['admins'] / $stats['active_users']) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-dark-700 flex items-center">
                        <i class="fas fa-chalkboard-teacher text-success-600 mr-2 w-4"></i>
                        Teachers
                    </span>
                    <span class="text-sm font-bold text-dark-900">{{ $user_roles['teachers'] }}</span>
                </div>
                <div class="w-full bg-dark-100 rounded-full h-2.5">
                    <div class="bg-gradient-to-r from-success-500 to-success-600 h-2.5 rounded-full transition-all duration-500" style="width: {{ $stats['active_users'] > 0 ? ($user_roles['teachers'] / $stats['active_users']) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-dark-700 flex items-center">
                        <i class="fas fa-user-graduate text-primary-600 mr-2 w-4"></i>
                        Students
                    </span>
                    <span class="text-sm font-bold text-dark-900">{{ $user_roles['students'] }}</span>
                </div>
                <div class="w-full bg-dark-100 rounded-full h-2.5">
                    <div class="bg-gradient-to-r from-primary-500 to-primary-600 h-2.5 rounded-full transition-all duration-500" style="width: {{ $stats['active_users'] > 0 ? ($user_roles['students'] / $stats['active_users']) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-dark-700 flex items-center">
                        <i class="fas fa-user-tie text-secondary-600 mr-2 w-4"></i>
                        Staff
                    </span>
                    <span class="text-sm font-bold text-dark-900">{{ $user_roles['staff'] }}</span>
                </div>
                <div class="w-full bg-dark-100 rounded-full h-2.5">
                    <div class="bg-gradient-to-r from-secondary-500 to-secondary-600 h-2.5 rounded-full transition-all duration-500" style="width: {{ $stats['active_users'] > 0 ? ($user_roles['staff'] / $stats['active_users']) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Admission Status -->
    <div class="modern-card bg-white rounded-2xl shadow-soft p-6 border border-dark-200">
        <h3 class="text-xl font-bold text-dark-900 mb-6 flex items-center">
            <i class="fas fa-chart-pie mr-3 text-secondary-600"></i>
            Admission Status
        </h3>
        <div class="space-y-5">
            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-dark-700">Pending</span>
                    <span class="text-sm font-bold text-dark-900">{{ $admission_stats['pending'] }}</span>
                </div>
                <div class="w-full bg-dark-100 rounded-full h-2.5">
                    <div class="bg-gradient-to-r from-warning-500 to-warning-600 h-2.5 rounded-full transition-all duration-500" style="width: {{ $stats['total_admissions'] > 0 ? ($admission_stats['pending'] / $stats['total_admissions']) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-dark-700">Under Review</span>
                    <span class="text-sm font-bold text-dark-900">{{ $admission_stats['under_review'] }}</span>
                </div>
                <div class="w-full bg-dark-100 rounded-full h-2.5">
                    <div class="bg-gradient-to-r from-primary-500 to-primary-600 h-2.5 rounded-full transition-all duration-500" style="width: {{ $stats['total_admissions'] > 0 ? ($admission_stats['under_review'] / $stats['total_admissions']) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-dark-700">Approved</span>
                    <span class="text-sm font-bold text-dark-900">{{ $admission_stats['approved'] }}</span>
                </div>
                <div class="w-full bg-dark-100 rounded-full h-2.5">
                    <div class="bg-gradient-to-r from-success-500 to-success-600 h-2.5 rounded-full transition-all duration-500" style="width: {{ $stats['total_admissions'] > 0 ? ($admission_stats['approved'] / $stats['total_admissions']) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-dark-700">Rejected</span>
                    <span class="text-sm font-bold text-dark-900">{{ $admission_stats['rejected'] }}</span>
                </div>
                <div class="w-full bg-dark-100 rounded-full h-2.5">
                    <div class="bg-gradient-to-r from-danger-500 to-danger-600 h-2.5 rounded-full transition-all duration-500" style="width: {{ $stats['total_admissions'] > 0 ? ($admission_stats['rejected'] / $stats['total_admissions']) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="modern-card bg-white rounded-2xl shadow-soft p-6 border border-dark-200">
        <h3 class="text-xl font-bold text-dark-900 mb-6 flex items-center">
            <i class="fas fa-bolt mr-3 text-accent-600"></i>
            Quick Actions
        </h3>
        <div class="space-y-3">
            <a href="{{ route('admin.admissions.index') }}" class="modern-feature flex items-center p-4 bg-dark-50 rounded-xl hover:bg-primary-50 hover:border-primary-200 border border-transparent transition-all group">
                <div class="modern-feature-icon bg-gradient-to-br from-primary-500 to-primary-600 !w-10 !h-10">
                    <i class="fas fa-user-graduate !text-base"></i>
                </div>
                <span class="ml-4 text-dark-900 font-semibold group-hover:text-primary-600 text-sm">Admissions</span>
                <i class="fas fa-chevron-right ml-auto text-dark-400 group-hover:text-primary-600"></i>
            </a>

            <a href="{{ route('admin.schedules.create') }}" class="modern-feature flex items-center p-4 bg-dark-50 rounded-xl hover:bg-secondary-50 hover:border-secondary-200 border border-transparent transition-all group">
                <div class="modern-feature-icon bg-gradient-to-br from-secondary-500 to-secondary-600 !w-10 !h-10 secondary">
                    <i class="fas fa-calendar-plus !text-base"></i>
                </div>
                <span class="ml-4 text-dark-900 font-semibold group-hover:text-secondary-600 text-sm">Add Schedule</span>
                <i class="fas fa-chevron-right ml-auto text-dark-400 group-hover:text-secondary-600"></i>
            </a>

            <a href="{{ route('admin.announcements.create') }}" class="modern-feature flex items-center p-4 bg-dark-50 rounded-xl hover:bg-success-50 hover:border-success-200 border border-transparent transition-all group">
                <div class="modern-feature-icon bg-gradient-to-br from-success-500 to-success-600 !w-10 !h-10">
                    <i class="fas fa-bullhorn !text-base"></i>
                </div>
                <span class="ml-4 text-dark-900 font-semibold group-hover:text-success-600 text-sm">New Announcement</span>
                <i class="fas fa-chevron-right ml-auto text-dark-400 group-hover:text-success-600"></i>
            </a>

            <a href="{{ route('admin.posts.create') }}" class="modern-feature flex items-center p-4 bg-dark-50 rounded-xl hover:bg-accent-50 hover:border-accent-200 border border-transparent transition-all group">
                <div class="modern-feature-icon bg-gradient-to-br from-accent-500 to-accent-600 !w-10 !h-10 accent">
                    <i class="fas fa-blog !text-base"></i>
                </div>
                <span class="ml-4 text-dark-900 font-semibold group-hover:text-accent-600 text-sm">New Blog Post</span>
                <i class="fas fa-chevron-right ml-auto text-dark-400 group-hover:text-accent-600"></i>
            </a>

            <a href="{{ route('admin.users.create') }}" class="modern-feature flex items-center p-4 bg-dark-50 rounded-xl hover:bg-primary-50 hover:border-primary-200 border border-transparent transition-all group">
                <div class="modern-feature-icon bg-gradient-to-br from-primary-600 to-secondary-600 !w-10 !h-10">
                    <i class="fas fa-user-plus !text-base"></i>
                </div>
                <span class="ml-4 text-dark-900 font-semibold group-hover:text-primary-600 text-sm">Add User</span>
                <i class="fas fa-chevron-right ml-auto text-dark-400 group-hover:text-primary-600"></i>
            </a>

            <a href="{{ route('admin.feedback.index') }}" class="modern-feature flex items-center p-4 bg-dark-50 rounded-xl hover:bg-secondary-50 hover:border-secondary-200 border border-transparent transition-all group">
                <div class="modern-feature-icon bg-gradient-to-br from-secondary-500 to-primary-600 !w-10 !h-10">
                    <i class="fas fa-comments !text-base"></i>
                </div>
                <span class="ml-4 text-dark-900 font-semibold group-hover:text-secondary-600 text-sm">View Feedback</span>
                <i class="fas fa-chevron-right ml-auto text-dark-400 group-hover:text-secondary-600"></i>
            </a>
        </div>
    </div>
</div>

<!-- Today's Class Schedule -->
@if($today_schedule->count() > 0)
<div class="modern-card bg-white rounded-2xl shadow-soft border border-dark-200 mb-8">
    <div class="p-6 border-b border-dark-200 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-t-2xl">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-calendar-day mr-3"></i>
                    Today's Class Schedule
                </h3>
                <p class="text-primary-100 mt-1 text-sm">{{ now()->format('l, F d, Y') }}</p>
            </div>
            <a href="{{ route('admin.schedules.index') }}" class="btn-modern-outline border-white text-white hover:bg-white hover:text-primary-600 text-sm py-2 px-4">
                View All <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($today_schedule as $schedule)
            <div class="modern-card hover-lift border-l-4 border-primary-500 bg-gradient-to-r from-primary-50 to-white p-5 rounded-r-xl">
                <h4 class="font-bold text-dark-900 text-lg mb-2">
                    {{ $schedule->subject ? $schedule->subject->subject_name : 'N/A' }}
                </h4>
                <p class="text-sm text-dark-600 mb-2">
                    <i class="fas fa-user-tie mr-2"></i>
                    {{ $schedule->teacher ? $schedule->teacher->first_name . ' ' . $schedule->teacher->last_name : 'TBA' }}
                </p>
                <p class="text-sm text-primary-700 font-semibold mb-1">
                    <i class="fas fa-clock mr-2"></i>
                    {{ date('g:i A', strtotime($schedule->start_time)) }} - {{ date('g:i A', strtotime($schedule->end_time)) }}
                </p>
                @if($schedule->room)
                <p class="text-xs text-dark-600">
                    <i class="fas fa-door-open mr-2"></i>
                    Room: {{ $schedule->room }}
                </p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Admission Trend Chart -->
<div class="modern-card bg-white rounded-2xl shadow-soft border border-dark-200 p-6 mb-8">
    <h3 class="text-xl font-bold text-dark-900 mb-6 flex items-center">
        <i class="fas fa-chart-line mr-3 text-primary-600"></i>
        Admission Trend (Last 6 Months)
    </h3>
    <div class="h-64">
        <canvas id="admissionTrendChart"></canvas>
    </div>
</div>

<!-- Recent Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Recent Blog Posts -->
    <div class="modern-card bg-white rounded-2xl shadow-soft border border-dark-200">
        <div class="p-6 border-b border-dark-200">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-dark-900 flex items-center">
                    <i class="fas fa-blog mr-3 text-accent-600"></i>
                    Recent Blog Posts
                </h3>
                <a href="{{ route('admin.posts.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-semibold">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        <div class="p-6">
            @if($recent_posts->count() > 0)
                <div class="space-y-4">
                    @foreach($recent_posts->take(3) as $post)
                    <div class="border border-dark-200 rounded-xl p-4 hover:shadow-md hover:border-accent-200 transition-all">
                        <h4 class="font-bold text-dark-900 mb-2">{{ $post->title }}</h4>
                        <p class="text-sm text-dark-600 line-clamp-2 mb-3">
                            {{ Str::limit(strip_tags($post->content), 100) }}
                        </p>
                        <div class="flex items-center justify-between text-xs text-dark-500">
                            <span>
                                <i class="fas fa-calendar mr-1"></i>
                                {{ $post->created_at ? $post->created_at->format('M d, Y') : 'N/A' }}
                            </span>
                            @if($post->author)
                            <span>
                                <i class="fas fa-user mr-1"></i>
                                {{ $post->author->first_name }} {{ $post->author->last_name }}
                            </span>
                            @endif
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

    <!-- Recent Success Stories -->
    <div class="modern-card bg-white rounded-2xl shadow-soft border border-dark-200">
        <div class="p-6 border-b border-dark-200">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-dark-900 flex items-center">
                    <i class="fas fa-star mr-3 text-accent-600"></i>
                    Recent Success Stories
                </h3>
                <a href="{{ route('admin.stories.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-semibold">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        <div class="p-6">
            @if($recent_stories->count() > 0)
                <div class="space-y-4">
                    @foreach($recent_stories->take(3) as $story)
                    <div class="border border-dark-200 rounded-xl p-4 hover:shadow-md hover:border-accent-200 transition-all">
                        <h4 class="font-bold text-dark-900 mb-2">{{ $story->title }}</h4>
                        <p class="text-sm text-dark-600 line-clamp-2 mb-3">
                            {{ Str::limit($story->content, 100) }}
                        </p>
                        <div class="text-xs text-dark-500">
                            <i class="fas fa-calendar mr-1"></i>
                            {{ $story->created_at ? $story->created_at->format('M d, Y') : 'N/A' }}
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-dark-100 text-dark-400 mb-4">
                        <i class="fas fa-star text-3xl"></i>
                    </div>
                    <p class="text-dark-600">No success stories yet</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Recent Admissions & Messages -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Admissions -->
    <div class="modern-card bg-white rounded-2xl shadow-soft border border-dark-200">
        <div class="p-6 border-b border-dark-200">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-dark-900 flex items-center">
                    <i class="fas fa-user-graduate mr-3 text-primary-600"></i>
                    Recent Admissions
                </h3>
                <a href="{{ route('admin.admissions.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-semibold">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        <div class="p-6">
            @if($recent_admissions->count() > 0)
                <div class="space-y-4">
                    @foreach($recent_admissions->take(5) as $admission)
                    <div class="flex items-center justify-between pb-4 border-b border-dark-200 last:border-0">
                        <div>
                            <p class="font-semibold text-dark-900">{{ $admission->full_name }}</p>
                            <p class="text-sm text-dark-500">{{ $admission->grade_level }} • {{ $admission->email }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                {{ $admission->status === 'Pending' ? 'bg-warning-100 text-warning-800' : '' }}
                                {{ $admission->status === 'Under Review' ? 'bg-primary-100 text-primary-800' : '' }}
                                {{ $admission->status === 'Approved' ? 'bg-success-100 text-success-800' : '' }}
                                {{ $admission->status === 'Rejected' ? 'bg-danger-100 text-danger-800' : '' }}">
                                {{ $admission->status }}
                            </span>
                            <p class="text-xs text-dark-500 mt-1">{{ $admission->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-dark-100 text-dark-400 mb-4">
                        <i class="fas fa-user-graduate text-3xl"></i>
                    </div>
                    <p class="text-dark-600">No recent admissions</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Messages -->
    <div class="modern-card bg-white rounded-2xl shadow-soft border border-dark-200">
        <div class="p-6 border-b border-dark-200">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-dark-900 flex items-center">
                    <i class="fas fa-envelope mr-3 text-secondary-600"></i>
                    Recent Contact Messages
                </h3>
                <a href="{{ route('admin.contact-messages.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-semibold">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        <div class="p-6">
            @if($recent_messages->count() > 0)
                <div class="space-y-4">
                    @foreach($recent_messages->take(5) as $message)
                    <div class="flex items-start justify-between pb-4 border-b border-dark-200 last:border-0">
                        <div class="flex-1">
                            <div class="flex items-center mb-1">
                                <p class="font-semibold text-dark-900">{{ $message->name }}</p>
                                @if($message->status === 'unread')
                                <span class="ml-2 h-2 w-2 bg-danger-500 rounded-full"></span>
                                @endif
                            </div>
                            <p class="text-sm font-medium text-dark-700 mb-1">{{ $message->subject }}</p>
                            <p class="text-xs text-dark-500">{{ Str::limit($message->message, 60) }}</p>
                        </div>
                        <div class="text-right ml-4">
                            <p class="text-xs text-dark-500">{{ $message->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-dark-100 text-dark-400 mb-4">
                        <i class="fas fa-envelope text-3xl"></i>
                    </div>
                    <p class="text-dark-600">No recent messages</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

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

// Admission Trend Chart
const monthlyData = @json($monthly_admissions);
const months = monthlyData.map(item => {
    const date = new Date(item.month + '-01');
    return date.toLocaleDateString('en-US', { month: 'short', year: 'numeric' });
});
const totals = monthlyData.map(item => item.total);

const ctx = document.getElementById('admissionTrendChart');
if (ctx) {
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Admissions',
                data: totals,
                borderColor: 'rgb(37, 99, 235)',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 3,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: 'rgb(37, 99, 235)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointHoverBackgroundColor: 'rgb(29, 78, 216)',
                pointHoverBorderColor: '#fff',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    padding: 12,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    cornerRadius: 8,
                    displayColors: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            size: 12
                        }
                    },
                    grid: {
                        color: 'rgba(226, 232, 240, 0.5)'
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 12
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
}
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

/* Pulse Animation */
.pulse {
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
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
