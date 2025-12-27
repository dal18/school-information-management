@extends('layouts.public')

@section('title', 'Alma Mater Hymn')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'About', 'url' => route('about')],
    ['label' => 'Alma Mater Hymn', 'icon' => 'fas fa-music']
]" />

<!-- Hero Section -->
<section class="relative py-16 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm font-semibold tracking-wide mb-4">
                <i class="fas fa-music mr-2"></i>OUR SCHOOL HYMN
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Alma Mater Hymn</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                The cherished song that unites all LFHS students, past and present
            </p>
        </div>
    </div>
</section>

<!-- Alma Mater Section -->
<section class="modern-section bg-gradient-to-br from-primary-50 to-secondary-50">
    <div class="modern-container">

        <!-- Hymn Content -->
        <div class="max-w-5xl mx-auto space-y-8">
            <!-- Verse 1 -->
            <div class="modern-card shadow-modern-lg border-l-4 border-primary-600">
                <div class="modern-card-content">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-music text-primary-600 text-xl"></i>
                        </div>
                        <h2 class="modern-heading-md text-primary-900">Verse 1</h2>
                    </div>
                    <div class="modern-text-lead space-y-2 font-serif">
                    <p>O, Alma Mater dear, full of love and care;</p>
                    <p>You're the pride of our town</p>
                    <p>Very dear thoughts in you are found;</p>
                    <p>O, dear LFHS, full of love and kindness</p>
                    <p>Thought in you is dear to me;</p>
                    <p>Inspiration it will be.</p>
                    </div>
                </div>
            </div>

            <!-- Chorus -->
            <div class="modern-card bg-gradient-to-r from-primary-600 to-primary-800 text-white shadow-modern-lg">
                <div class="modern-card-content">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-star text-primary-600 text-xl"></i>
                        </div>
                        <h2 class="modern-heading-md text-white">Chorus</h2>
                    </div>
                    <div class="modern-text-lead text-white/90 space-y-2 font-serif">
                    <p>When we wander, far or near Little Flow'r;</p>
                    <p>Our loyalty still be with you so</p>
                    <p>With Hope, Faith and Charity;</p>
                    <p>When we wander far or near Little Flow'r;</p>
                    <p>We'll work and strive for thee;</p>
                    <p>Alma Mater shrine of Truth Divine.</p>
                    </div>
                </div>
            </div>

            <!-- Verse 2 -->
            <div class="modern-card shadow-modern-lg border-l-4 border-primary-600">
                <div class="modern-card-content">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-music text-primary-600 text-xl"></i>
                    </div>
                    <h2 class="modern-heading-md text-primary-900">Verse 2</h2>
                </div>
                <div class="modern-text-lead space-y-2 font-serif">
                    <p>Your faithful students we stand;</p>
                    <p>On the seas and the strand</p>
                    <p>Sing you, praise you without end;</p>
                    <p>Though from you we'll be from afar,</p>
                    <p>Bind us with thy banner;</p>
                    <p>With thy fame which we all share</p>
                    <p>Alma mater will praise you Forever and ever</p>
                </div>
                </div>
            </div>

            <!-- Verse 3 -->
            <div class="modern-card shadow-modern-lg border-l-4 border-primary-600">
                <div class="modern-card-content">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-music text-primary-600 text-xl"></i>
                        </div>
                        <h2 class="modern-heading-md text-primary-900">Verse 3</h2>
                    </div>
                    <div class="modern-text-lead space-y-2 font-serif">
                    <p>Alma Mater dear so kind; so fair to us and kind</p>
                    <p>Freedom's holy altar shrine; Shine emblem so divine</p>
                    <p>To thee our love abide; Little Flower light to guide;</p>
                    <p>Guide to seekers of truth;</p>
                    <p>Bind us with thy banner;</p>
                    <p>With thy fame which we all share</p>
                    <p>Forever and ever</p>
                    </div>
                </div>
            </div>

            <!-- Closing Message -->
            <div class="modern-card bg-gradient-to-r from-primary-600 to-primary-800 text-white shadow-modern-lg">
                <div class="modern-card-content text-center">
                    <i class="fas fa-heart text-5xl text-white/20 mb-4"></i>
                    <p class="modern-heading-md text-white mb-2">Our Alma Mater binds us together</p>
                    <p class="text-primary-100">United in faith, excellence, and service to God and community</p>
                </div>
            </div>
        </div>

        <div class="mt-12 flex justify-center gap-4 flex-wrap">
            <a href="{{ route('mission-vision') }}" class="btn-modern-secondary">
                <i class="fas fa-bullseye mr-2"></i>
                Mission & Vision
            </a>
            <a href="{{ route('administration') }}" class="btn-modern-secondary">
                <i class="fas fa-user-tie mr-2"></i>
                Administration
            </a>
            <a href="{{ route('home') }}" class="btn-modern-primary">
                <i class="fas fa-home mr-2"></i>
                Back to Home
            </a>
        </div>
    </div>
</section>
@endsection
