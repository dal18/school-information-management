<nav x-data="{ open: false }" class="bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-900 border-b border-blue-700 shadow-lg sticky top-0 z-40 backdrop-blur-sm bg-opacity-95">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="relative">
                            <img src="{{ asset('images/logo.png') }}" alt="LFHS Logo" class="h-12 w-12 rounded-full ring-2 ring-blue-400 group-hover:ring-white transition-all duration-300">
                            <div class="absolute inset-0 rounded-full bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                        </div>
                        <div class="hidden sm:block">
                            <div class="text-white font-bold text-lg leading-tight group-hover:text-blue-100 transition-colors duration-200">Little Flower High School</div>
                            <div class="text-blue-200 text-xs group-hover:text-blue-100 transition-colors duration-200">Excellence in Education</div>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ml-10 sm:flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('home') ? 'text-white bg-white/10' : 'text-blue-100 hover:text-white hover:bg-white/10' }}">
                        <i class="fas fa-home mr-2"></i>
                        Home
                    </a>

                    <!-- About Dropdown -->
                    <div class="hidden sm:flex sm:items-center">
                        <x-nav-dropdown align="left" width="64" title="About Little Flower">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-100 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 group">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    <span>About</span>
                                    <svg class="ml-1 h-4 w-4 fill-current group-hover:rotate-180 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-nav-dropdown-item :href="route('about')" icon="fas fa-school" description="Learn about our institution and values">
                                About Us
                            </x-nav-dropdown-item>
                            <x-nav-dropdown-item :href="route('history')" icon="fas fa-history" description="Our journey through the years">
                                Our History
                            </x-nav-dropdown-item>
                            <x-nav-dropdown-item :href="route('mission-vision')" icon="fas fa-bullseye" description="Our mission, vision and core values">
                                Mission & Vision
                            </x-nav-dropdown-item>
                            <x-nav-dropdown-item :href="route('alma-mater')" icon="fas fa-music" description="School hymn and traditions">
                                Alma Mater Hymn
                            </x-nav-dropdown-item>
                            <x-nav-dropdown-item :href="route('administration')" icon="fas fa-user-tie" description="Meet our leadership team">
                                Administration
                            </x-nav-dropdown-item>

                            <x-slot name="footer">
                                <a href="{{ route('about') }}" class="text-xs text-blue-600 hover:text-blue-800 font-medium flex items-center justify-center">
                                    View All About Pages
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </x-slot>
                        </x-nav-dropdown>
                    </div>

                    <!-- Academics Dropdown -->
                    <div class="hidden sm:flex sm:items-center">
                        <x-nav-dropdown align="left" width="64" title="Academic Programs">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-100 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 group">
                                    <i class="fas fa-graduation-cap mr-2"></i>
                                    <span>Academics</span>
                                    <svg class="ml-1 h-4 w-4 fill-current group-hover:rotate-180 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-nav-dropdown-item :href="route('admissions')" icon="fas fa-user-plus" description="Join our community of learners" badge="Apply Now">
                                Admissions
                            </x-nav-dropdown-item>
                            <x-nav-dropdown-item :href="route('courses')" icon="fas fa-book-open" description="Explore our curriculum">
                                Courses
                            </x-nav-dropdown-item>
                            <x-nav-dropdown-item :href="route('schedules')" icon="fas fa-calendar-alt" description="View class schedules and timings">
                                Class Schedules
                            </x-nav-dropdown-item>
                        </x-nav-dropdown>
                    </div>

                    <!-- Campus Life Dropdown -->
                    <div class="hidden sm:flex sm:items-center">
                        <x-nav-dropdown align="left" width="64" title="Campus Life">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-100 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 group">
                                    <i class="fas fa-university mr-2"></i>
                                    <span>Campus Life</span>
                                    <svg class="ml-1 h-4 w-4 fill-current group-hover:rotate-180 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-nav-dropdown-item :href="route('activities')" icon="fas fa-running" description="Student events and programs">
                                Activities
                            </x-nav-dropdown-item>
                            <x-nav-dropdown-item :href="route('facilities')" icon="fas fa-building" description="Campus facilities and amenities">
                                Facilities
                            </x-nav-dropdown-item>
                            <x-nav-dropdown-item :href="route('announcements')" icon="fas fa-bullhorn" description="Latest school announcements">
                                Announcements
                            </x-nav-dropdown-item>
                        </x-nav-dropdown>
                    </div>

                    <a href="{{ route('blog') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('blog') ? 'text-white bg-white/10' : 'text-blue-100 hover:text-white hover:bg-white/10' }}">
                        <i class="fas fa-newspaper mr-2"></i>
                        News
                    </a>

                    <a href="{{ route('contact') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('contact') ? 'text-white bg-white/10' : 'text-blue-100 hover:text-white hover:bg-white/10' }}">
                        <i class="fas fa-envelope mr-2"></i>
                        Contact
                    </a>
                </div>
            </div>

            <!-- Right Side (Search, Feedback, Notifications, Auth Links) -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-2">
                <!-- Search Button -->
                <button @click="$dispatch('open-search')" class="p-2.5 text-blue-200 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 group" title="Search">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>

                @auth
                    <!-- Notifications -->
                    <div class="relative" x-data="{ open: false, unreadCount: {{ auth()->check() && auth()->user()->access_rights === 'Student' ? (isset($sidebarStats['unseen_replies']) ? $sidebarStats['unseen_replies'] : 0) : 0 }} }">
                        <button @click="open = !open" class="relative p-2.5 text-blue-200 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span x-show="unreadCount > 0" class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full animate-pulse">
                                <span x-text="unreadCount"></span>
                            </span>
                        </button>

                        <!-- Notifications Dropdown -->
                        <div x-show="open" @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             class="absolute right-0 mt-3 w-96 bg-white rounded-xl shadow-2xl z-50 border border-gray-200 overflow-hidden">

                            <!-- Arrow -->
                            <div class="absolute -top-2 right-4">
                                <div class="w-4 h-4 bg-white transform rotate-45 border-l border-t border-gray-200"></div>
                            </div>

                            <div class="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                    <i class="fas fa-bell mr-2 text-blue-600"></i>
                                    Notifications
                                </h3>
                            </div>
                            <div class="max-h-96 overflow-y-auto">
                                @if(auth()->user()->access_rights === 'Student' && isset($sidebarStats['unseen_replies']) && $sidebarStats['unseen_replies'] > 0)
                                    <a href="{{ route('student.contact-messages.index') }}" class="block p-4 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 border-b border-gray-100 transition-all duration-200 group">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-indigo-100 group-hover:from-blue-500 group-hover:to-indigo-600 rounded-lg flex items-center justify-center transition-all duration-200 shadow-sm">
                                                    <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-4 flex-1">
                                                <p class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">New Message Replies</p>
                                                <p class="text-sm text-gray-500 mt-1">You have {{ $sidebarStats['unseen_replies'] }} new {{ $sidebarStats['unseen_replies'] == 1 ? 'reply' : 'replies' }}</p>
                                            </div>
                                            <div class="ml-2">
                                                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                @else
                                    <div class="p-12 text-center text-gray-500">
                                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                        </svg>
                                        <p class="text-sm font-medium">No new notifications</p>
                                        <p class="text-xs text-gray-400 mt-1">You're all caught up!</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Feedback Link -->
                    <a href="{{ auth()->user()->access_rights === 'Student' ? route('student.feedback') : route('feedback') }}" class="p-2.5 text-blue-200 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 group" title="Send Feedback">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                    </a>

                    <!-- User Dropdown with Profile Picture -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-sm font-medium text-white hover:text-blue-100 focus:outline-none transition-all duration-200 px-3 py-2 rounded-lg hover:bg-white/10">
                            <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-avatar.png') }}"
                                 alt="{{ Auth::user()->name }}"
                                 class="h-8 w-8 rounded-full object-cover border-2 border-blue-400 group-hover:border-white transition-colors duration-200">
                            <span class="hidden md:block">{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             class="absolute right-0 mt-3 w-64 bg-white rounded-xl shadow-2xl z-50 border border-gray-200 overflow-hidden">

                            <!-- Arrow -->
                            <div class="absolute -top-2 right-4">
                                <div class="w-4 h-4 bg-white transform rotate-45 border-l border-t border-gray-200"></div>
                            </div>

                            <div class="px-5 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-avatar.png') }}"
                                         alt="{{ Auth::user()->name }}"
                                         class="h-12 w-12 rounded-full object-cover ring-2 ring-blue-200">
                                    <div class="flex-1 min-w-0">
                                        <div class="font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</div>
                                        <div class="text-sm text-gray-600 truncate">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="py-2">
                                <a href="{{ route('dashboard') }}" class="group flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-100 to-indigo-100 group-hover:from-blue-500 group-hover:to-indigo-600 flex items-center justify-center transition-all duration-200">
                                        <svg class="w-5 h-5 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                    </div>
                                    <span class="ml-4 text-sm font-medium text-gray-900 group-hover:text-blue-600">Dashboard</span>
                                </a>

                                <a href="{{ route('profile.edit') }}" class="group flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-100 to-indigo-100 group-hover:from-blue-500 group-hover:to-indigo-600 flex items-center justify-center transition-all duration-200">
                                        <svg class="w-5 h-5 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <span class="ml-4 text-sm font-medium text-gray-900 group-hover:text-blue-600">Profile</span>
                                </a>
                            </div>

                            <div class="border-t border-gray-100"></div>

                            <form method="POST" action="{{ route('logout') }}" class="py-2">
                                @csrf
                                <button type="submit" class="w-full group flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 transition-all duration-200">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-red-100 to-pink-100 group-hover:from-red-500 group-hover:to-pink-600 flex items-center justify-center transition-all duration-200">
                                        <svg class="w-5 h-5 text-red-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                    </div>
                                    <span class="ml-4 text-sm font-medium text-gray-900 group-hover:text-red-600">Log Out</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Feedback for Guests -->
                    <a href="{{ route('feedback') }}" class="p-2.5 text-blue-200 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 group" title="Send Feedback">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                    </a>

                    <a href="{{ route('login') }}" class="text-blue-100 hover:text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-white/10 transition-all duration-200">
                        Log in
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-wider shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <i class="fas fa-user-plus mr-2"></i>
                        Register
                    </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2.5 rounded-lg text-blue-200 hover:text-white hover:bg-white/10 focus:outline-none focus:bg-white/10 focus:text-white transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-blue-900/95 backdrop-blur-sm">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                <i class="fas fa-home mr-2"></i>
                Home
            </x-responsive-nav-link>

            <!-- About Links -->
            <div class="border-t border-blue-800 pt-2 mt-2">
                <div class="px-4 py-2 text-xs font-semibold text-blue-300 uppercase tracking-wider flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    About
                </div>
                <x-responsive-nav-link :href="route('about')">About Us</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('history')">Our History</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('mission-vision')">Mission & Vision</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('alma-mater')">Alma Mater Hymn</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('administration')">Administration</x-responsive-nav-link>
            </div>

            <!-- Academics Links -->
            <div class="border-t border-blue-800 pt-2 mt-2">
                <div class="px-4 py-2 text-xs font-semibold text-blue-300 uppercase tracking-wider flex items-center">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    Academics
                </div>
                <x-responsive-nav-link :href="route('admissions')">Admissions</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('courses')">Courses</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('schedules')">Class Schedules</x-responsive-nav-link>
            </div>

            <!-- Campus Life Links -->
            <div class="border-t border-blue-800 pt-2 mt-2">
                <div class="px-4 py-2 text-xs font-semibold text-blue-300 uppercase tracking-wider flex items-center">
                    <i class="fas fa-university mr-2"></i>
                    Campus Life
                </div>
                <x-responsive-nav-link :href="route('activities')">Activities</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('facilities')">Facilities</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('announcements')">Announcements</x-responsive-nav-link>
            </div>

            <div class="border-t border-blue-800 pt-2 mt-2">
                <x-responsive-nav-link :href="route('blog')">
                    <i class="fas fa-newspaper mr-2"></i>
                    News
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('contact')">
                    <i class="fas fa-envelope mr-2"></i>
                    Contact
                </x-responsive-nav-link>
            </div>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-blue-800">
                <div class="px-4 pb-3">
                    <div class="flex items-center space-x-3">
                        <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-avatar.png') }}"
                             alt="{{ Auth::user()->name }}"
                             class="h-12 w-12 rounded-full object-cover ring-2 ring-blue-400">
                        <div>
                            <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-blue-300">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')">
                        <i class="fas fa-home mr-2"></i>
                        Dashboard
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('profile.edit')">
                        <i class="fas fa-user mr-2"></i>
                        Profile
                    </x-responsive-nav-link>

                    @if(auth()->user()->access_rights === 'Student' && isset($sidebarStats['unseen_replies']) && $sidebarStats['unseen_replies'] > 0)
                        <x-responsive-nav-link :href="route('student.contact-messages.index')">
                            <i class="fas fa-bell mr-2"></i>
                            Notifications
                            <span class="ml-2 px-2 py-0.5 bg-red-600 text-white text-xs rounded-full">{{ $sidebarStats['unseen_replies'] }}</span>
                        </x-responsive-nav-link>
                    @endif

                    <x-responsive-nav-link :href="auth()->user()->access_rights === 'Student' ? route('student.feedback') : route('feedback')">
                        <i class="fas fa-comment mr-2"></i>
                        Send Feedback
                    </x-responsive-nav-link>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Log Out
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="py-4 border-t border-blue-800">
                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('feedback')">
                        <i class="fas fa-comment mr-2"></i>
                        Send Feedback
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('login')">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Log in
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">
                        <i class="fas fa-user-plus mr-2"></i>
                        Register
                    </x-responsive-nav-link>
                </div>
            </div>
        @endauth
    </div>
</nav>
