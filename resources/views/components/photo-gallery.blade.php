<!-- Photo Gallery Section -->
<section class="py-12 sm:py-16 md:py-20 bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8 sm:mb-12">
            <span class="inline-block px-3 sm:px-4 py-1.5 sm:py-2 bg-purple-100 rounded-full text-purple-800 text-xs sm:text-sm font-semibold mb-3 sm:mb-4">
                <i class="fas fa-camera mr-1 sm:mr-2"></i>GALLERY
            </span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-gray-900 mb-3 sm:mb-4">
                Campus <span class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">Life</span>
            </h2>
            <p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto">
                Glimpses of student life, events, and activities at Little Flower High School
            </p>
        </div>

        <!-- Masonry Gallery Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4" x-data="{ activeImage: null }">
            <!-- Photo 1 -->
            <div @click="activeImage = 1" class="group relative aspect-square overflow-hidden rounded-xl sm:rounded-2xl cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-300">
                <img src="{{ asset('images/hero/1.jpg') }}" alt="Campus Life" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4 right-3 sm:right-4">
                        <p class="text-white font-semibold text-xs sm:text-sm">Campus View</p>
                    </div>
                </div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-base sm:text-lg"></i>
                    </div>
                </div>
            </div>

            <!-- Photo 2 - Tall -->
            <div @click="activeImage = 2" class="group relative md:row-span-2 overflow-hidden rounded-xl sm:rounded-2xl cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-300">
                <img src="{{ asset('images/hero/2.jpg') }}" alt="Students Learning" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4 right-3 sm:right-4">
                        <p class="text-white font-semibold text-xs sm:text-sm">Students Learning</p>
                    </div>
                </div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-base sm:text-lg"></i>
                    </div>
                </div>
            </div>

            <!-- Photo 3 -->
            <div @click="activeImage = 3" class="group relative aspect-square overflow-hidden rounded-xl sm:rounded-2xl cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-300">
                <img src="{{ asset('images/hero/14.jpg') }}" alt="Science Lab" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4 right-3 sm:right-4">
                        <p class="text-white font-semibold text-xs sm:text-sm">Science Laboratory</p>
                    </div>
                </div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-base sm:text-lg"></i>
                    </div>
                </div>
            </div>

            <!-- Photo 4 -->
            <div @click="activeImage = 4" class="group relative aspect-square overflow-hidden rounded-xl sm:rounded-2xl cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-300">
                <img src="{{ asset('images/hero/13.jpg') }}" alt="Sports Activities" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4 right-3 sm:right-4">
                        <p class="text-white font-semibold text-xs sm:text-sm">Sports Activities</p>
                    </div>
                </div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-base sm:text-lg"></i>
                    </div>
                </div>
            </div>

            <!-- Photo 5 -->
            <div @click="activeImage = 5" class="group relative aspect-square overflow-hidden rounded-xl sm:rounded-2xl cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-300">
                <img src="{{ asset('images/hero/2.png') }}" alt="Faculty" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4 right-3 sm:right-4">
                        <p class="text-white font-semibold text-xs sm:text-sm">Expert Faculty</p>
                    </div>
                </div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-base sm:text-lg"></i>
                    </div>
                </div>
            </div>

            <!-- Photo 6 - Wide -->
            <div @click="activeImage = 6" class="group relative lg:col-span-2 aspect-video overflow-hidden rounded-xl sm:rounded-2xl cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-300">
                <img src="{{ asset('images/hero/3.png') }}" alt="Graduation" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4 right-3 sm:right-4">
                        <p class="text-white font-semibold text-xs sm:text-sm">Facilities</p>
                    </div>
                </div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-base sm:text-lg"></i>
                    </div>
                </div>
            </div>

            <!-- Lightbox Modal -->
            <div x-show="activeImage !== null"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="activeImage = null"
                 @keydown.escape="activeImage = null"
                 class="fixed inset-0 bg-black/95 backdrop-blur-sm z-50 flex items-center justify-center p-4"
                 style="display: none;">
                <div @click.stop class="relative max-w-6xl w-full">
                    <!-- Close Button -->
                    <button @click="activeImage = null"
                            class="absolute -top-10 sm:-top-12 right-0 w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors">
                        <i class="fas fa-times text-white text-lg"></i>
                    </button>

                    <!-- Image -->
                    <img :src="`{{ asset('images/hero/') }}${activeImage <= 3 ? activeImage : activeImage - 3}.${activeImage <= 3 ? 'jpg' : 'png'}`"
                         alt="Gallery Image"
                         class="w-full rounded-2xl shadow-2xl">
                </div>
            </div>
        </div>

        <!-- View More Button -->
        <div class="text-center mt-8 sm:mt-12">
            <a href="{{ route('facilities') }}"
               class="inline-flex items-center gap-2 sm:gap-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold px-6 sm:px-8 py-3 sm:py-4 text-sm sm:text-base rounded-xl transition-all duration-300 transform hover:scale-105 shadow-xl active:scale-95">
                <i class="fas fa-images text-lg sm:text-xl"></i>
                <span>View Full Gallery</span>
                <i class="fas fa-arrow-right text-sm sm:text-base"></i>
            </a>
        </div>
    </div>
</section>
