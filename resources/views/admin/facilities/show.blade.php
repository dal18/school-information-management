@extends('layouts.admin')

@section('title', 'View Facility')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Facility Details</h1>
        <p class="text-gray-600 mt-1">View facility information</p>
    </div>
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.facilities.edit', $facility) }}"
            class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
            <i class="fas fa-edit mr-2"></i>Edit
        </a>
        <a href="{{ route('admin.facilities.index') }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
            <i class="fas fa-arrow-left mr-2"></i>Back
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Facility Image -->
        @if($facility->image_path)
            <div class="w-full h-96 bg-gray-100">
                <img src="{{ asset('storage/' . $facility->image_path) }}"
                     alt="{{ $facility->caption }}"
                     class="w-full h-full object-cover">
            </div>
        @else
            <div class="w-full h-96 bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                <i class="fas fa-building text-9xl text-green-300"></i>
            </div>
        @endif

        <!-- Facility Information -->
        <div class="p-8">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $facility->caption }}</h2>
            </div>

            <!-- Description -->
            @if($facility->detail)
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">
                    <i class="fas fa-info-circle text-gray-600 mr-2"></i>Description
                </h3>
                <p class="text-gray-700 leading-relaxed">{{ $facility->detail }}</p>
            </div>
            @endif

            <!-- Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Facility Name -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-green-100 rounded-full p-3 mr-4">
                            <i class="fas fa-building text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Facility Name</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $facility->caption }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Created At -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-blue-100 rounded-full p-3 mr-4">
                            <i class="fas fa-clock text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Created At</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $facility->created_at ? $facility->created_at->format('M d, Y g:i A') : 'N/A' }}
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
                                {{ $facility->updated_at ? $facility->updated_at->diffForHumans() : 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-purple-100 rounded-full p-3 mr-4">
                            <i class="fas fa-check-circle text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Status</p>
                            <p class="text-lg font-semibold text-gray-900">
                                Active
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <div>
                    <form id="delete-form-{{ $facility->id }}" action="{{ route('admin.facilities.destroy', $facility) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                                onclick="confirmDelete('delete-form-{{ $facility->id }}', 'This will permanently delete this facility. This action cannot be undone!', 'Delete Facility?')"
                                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                            <i class="fas fa-trash mr-2"></i>Delete Facility
                        </button>
                    </form>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.facilities.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-list mr-2"></i>View All Facilities
                    </a>
                    <a href="{{ route('admin.facilities.edit', $facility) }}"
                       class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-edit mr-2"></i>Edit Facility
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
