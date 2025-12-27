<header class="bg-white shadow-md border-b-2 border-primary-500">
    <div class="flex items-center justify-between px-6 py-3">
        <!-- Left Side - Logo & Title -->
        <div class="flex items-center space-x-4">
            <!-- Mobile menu button -->
            <button @click="sidebarOpen = !sidebarOpen"
                    class="text-gray-500 hover:text-gray-700 focus:outline-none md:hidden transition p-2 rounded-lg hover:bg-gray-100 active:scale-95">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Logo & School Name -->
            <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.dashboard') }}" class="flex items-center space-x-3 group">
                <img src="{{ asset('images/logo.png') }}" alt="LFHS Logo" class="h-12 w-12 rounded-full border-2 border-primary-500 shadow-md transition-transform duration-300 group-hover:scale-110">
                <div class="hidden md:block">
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-purple-600 bg-clip-text text-transparent">
                        Little Flower High School
                    </h1>
                    <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold">Admin Panel</p>
                </div>
            </a>
        </div>

        <!-- Center - Search Bar -->
        <div class="hidden lg:flex flex-1 justify-center px-4 max-w-md">
            <div class="w-full">
                <label for="search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input id="search"
                           name="search"
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-gray-50 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white sm:text-sm transition"
                           placeholder="Search anything..."
                           type="search">
                </div>
            </div>
        </div>

        <!-- Right Side - Notifications & Profile -->
        <div class="flex items-center space-x-3">
            <!-- Notifications Dropdown -->
            <div class="relative" x-data="{ open: false, unreadCount: 0, notifications: [] }"
                 x-init="
                     fetch('{{ route('notifications.unread-count') }}')
                         .then(res => res.json())
                         .then(data => unreadCount = data.count);
                     setInterval(() => {
                         fetch('{{ route('notifications.unread-count') }}')
                             .then(res => res.json())
                             .then(data => unreadCount = data.count);
                     }, 30000);
                 ">
                <button @click="open = !open; if(open && notifications.length === 0) {
                            fetch('{{ route('notifications.recent') }}')
                                .then(res => res.json())
                                .then(data => notifications = data);
                        }"
                        class="relative p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg focus:outline-none transition">
                    <i class="fas fa-bell text-xl"></i>
                    <span x-show="unreadCount > 0"
                          x-text="unreadCount > 9 ? '9+' : unreadCount"
                          class="absolute top-0 right-0 px-1.5 py-0.5 text-xs font-bold bg-red-500 text-white rounded-full min-w-[20px] text-center"></span>
                </button>

                <!-- Notification Dropdown -->
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     @click.away="open = false"
                     class="absolute right-0 mt-2 w-96 bg-white rounded-lg shadow-xl border border-gray-200 z-50"
                     style="display: none;">
                    <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-gray-900">Notifications</h3>
                        <a href="{{ route('notifications.index') }}" class="text-xs text-primary-600 hover:text-primary-800">View All</a>
                    </div>
                    <div class="max-h-96 overflow-y-auto">
                        <template x-if="notifications.length === 0">
                            <div class="px-4 py-8 text-center text-gray-500">
                                <i class="fas fa-bell-slash text-3xl mb-2"></i>
                                <p class="text-sm">No notifications yet</p>
                            </div>
                        </template>
                        <template x-for="notification in notifications" :key="notification.id">
                            <a :href="notification.link || '{{ route('notifications.index') }}'"
                               class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition"
                               :class="!notification.is_read ? 'bg-blue-50' : ''">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 mt-1">
                                        <i :class="'fas fa-' + getIcon(notification.type) + ' text-primary-600'"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900" x-text="notification.title"></p>
                                        <p class="text-xs text-gray-600 mt-1 line-clamp-2" x-text="notification.message"></p>
                                        <p class="text-xs text-gray-500 mt-1" x-text="formatTime(notification.created_at)"></p>
                                    </div>
                                    <template x-if="!notification.is_read">
                                        <span class="flex-shrink-0 w-2 h-2 bg-blue-600 rounded-full mt-2"></span>
                                    </template>
                                </div>
                            </a>
                        </template>
                    </div>
                    <div class="px-4 py-3 border-t border-gray-200 text-center">
                        <a href="{{ route('notifications.index') }}" class="text-sm text-primary-600 hover:text-primary-800 font-medium">
                            See All Notifications
                        </a>
                    </div>
                </div>
            </div>

            <script>
                function getIcon(type) {
                    const icons = {
                        'admission': 'user-graduate',
                        'schedule': 'calendar-alt',
                        'announcement': 'bullhorn',
                        'feedback': 'comment-dots',
                        'activity': 'calendar-check',
                        'post': 'newspaper',
                        'story': 'book-open'
                    };
                    return icons[type] || 'bell';
                }

                function formatTime(dateString) {
                    const date = new Date(dateString);
                    const now = new Date();
                    const diffInSeconds = Math.floor((now - date) / 1000);

                    if (diffInSeconds < 60) return 'Just now';
                    if (diffInSeconds < 3600) return Math.floor(diffInSeconds / 60) + 'm ago';
                    if (diffInSeconds < 86400) return Math.floor(diffInSeconds / 3600) + 'h ago';
                    if (diffInSeconds < 604800) return Math.floor(diffInSeconds / 86400) + 'd ago';
                    return date.toLocaleDateString();
                }
            </script>

            <!-- Messages -->
            @if(auth()->user()->isStudent())
                <a href="{{ route('student.contact-messages.index') }}" class="relative p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg focus:outline-none transition">
                    <i class="fas fa-envelope text-xl"></i>
                    @php
                        $unseenReplies = \App\Models\ContactMessage::where(function($q) {
                                $q->where('user_id', auth()->id())
                                  ->orWhere('email', auth()->user()->email);
                            })
                            ->where('status', 'responded')
                            ->where('user_has_seen_reply', false)
                            ->count();
                    @endphp
                    @if($unseenReplies > 0)
                        <span class="absolute top-0 right-0 px-1.5 py-0.5 text-xs font-bold bg-blue-500 text-white rounded-full">{{ $unseenReplies }}</span>
                    @endif
                </a>
            @else
                <a href="{{ route('admin.contact-messages.index') }}" class="relative p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg focus:outline-none transition">
                    <i class="fas fa-envelope text-xl"></i>
                    @php
                        $unreadCount = \App\Models\ContactMessage::where('status', 'unread')->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span class="absolute top-0 right-0 px-1.5 py-0.5 text-xs font-bold bg-red-500 text-white rounded-full">{{ $unreadCount }}</span>
                    @endif
                </a>
            @endif

            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                        class="flex items-center space-x-3 hover:bg-gray-50 rounded-lg px-3 py-2 transition focus:outline-none">
                    @if(auth()->user()->profile_image)
                        <img src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                             alt="{{ auth()->user()->name }}"
                             class="h-10 w-10 rounded-full object-cover border-2 border-primary-500 shadow-sm">
                    @else
                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-primary-500 to-purple-600 flex items-center justify-center border-2 border-primary-500 shadow-sm">
                            <span class="text-white font-bold text-sm">
                                {{ strtoupper(substr(auth()->user()->first_name ?? auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?? '', 0, 1)) }}
                            </span>
                        </div>
                    @endif
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->access_rights ?? 'Admin' }}</p>
                    </div>
                    <i class="fas fa-chevron-down text-xs text-gray-400 hidden md:block"></i>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     @click.away="open = false"
                     class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50"
                     style="display: none;">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition">
                        <i class="fas fa-user-circle mr-3 w-4"></i>My Profile
                    </a>
                    <a href="{{ route('home') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition">
                        <i class="fas fa-globe mr-3 w-4"></i>View Website
                    </a>
                    <div class="border-t border-gray-200 my-2"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                            <i class="fas fa-sign-out-alt mr-3 w-4"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
