<!-- Dashboard Preview Widgets (Only shown to authenticated users) -->
@auth
<section class="py-16 bg-gradient-to-br from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-display font-bold text-gray-900 mb-2">
                    Welcome Back, {{ Auth::user()->name }}!
                </h2>
                <p class="text-gray-600">Here's your quick overview</p>
            </div>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-200">
                <i class="fas fa-th-large"></i>
                <span>Full Dashboard</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <!-- Quick Stats Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Attendance Card -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-primary-100 hover:border-primary-300 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-calendar-check text-2xl text-primary-600"></i>
                    </div>
                    <span class="px-3 py-1 bg-accent-100 text-accent-700 rounded-full text-xs font-semibold">
                        This Month
                    </span>
                </div>
                <div class="text-4xl font-bold text-gray-900 mb-1">
                    95%
                </div>
                <p class="text-gray-600 text-sm">Attendance Rate</p>
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-accent-500 h-2 rounded-full" style="width: 95%"></div>
                    </div>
                </div>
            </div>

            <!-- Current GPA Card -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-secondary-100 hover:border-secondary-300 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-secondary-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-chart-line text-2xl text-secondary-600"></i>
                    </div>
                    <span class="px-3 py-1 bg-secondary-100 text-secondary-700 rounded-full text-xs font-semibold">
                        Current
                    </span>
                </div>
                <div class="text-4xl font-bold text-gray-900 mb-1">
                    3.8
                </div>
                <p class="text-gray-600 text-sm">Current GPA</p>
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <div class="flex items-center text-xs text-accent-600">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>+0.2 from last term</span>
                    </div>
                </div>
            </div>

            <!-- Pending Assignments Card -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-accent-100 hover:border-accent-300 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-accent-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-tasks text-2xl text-accent-600"></i>
                    </div>
                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                        Due Soon
                    </span>
                </div>
                <div class="text-4xl font-bold text-gray-900 mb-1">
                    3
                </div>
                <p class="text-gray-600 text-sm">Pending Assignments</p>
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <a href="{{ route('dashboard') }}" class="text-xs text-accent-600 hover:text-accent-700 font-medium">
                        View all assignments <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>

            <!-- Upcoming Events Card -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-primary-100 hover:border-primary-300 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-2xl text-primary-600"></i>
                    </div>
                    <span class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-xs font-semibold">
                        This Week
                    </span>
                </div>
                <div class="text-4xl font-bold text-gray-900 mb-1">
                    5
                </div>
                <p class="text-gray-600 text-sm">Upcoming Events</p>
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <a href="{{ route('dashboard') }}" class="text-xs text-primary-600 hover:text-primary-700 font-medium">
                        View calendar <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Access Cards -->
        <div class="grid md:grid-cols-2 gap-6">
            <!-- Recent Announcements -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-bullhorn mr-3 text-primary-600"></i>
                        Recent Announcements
                    </h3>
                    <a href="{{ route('announcements') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                        View All
                    </a>
                </div>
                <div class="space-y-4">
                    <!-- Sample Announcement 1 -->
                    <div class="flex items-start gap-4 p-3 hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-megaphone text-primary-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Midterm Exam Schedule Released</p>
                            <p class="text-xs text-gray-500 mt-1">Posted 2 hours ago</p>
                        </div>
                    </div>

                    <!-- Sample Announcement 2 -->
                    <div class="flex items-start gap-4 p-3 hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="w-10 h-10 bg-accent-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-trophy text-accent-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Sports Day Registration Now Open</p>
                            <p class="text-xs text-gray-500 mt-1">Posted 1 day ago</p>
                        </div>
                    </div>

                    <!-- Sample Announcement 3 -->
                    <div class="flex items-start gap-4 p-3 hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="w-10 h-10 bg-secondary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-book text-secondary-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">New Library Books Available</p>
                            <p class="text-xs text-gray-500 mt-1">Posted 2 days ago</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Schedule -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-clock mr-3 text-accent-600"></i>
                        Today's Schedule
                    </h3>
                    <a href="{{ route('schedules') }}" class="text-sm text-accent-600 hover:text-accent-700 font-medium">
                        Full Schedule
                    </a>
                </div>
                <div class="space-y-4">
                    <!-- Sample Schedule 1 -->
                    <div class="flex items-center gap-4 p-3 border-l-4 border-primary-500 bg-primary-50 rounded-r-lg">
                        <div class="text-center flex-shrink-0">
                            <div class="text-xl font-bold text-primary-700">8:00</div>
                            <div class="text-xs text-primary-600">AM</div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Mathematics</p>
                            <p class="text-xs text-gray-600">Room 201 • Mr. Johnson</p>
                        </div>
                        <span class="px-2 py-1 bg-accent-500 text-white text-xs rounded-full">Now</span>
                    </div>

                    <!-- Sample Schedule 2 -->
                    <div class="flex items-center gap-4 p-3 border-l-4 border-gray-300 bg-gray-50 rounded-r-lg">
                        <div class="text-center flex-shrink-0">
                            <div class="text-xl font-bold text-gray-700">10:00</div>
                            <div class="text-xs text-gray-600">AM</div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Science</p>
                            <p class="text-xs text-gray-600">Lab 1 • Mrs. Smith</p>
                        </div>
                    </div>

                    <!-- Sample Schedule 3 -->
                    <div class="flex items-center gap-4 p-3 border-l-4 border-gray-300 bg-gray-50 rounded-r-lg">
                        <div class="text-center flex-shrink-0">
                            <div class="text-xl font-bold text-gray-700">1:00</div>
                            <div class="text-xs text-gray-600">PM</div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">English Literature</p>
                            <p class="text-xs text-gray-600">Room 105 • Ms. Davis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 bg-gradient-to-r from-primary-600 to-primary-700 rounded-2xl p-6 shadow-lg">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="text-white">
                    <h3 class="text-xl font-bold mb-1">Quick Actions</h3>
                    <p class="text-primary-100 text-sm">Access commonly used features</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 text-white font-medium px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-file-alt"></i>
                        <span>Submit Assignment</span>
                    </a>
                    <a href="{{ route('schedules') }}" class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 text-white font-medium px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-calendar"></i>
                        <span>View Schedule</span>
                    </a>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 text-white font-medium px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-book-reader"></i>
                        <span>Library Access</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endauth
