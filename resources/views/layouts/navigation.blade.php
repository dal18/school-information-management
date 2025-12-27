<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Side: Logo & Navigation Links -->
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.dashboard') }}" class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo.png') }}" alt="LFHS Logo" class="h-10 w-10 rounded-full border-2 border-primary-500">
                        <div class="hidden md:block">
                            <h1 class="text-sm font-bold text-gray-800 dark:text-white">Little Flower High School</h1>
                            <p class="text-xs text-gray-500 dark:text-gray-400">School Management</p>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
                    @if(auth()->user()->isAdmin())
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            <i class="fas fa-tachometer-alt mr-2"></i>{{ __('Dashboard') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('student.dashboard')" :active="request()->routeIs('student.dashboard')">
                            <i class="fas fa-tachometer-alt mr-2"></i>{{ __('Dashboard') }}
                        </x-nav-link>
                    @endif

                    @if(Route::has('calendar.index'))
                        <x-nav-link :href="route('calendar.index')" :active="request()->routeIs('calendar.index')">
                            <i class="fas fa-calendar mr-2"></i>{{ __('Calendar') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Right Side: Notifications & User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-4">
                <!-- Notifications Bell -->
                @if(Route::has('notifications.index') && Route::has('notifications.unread-count'))
                    <div class="relative" x-data="{ unreadCount: 0 }"
                         x-init="
                             fetch('{{ route('notifications.unread-count') }}')
                                 .then(res => res.json())
                                 .then(data => unreadCount = data.count)
                                 .catch(err => console.error('Failed to fetch notifications:', err));
                         ">
                        <a href="{{ route('notifications.index') }}"
                           class="relative p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition">
                            <i class="fas fa-bell text-xl"></i>
                            <span x-show="unreadCount > 0"
                                  x-text="unreadCount > 9 ? '9+' : unreadCount"
                                  class="absolute -top-1 -right-1 px-1.5 py-0.5 text-xs font-bold bg-red-500 text-white rounded-full min-w-[18px] text-center"></span>
                        </a>
                    </div>
                @endif

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <!-- User Avatar -->
                            @if(auth()->user()->profile_image)
                                <img src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                                     alt="{{ auth()->user()->name }}"
                                     class="h-8 w-8 rounded-full object-cover mr-2">
                            @else
                                <div class="h-8 w-8 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center mr-2">
                                    <span class="text-white font-bold text-xs">
                                        {{ strtoupper(substr(auth()->user()->first_name ?? auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?? '', 0, 1)) }}
                                    </span>
                                </div>
                            @endif

                            <div class="text-left mr-2">
                                <div class="font-medium text-sm text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->access_rights ?? 'User' }}</div>
                            </div>

                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Profile Header -->
                        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                            <div class="font-medium text-sm text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                        </div>

                        <!-- Menu Items -->
                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="fas fa-user-circle w-4 mr-2"></i>{{ __('My Profile') }}
                        </x-dropdown-link>

                        @if(Route::has('calendar.index'))
                            <x-dropdown-link :href="route('calendar.index')">
                                <i class="fas fa-calendar w-4 mr-2"></i>{{ __('Calendar') }}
                            </x-dropdown-link>
                        @endif

                        @if(Route::has('notifications.index'))
                            <x-dropdown-link :href="route('notifications.index')">
                                <i class="fas fa-bell w-4 mr-2"></i>{{ __('Notifications') }}
                            </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-100 dark:border-gray-700"></div>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt w-4 mr-2 text-red-500"></i>
                                <span class="text-red-600 dark:text-red-400">{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Hamburger Menu -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Navigation Links -->
        <div class="pt-2 pb-3 space-y-1">
            @if(auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    <i class="fas fa-tachometer-alt mr-2"></i>{{ __('Dashboard') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('student.dashboard')" :active="request()->routeIs('student.dashboard')">
                    <i class="fas fa-tachometer-alt mr-2"></i>{{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endif

            @if(Route::has('calendar.index'))
                <x-responsive-nav-link :href="route('calendar.index')" :active="request()->routeIs('calendar.index')">
                    <i class="fas fa-calendar mr-2"></i>{{ __('Calendar') }}
                </x-responsive-nav-link>
            @endif

            @if(Route::has('notifications.index'))
                <x-responsive-nav-link :href="route('notifications.index')" :active="request()->routeIs('notifications.index')"
                    x-data="{ unreadCount: 0 }"
                    x-init="
                        fetch('{{ route('notifications.unread-count') }}')
                            .then(res => res.json())
                            .then(data => unreadCount = data.count)
                            .catch(err => console.error('Failed to fetch notifications:', err));
                    ">
                    <i class="fas fa-bell mr-2"></i>{{ __('Notifications') }}
                    <span x-show="unreadCount > 0" x-text="'(' + unreadCount + ')'" class="ml-2 text-red-500 font-bold"></span>
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- User Settings (Mobile) -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4 flex items-center space-x-3">
                @if(auth()->user()->profile_image)
                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                         alt="{{ auth()->user()->name }}"
                         class="h-12 w-12 rounded-full object-cover">
                @else
                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center">
                        <span class="text-white font-bold">
                            {{ strtoupper(substr(auth()->user()->first_name ?? auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?? '', 0, 1)) }}
                        </span>
                    </div>
                @endif
                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="fas fa-user-circle mr-2"></i>{{ __('My Profile') }}
                </x-responsive-nav-link>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
