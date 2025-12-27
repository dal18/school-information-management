<nav x-data="{ open: false }" class="bg-blue-900 border-b border-blue-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo.png') }}" alt="LFHS Logo" class="h-10 w-10 rounded-full">
                        <div class="hidden sm:block">
                            <div class="text-white font-bold text-lg leading-tight">Little Flower High School</div>
                            <div class="text-blue-200 text-xs">Excellence in Education</div>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out {{ request()->routeIs('home') ? 'border-blue-400 text-white focus:border-blue-300' : 'border-transparent text-blue-200 hover:text-white hover:border-blue-300 focus:text-white focus:border-blue-300' }}">
                        Home
                    </a>

                    <!-- About Dropdown -->
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-blue-200 hover:text-white hover:border-blue-300 focus:outline-none focus:text-white focus:border-blue-300 transition duration-150 ease-in-out">
                                    <div>About</div>
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('about')">About Us</x-dropdown-link>
                                <x-dropdown-link :href="route('history')">Our History</x-dropdown-link>
                                <x-dropdown-link :href="route('mission-vision')">Mission & Vision</x-dropdown-link>
                                <x-dropdown-link :href="route('alma-mater')">Alma Mater Hymn</x-dropdown-link>
                                <x-dropdown-link :href="route('administration')">Administration</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <!-- Academics Dropdown -->
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-blue-200 hover:text-white hover:border-blue-300 focus:outline-none focus:text-white focus:border-blue-300 transition duration-150 ease-in-out">
                                    <div>Academics</div>
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('admissions')">Admissions</x-dropdown-link>
                                <x-dropdown-link :href="route('courses')">Courses</x-dropdown-link>
                                <x-dropdown-link :href="route('schedules')">Class Schedules</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <!-- Campus Life Dropdown -->
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-blue-200 hover:text-white hover:border-blue-300 focus:outline-none focus:text-white focus:border-blue-300 transition duration-150 ease-in-out">
                                    <div>Campus Life</div>
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('activities')">Activities</x-dropdown-link>
                                <x-dropdown-link :href="route('facilities')">Facilities</x-dropdown-link>
                                <x-dropdown-link :href="route('announcements')">Announcements</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <a href="{{ route('blog') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out {{ request()->routeIs('blog') ? 'border-blue-400 text-white focus:border-blue-300' : 'border-transparent text-blue-200 hover:text-white hover:border-blue-300 focus:text-white focus:border-blue-300' }}">
                        News
                    </a>

                    <a href="{{ route('contact') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out {{ request()->routeIs('contact') ? 'border-blue-400 text-white focus:border-blue-300' : 'border-transparent text-blue-200 hover:text-white hover:border-blue-300 focus:text-white focus:border-blue-300' }}">
                        Contact
                    </a>
                </div>
            </div>

            <!-- Right Side (Search, Feedback, Notifications, Auth Links) -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-2">
                <!-- Search Button -->
                <button @click="$dispatch('open-search')" class="p-2 text-blue-200 hover:text-white hover:bg-blue-800 rounded-lg transition duration-150">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>

                @auth
                    <!-- Notifications -->
                    <div class="relative" x-data="{ open: false, unreadCount: {{ auth()->check() && auth()->user()->access_rights === 'Student' ? (isset($sidebarStats['unseen_replies']) ? $sidebarStats['unseen_replies'] : 0) : 0 }} }">
                        <button @click="open = !open" class="relative p-2 text-blue-200 hover:text-white hover:bg-blue-800 rounded-lg transition duration-150">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span x-show="unreadCount > 0" class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                                <span x-text="unreadCount"></span>
                            </span>
                        </button>

                        <!-- Notifications Dropdown -->
                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-50 border border-gray-200">
                            <div class="p-4 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900">Notifications</h3>
                            </div>
                            <div class="max-h-96 overflow-y-auto">
                                @if(auth()->user()->access_rights === 'Student' && isset($sidebarStats['unseen_replies']) && $sidebarStats['unseen_replies'] > 0)
                                    <a href="{{ route('student.contact-messages.index') }}" class="block p-4 hover:bg-gray-50 border-b border-gray-100">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <p class="text-sm font-medium text-gray-900">New Message Replies</p>
                                                <p class="text-sm text-gray-500">You have {{ $sidebarStats['unseen_replies'] }} new {{ $sidebarStats['unseen_replies'] == 1 ? 'reply' : 'replies' }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @else
                                    <div class="p-8 text-center text-gray-500">
                                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                        </svg>
                                        <p class="text-sm">No new notifications</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Feedback Link -->
                    <a href="{{ auth()->user()->access_rights === 'Student' ? route('student.feedback') : route('feedback') }}" class="p-2 text-blue-200 hover:text-white hover:bg-blue-800 rounded-lg transition duration-150" title="Send Feedback">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                    </a>

                    <!-- User Dropdown with Profile Picture -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-white hover:text-gray-200 focus:outline-none transition duration-150 ease-in-out">
                                <div class="flex items-center space-x-2">
                                    <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-avatar.png') }}"
                                         alt="{{ Auth::user()->name }}"
                                         class="h-8 w-8 rounded-full object-cover border-2 border-blue-400">
                                    <span class="hidden md:block">{{ Auth::user()->name }}</span>
                                    <svg class="ml-1 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-avatar.png') }}"
                                         alt="{{ Auth::user()->name }}"
                                         class="h-10 w-10 rounded-full object-cover">
                                    <div>
                                        <div class="font-medium text-gray-800">{{ Auth::user()->name }}</div>
                                        <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>
                            </div>
                            <x-dropdown-link :href="route('dashboard')">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Dashboard
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profile
                            </x-dropdown-link>

                            <div class="border-t border-gray-100"></div>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <!-- Feedback for Guests -->
                    <a href="{{ route('feedback') }}" class="p-2 text-blue-200 hover:text-white hover:bg-blue-800 rounded-lg transition duration-150" title="Send Feedback">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                    </a>

                    <a href="{{ route('login') }}" class="text-blue-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Log in</a>
                    <a href="{{ route('register') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-blue-200 hover:text-white hover:bg-blue-800 focus:outline-none focus:bg-blue-800 focus:text-white transition duration-150 ease-in-out">
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
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                Home
            </x-responsive-nav-link>

            <!-- About Links -->
            <div class="border-t border-blue-800 pt-2 mt-2">
                <div class="px-4 py-2 text-xs font-semibold text-blue-300 uppercase">About</div>
                <x-responsive-nav-link :href="route('about')">About Us</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('history')">Our History</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('mission-vision')">Mission & Vision</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('alma-mater')">Alma Mater Hymn</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('administration')">Administration</x-responsive-nav-link>
            </div>

            <!-- Academics Links -->
            <div class="border-t border-blue-800 pt-2 mt-2">
                <div class="px-4 py-2 text-xs font-semibold text-blue-300 uppercase">Academics</div>
                <x-responsive-nav-link :href="route('admissions')">Admissions</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('courses')">Courses</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('schedules')">Class Schedules</x-responsive-nav-link>
            </div>

            <!-- Campus Life Links -->
            <div class="border-t border-blue-800 pt-2 mt-2">
                <div class="px-4 py-2 text-xs font-semibold text-blue-300 uppercase">Campus Life</div>
                <x-responsive-nav-link :href="route('activities')">Activities</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('facilities')">Facilities</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('announcements')">Announcements</x-responsive-nav-link>
            </div>

            <div class="border-t border-blue-800 pt-2 mt-2">
                <x-responsive-nav-link :href="route('blog')">News</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('contact')">Contact</x-responsive-nav-link>
            </div>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-blue-800">
                <div class="px-4 pb-3">
                    <div class="flex items-center space-x-3">
                        <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-avatar.png') }}"
                             alt="{{ Auth::user()->name }}"
                             class="h-10 w-10 rounded-full object-cover">
                        <div>
                            <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-blue-300">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')">
                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('profile.edit')">
                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Profile
                    </x-responsive-nav-link>

                    @if(auth()->user()->access_rights === 'Student' && isset($sidebarStats['unseen_replies']) && $sidebarStats['unseen_replies'] > 0)
                        <x-responsive-nav-link :href="route('student.contact-messages.index')">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            Notifications
                            <span class="ml-2 px-2 py-0.5 bg-red-600 text-white text-xs rounded-full">{{ $sidebarStats['unseen_replies'] }}</span>
                        </x-responsive-nav-link>
                    @endif

                    <x-responsive-nav-link :href="auth()->user()->access_rights === 'Student' ? route('student.feedback') : route('feedback')">
                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        Send Feedback
                    </x-responsive-nav-link>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Log Out
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="py-4 border-t border-blue-800">
                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('feedback')">
                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        Send Feedback
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('login')">Log in</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">Register</x-responsive-nav-link>
                </div>
            </div>
        @endauth
    </div>
</nav>
