@extends('layouts.public')

@section('title', 'Mission & Vision')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'About', 'url' => route('about')],
    ['label' => 'Mission & Vision', 'icon' => 'fas fa-bullseye']
]" />

<!-- Hero Section -->
<section class="relative py-16 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm font-semibold tracking-wide mb-4">
                <i class="fas fa-compass mr-2"></i>Our Guiding Light
            </div>
            <h1 class="text-5xl md:text-6xl font-bold font-serif mb-6">Mission & Vision</h1>
            <p class="text-xl text-gray-200 leading-relaxed">
                The heart and soul that drives Little Flower High School toward excellence
            </p>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">

            <!-- Mission -->
            <div class="mb-20">
                <div class="bg-gradient-to-r from-primary-600 to-primary-800 text-white p-8 md:p-12 rounded-2xl mb-8">
                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0">
                            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center">
                                <i class="fas fa-bullseye text-primary-600 text-3xl"></i>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-4xl font-bold font-serif mb-4">Our Mission</h2>
                            <p class="text-lg text-primary-100 mb-6">Our Core Purpose and Commitment</p>
                            <p class="text-xl text-white leading-relaxed">
                                To educate and influence the young people of Abra to become <strong>mature Christians</strong> with faith and trust in God, love and concern for others, and a spirit of service for the Church. We aim to produce <strong>enlightened and empowered model citizens</strong> equipped with 21st-century skills.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Mission Pillars -->
                <h3 class="text-3xl font-bold text-primary-900 font-serif mb-8 text-center">
                    Pillars of Our Mission
                </h3>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl">
                        <div class="w-20 h-20 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-cross text-white text-3xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-primary-900 mb-3">Faith Formation</h4>
                        <p class="text-gray-700">
                            Nurturing mature Christians with deep faith and trust in God through prayer, sacraments, and Christian living.
                        </p>
                    </div>

                    <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl">
                        <div class="w-20 h-20 bg-gradient-to-br from-secondary-400 to-secondary-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-heart text-white text-3xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-primary-900 mb-3">Love & Compassion</h4>
                        <p class="text-gray-700">
                            Cultivating genuine love and concern for others, inspired by Christ's example of selfless service.
                        </p>
                    </div>

                    <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl">
                        <div class="w-20 h-20 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-hands-helping text-white text-3xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-primary-900 mb-3">Spirit of Service</h4>
                        <p class="text-gray-700">
                            Instilling a commitment to serve the Church, community, and nation with dedication and humility.
                        </p>
                    </div>

                    <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl">
                        <div class="w-20 h-20 bg-gradient-to-br from-secondary-400 to-secondary-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-brain text-white text-3xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-primary-900 mb-3">21st Century Skills</h4>
                        <p class="text-gray-700">
                            Equipping students with critical thinking, creativity, communication, and collaboration skills.
                        </p>
                    </div>
                </div>

                <!-- Mission in Practice -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl">
                    <h3 class="text-2xl font-bold text-primary-900 font-serif mb-6 text-center">
                        <i class="fas fa-lightbulb mr-2 text-secondary-500"></i>
                        How We Live Our Mission
                    </h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-primary-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-900 mb-2">Catholic Education</h5>
                                <p class="text-gray-700 text-sm">Daily prayers, Mass celebrations, and integration of faith in all subjects</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-primary-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-900 mb-2">Holistic Development</h5>
                                <p class="text-gray-700 text-sm">Academic excellence combined with character formation and values education</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-primary-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-900 mb-2">Community Outreach</h5>
                                <p class="text-gray-700 text-sm">Regular service projects and immersion programs in the community</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-primary-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-900 mb-2">Modern Pedagogy</h5>
                                <p class="text-gray-700 text-sm">Technology integration and innovative teaching methods for 21st-century learners</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vision -->
            <div class="mb-20">
                <div class="bg-gradient-to-r from-secondary-500 to-secondary-700 text-white p-8 md:p-12 rounded-2xl mb-8">
                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0">
                            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center">
                                <i class="fas fa-eye text-secondary-600 text-3xl"></i>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-4xl font-bold font-serif mb-4">Our Vision</h2>
                            <p class="text-lg text-secondary-100 mb-6">Where We're Heading</p>
                            <p class="text-xl text-white leading-relaxed">
                                To be the <strong>leading Christian educational institution in Abra</strong> that produces globally competitive graduates rooted in Christian values, equipped with 21st-century skills, and committed to serving God, community, and nation with integrity and excellence.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Vision Elements -->
                <h3 class="text-3xl font-bold text-primary-900 font-serif mb-8 text-center">
                    Key Elements of Our Vision
                </h3>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    <div class="text-center p-6 bg-gradient-to-br from-amber-50 to-yellow-50 rounded-xl">
                        <div class="w-20 h-20 bg-gradient-to-br from-secondary-400 to-secondary-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-trophy text-white text-3xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-primary-900 mb-3">Leading Institution</h4>
                        <p class="text-gray-700">
                            Setting the standard for Catholic education in Abra province and beyond.
                        </p>
                    </div>

                    <div class="text-center p-6 bg-gradient-to-br from-amber-50 to-yellow-50 rounded-xl">
                        <div class="w-20 h-20 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-globe text-white text-3xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-primary-900 mb-3">Global Competitiveness</h4>
                        <p class="text-gray-700">
                            Preparing students to compete and excel in the global arena.
                        </p>
                    </div>

                    <div class="text-center p-6 bg-gradient-to-br from-amber-50 to-yellow-50 rounded-xl">
                        <div class="w-20 h-20 bg-gradient-to-br from-secondary-400 to-secondary-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-shield-alt text-white text-3xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-primary-900 mb-3">Christian Values</h4>
                        <p class="text-gray-700">
                            Graduates firmly rooted in faith and Christian principles.
                        </p>
                    </div>

                    <div class="text-center p-6 bg-gradient-to-br from-amber-50 to-yellow-50 rounded-xl">
                        <div class="w-20 h-20 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-flag text-white text-3xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-primary-900 mb-3">Service & Integrity</h4>
                        <p class="text-gray-700">
                            Committed to serving with honesty, excellence, and moral uprightness.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Core Values -->
            <div class="mb-16">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-primary-900 font-serif mb-4">
                        <i class="fas fa-heart mr-3 text-secondary-500"></i>
                        Our Core Values
                    </h2>
                    <p class="text-xl text-gray-600">
                        The principles that guide everything we do
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Faith -->
                    <div class="flex gap-6 p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center shadow-lg">
                                <i class="fas fa-pray text-white text-2xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-primary-900 mb-3">Faith</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Deep-rooted Christian faith guiding all our actions and decisions. We believe that faith is the foundation of true wisdom and the source of strength in facing life's challenges.
                            </p>
                        </div>
                    </div>

                    <!-- Excellence -->
                    <div class="flex gap-6 p-6 bg-gradient-to-br from-amber-50 to-yellow-50 rounded-xl">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-gradient-to-br from-secondary-400 to-secondary-600 rounded-full flex items-center justify-center shadow-lg">
                                <i class="fas fa-star text-white text-2xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-primary-900 mb-3">Excellence</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Striving for the highest standards in education and character formation. We pursue excellence not for pride, but to honor God through the best use of our talents and abilities.
                            </p>
                        </div>
                    </div>

                    <!-- Service -->
                    <div class="flex gap-6 p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center shadow-lg">
                                <i class="fas fa-hands-helping text-white text-2xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-primary-900 mb-3">Service</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Commitment to serving God, community, and nation with dedication. Following the Little Way of St. Thérèse, we believe in doing small things with great love.
                            </p>
                        </div>
                    </div>

                    <!-- Integrity -->
                    <div class="flex gap-6 p-6 bg-gradient-to-br from-purple-50 to-violet-50 rounded-xl">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-gradient-to-br from-secondary-400 to-secondary-600 rounded-full flex items-center justify-center shadow-lg">
                                <i class="fas fa-balance-scale text-white text-2xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-primary-900 mb-3">Integrity</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Maintaining honesty, transparency, and moral uprightness in all endeavors. We teach students to be persons of their word, accountable for their actions.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Institutional Goals -->
            <div class="bg-gradient-to-r from-primary-900 to-primary-700 text-white p-8 md:p-12 rounded-2xl mb-16">
                <h2 class="text-3xl font-bold font-serif mb-8 text-center">Our Institutional Goals</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="text-6xl font-bold text-secondary-400 mb-3">01</div>
                        <h4 class="text-xl font-bold mb-3">Academic Excellence</h4>
                        <p class="text-white/80">
                            Provide rigorous academic programs that develop critical thinking and prepare students for higher education.
                        </p>
                    </div>
                    <div class="text-center">
                        <div class="text-6xl font-bold text-secondary-400 mb-3">02</div>
                        <h4 class="text-xl font-bold mb-3">Character Formation</h4>
                        <p class="text-white/80">
                            Nurture moral and spiritual development grounded in Catholic teachings and Christian values.
                        </p>
                    </div>
                    <div class="text-center">
                        <div class="text-6xl font-bold text-secondary-400 mb-3">03</div>
                        <h4 class="text-xl font-bold mb-3">Community Engagement</h4>
                        <p class="text-white/80">
                            Foster active participation in church and community service, developing socially responsible citizens.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Closing Statement -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-primary-900 font-serif mb-6">Living Our Mission Daily</h2>
                <p class="text-xl text-gray-700 leading-relaxed max-w-3xl mx-auto mb-8">
                    At Little Flower High School, our mission and vision are not mere words on paper. They are living principles that guide our daily decisions, shape our curriculum, inspire our teachers, and empower our students to become the best versions of themselves—faithful, excellent, and service-oriented individuals ready to make a positive difference in the world.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('history') }}" class="btn-modern-secondary">
                        <i class="fas fa-history mr-2"></i>
                        Our History
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

        </div>
    </div>
</section>
@endsection
