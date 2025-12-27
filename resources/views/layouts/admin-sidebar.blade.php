<aside class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 text-white transform transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-auto"
       :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
    <div class="h-full flex flex-col">
        <!-- Logo -->
        <div class="flex items-center justify-between h-20 border-b border-gray-800 px-4">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-10">
                <span class="text-xl font-bold">
                    @if(auth()->user()->access_rights === 'Student')
                        LFHS Portal
                    @else
                        LFHS Admin
                    @endif
                </span>
            </div>
            <!-- Close button for mobile -->
            <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-white p-2">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4" @click.self="return" @click="if($event.target.tagName === 'A' || $event.target.closest('a')) { setTimeout(() => sidebarOpen = false, 100) }">
            @if(auth()->user()->access_rights === 'Student')
                <!-- Student Dashboard Link -->
                <a href="{{ route('student.dashboard') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('student.dashboard') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-home w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>

                <!-- Calendar Link -->
                <a href="{{ route('calendar.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('calendar.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-calendar w-5"></i>
                    <span class="ml-3">Calendar</span>
                </a>

                <!-- View-Only Links for Students -->
                <a href="{{ route('student.announcements') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('student.announcements') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-bullhorn w-5"></i>
                    <span class="ml-3">Announcements</span>
                </a>

                <a href="{{ route('student.courses') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('student.courses') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-book w-5"></i>
                    <span class="ml-3">Courses</span>
                </a>

                <a href="{{ route('student.facilities') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('student.facilities') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-building w-5"></i>
                    <span class="ml-3">Facilities</span>
                </a>

                <a href="{{ route('student.activities') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('student.activities') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-calendar-alt w-5"></i>
                    <span class="ml-3">Activities</span>
                </a>

                <a href="{{ route('student.stories') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('student.stories') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-book-open w-5"></i>
                    <span class="ml-3">Stories</span>
                </a>

                <a href="{{ route('student.blog') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('student.blog') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-newspaper w-5"></i>
                    <span class="ml-3">Blog Posts</span>
                </a>

                <a href="{{ route('student.schedules') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('student.schedules') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-clock w-5"></i>
                    <span class="ml-3">Schedules</span>
                </a>

                <a href="{{ route('student.feedback') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('student.feedback') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-comment-dots w-5"></i>
                    <span class="ml-3">Send Feedback</span>
                </a>

                <a href="{{ route('student.contact-messages.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('student.contact-messages.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-envelope w-5"></i>
                    <span class="ml-3">My Messages</span>
                    @if(isset($sidebarStats['unseen_replies']) && $sidebarStats['unseen_replies'] > 0)
                        <span class="ml-auto mr-3 px-2 py-0.5 text-xs font-bold bg-blue-500 text-white rounded-full">{{ $sidebarStats['unseen_replies'] }}</span>
                    @endif
                </a>
            @else
                <!-- Admin/Teacher Dashboard Links -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-home w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>

                <!-- Calendar Link -->
                <a href="{{ route('calendar.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('calendar.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-calendar w-5"></i>
                    <span class="ml-3">Calendar</span>
                </a>

                <a href="{{ route('admin.admissions.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.admissions.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-user-graduate w-5"></i>
                    <span class="ml-3">Admissions</span>
                </a>

                <a href="{{ route('admin.announcements.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.announcements.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-bullhorn w-5"></i>
                    <span class="ml-3">Announcements</span>
                </a>

                <!-- Hide Users from Teachers, only show to Admin -->
                @if(auth()->user()->access_rights === 'Admin')
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.users.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-users w-5"></i>
                    <span class="ml-3">Users</span>
                </a>
                @endif

                <a href="{{ route('admin.courses.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.courses.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-book w-5"></i>
                    <span class="ml-3">Courses</span>
                </a>

                <a href="{{ route('admin.facilities.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.facilities.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-building w-5"></i>
                    <span class="ml-3">Facilities</span>
                </a>

                <a href="{{ route('admin.activities.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.activities.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-calendar-alt w-5"></i>
                    <span class="ml-3">Activities</span>
                </a>

                <a href="{{ route('admin.administrators.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.administrators.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-user-tie w-5"></i>
                    <span class="ml-3">Administrators</span>
                </a>

                <a href="{{ route('admin.contact-messages.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.contact-messages.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-envelope w-5"></i>
                    <span class="ml-3">Contact Messages</span>
                    @if(isset($sidebarStats['unread_contact_messages']) && $sidebarStats['unread_contact_messages'] > 0)
                        <span class="ml-auto mr-3 px-2 py-0.5 text-xs font-bold bg-red-500 text-white rounded-full">{{ $sidebarStats['unread_contact_messages'] }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.newsletter-subscribers.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.newsletter-subscribers.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-envelope-open-text w-5"></i>
                    <span class="ml-3">Newsletter Subscribers</span>
                    @if(isset($sidebarStats['active_newsletter_subscribers']) && $sidebarStats['active_newsletter_subscribers'] > 0)
                        <span class="ml-auto mr-3 px-2 py-0.5 text-xs font-bold bg-green-500 text-white rounded-full">{{ $sidebarStats['active_newsletter_subscribers'] }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.testimonials.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.testimonials.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-comments w-5"></i>
                    <span class="ml-3">Testimonials</span>
                    @if(isset($sidebarStats['pending_testimonials']) && $sidebarStats['pending_testimonials'] > 0)
                        <span class="ml-auto mr-3 px-2 py-0.5 text-xs font-bold bg-yellow-500 text-white rounded-full">{{ $sidebarStats['pending_testimonials'] }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.stories.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.stories.index') || request()->routeIs('admin.stories.create') || request()->routeIs('admin.stories.edit') || request()->routeIs('admin.stories.show') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-book-open w-5"></i>
                    <span class="ml-3">Stories</span>
                </a>

                <a href="{{ route('admin.story-comments.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.story-comments.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-comment-alt w-5"></i>
                    <span class="ml-3">Story Comments</span>
                    @if(isset($sidebarStats['pending_story_comments']) && $sidebarStats['pending_story_comments'] > 0)
                        <span class="ml-auto mr-3 px-2 py-0.5 text-xs font-bold bg-yellow-500 text-white rounded-full">{{ $sidebarStats['pending_story_comments'] }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.feedback.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.feedback.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-comment-dots w-5"></i>
                    <span class="ml-3">Feedback</span>
                </a>

                <a href="{{ route('admin.posts.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.posts.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-newspaper w-5"></i>
                    <span class="ml-3">Blog Posts</span>
                </a>

                <a href="{{ route('admin.blog-comments.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.blog-comments.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-comments w-5"></i>
                    <span class="ml-3">Blog Comments</span>
                    @if(isset($sidebarStats['pending_blog_comments']) && $sidebarStats['pending_blog_comments'] > 0)
                        <span class="ml-auto mr-3 px-2 py-0.5 text-xs font-bold bg-yellow-500 text-white rounded-full">{{ $sidebarStats['pending_blog_comments'] }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.schedules.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white {{ request()->routeIs('admin.schedules.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-clock w-5"></i>
                    <span class="ml-3">Schedules</span>
                </a>
            @endif

            <!-- Settings -->
            <div class="mt-4 pt-4 border-t border-gray-800">
                <a href="{{ route('profile.edit') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white">
                    <i class="fas fa-cog w-5"></i>
                    <span class="ml-3">Settings</span>
                </a>
            </div>
        </nav>

        <!-- User Info -->
        <div class="border-t border-gray-800 p-4">
            <div class="flex items-center">
                <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('images/default-avatar.png') }}"
                     alt="{{ auth()->user()->full_name }}"
                     class="h-10 w-10 rounded-full">
                <div class="ml-3">
                    <p class="text-sm font-medium">{{ auth()->user()->full_name }}</p>
                    <p class="text-xs text-gray-400">{{ auth()->user()->access_rights }}</p>
                </div>
            </div>
        </div>
    </div>
</aside>
