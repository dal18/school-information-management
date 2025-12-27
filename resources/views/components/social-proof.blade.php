@props(['recentActivities' => collect(), 'activeStudentsCount' => 0])

<!-- Social Proof & Live Stats Widget -->
<section class="py-16 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Active Students Counter -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-primary-100 hover:border-primary-300 transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-graduate text-2xl text-primary-600"></i>
                    </div>
                    <div class="px-3 py-1 bg-accent-100 text-accent-700 rounded-full text-xs font-semibold">
                        <i class="fas fa-circle mr-1"></i>Live
                    </div>
                </div>
                <div class="text-4xl font-bold text-gray-900 mb-1">
                    {{ number_format($activeStudentsCount) }}
                </div>
                <p class="text-gray-600 text-sm">Active Students</p>
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <div class="flex items-center text-xs text-accent-600">
                        <i class="fas fa-check-circle mr-1"></i>
                        <span>Enrolled & Active</span>
                    </div>
                </div>
            </div>

            <!-- Graduation Rate -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-accent-100 hover:border-accent-300 transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-accent-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-chart-line text-2xl text-accent-600"></i>
                    </div>
                    <div class="text-accent-600">
                        <i class="fas fa-trophy text-2xl"></i>
                    </div>
                </div>
                <div class="text-4xl font-bold text-gray-900 mb-1">
                    95%
                </div>
                <p class="text-gray-600 text-sm">Graduation Rate</p>
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-accent-500 h-2 rounded-full" style="width: 95%"></div>
                    </div>
                </div>
            </div>

            <!-- College Acceptance -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-secondary-100 hover:border-secondary-300 transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-secondary-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-university text-2xl text-secondary-600"></i>
                    </div>
                    <div class="text-secondary-600">
                        <i class="fas fa-medal text-2xl"></i>
                    </div>
                </div>
                <div class="text-4xl font-bold text-gray-900 mb-1">
                    88%
                </div>
                <p class="text-gray-600 text-sm">College Acceptance</p>
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <p class="text-xs text-gray-500">
                        Top universities nationwide
                    </p>
                </div>
            </div>

            <!-- Parent Satisfaction -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-primary-100 hover:border-primary-300 transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-heart text-2xl text-primary-600"></i>
                    </div>
                    <div class="flex gap-1">
                        <i class="fas fa-star text-secondary-500 text-sm"></i>
                        <i class="fas fa-star text-secondary-500 text-sm"></i>
                        <i class="fas fa-star text-secondary-500 text-sm"></i>
                        <i class="fas fa-star text-secondary-500 text-sm"></i>
                        <i class="fas fa-star text-secondary-500 text-sm"></i>
                    </div>
                </div>
                <div class="text-4xl font-bold text-gray-900 mb-1">
                    4.9/5
                </div>
                <p class="text-gray-600 text-sm">Parent Satisfaction</p>
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <p class="text-xs text-gray-500">
                        Based on 200+ reviews
                    </p>
                </div>
            </div>
        </div>

        <!-- Recent Activity Feed -->
        <div class="mt-12 bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-rss mr-3 text-primary-600"></i>
                    Recent Activity
                </h3>
                <span class="px-3 py-1 bg-accent-100 text-accent-700 rounded-full text-xs font-semibold">
                    <i class="fas fa-circle mr-1"></i>Live Updates
                </span>
            </div>

            @if($recentActivities->count() > 0)
                <div class="space-y-4">
                    @foreach($recentActivities as $activity)
                        <div class="flex items-center gap-4 p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                            <div class="w-10 h-10 bg-{{ $activity['color'] }}-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas {{ $activity['icon'] }} text-{{ $activity['color'] }}-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $activity['text'] }}</p>
                                <p class="text-xs text-gray-500">{{ $activity['time'] }}</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">No recent activities to display</p>
                </div>
            @endif
        </div>

        <!-- Trust Badges -->
        <div class="mt-12">
            <h3 class="text-center text-sm font-semibold text-gray-500 uppercase tracking-wider mb-6">
                Accredited & Recognized By
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 flex items-center justify-center hover:shadow-md transition-shadow duration-200">
                    <div class="text-center">
                        <i class="fas fa-certificate text-4xl text-primary-600 mb-2"></i>
                        <p class="text-xs text-gray-600 font-medium">DepEd Certified</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 flex items-center justify-center hover:shadow-md transition-shadow duration-200">
                    <div class="text-center">
                        <i class="fas fa-shield-alt text-4xl text-accent-600 mb-2"></i>
                        <p class="text-xs text-gray-600 font-medium">ISO Certified</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 flex items-center justify-center hover:shadow-md transition-shadow duration-200">
                    <div class="text-center">
                        <i class="fas fa-award text-4xl text-secondary-600 mb-2"></i>
                        <p class="text-xs text-gray-600 font-medium">Award Winning</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 flex items-center justify-center hover:shadow-md transition-shadow duration-200">
                    <div class="text-center">
                        <i class="fas fa-globe text-4xl text-primary-600 mb-2"></i>
                        <p class="text-xs text-gray-600 font-medium">Int'l Standards</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
