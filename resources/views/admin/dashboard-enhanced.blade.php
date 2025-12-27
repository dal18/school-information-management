@extends('layouts.admin')

@section('title', 'Dashboard')

@section('header')
<div class="mb-6 fade-in-down">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-extrabold text-gray-900">
                Dashboard <span class="wave inline-block">👋</span>
            </h1>
            <p class="text-gray-600 mt-2 text-lg">Welcome back, <span class="font-bold text-indigo-600">{{ auth()->user()->name }}</span>!</p>
        </div>
        <div class="hidden md:flex items-center space-x-4">
            <div class="bg-white rounded-lg shadow-md px-4 py-2 border border-gray-200">
                <div class="text-sm text-gray-600">
                    <i class="fas fa-clock mr-2 text-indigo-600"></i><span id="current-time" class="font-semibold text-gray-900"></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<!-- Quick Search -->
<div class="mb-6">
    <div class="relative">
        <input type="text"
               id="dashboard-search"
               placeholder="Search admissions, users, messages..."
               class="w-full px-4 py-3 pl-12 pr-4 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm">
        <i class="fas fa-search absolute left-4 top-4 text-gray-400"></i>
    </div>
</div>

<!-- KPI Dashboard -->
<div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-2xl shadow-lg p-8 mb-8 text-white">
    <h3 class="text-2xl font-bold mb-6 flex items-center">
        <i class="fas fa-chart-line mr-3"></i>
        Key Performance Indicators
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="text-center">
            <div class="text-4xl font-bold text-green-400">{{ $kpis['approval_rate'] }}%</div>
            <div class="text-sm text-gray-400 mt-1">Admission Approval Rate</div>
            <div class="flex items-center justify-center mt-2 text-xs">
                @if($kpis['approval_trend'] > 0)
                    <i class="fas fa-arrow-up text-green-400 mr-1"></i>
                    <span class="text-green-400">+{{ number_format($kpis['approval_trend'], 1) }}%</span>
                @else
                    <i class="fas fa-arrow-down text-red-400 mr-1"></i>
                    <span class="text-red-400">{{ number_format($kpis['approval_trend'], 1) }}%</span>
                @endif
            </div>
        </div>
        <div class="text-center">
            <div class="text-4xl font-bold text-blue-400">{{ $kpis['avg_response_time'] }}</div>
            <div class="text-sm text-gray-400 mt-1">Avg Response Time (hrs)</div>
            <div class="text-xs text-gray-500 mt-2">Last 30 days</div>
        </div>
        <div class="text-center">
            <div class="text-4xl font-bold text-purple-400">{{ $kpis['active_users_today'] }}</div>
            <div class="text-sm text-gray-400 mt-1">Active Users Today</div>
            <div class="flex items-center justify-center mt-2 text-xs">
                @if($kpis['user_growth'] > 0)
                    <i class="fas fa-arrow-up text-purple-400 mr-1"></i>
                    <span class="text-purple-400">+{{ $kpis['user_growth'] }}%</span>
                @else
                    <i class="fas fa-minus text-gray-400 mr-1"></i>
                    <span class="text-gray-400">{{ $kpis['user_growth'] }}%</span>
                @endif
            </div>
        </div>
        <div class="text-center">
            <div class="text-4xl font-bold text-orange-400">{{ $kpis['pending_items'] }}</div>
            <div class="text-sm text-gray-400 mt-1">Pending Actions</div>
            <div class="text-xs text-gray-500 mt-2">Require attention</div>
        </div>
    </div>
</div>

<!-- Admin Profile Card -->
<div class="bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-600 rounded-2xl shadow-lg p-8 mb-8 text-white hover:shadow-2xl transition-all duration-300 fade-in-up">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-6">
            <div class="relative">
                @if(auth()->user()->profile_image)
                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                         alt="{{ auth()->user()->name }}"
                         class="w-24 h-24 rounded-full object-cover border-4 border-white/30 shadow-lg">
                @else
                    <div class="w-24 h-24 rounded-full bg-white/20 backdrop-blur flex items-center justify-center border-4 border-white/30 shadow-lg">
                        <span class="text-3xl font-bold">
                            {{ strtoupper(substr(auth()->user()->first_name ?? auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?? '', 0, 1)) }}
                        </span>
                    </div>
                @endif
                <div class="absolute -bottom-1 -right-1 w-7 h-7 bg-green-400 rounded-full border-4 border-white/30"></div>
            </div>
            <div>
                <h2 class="text-2xl font-bold mb-1">{{ auth()->user()->name }}</h2>
                <p class="text-indigo-100 flex items-center mb-1">
                    <i class="fas fa-shield-alt mr-2"></i>
                    {{ auth()->user()->access_rights ?? 'Administrator' }}
                </p>
                <p class="text-indigo-100 flex items-center">
                    <i class="fas fa-envelope mr-2"></i>
                    {{ auth()->user()->email }}
                </p>
            </div>
        </div>
        <div class="hidden md:flex flex-col space-y-3">
            <a href="{{ route('profile.edit') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center">
                <i class="fas fa-user-edit mr-2"></i>Edit Profile
            </a>
            <a href="{{ route('admin.contact-messages.index') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center">
                <i class="fas fa-envelope mr-2"></i>Messages
                @if($stats['unread_messages'] > 0)
                    <span class="ml-2 px-2 py-0.5 text-xs font-bold bg-red-500 text-white rounded-full">{{ $stats['unread_messages'] }}</span>
                @endif
            </a>
        </div>
    </div>
</div>

<!-- Main Statistics Cards with Trends -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Admissions -->
    <div class="card-interactive modern-card bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 rounded-2xl shadow-modern-lg p-6 text-white scale-in relative overflow-hidden group" data-stagger>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-blue-100">Total Admissions</p>
                <p class="text-4xl font-bold mt-2" data-counter="{{ $stats['total_admissions'] }}">0</p>
            </div>
            <div class="bg-white/20 backdrop-blur rounded-full p-4">
                <i class="fas fa-user-graduate text-3xl"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <span class="text-sm font-medium">{{ $stats['pending_admissions'] }} pending</span>
            <div class="flex items-center space-x-1">
                @if($trends['admissions'] > 0)
                    <i class="fas fa-arrow-up text-green-300"></i>
                    <span class="text-xs text-green-300">+{{ $trends['admissions'] }}%</span>
                @elseif($trends['admissions'] < 0)
                    <i class="fas fa-arrow-down text-red-300"></i>
                    <span class="text-xs text-red-300">{{ $trends['admissions'] }}%</span>
                @else
                    <i class="fas fa-minus text-gray-300"></i>
                @endif
            </div>
        </div>
    </div>

    <!-- Approved Admissions -->
    <div class="card-interactive modern-card bg-gradient-to-br from-green-500 via-green-600 to-green-700 rounded-2xl shadow-modern-lg p-6 text-white scale-in relative overflow-hidden group" data-stagger>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-green-100">Approved</p>
                <p class="text-4xl font-bold mt-2" data-counter="{{ $stats['approved_admissions'] }}">0</p>
            </div>
            <div class="bg-white/20 backdrop-blur rounded-full p-4">
                <i class="fas fa-check-circle text-3xl"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <i class="fas fa-calendar mr-2"></i>
            <span class="font-medium">This academic year</span>
        </div>
    </div>

    <!-- Total Users -->
    <div class="card-interactive modern-card bg-gradient-to-br from-purple-500 via-purple-600 to-purple-700 rounded-2xl shadow-modern-lg p-6 text-white scale-in relative overflow-hidden group" data-stagger>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-purple-100">Total Users</p>
                <p class="text-4xl font-bold mt-2" data-counter="{{ $stats['total_users'] }}">0</p>
            </div>
            <div class="bg-white/20 backdrop-blur rounded-full p-4">
                <i class="fas fa-users text-3xl"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center justify-between">
            <span class="text-sm font-medium">Active accounts</span>
            <div class="flex items-center space-x-1">
                @if($trends['users'] > 0)
                    <i class="fas fa-arrow-up text-green-300"></i>
                    <span class="text-xs text-green-300">+{{ $trends['users'] }}%</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Unread Messages -->
    <div class="card-interactive modern-card bg-gradient-to-br from-red-500 via-red-600 to-red-700 rounded-2xl shadow-modern-lg p-6 text-white scale-in relative overflow-hidden group" data-stagger>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-red-100">Unread Messages</p>
                <p class="text-4xl font-bold mt-2" data-counter="{{ $stats['unread_messages'] }}">0</p>
            </div>
            <div class="bg-white/20 backdrop-blur rounded-full p-4 {{ $stats['unread_messages'] > 0 ? 'pulse' : '' }}">
                <i class="fas fa-envelope text-3xl"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <span class="font-medium">Requires attention</span>
        </div>
    </div>
</div>

<!-- Quick Reports Export Section -->
<div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
        <i class="fas fa-file-export mr-2 text-green-600"></i>
        Quick Reports & Exports
    </h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        <a href="{{ route('admin.admissions.index') }}?export=pdf"
           class="flex flex-col items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition group">
            <i class="fas fa-file-pdf text-3xl text-blue-600 mb-2 group-hover:scale-110 transition"></i>
            <span class="text-sm font-medium text-gray-900">Admissions PDF</span>
            <span class="text-xs text-gray-500 mt-1">Export report</span>
        </a>
        <a href="{{ route('admin.users.index') }}?export=csv"
           class="flex flex-col items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition group">
            <i class="fas fa-file-excel text-3xl text-green-600 mb-2 group-hover:scale-110 transition"></i>
            <span class="text-sm font-medium text-gray-900">User Data CSV</span>
            <span class="text-xs text-gray-500 mt-1">Export list</span>
        </a>
        <a href="{{ route('admin.feedback.index') }}?export=pdf"
           class="flex flex-col items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition group">
            <i class="fas fa-file-alt text-3xl text-purple-600 mb-2 group-hover:scale-110 transition"></i>
            <span class="text-sm font-medium text-gray-900">Feedback Report</span>
            <span class="text-xs text-gray-500 mt-1">Analysis</span>
        </a>
        <a href="#" onclick="alert('Generate Activity Log Report')"
           class="flex flex-col items-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition group">
            <i class="fas fa-chart-line text-3xl text-orange-600 mb-2 group-hover:scale-110 transition"></i>
            <span class="text-sm font-medium text-gray-900">Activity Log</span>
            <span class="text-xs text-gray-500 mt-1">Last 30 days</span>
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Admin Tasks / To-Do -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-tasks mr-2 text-indigo-600"></i>
            Your Tasks
            <span class="ml-2 px-2 py-0.5 text-xs font-bold bg-indigo-100 text-indigo-800 rounded-full">
                {{ $pending_tasks }}
            </span>
        </h3>
        <div class="space-y-2">
            @if($stats['pending_admissions'] > 0)
            <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition cursor-pointer">
                <input type="checkbox" class="h-4 w-4 text-indigo-600 rounded">
                <span class="ml-3 text-sm text-gray-900">Review {{ $stats['pending_admissions'] }} pending admissions</span>
            </label>
            @endif
            @if($stats['unread_messages'] > 0)
            <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition cursor-pointer">
                <input type="checkbox" class="h-4 w-4 text-indigo-600 rounded">
                <span class="ml-3 text-sm text-gray-900">Reply to {{ $stats['unread_messages'] }} messages</span>
            </label>
            @endif
            <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition cursor-pointer">
                <input type="checkbox" class="h-4 w-4 text-indigo-600 rounded">
                <span class="ml-3 text-sm text-gray-900">Update class schedules</span>
            </label>
            <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition cursor-pointer">
                <input type="checkbox" class="h-4 w-4 text-indigo-600 rounded">
                <span class="ml-3 text-sm text-gray-900">Review recent feedback</span>
            </label>
        </div>
    </div>

    <!-- User Roles Breakdown -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-users-cog mr-2 text-blue-600"></i>
            User Roles
        </h3>
        <div class="space-y-4">
            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-user-shield text-red-600 mr-2 w-4"></i>
                        Admins
                    </span>
                    <span class="text-sm font-semibold text-gray-900">{{ $user_roles['admins'] }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-red-500 h-2 rounded-full" style="width: {{ $stats['active_users'] > 0 ? ($user_roles['admins'] / $stats['active_users']) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-chalkboard-teacher text-green-600 mr-2 w-4"></i>
                        Teachers
                    </span>
                    <span class="text-sm font-semibold text-gray-900">{{ $user_roles['teachers'] }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-500 h-2 rounded-full" style="width: {{ $stats['active_users'] > 0 ? ($user_roles['teachers'] / $stats['active_users']) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-user-graduate text-blue-600 mr-2 w-4"></i>
                        Students
                    </span>
                    <span class="text-sm font-semibold text-gray-900">{{ $user_roles['students'] }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $stats['active_users'] > 0 ? ($user_roles['students'] / $stats['active_users']) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-user-tie text-purple-600 mr-2 w-4"></i>
                        Staff
                    </span>
                    <span class="text-sm font-semibold text-gray-900">{{ $user_roles['staff'] }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-purple-500 h-2 rounded-full" style="width: {{ $stats['active_users'] > 0 ? ($user_roles['staff'] / $stats['active_users']) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
        <div class="space-y-2">
            <a href="{{ route('admin.admissions.index') }}" class="flex items-center justify-between p-2.5 bg-blue-50 hover:bg-blue-100 rounded-lg transition duration-200">
                <div class="flex items-center">
                    <i class="fas fa-user-graduate text-blue-600 mr-2 w-5"></i>
                    <span class="text-sm font-medium text-gray-900">Admissions</span>
                </div>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            </a>

            <a href="{{ route('admin.schedules.create') }}" class="flex items-center justify-between p-2.5 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition duration-200">
                <div class="flex items-center">
                    <i class="fas fa-calendar-plus text-indigo-600 mr-2 w-5"></i>
                    <span class="text-sm font-medium text-gray-900">Add Schedule</span>
                </div>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            </a>

            <a href="{{ route('admin.announcements.create') }}" class="flex items-center justify-between p-2.5 bg-green-50 hover:bg-green-100 rounded-lg transition duration-200">
                <div class="flex items-center">
                    <i class="fas fa-bullhorn text-green-600 mr-2 w-5"></i>
                    <span class="text-sm font-medium text-gray-900">New Announcement</span>
                </div>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            </a>

            <a href="{{ route('admin.posts.create') }}" class="flex items-center justify-between p-2.5 bg-pink-50 hover:bg-pink-100 rounded-lg transition duration-200">
                <div class="flex items-center">
                    <i class="fas fa-blog text-pink-600 mr-2 w-5"></i>
                    <span class="text-sm font-medium text-gray-900">New Blog Post</span>
                </div>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            </a>

            <a href="{{ route('admin.users.create') }}" class="flex items-center justify-between p-2.5 bg-purple-50 hover:bg-purple-100 rounded-lg transition duration-200">
                <div class="flex items-center">
                    <i class="fas fa-user-plus text-purple-600 mr-2 w-5"></i>
                    <span class="text-sm font-medium text-gray-900">Add User</span>
                </div>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            </a>

            <a href="{{ route('admin.feedback.index') }}" class="flex items-center justify-between p-2.5 bg-teal-50 hover:bg-teal-100 rounded-lg transition duration-200">
                <div class="flex items-center">
                    <i class="fas fa-comments text-teal-600 mr-2 w-5"></i>
                    <span class="text-sm font-medium text-gray-900">View Feedback</span>
                </div>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            </a>
        </div>
    </div>
</div>

<!-- Analytics Charts -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- User Growth Chart -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-chart-area mr-2 text-blue-600"></i>
            User Growth (Last 30 Days)
        </h3>
        <div class="h-64">
            <canvas id="userGrowthChart"></canvas>
        </div>
    </div>

    <!-- Admission Trend Chart -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-chart-line mr-2 text-purple-600"></i>
            Admission Trend (Last 6 Months)
        </h3>
        <div class="h-64">
            <canvas id="admissionTrendChart"></canvas>
        </div>
    </div>
</div>

<!-- Recent Activity Log -->
@if(isset($recent_activities) && $recent_activities->count() > 0)
<div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-history mr-2 text-purple-600"></i>
            Recent Admin Activities
        </h3>
        <a href="#" class="text-sm text-purple-600 hover:text-purple-800">
            View All <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
    <div class="space-y-3">
        @foreach($recent_activities as $activity)
        <div class="flex items-start space-x-4 pb-3 border-b border-gray-100 last:border-0">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 rounded-full
                    {{ $activity->action === 'create' ? 'bg-green-100' : '' }}
                    {{ $activity->action === 'update' ? 'bg-blue-100' : '' }}
                    {{ $activity->action === 'delete' ? 'bg-red-100' : '' }}
                    {{ $activity->action === 'login' ? 'bg-purple-100' : '' }}
                    flex items-center justify-center">
                    <i class="fas
                        {{ $activity->action === 'create' ? 'fa-plus text-green-600' : '' }}
                        {{ $activity->action === 'update' ? 'fa-edit text-blue-600' : '' }}
                        {{ $activity->action === 'delete' ? 'fa-trash text-red-600' : '' }}
                        {{ $activity->action === 'login' ? 'fa-sign-in-alt text-purple-600' : '' }}"></i>
                </div>
            </div>
            <div class="flex-1">
                <p class="text-sm text-gray-900">
                    <span class="font-semibold">{{ $activity->user ? $activity->user->name : 'System' }}</span>
                    <span class="text-gray-600"> {{ $activity->action }}</span>
                    <span class="font-medium"> {{ $activity->model_type }}</span>
                    @if($activity->model_id)
                        <span class="text-gray-600">#{{ $activity->model_id }}</span>
                    @endif
                </p>
                <p class="text-xs text-gray-500 mt-1">{{ $activity->created_at->diffForHumans() }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Today's Schedule & Secondary Stats -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Today's Class Schedule -->
    @if($today_schedule->count() > 0)
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-calendar-day mr-2 text-indigo-600"></i>
                    Today's Schedule
                </h3>
                <a href="{{ route('admin.schedules.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        <div class="p-6">
            <div class="space-y-3">
                @foreach($today_schedule->take(4) as $schedule)
                <div class="border-l-4 border-indigo-500 bg-gradient-to-r from-indigo-50 to-purple-50 p-3 rounded-r-lg">
                    <h4 class="font-bold text-gray-900 text-sm">
                        {{ $schedule->subject ? $schedule->subject->subject_name : 'N/A' }}
                    </h4>
                    <p class="text-xs text-gray-600 mt-1">
                        <i class="fas fa-user-tie mr-1"></i>
                        {{ $schedule->teacher ? $schedule->teacher->first_name . ' ' . $schedule->teacher->last_name : 'TBA' }}
                    </p>
                    <p class="text-xs text-indigo-700 mt-1">
                        <i class="fas fa-clock mr-1"></i>
                        {{ date('g:i A', strtotime($schedule->start_time)) }} - {{ date('g:i A', strtotime($schedule->end_time)) }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Admission Status Chart -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Admission Status</h3>
        <div class="space-y-4">
            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-gray-600">Pending</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $admission_stats['pending'] }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $stats['total_admissions'] > 0 ? ($admission_stats['pending'] / $stats['total_admissions']) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-gray-600">Under Review</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $admission_stats['under_review'] }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $stats['total_admissions'] > 0 ? ($admission_stats['under_review'] / $stats['total_admissions']) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-gray-600">Approved</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $admission_stats['approved'] }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-500 h-2 rounded-full" style="width: {{ $stats['total_admissions'] > 0 ? ($admission_stats['approved'] / $stats['total_admissions']) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-gray-600">Rejected</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $admission_stats['rejected'] }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-red-500 h-2 rounded-full" style="width: {{ $stats['total_admissions'] > 0 ? ($admission_stats['rejected'] / $stats['total_admissions']) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Secondary Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Courses -->
    <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Courses</p>
                <p class="text-3xl font-bold text-gray-900 mt-2" data-counter="{{ $stats['total_courses'] }}">0</p>
            </div>
            <div class="bg-blue-100 rounded-full p-3">
                <i class="fas fa-book text-2xl text-blue-600"></i>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('admin.courses.index') }}" class="text-xs text-blue-600 hover:text-blue-800">
                Manage Courses <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>

    <!-- Total Schedules -->
    <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Class Schedules</p>
                <p class="text-3xl font-bold text-gray-900 mt-2" data-counter="{{ $stats['total_schedules'] }}">0</p>
            </div>
            <div class="bg-indigo-100 rounded-full p-3">
                <i class="fas fa-calendar-week text-2xl text-indigo-600"></i>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('admin.schedules.index') }}" class="text-xs text-indigo-600 hover:text-indigo-800">
                Manage Schedules <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>

    <!-- Total Blog Posts -->
    <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Blog Posts</p>
                <p class="text-3xl font-bold text-gray-900 mt-2" data-counter="{{ $stats['total_posts'] }}">0</p>
            </div>
            <div class="bg-pink-100 rounded-full p-3">
                <i class="fas fa-blog text-2xl text-pink-600"></i>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('admin.posts.index') }}" class="text-xs text-pink-600 hover:text-pink-800">
                Manage Posts <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>

    <!-- Total Stories -->
    <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Success Stories</p>
                <p class="text-3xl font-bold text-gray-900 mt-2" data-counter="{{ $stats['total_stories'] }}">0</p>
            </div>
            <div class="bg-orange-100 rounded-full p-3">
                <i class="fas fa-star text-2xl text-orange-600"></i>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('admin.stories.index') }}" class="text-xs text-orange-600 hover:text-orange-800">
                Manage Stories <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
</div>

<!-- Recent Data Sections -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Recent Admissions -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Recent Admissions</h3>
                <a href="{{ route('admin.admissions.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View All</a>
            </div>
        </div>
        <div class="p-6">
            @if($recent_admissions->count() > 0)
                <div class="space-y-4">
                    @foreach($recent_admissions as $admission)
                    <div class="flex items-center justify-between pb-4 border-b border-gray-200 last:border-0">
                        <div>
                            <p class="font-medium text-gray-900">{{ $admission->full_name }}</p>
                            <p class="text-sm text-gray-500">{{ $admission->grade_level }} • {{ $admission->email }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $admission->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $admission->status === 'Under Review' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $admission->status === 'Approved' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $admission->status === 'Rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ $admission->status }}
                            </span>
                            <p class="text-xs text-gray-500 mt-1">{{ $admission->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">No recent admissions</p>
            @endif
        </div>
    </div>

    <!-- Recent Messages -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Recent Contact Messages</h3>
                <a href="{{ route('admin.contact-messages.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View All</a>
            </div>
        </div>
        <div class="p-6">
            @if($recent_messages->count() > 0)
                <div class="space-y-4">
                    @foreach($recent_messages as $message)
                    <div class="flex items-start justify-between pb-4 border-b border-gray-200 last:border-0">
                        <div class="flex-1">
                            <div class="flex items-center">
                                <p class="font-medium text-gray-900">{{ $message->name }}</p>
                                @if($message->status === 'unread')
                                <span class="ml-2 h-2 w-2 bg-red-500 rounded-full"></span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600 mt-1">{{ $message->subject }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ Str::limit($message->message, 60) }}</p>
                        </div>
                        <div class="text-right ml-4">
                            <p class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">No recent messages</p>
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
function animateCounter(element) {
    const target = parseInt(element.getAttribute('data-counter'));
    const duration = 2000;
    const increment = target / (duration / 16);
    let current = 0;

    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 16);
}

// Animate all counters when page loads
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-counter]').forEach(element => {
        animateCounter(element);
    });
});

// User Growth Chart
const userTrendData = @json($user_trend);
const userCtx = document.getElementById('userGrowthChart');
if (userCtx) {
    new Chart(userCtx, {
        type: 'line',
        data: {
            labels: userTrendData.labels,
            datasets: [{
                label: 'New Users',
                data: userTrendData.values,
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 3,
                pointRadius: 4,
                pointHoverRadius: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    cornerRadius: 8,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                    grid: { color: 'rgba(0, 0, 0, 0.05)' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
}

// Admission Trend Chart
const monthlyData = @json($monthly_admissions);
const months = monthlyData.map(item => {
    const date = new Date(item.month + '-01');
    return date.toLocaleDateString('en-US', { month: 'short', year: 'numeric' });
});
const totals = monthlyData.map(item => item.total);

const admissionCtx = document.getElementById('admissionTrendChart');
if (admissionCtx) {
    new Chart(admissionCtx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Admissions',
                data: totals,
                borderColor: 'rgb(168, 85, 247)',
                backgroundColor: 'rgba(168, 85, 247, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 3,
                pointRadius: 5,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    cornerRadius: 8,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                    grid: { color: 'rgba(0, 0, 0, 0.05)' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
}

// Dashboard Search
document.getElementById('dashboard-search')?.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    // Add your search logic here
    console.log('Searching for:', searchTerm);
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

/* Pulse Animation */
.pulse {
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

/* Modern card hover effects */
.modern-card {
    transition: all 0.3s ease;
}

.modern-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.3);
}

/* Card Interactive */
.card-interactive {
    transition: all 0.3s ease;
}

/* Modern shadows */
.shadow-modern-lg {
    box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Fade in animations */
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

/* Scale in animation */
@keyframes scaleIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.scale-in {
    animation: scaleIn 0.5s ease-out forwards;
}

/* Stagger animation delay */
[data-stagger]:nth-child(1) { animation-delay: 0.1s; }
[data-stagger]:nth-child(2) { animation-delay: 0.2s; }
[data-stagger]:nth-child(3) { animation-delay: 0.3s; }
[data-stagger]:nth-child(4) { animation-delay: 0.4s; }

/* Glow effect on hover */
.group:hover .bg-white\/20 {
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
}
</style>
@endpush
