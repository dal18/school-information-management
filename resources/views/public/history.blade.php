@extends('layouts.public')

@section('title', 'Our History')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'About', 'url' => route('about')],
    ['label' => 'Our History', 'icon' => 'fas fa-history']
]" />

<!-- Hero Section -->
<section class="relative py-16 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm font-semibold tracking-wide mb-4">
                <i class="fas fa-history mr-2"></i>Since 1961
            </div>
            <h1 class="text-5xl md:text-6xl font-bold font-serif mb-6">Our Rich Heritage</h1>
            <p class="text-xl text-gray-200 leading-relaxed">
                Over six decades of Catholic education excellence in the heart of Peñarrubia, Abra
            </p>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">

            <!-- The Foundation Story -->
            <div class="mb-16">
                <div class="bg-gradient-to-r from-primary-600 to-primary-800 text-white p-8 md:p-12 rounded-2xl mb-8">
                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0">
                            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center">
                                <i class="fas fa-church text-primary-600 text-3xl"></i>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold font-serif mb-4">The Foundation - 1961</h2>
                            <p class="text-lg text-white/90 leading-relaxed mb-4">
                                Little Flower High School was founded in <strong>1961</strong> as part of the Catholic diocesan school system under the <strong>Diocese of Bangued</strong>. Established in the municipality of Peñarrubia, Abra, the school was created with a clear mission: to provide quality Catholic education to the youth of the Cordillera Administrative Region.
                            </p>
                            <p class="text-lg text-white/90 leading-relaxed">
                                The school takes its name from <strong>St. Thérèse of Lisieux</strong>, also known as "The Little Flower," a revered French Catholic saint known for her simple yet profound spirituality and devotion. Her philosophy of "doing small things with great love" became the cornerstone of the school's educational approach.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <h3 class="text-2xl font-bold text-primary-900 font-serif mb-4">
                            <i class="fas fa-praying-hands mr-2 text-secondary-500"></i>
                            St. Thérèse of Lisieux: Our Patroness
                        </h3>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Saint Thérèse of Lisieux (1873-1897), known as "The Little Flower of Jesus," was a French Discalced Carmelite nun who is widely venerated in modern times. She is popularly known as "The Little Flower" in reference to her natural humility and simplicity of life.
                        </p>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Her autobiography, "Story of a Soul," inspired countless believers through her "Little Way" of spiritual childhood - a path of trust and absolute surrender to God's will. She became a Doctor of the Church in 1997, one of only four women to hold this distinction.
                        </p>
                        <blockquote class="border-l-4 border-primary-600 pl-4 italic text-gray-600 my-6">
                            "Miss no single opportunity of making some small sacrifice, here by a smiling look, there by a kindly word; always doing the smallest right and doing it all for love."
                            <footer class="text-sm mt-2 not-italic">— St. Thérèse of Lisieux</footer>
                        </blockquote>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-primary-900 font-serif mb-4">
                            <i class="fas fa-map-marked-alt mr-2 text-secondary-500"></i>
                            Peñarrubia, Abra: Our Home
                        </h3>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Peñarrubia is a 6th class municipality in the province of Abra, Cordillera Administrative Region (CAR), Philippines. With a population of 6,951 (2020 Census), this peaceful town provides an ideal setting for learning and character formation.
                        </p>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            The municipality has a rich history dating back to Spanish colonial times. Originally consisting of pioneer settlements, these were Christianized and regrouped by the Spaniards in 1723 into Rancheria Gravelinas and Rancheria Patok. The town was renamed Alfonso XII in 1884 in honor of the King of Spain, before eventually becoming Peñarrubia.
                        </p>
                        <p class="text-gray-700 leading-relaxed">
                            Located in the heartland of Abra province, Peñarrubia serves as a vital educational center for surrounding communities, with Little Flower High School playing a crucial role in shaping young minds for over 60 years.
                        </p>
                    </div>
                </div>

                <!-- Map Embed -->
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-primary-900 font-serif mb-4 text-center">
                        <i class="fas fa-location-dot mr-2 text-secondary-500"></i>
                        Find Us in Peñarrubia, Abra
                    </h3>
                    <div class="rounded-xl overflow-hidden shadow-lg">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15302.576817863347!2d120.63527193955078!3d17.583333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x338ed6c5e3e1c24d%3A0x3f1bb1ad5db83c7!2sPe%C3%B1arrubia%2C%20Abra!5e0!3m2!1sen!2sph!4v1735102000000!5m2!1sen!2sph"
                            width="100%"
                            height="450"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Timeline of Growth -->
            <div class="mb-16">
                <h2 class="text-4xl font-bold text-primary-900 font-serif mb-8 text-center">
                    Our Journey Through the Decades
                </h2>

                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-gradient-to-b from-primary-600 to-secondary-500 hidden md:block"></div>

                    <!-- 1960s -->
                    <div class="mb-12 flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 md:pr-12 mb-4 md:mb-0 md:text-right">
                            <div class="inline-block px-4 py-2 bg-primary-600 text-white rounded-full font-bold text-lg mb-2">
                                1961
                            </div>
                            <h3 class="text-2xl font-bold text-primary-900 mb-2">Foundation & Early Years</h3>
                            <p class="text-gray-700">
                                Little Flower High School was established under the Diocese of Bangued as a Catholic educational institution, beginning with modest facilities but a grand vision for youth formation.
                            </p>
                        </div>
                        <div class="flex-shrink-0 w-12 h-12 bg-primary-600 rounded-full border-4 border-white shadow-lg flex items-center justify-center z-10">
                            <i class="fas fa-seedling text-white"></i>
                        </div>
                        <div class="md:w-1/2 md:pl-12"></div>
                    </div>

                    <!-- 1970s-1980s -->
                    <div class="mb-12 flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 md:pr-12"></div>
                        <div class="flex-shrink-0 w-12 h-12 bg-secondary-500 rounded-full border-4 border-white shadow-lg flex items-center justify-center z-10">
                            <i class="fas fa-building text-white"></i>
                        </div>
                        <div class="md:w-1/2 md:pl-12 mb-4 md:mb-0">
                            <div class="inline-block px-4 py-2 bg-secondary-500 text-white rounded-full font-bold text-lg mb-2">
                                1970s - 1980s
                            </div>
                            <h3 class="text-2xl font-bold text-primary-900 mb-2">Expansion & Growth</h3>
                            <p class="text-gray-700">
                                The school expanded its facilities and programs, adding new classrooms, laboratories, and learning resources to accommodate growing enrollment from Peñarrubia and neighboring municipalities.
                            </p>
                        </div>
                    </div>

                    <!-- 1990s-2000s -->
                    <div class="mb-12 flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 md:pr-12 mb-4 md:mb-0 md:text-right">
                            <div class="inline-block px-4 py-2 bg-primary-600 text-white rounded-full font-bold text-lg mb-2">
                                1990s - 2000s
                            </div>
                            <h3 class="text-2xl font-bold text-primary-900 mb-2">Modernization Era</h3>
                            <p class="text-gray-700">
                                Introduction of modern teaching methods, computer education, and enhanced science and mathematics programs. The school maintained its Catholic identity while embracing educational innovation.
                            </p>
                        </div>
                        <div class="flex-shrink-0 w-12 h-12 bg-primary-600 rounded-full border-4 border-white shadow-lg flex items-center justify-center z-10">
                            <i class="fas fa-computer text-white"></i>
                        </div>
                        <div class="md:w-1/2 md:pl-12"></div>
                    </div>

                    <!-- 2010s-Present -->
                    <div class="mb-12 flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 md:pr-12"></div>
                        <div class="flex-shrink-0 w-12 h-12 bg-secondary-500 rounded-full border-4 border-white shadow-lg flex items-center justify-center z-10">
                            <i class="fas fa-star text-white"></i>
                        </div>
                        <div class="md:w-1/2 md:pl-12 mb-4 md:mb-0">
                            <div class="inline-block px-4 py-2 bg-secondary-500 text-white rounded-full font-bold text-lg mb-2">
                                2010s - Present
                            </div>
                            <h3 class="text-2xl font-bold text-primary-900 mb-2">Excellence Continues</h3>
                            <p class="text-gray-700">
                                Operating as Little Flower High School of Peñarrubia, Abra, Inc., the school continues to uphold its tradition of academic excellence and Catholic values while preparing students for the challenges of the 21st century.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diocese Connection -->
            <div class="mb-16 bg-gradient-to-br from-blue-50 to-indigo-50 p-8 md:p-12 rounded-2xl">
                <h2 class="text-3xl font-bold text-primary-900 font-serif mb-6 text-center">
                    <i class="fas fa-church mr-2 text-secondary-500"></i>
                    Part of a Proud Catholic Educational Legacy
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed mb-6 text-center max-w-3xl mx-auto">
                    Little Flower High School is one of several distinguished Catholic educational institutions under the Diocese of Bangued in Abra province. We stand alongside a network of schools dedicated to Catholic education in the Cordillera region:
                </p>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h4 class="font-bold text-primary-900 mb-2">Holy Cross School</h4>
                        <p class="text-sm text-gray-600">Founded 1914 - Peñarrubia</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h4 class="font-bold text-primary-900 mb-2">Holy Ghost School</h4>
                        <p class="text-sm text-gray-600">Founded 1912 - Bangued</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h4 class="font-bold text-primary-900 mb-2">Divine Word College</h4>
                        <p class="text-sm text-gray-600">Founded 1920 - Bangued</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md border-4 border-primary-600">
                        <h4 class="font-bold text-primary-900 mb-2">Little Flower High School</h4>
                        <p class="text-sm text-gray-600">Founded 1961 - Peñarrubia</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h4 class="font-bold text-primary-900 mb-2">And many others...</h4>
                        <p class="text-sm text-gray-600">Serving Abra communities</p>
                    </div>
                </div>
            </div>

            <!-- Core Values -->
            <div class="mb-16">
                <h2 class="text-4xl font-bold text-primary-900 font-serif mb-12 text-center">
                    Our Enduring Values
                </h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <i class="fas fa-cross text-white text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-primary-900 mb-4">Faith</h3>
                        <p class="text-gray-700 leading-relaxed">
                            Rooted in Catholic teachings and the spirituality of St. Thérèse, we nurture students' faith through prayer, sacraments, and Christian living.
                        </p>
                    </div>
                    <div class="text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-secondary-400 to-secondary-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <i class="fas fa-graduation-cap text-white text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-primary-900 mb-4">Excellence</h3>
                        <p class="text-gray-700 leading-relaxed">
                            Committed to academic rigor and holistic development, preparing students to excel in higher education and in life.
                        </p>
                    </div>
                    <div class="text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <i class="fas fa-hands-helping text-white text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-primary-900 mb-4">Service</h3>
                        <p class="text-gray-700 leading-relaxed">
                            Inspired by the Little Way, we teach students to serve God, Church, and community with love in both great and small acts.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-gradient-to-r from-primary-900 to-primary-700 text-white p-8 md:p-12 rounded-2xl mb-16">
                <h2 class="text-3xl font-bold font-serif mb-8 text-center">Our Legacy in Numbers</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-5xl font-bold text-secondary-400 mb-2">64+</div>
                        <div class="text-white/80">Years of Service</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl font-bold text-secondary-400 mb-2">1000+</div>
                        <div class="text-white/80">Alumni</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl font-bold text-secondary-400 mb-2">100%</div>
                        <div class="text-white/80">Catholic Identity</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl font-bold text-secondary-400 mb-2">1961</div>
                        <div class="text-white/80">Founded</div>
                    </div>
                </div>
            </div>

            <!-- Looking Forward -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-primary-900 font-serif mb-6">Looking to the Future</h2>
                <p class="text-xl text-gray-700 leading-relaxed max-w-3xl mx-auto mb-8">
                    As we continue our journey into the future, Little Flower High School remains committed to its founding mission: providing quality Catholic education that nurtures faith, excellence, and service. We honor our past while embracing the opportunities and challenges of the 21st century, always guided by the gentle wisdom of our patroness, St. Thérèse of Lisieux.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('mission-vision') }}" class="btn-modern-secondary">
                        <i class="fas fa-bullseye mr-2"></i>
                        Mission & Vision
                    </a>
                    <a href="{{ route('administration') }}" class="btn-modern-secondary">
                        <i class="fas fa-user-tie mr-2"></i>
                        Administration
                    </a>
                    <a href="{{ route('admissions') }}" class="btn-modern-primary">
                        <i class="fas fa-file-alt mr-2"></i>
                        Apply Now
                    </a>
                </div>
            </div>

            <!-- Sources -->
            <div class="mt-16 pt-8 border-t-2 border-gray-200">
                <h3 class="text-sm font-bold text-gray-600 mb-4 uppercase tracking-wide">Sources & References:</h3>
                <div class="text-sm text-gray-600 space-y-2">
                    <p>• <a href="https://www.ucanews.com/directory/educational-institutions/philippines-bangued/395/10" target="_blank" class="text-primary-600 hover:underline">Diocese Activities and Organizations of Bangued Diocese - UCA News</a></p>
                    <p>• <a href="https://en.wikipedia.org/wiki/Pe%C3%B1arrubia,_Abra" target="_blank" class="text-primary-600 hover:underline">Peñarrubia, Abra - Wikipedia</a></p>
                    <p>• <a href="https://www.philatlas.com/luzon/car/abra/penarrubia.html" target="_blank" class="text-primary-600 hover:underline">Peñarrubia, Abra Profile - PhilAtlas</a></p>
                    <p>• <a href="http://abra.asia/_pages/diocese.htm" target="_blank" class="text-primary-600 hover:underline">Abra Diocese Official Directory</a></p>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
