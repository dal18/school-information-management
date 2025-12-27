<!-- Explore Our Campus Video Section -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-gradient-to-br from-primary-900 via-primary-800 to-primary-900 text-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>

    <!-- Decorative Blobs -->
    <div class="absolute top-0 left-0 w-64 sm:w-96 h-64 sm:h-96 bg-secondary-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-80 sm:w-[30rem] h-80 sm:h-[30rem] bg-accent-500/10 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Header -->
        <div class="text-center mb-8 sm:mb-12 md:mb-16">
            <span class="inline-block px-3 sm:px-4 py-1.5 sm:py-2 bg-white/10 backdrop-blur-md rounded-full text-xs sm:text-sm font-semibold mb-3 sm:mb-4">
                <i class="fas fa-video mr-1 sm:mr-2"></i>VIRTUAL EXPERIENCE
            </span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-display font-bold mb-3 sm:mb-4 bg-gradient-to-r from-white via-white to-secondary-300 bg-clip-text text-transparent">
                Explore Our Campus
            </h2>
            <p class="text-base sm:text-lg md:text-xl text-gray-200 max-w-3xl mx-auto px-4">
                Take a virtual tour of our state-of-the-art facilities from the comfort of your home
            </p>
        </div>

        <!-- Main Campus Tour Video - Facebook Embed -->
        <div class="mb-10 sm:mb-12 md:mb-16">
            <div class="max-w-full mx-auto">
                <!-- Video Container with Professional Frame -->
                <div class="relative group">
                    <!-- Decorative Frame -->
                    <div class="absolute -inset-1 bg-gradient-to-r from-accent-500 via-secondary-500 to-accent-500 rounded-2xl sm:rounded-3xl blur opacity-75 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>

                    <!-- Video Wrapper -->
                    <div class="relative bg-black rounded-xl sm:rounded-2xl overflow-hidden shadow-2xl">
                        <!-- Facebook Video Embed -->
                        <div class="w-full flex justify-center items-center">
                            <iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2FLFHSPAI%2Fvideos%2F1315998185948232%2F&show_text=true&width=560&t=0"
                                    width="100%"
                                    height="600"
                                    style="border:none;overflow:hidden"
                                    scrolling="no"
                                    frameborder="0"
                                    allowfullscreen="true"
                                    allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
                                    allowFullScreen="true">
                            </iframe>
                        </div>
                    </div>
                </div>

                <!-- Video Description -->
                <div class="mt-4 sm:mt-6 text-center">
                    <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-2">Little Flower High School Campus Tour</h3>
                    <p class="text-sm sm:text-base text-gray-300 max-w-2xl mx-auto px-4">
                        Experience our beautiful campus featuring modern classrooms, science laboratories, sports facilities, library, and more. See why thousands of students choose LFHS for their education.
                    </p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center">
            <a href="{{ route('facilities') }}"
               class="inline-flex items-center gap-2 sm:gap-3 bg-white text-primary-900 hover:bg-accent-500 hover:text-white font-bold px-6 sm:px-8 py-3 sm:py-4 text-sm sm:text-base rounded-xl transition-all duration-300 transform hover:scale-105 shadow-2xl active:scale-95">
                <i class="fas fa-building text-lg sm:text-xl"></i>
                <span>View All Facilities</span>
                <i class="fas fa-arrow-right text-sm sm:text-base"></i>
            </a>
        </div>
    </div>
</section>
