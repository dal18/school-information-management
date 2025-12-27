@extends('layouts.admin')

@section('title', 'View Activity')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Activity Details</h1>
        <p class="text-gray-600 mt-1">View activity information</p>
    </div>
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.activities.edit', $activity) }}"
            class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
            <i class="fas fa-edit mr-2"></i>Edit
        </a>
        <a href="{{ route('admin.activities.index') }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
            <i class="fas fa-arrow-left mr-2"></i>Back
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Activity Image -->
        @if($activity->link_image)
            <div class="w-full h-96 bg-gray-100">
                <img src="{{ asset('storage/' . $activity->link_image) }}"
                     alt="{{ $activity->caption }}"
                     class="w-full h-full object-cover">
            </div>
        @else
            <div class="w-full h-96 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                <i class="fas fa-calendar-alt text-9xl text-blue-300"></i>
            </div>
        @endif

        <!-- Activity Information -->
        <div class="p-8">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $activity->caption }}</h2>
                @if($activity->category)
                <span class="inline-block px-3 py-1 text-sm font-medium bg-blue-100 text-blue-800 rounded-full">
                    {{ $activity->category }}
                </span>
                @endif
            </div>

            <!-- Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Activity Date -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-blue-100 rounded-full p-3 mr-4">
                            <i class="fas fa-calendar text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Activity Date</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $activity->date_uploaded ? $activity->date_uploaded->format('F d, Y') : 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Created At -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-green-100 rounded-full p-3 mr-4">
                            <i class="fas fa-clock text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Created At</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $activity->created_at ? $activity->created_at->format('M d, Y g:i A') : 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Category -->
                @if($activity->category)
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-purple-100 rounded-full p-3 mr-4">
                            <i class="fas fa-tag text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Category</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $activity->category }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Last Updated -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-yellow-100 rounded-full p-3 mr-4">
                            <i class="fas fa-history text-yellow-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Last Updated</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $activity->updated_at ? $activity->updated_at->diffForHumans() : 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <div>
                    <form action="{{ route('admin.activities.destroy', $activity) }}"
                          method="POST"
                          id="delete-form-{{ $activity->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                                onclick="confirmDelete('delete-form-{{ $activity->id }}', 'Are you sure you want to delete this activity?', 'Delete Activity?')"
                                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                            <i class="fas fa-trash mr-2"></i>Delete Activity
                        </button>
                    </form>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.activities.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-list mr-2"></i>View All Activities
                    </a>
                    <a href="{{ route('admin.activities.edit', $activity) }}"
                       class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-edit mr-2"></i>Edit Activity
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
