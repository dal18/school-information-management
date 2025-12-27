@extends('layouts.admin')

@section('title', 'View Course')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Course Details</h1>
        <p class="text-gray-600 mt-1">View course information</p>
    </div>
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.courses.edit', $course) }}"
            class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
            <i class="fas fa-edit mr-2"></i>Edit
        </a>
        <a href="{{ route('admin.courses.index') }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
            <i class="fas fa-arrow-left mr-2"></i>Back
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Course Image -->
        @if($course->image_path)
            <div class="w-full h-96 bg-gray-100">
                <img src="{{ asset('storage/' . $course->image_path) }}"
                     alt="{{ $course->subject_name }}"
                     class="w-full h-full object-cover">
            </div>
        @else
            <div class="w-full h-96 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                <i class="fas fa-book text-9xl text-blue-300"></i>
            </div>
        @endif

        <!-- Course Information -->
        <div class="p-8">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $course->subject_name }}</h2>
                <span class="inline-block px-3 py-1 text-sm font-medium bg-blue-100 text-blue-800 rounded-full">
                    {{ $course->grade_level }}
                </span>
            </div>

            <!-- Description -->
            @if($course->description)
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">
                    <i class="fas fa-info-circle text-gray-600 mr-2"></i>Description
                </h3>
                <p class="text-gray-700 leading-relaxed">{{ $course->description }}</p>
            </div>
            @endif

            <!-- Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Subject Name -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-blue-100 rounded-full p-3 mr-4">
                            <i class="fas fa-book text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Subject Name</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $course->subject_name }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Grade Level -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-green-100 rounded-full p-3 mr-4">
                            <i class="fas fa-graduation-cap text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Grade Level</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $course->grade_level }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Created At -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-purple-100 rounded-full p-3 mr-4">
                            <i class="fas fa-clock text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Created At</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $course->created_at ? $course->created_at->format('M d, Y g:i A') : 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Last Updated -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-yellow-100 rounded-full p-3 mr-4">
                            <i class="fas fa-history text-yellow-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Last Updated</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $course->updated_at ? $course->updated_at->diffForHumans() : 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <div>
                    <form action="{{ route('admin.courses.destroy', $course) }}"
                          method="POST"
                          id="delete-form-{{ $course->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                                onclick="confirmDelete('delete-form-{{ $course->id }}', 'Are you sure you want to delete this course?', 'Delete Course?')"
                                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                            <i class="fas fa-trash mr-2"></i>Delete Course
                        </button>
                    </form>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.courses.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-list mr-2"></i>View All Courses
                    </a>
                    <a href="{{ route('admin.courses.edit', $course) }}"
                       class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-edit mr-2"></i>Edit Course
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
