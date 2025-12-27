<footer class="bg-gradient-to-br from-dark-900 via-dark-800 to-primary-950 text-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-pattern-dots opacity-5"></div>
    <div class="relative z-10">
    <!-- Main Footer Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
            <!-- About / Logo Column -->
            <div class="lg:col-span-2">
                <div class="flex items-center space-x-3 mb-6">
                    <img src="{{ asset('images/logo.png') }}" alt="LFHS Logo" class="h-14 w-14 rounded-full border-2 border-secondary-400 shadow-lg">
                    <div>
                        <h3 class="text-2xl font-display font-bold text-white">Little Flower High School</h3>
                        <p class="text-sm text-secondary-400 font-semibold">Excellence in Education Since 1961</p>
                    </div>
                </div>
                <p class="text-gray-300 text-sm leading-relaxed mb-6">
                    Dedicated to providing quality education and nurturing future leaders with strong values, academic excellence, and character development.
                </p>

                <!-- Social Media -->
                <div class="mb-6">
                    <h4 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-3">Connect With Us</h4>
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-accent-600 rounded-lg flex items-center justify-center transition-all duration-300 group">
                            <i class="fab fa-facebook-f text-gray-300 group-hover:text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-accent-600 rounded-lg flex items-center justify-center transition-all duration-300 group">
                            <i class="fab fa-twitter text-gray-300 group-hover:text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-accent-600 rounded-lg flex items-center justify-center transition-all duration-300 group">
                            <i class="fab fa-instagram text-gray-300 group-hover:text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-accent-600 rounded-lg flex items-center justify-center transition-all duration-300 group">
                            <i class="fab fa-youtube text-gray-300 group-hover:text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-accent-600 rounded-lg flex items-center justify-center transition-all duration-300 group">
                            <i class="fab fa-linkedin-in text-gray-300 group-hover:text-white"></i>
                        </a>
                    </div>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-3">Stay Updated</h4>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex gap-2">
                        @csrf
                        <input
                            type="email"
                            name="email"
                            placeholder="Your email"
                            required
                            class="flex-1 px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-transparent text-sm"
                        >
                        <button type="submit" class="px-4 py-2 bg-accent-500 hover:bg-accent-600 rounded-lg font-semibold text-sm transition-colors duration-300">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Quick Links</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-accent-400 transition duration-200 text-sm flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-accent-600 group-hover:translate-x-1 transition-transform"></i>About Us
                    </a></li>
                    <li><a href="{{ route('admissions') }}" class="text-gray-300 hover:text-accent-400 transition duration-200 text-sm flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-accent-600 group-hover:translate-x-1 transition-transform"></i>Admissions
                    </a></li>
                    <li><a href="{{ route('courses') }}" class="text-gray-300 hover:text-accent-400 transition duration-200 text-sm flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-accent-600 group-hover:translate-x-1 transition-transform"></i>Courses
                    </a></li>
                    <li><a href="{{ route('facilities') }}" class="text-gray-300 hover:text-accent-400 transition duration-200 text-sm flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-accent-600 group-hover:translate-x-1 transition-transform"></i>Facilities
                    </a></li>
                    <li><a href="{{ route('activities') }}" class="text-gray-300 hover:text-accent-400 transition duration-200 text-sm flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-accent-600 group-hover:translate-x-1 transition-transform"></i>Activities
                    </a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-accent-400 transition duration-200 text-sm flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-accent-600 group-hover:translate-x-1 transition-transform"></i>Contact Us
                    </a></li>
                </ul>
            </div>

            <!-- Resources -->
            <div>
                <h4 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Resources</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('announcements') }}" class="text-gray-300 hover:text-accent-400 transition duration-200 text-sm flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-accent-600 group-hover:translate-x-1 transition-transform"></i>Announcements
                    </a></li>
                    <li><a href="{{ route('schedules') }}" class="text-gray-300 hover:text-accent-400 transition duration-200 text-sm flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-accent-600 group-hover:translate-x-1 transition-transform"></i>Class Schedules
                    </a></li>
                    <li><a href="{{ route('blog') }}" class="text-gray-300 hover:text-accent-400 transition duration-200 text-sm flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-accent-600 group-hover:translate-x-1 transition-transform"></i>Blog
                    </a></li>
                    <li><a href="{{ route('stories') }}" class="text-gray-300 hover:text-accent-400 transition duration-200 text-sm flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-accent-600 group-hover:translate-x-1 transition-transform"></i>Success Stories
                    </a></li>
                    <li><a href="{{ route('feedback') }}" class="text-gray-300 hover:text-accent-400 transition duration-200 text-sm flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-accent-600 group-hover:translate-x-1 transition-transform"></i>Send Feedback
                    </a></li>
                    @auth
                    <li><a href="{{ route('calendar.index') }}" class="text-gray-300 hover:text-accent-400 transition duration-200 text-sm flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-accent-600 group-hover:translate-x-1 transition-transform"></i>Calendar
                    </a></li>
                    @endauth
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Contact Info</h4>
                <ul class="space-y-4">
                    <li class="flex items-start text-sm">
                        <i class="fas fa-map-marker-alt text-accent-500 mt-1 mr-3"></i>
                        <span class="text-gray-300"> Poblacion<br>Penarrubia, Abra<br>2806</span>
                    </li>
                    <li class="flex items-center text-sm">
                        <i class="fas fa-phone text-accent-500 mr-3"></i>
                        <a href="tel:+1234567890" class="text-gray-300 hover:text-accent-400 transition">(123) 456-7890</a>
                    </li>
                    <li class="flex items-center text-sm">
                        <i class="fas fa-envelope text-accent-500 mr-3"></i>
                        <a href="mailto:lfhssystemmanagement@gmail.com" class="text-gray-300 hover:text-accent-400 transition">lfhssystemmanagement@gmail.com</a>
                    </li>
                    <li class="flex items-center text-sm">
                        <i class="fas fa-clock text-accent-500 mr-3"></i>
                        <span class="text-gray-300">Mon-Fri: 7:00 AM - 5:00 PM</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <!-- Copyright -->
                <div class="text-sm text-gray-400">
                    <p>&copy; {{ date('Y') }} Little Flower High School. All rights reserved.</p>
                </div>

                <!-- Links -->
                <div class="flex flex-wrap items-center gap-6 text-sm">
                    <a href="{{ route('privacy') }}" class="text-gray-400 hover:text-accent-400 transition">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="text-gray-400 hover:text-accent-400 transition">Terms of Service</a>
                    <a href="{{ route('sitemap') }}" class="text-gray-400 hover:text-accent-400 transition">Sitemap</a>
                    @auth
                    <a href="{{ route('profile.edit') }}" class="text-gray-400 hover:text-accent-400 transition">
                        <i class="fas fa-user-circle mr-1"></i>My Profile
                    </a>
                    @endauth
                </div>

                <!-- Built with -->
                <div class="text-sm text-gray-400">
                    Built with <i class="fas fa-heart text-accent-500 mx-1"></i> using
                    <a href="https://laravel.com" target="_blank" class="text-accent-400 hover:text-accent-300 transition">Laravel</a>
                </div>
            </div>
        </div>
    </div>
    </div>
</footer>
