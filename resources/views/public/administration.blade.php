@extends('layouts.public')

@section('title', 'Administration')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'About', 'url' => route('about')],
    ['label' => 'Administration', 'icon' => 'fas fa-user-tie']
]" />

<!-- Hero Section -->
<section class="relative py-16 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm font-semibold tracking-wide mb-4">
                <i class="fas fa-sitemap mr-2"></i>ORGANIZATIONAL STRUCTURE
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">School Administration</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                Meet the distinguished leaders who guide Little Flower High School toward educational excellence
            </p>
        </div>
    </div>
</section>

<!-- Administration Section -->
<section class="modern-section modern-section-white">
    <div class="modern-container">

        <!-- Organizational Chart -->
        <div class="org-chart-container">
            @if($directors->count() > 0 || $principals->count() > 0 || $staff->count() > 0)

            <!-- Level 1: Directors -->
            @if($directors->count() > 0)
            <div class="org-level org-level-directors">
                <div class="org-level-title">
                    <i class="fas fa-crown mr-2"></i>School Directors
                </div>
                <div class="org-nodes">
                    @foreach($directors as $director)
                    <div class="org-node org-node-director">
                        <div class="org-node-card">
                            @if($director->image)
                            <div class="org-node-photo cursor-pointer group relative"
                                 onclick="openImageModal('{{ asset('storage/' . $director->image) }}', '{{ $director->name }} - {{ $director->position }}')">
                                <x-responsive-image
                                    :src="$director->image"
                                    :alt="$director->name"
                                    :lazy="true" />
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center rounded-full">
                                    <i class="fas fa-search-plus text-white text-4xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                                </div>
                            </div>
                            @else
                            <div class="org-node-photo org-node-photo-placeholder">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            @endif
                            <h3 class="org-node-name">{{ $director->name }}</h3>
                            <p class="org-node-position">{{ $director->position }}</p>
                            @if($director->email || $director->phone)
                            <div class="org-node-contact">
                                @if($director->email)
                                <p><i class="fas fa-envelope"></i> {{ Str::limit($director->email, 20) }}</p>
                                @endif
                                @if($director->phone)
                                <p><i class="fas fa-phone"></i> {{ $director->phone }}</p>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Level 2: Principals -->
            @if($principals->count() > 0)
            <div class="org-level org-level-principals">
                <div class="org-level-title">
                    <i class="fas fa-user-graduate mr-2"></i>Principals
                </div>
                <div class="org-nodes">
                    @foreach($principals as $principal)
                    <div class="org-node org-node-principal">
                        <div class="org-node-card">
                            @if($principal->image)
                            <div class="org-node-photo cursor-pointer group relative"
                                 onclick="openImageModal('{{ asset('storage/' . $principal->image) }}', '{{ $principal->name }} - {{ $principal->position }}')">
                                <x-responsive-image
                                    :src="$principal->image"
                                    :alt="$principal->name"
                                    :lazy="true" />
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center rounded-full">
                                    <i class="fas fa-search-plus text-white text-4xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                                </div>
                            </div>
                            @else
                            <div class="org-node-photo org-node-photo-placeholder">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            @endif
                            <h3 class="org-node-name">{{ $principal->name }}</h3>
                            <p class="org-node-position">{{ $principal->position }}</p>
                            @if($principal->email || $principal->phone)
                            <div class="org-node-contact">
                                @if($principal->email)
                                <p><i class="fas fa-envelope"></i> {{ Str::limit($principal->email, 20) }}</p>
                                @endif
                                @if($principal->phone)
                                <p><i class="fas fa-phone"></i> {{ $principal->phone }}</p>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Level 3: Administrative Staff -->
            @if($staff->count() > 0)
            <div class="org-level org-level-staff">
                <div class="org-level-title">
                    <i class="fas fa-users mr-2"></i>Administrative Staff
                </div>
                <div class="org-nodes org-nodes-staff">
                    @foreach($staff as $member)
                    <div class="org-node org-node-staff">
                        <div class="org-node-card org-node-card-small">
                            @if($member->image)
                            <div class="org-node-photo org-node-photo-small cursor-pointer group relative"
                                 onclick="openImageModal('{{ asset('storage/' . $member->image) }}', '{{ $member->name }} - {{ $member->position }}')">
                                <x-responsive-image
                                    :src="$member->image"
                                    :alt="$member->name"
                                    :lazy="true" />
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center rounded-full">
                                    <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                                </div>
                            </div>
                            @else
                            <div class="org-node-photo org-node-photo-small org-node-photo-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                            @endif
                            <h4 class="org-node-name">{{ $member->name }}</h4>
                            <p class="org-node-position">{{ $member->position }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @else
            <div class="text-center py-16 bg-gray-50 rounded-xl">
                <i class="fas fa-sitemap text-6xl text-gray-300 mb-4"></i>
                <p class="modern-text-muted text-lg">Organizational chart information will be available soon.</p>
            </div>
            @endif
        </div>

        <!-- Contact Information -->
        <div class="mt-16 modern-card bg-gradient-to-r from-primary-600 to-primary-800 text-white shadow-modern-lg">
            <div class="modern-card-content text-center">
                <h3 class="modern-heading-md text-white mb-4">Get in Touch with Our Administration</h3>
                <p class="text-primary-100 mb-6 max-w-2xl mx-auto">
                    Have questions or need assistance? Our administrative team is here to help you.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('contact') }}" class="btn-modern-secondary bg-white text-primary-900 border-white hover:bg-gray-100">
                        <i class="fas fa-envelope mr-2"></i>
                        Contact Us
                    </a>
                    <a href="tel:074-752-8084" class="inline-flex items-center px-6 py-3 bg-white/10 backdrop-blur text-white font-semibold rounded-lg hover:bg-white/20 transition-all duration-300">
                        <i class="fas fa-phone mr-2"></i>
                        (074) 752-8084
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-12 flex justify-center gap-4 flex-wrap">
            <a href="{{ route('mission-vision') }}" class="btn-modern-secondary">
                <i class="fas fa-bullseye mr-2"></i>
                Mission & Vision
            </a>
            <a href="{{ route('alma-mater') }}" class="btn-modern-secondary">
                <i class="fas fa-music mr-2"></i>
                Alma Mater Hymn
            </a>
            <a href="{{ route('home') }}" class="btn-modern-primary">
                <i class="fas fa-home mr-2"></i>
                Back to Home
            </a>
        </div>
    </div>
</section>

<style>
    /* Organizational Chart Styles */
    .org-chart-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 3rem 1rem;
        overflow-x: auto;
    }

    .org-level {
        position: relative;
        margin-bottom: 4rem;
    }

    .org-level-title {
        text-align: center;
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 2rem;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, #e0e7ff 0%, #dbeafe 100%);
        border-radius: 50px;
        display: inline-block;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .org-nodes {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        gap: 2rem;
        flex-wrap: wrap;
        position: relative;
    }

    .org-nodes-staff {
        gap: 1.5rem;
    }

    /* Connecting Lines - Vertical from Directors to Principals */
    .org-level-directors + .org-level-principals::before {
        content: '';
        position: absolute;
        top: -4rem;
        left: 50%;
        width: 3px;
        height: 4rem;
        background: linear-gradient(180deg, #3b82f6 0%, #1e40af 100%);
        transform: translateX(-50%);
        border-radius: 2px;
    }

    /* Connecting Lines - Horizontal between Principals */
    .org-level-principals .org-nodes::before {
        content: '';
        position: absolute;
        top: -2rem;
        left: 20%;
        right: 20%;
        height: 3px;
        background: linear-gradient(90deg, transparent 0%, #3b82f6 20%, #3b82f6 80%, transparent 100%);
        border-radius: 2px;
    }

    /* Connecting Lines - Vertical to each Principal */
    .org-level-principals .org-node::before {
        content: '';
        position: absolute;
        top: -2rem;
        left: 50%;
        width: 3px;
        height: 2rem;
        background: #3b82f6;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    /* Connecting Lines - Vertical from Principals to Staff */
    .org-level-principals + .org-level-staff::before {
        content: '';
        position: absolute;
        top: -4rem;
        left: 50%;
        width: 3px;
        height: 4rem;
        background: linear-gradient(180deg, #1e40af 0%, #6366f1 100%);
        transform: translateX(-50%);
        border-radius: 2px;
    }

    /* Connecting Lines - Horizontal between Staff */
    .org-level-staff .org-nodes::before {
        content: '';
        position: absolute;
        top: -2rem;
        left: 10%;
        right: 10%;
        height: 3px;
        background: linear-gradient(90deg, transparent 0%, #6366f1 10%, #6366f1 90%, transparent 100%);
        border-radius: 2px;
    }

    /* Connecting Lines - Vertical to each Staff */
    .org-level-staff .org-node::before {
        content: '';
        position: absolute;
        top: -2rem;
        left: 50%;
        width: 3px;
        height: 2rem;
        background: #6366f1;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    .org-node {
        position: relative;
        flex: 0 0 auto;
    }

    .org-node-director,
    .org-node-principal {
        width: 320px;
    }

    .org-node-staff {
        width: 240px;
    }

    .org-node-card {
        background: white;
        border-radius: 1rem;
        padding: 2rem 1.5rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 2px solid transparent;
        text-align: center;
    }

    .org-node-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 35px -5px rgba(0, 0, 0, 0.15), 0 10px 15px -8px rgba(0, 0, 0, 0.1);
        border-color: #3b82f6;
    }

    .org-node-card-small {
        padding: 1.5rem 1rem;
    }

    .org-node-director .org-node-card {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        border-color: #f59e0b;
    }

    .org-node-principal .org-node-card {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        border-color: #3b82f6;
    }

    .org-node-staff .org-node-card {
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        border-color: #6b7280;
    }

    .org-node-photo {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 1.5rem;
        border: 5px solid white;
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.3);
        position: relative;
    }

    .org-node-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .org-node-photo-small {
        width: 100px;
        height: 100px;
        border-width: 4px;
    }

    .org-node-photo-placeholder {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3.5rem;
    }

    .org-node-photo-small.org-node-photo-placeholder {
        font-size: 2.5rem;
    }

    .org-node-name {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .org-node-staff .org-node-name {
        font-size: 0.95rem;
    }

    .org-node-position {
        font-size: 0.875rem;
        color: #3b82f6;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .org-node-staff .org-node-position {
        font-size: 0.75rem;
    }

    .org-node-contact {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        font-size: 0.75rem;
        color: #6b7280;
    }

    .org-node-contact p {
        margin: 0.25rem 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .org-node-contact i {
        color: #3b82f6;
        font-size: 0.875rem;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .org-level-principals .org-nodes::before,
        .org-level-staff .org-nodes::before {
            display: none;
        }

        .org-level-principals .org-node::before,
        .org-level-staff .org-node::before {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .org-chart-container {
            padding: 2rem 0.5rem;
        }

        .org-nodes {
            flex-direction: column;
            align-items: center;
        }

        .org-level {
            margin-bottom: 3rem;
        }

        .org-level-directors + .org-level-principals::before,
        .org-level-principals + .org-level-staff::before {
            height: 3rem;
            top: -3rem;
        }

        .org-node-director,
        .org-node-principal,
        .org-node-staff {
            width: 100%;
            max-width: 320px;
        }

        .org-level-title {
            font-size: 1.25rem;
            padding: 0.5rem 1rem;
        }
    }
</style>
@endsection
