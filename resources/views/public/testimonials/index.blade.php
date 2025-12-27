@extends('layouts.public')

@section('title', 'Student Testimonials')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Testimonials', 'icon' => 'fas fa-quote-left']
]" />

<!-- Page Header -->
<section class="relative py-16 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Student Testimonials</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto mb-8">
                Hear from our students and alumni about their experiences at Little Flower High School
            </p>
            <a href="{{ route('testimonials.create') }}"
               class="inline-flex items-center bg-white text-primary-600 font-semibold px-8 py-3 rounded-lg hover:bg-gray-100 transition duration-300 shadow-lg">
                <i class="fas fa-pen mr-2"></i>Share Your Testimonial
            </a>
        </div>
    </div>
</section>

<!-- Testimonials Grid -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($testimonials->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 p-6">
                        <!-- Quote Icon -->
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-primary-100 text-primary-600 mb-4">
                            <i class="fas fa-quote-left text-xl"></i>
                        </div>

                        <!-- Message -->
                        <div class="mb-4">
                            <p class="text-gray-700 leading-relaxed">
                                "{{ $testimonial->message }}"
                            </p>
                        </div>

                        <!-- Student Info -->
                        <div class="border-t border-gray-200 pt-4 mt-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($testimonial->student_name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $testimonial->student_name }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $testimonial->grade_level }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="mt-3">
                            <p class="text-xs text-gray-400">
                                <i class="far fa-clock mr-1"></i>{{ $testimonial->created_at->format('F d, Y') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $testimonials->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gray-200 text-gray-400 mb-6">
                    <i class="fas fa-quote-left text-4xl"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-4">No Testimonials Yet</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    Be the first to share your experience at Little Flower High School!
                </p>
                <a href="{{ route('testimonials.create') }}"
                   class="inline-flex items-center bg-primary-600 hover:bg-primary-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-300 shadow-md">
                    <i class="fas fa-pen mr-2"></i>Write the First Testimonial
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Call to Action -->
@if($testimonials->count() > 0)
<section class="relative py-16 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Have a Story to Share?
        </h2>
        <p class="text-xl text-gray-200 mb-8">
            We'd love to hear about your journey at Little Flower High School
        </p>
        <a href="{{ route('testimonials.create') }}"
           class="inline-flex items-center bg-white text-primary-600 font-semibold px-8 py-4 rounded-lg hover:bg-gray-100 transition duration-300 shadow-lg text-lg">
            <i class="fas fa-pen mr-2"></i>Share Your Testimonial
        </a>
    </div>
</section>
@endif
@endsection
