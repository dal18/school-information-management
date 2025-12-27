<!-- Interactive Campus Map -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">
                <i class="fas fa-map-marked-alt mr-2"></i>CAMPUS MAP
            </span>
            <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 mb-4">
                Navigate Our Campus
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Explore our facilities and discover everything our campus has to offer
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Map Locations List -->
            <div x-data="{ activeLocation: null }" class="space-y-3">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-list mr-2 text-primary-600"></i>
                    Campus Locations
                </h3>

                <!-- Location Items -->
                <div
                    @click="activeLocation = 'admin'"
                    :class="activeLocation === 'admin' ? 'border-primary-500 bg-primary-50' : 'border-gray-200 hover:border-primary-300'"
                    class="border-2 rounded-xl p-4 cursor-pointer transition-all duration-200">
                    <div class="flex items-start gap-3">
                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-building text-primary-600 text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900">Administration Building</h4>
                            <p class="text-sm text-gray-600">Main office, Principal's office, Records</p>
                        </div>
                    </div>
                </div>

                <div
                    @click="activeLocation = 'academic'"
                    :class="activeLocation === 'academic' ? 'border-accent-500 bg-accent-50' : 'border-gray-200 hover:border-accent-300'"
                    class="border-2 rounded-xl p-4 cursor-pointer transition-all duration-200">
                    <div class="flex items-start gap-3">
                        <div class="w-12 h-12 bg-accent-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-graduation-cap text-accent-600 text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900">Academic Buildings</h4>
                            <p class="text-sm text-gray-600">Classrooms, Faculty rooms</p>
                        </div>
                    </div>
                </div>

                <div
                    @click="activeLocation = 'science'"
                    :class="activeLocation === 'science' ? 'border-secondary-500 bg-secondary-50' : 'border-gray-200 hover:border-secondary-300'"
                    class="border-2 rounded-xl p-4 cursor-pointer transition-all duration-200">
                    <div class="flex items-start gap-3">
                        <div class="w-12 h-12 bg-secondary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-flask text-secondary-600 text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900">Science Laboratories</h4>
                            <p class="text-sm text-gray-600">Physics, Chemistry, Biology labs</p>
                        </div>
                    </div>
                </div>

                <div
                    @click="activeLocation = 'library'"
                    :class="activeLocation === 'library' ? 'border-primary-500 bg-primary-50' : 'border-gray-200 hover:border-primary-300'"
                    class="border-2 rounded-xl p-4 cursor-pointer transition-all duration-200">
                    <div class="flex items-start gap-3">
                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-book text-primary-600 text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900">Library</h4>
                            <p class="text-sm text-gray-600">Books, Study areas, Computer lab</p>
                        </div>
                    </div>
                </div>

                <div
                    @click="activeLocation = 'sports'"
                    :class="activeLocation === 'sports' ? 'border-accent-500 bg-accent-50' : 'border-gray-200 hover:border-accent-300'"
                    class="border-2 rounded-xl p-4 cursor-pointer transition-all duration-200">
                    <div class="flex items-start gap-3">
                        <div class="w-12 h-12 bg-accent-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-running text-accent-600 text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900">Sports Complex</h4>
                            <p class="text-sm text-gray-600">Gymnasium, Courts, Field</p>
                        </div>
                    </div>
                </div>

                <div
                    @click="activeLocation = 'cafeteria'"
                    :class="activeLocation === 'cafeteria' ? 'border-secondary-500 bg-secondary-50' : 'border-gray-200 hover:border-secondary-300'"
                    class="border-2 rounded-xl p-4 cursor-pointer transition-all duration-200">
                    <div class="flex items-start gap-3">
                        <div class="w-12 h-12 bg-secondary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-utensils text-secondary-600 text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900">Cafeteria</h4>
                            <p class="text-sm text-gray-600">Dining hall, Student lounge</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Visualization -->
            <div class="lg:col-span-2">
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 border-2 border-gray-200 min-h-[600px] relative overflow-hidden">
                    <!-- Placeholder Map Illustration -->
                    <div class="absolute inset-0 flex items-center justify-center opacity-10">
                        <i class="fas fa-map text-9xl text-gray-400"></i>
                    </div>

                    <!-- Map Content -->
                    <div class="relative z-10">
                        <div class="grid grid-cols-3 gap-4 mb-8">
                            <!-- Building Blocks -->
                            <div class="col-span-1 space-y-4">
                                <div class="bg-primary-500 hover:bg-primary-600 text-white rounded-lg p-6 cursor-pointer transform hover:scale-105 transition-all duration-200 shadow-lg">
                                    <i class="fas fa-building text-2xl mb-2"></i>
                                    <p class="text-sm font-semibold">Admin</p>
                                </div>
                                <div class="bg-secondary-500 hover:bg-secondary-600 text-white rounded-lg p-6 cursor-pointer transform hover:scale-105 transition-all duration-200 shadow-lg">
                                    <i class="fas fa-flask text-2xl mb-2"></i>
                                    <p class="text-sm font-semibold">Science Labs</p>
                                </div>
                            </div>

                            <div class="col-span-2 space-y-4">
                                <div class="bg-accent-500 hover:bg-accent-600 text-white rounded-lg p-6 cursor-pointer transform hover:scale-105 transition-all duration-200 shadow-lg">
                                    <i class="fas fa-graduation-cap text-2xl mb-2"></i>
                                    <p class="text-sm font-semibold">Academic Buildings</p>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-primary-500 hover:bg-primary-600 text-white rounded-lg p-6 cursor-pointer transform hover:scale-105 transition-all duration-200 shadow-lg">
                                        <i class="fas fa-book text-2xl mb-2"></i>
                                        <p class="text-sm font-semibold">Library</p>
                                    </div>
                                    <div class="bg-secondary-500 hover:bg-secondary-600 text-white rounded-lg p-6 cursor-pointer transform hover:scale-105 transition-all duration-200 shadow-lg">
                                        <i class="fas fa-utensils text-2xl mb-2"></i>
                                        <p class="text-sm font-semibold">Cafeteria</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sports Complex -->
                        <div class="bg-accent-500 hover:bg-accent-600 text-white rounded-lg p-8 cursor-pointer transform hover:scale-105 transition-all duration-200 shadow-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <i class="fas fa-running text-3xl mb-2"></i>
                                    <p class="font-semibold">Sports Complex & Athletic Fields</p>
                                </div>
                                <i class="fas fa-expand-arrows-alt text-2xl opacity-50"></i>
                            </div>
                        </div>

                        <!-- Map Legend -->
                        <div class="mt-8 bg-white rounded-xl p-6 shadow-sm">
                            <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-info-circle mr-2 text-primary-600"></i>
                                Map Legend
                            </h4>
                            <div class="grid grid-cols-2 gap-3 text-sm">
                                <div class="flex items-center gap-2">
                                    <div class="w-4 h-4 bg-primary-500 rounded"></div>
                                    <span class="text-gray-700">Administrative</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-4 h-4 bg-accent-500 rounded"></div>
                                    <span class="text-gray-700">Academic</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-4 h-4 bg-secondary-500 rounded"></div>
                                    <span class="text-gray-700">Support Services</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-parking text-gray-600"></i>
                                    <span class="text-gray-700">Parking Areas</span>
                                </div>
                            </div>
                        </div>

                        <!-- Download Map Button -->
                        <div class="mt-6 text-center">
                            <button class="inline-flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-200">
                                <i class="fas fa-download"></i>
                                Download Campus Map (PDF)
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Note -->
                <p class="text-sm text-gray-500 mt-4 text-center">
                    <i class="fas fa-lightbulb mr-1"></i>
                    In production, integrate Google Maps API or custom SVG map for interactive navigation
                </p>
            </div>
        </div>
    </div>
</section>
