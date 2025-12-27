@extends('layouts.admin')

@section('title', 'Administrator Details')

@section('header')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Administrator Details</h1>
            <p class="text-gray-600 mt-1">View administrator information</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.administrators.edit', $administrator) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="{{ route('admin.administrators.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i>Back to List
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Information Card -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white">
                    <i class="fas fa-user-tie mr-2"></i>Administrator Information
                </h2>
            </div>

            <div class="p-6">
                <div class="space-y-4">
                    <!-- Name -->
                    <div class="flex items-start border-b border-gray-200 pb-4">
                        <div class="w-1/3">
                            <p class="text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-user mr-2 text-gray-400"></i>Full Name
                            </p>
                        </div>
                        <div class="w-2/3">
                            <p class="text-gray-900 font-medium">{{ $administrator->name }}</p>
                        </div>
                    </div>

                    <!-- Position -->
                    <div class="flex items-start border-b border-gray-200 pb-4">
                        <div class="w-1/3">
                            <p class="text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-briefcase mr-2 text-gray-400"></i>Position
                            </p>
                        </div>
                        <div class="w-2/3">
                            <p class="text-gray-900">{{ $administrator->position }}</p>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="flex items-start border-b border-gray-200 pb-4">
                        <div class="w-1/3">
                            <p class="text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-folder mr-2 text-gray-400"></i>Category
                            </p>
                        </div>
                        <div class="w-2/3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($administrator->category === 'Directors') bg-purple-100 text-purple-800
                                @elseif($administrator->category === 'Principals') bg-blue-100 text-blue-800
                                @else bg-green-100 text-green-800
                                @endif">
                                {{ $administrator->category }}
                            </span>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start border-b border-gray-200 pb-4">
                        <div class="w-1/3">
                            <p class="text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-envelope mr-2 text-gray-400"></i>Email
                            </p>
                        </div>
                        <div class="w-2/3">
                            @if($administrator->email)
                                <a href="mailto:{{ $administrator->email }}"
                                   class="text-blue-600 hover:text-blue-800 hover:underline">
                                    {{ $administrator->email }}
                                </a>
                            @else
                                <p class="text-gray-500 italic">Not provided</p>
                            @endif
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start border-b border-gray-200 pb-4">
                        <div class="w-1/3">
                            <p class="text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-phone mr-2 text-gray-400"></i>Phone
                            </p>
                        </div>
                        <div class="w-2/3">
                            @if($administrator->phone)
                                <a href="tel:{{ $administrator->phone }}"
                                   class="text-blue-600 hover:text-blue-800 hover:underline">
                                    {{ $administrator->phone }}
                                </a>
                            @else
                                <p class="text-gray-500 italic">Not provided</p>
                            @endif
                        </div>
                    </div>

                    <!-- Display Order -->
                    <div class="flex items-start border-b border-gray-200 pb-4">
                        <div class="w-1/3">
                            <p class="text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-sort-numeric-down mr-2 text-gray-400"></i>Display Order
                            </p>
                        </div>
                        <div class="w-2/3">
                            <p class="text-gray-900">{{ $administrator->display_order }}</p>
                        </div>
                    </div>

                    <!-- Biography -->
                    @if($administrator->bio)
                    <div class="flex items-start">
                        <div class="w-1/3">
                            <p class="text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                <i class="fas fa-file-alt mr-2 text-gray-400"></i>Biography
                            </p>
                        </div>
                        <div class="w-2/3">
                            <div class="prose prose-sm max-w-none text-gray-700">
                                {!! nl2br(e($administrator->bio)) !!}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Metadata Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mt-6">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-info-circle mr-2 text-gray-500"></i>Record Information
                </h3>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-600 font-medium mb-1">
                            <i class="fas fa-calendar-plus mr-2 text-gray-400"></i>Created At
                        </p>
                        <p class="text-gray-900">{{ $administrator->created_at->format('M d, Y - h:i A') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-medium mb-1">
                            <i class="fas fa-calendar-check mr-2 text-gray-400"></i>Last Updated
                        </p>
                        <p class="text-gray-900">{{ $administrator->updated_at->format('M d, Y - h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar - Image -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-md overflow-hidden sticky top-6">
            <div class="bg-gradient-to-r from-gray-700 to-gray-800 px-6 py-4">
                <h3 class="text-lg font-semibold text-white">
                    <i class="fas fa-image mr-2"></i>Profile Image
                </h3>
            </div>

            <div class="p-6">
                @if($administrator->image)
                    <div class="aspect-w-3 aspect-h-4 mb-4">
                        <img src="{{ asset('storage/' . $administrator->image) }}"
                             alt="{{ $administrator->name }}"
                             class="w-full h-auto rounded-lg shadow-lg object-cover">
                    </div>
                    <div class="text-center">
                        <a href="{{ asset('storage/' . $administrator->image) }}"
                           target="_blank"
                           class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 hover:underline">
                            <i class="fas fa-external-link-alt mr-2"></i>View Full Size
                        </a>
                    </div>
                @else
                    <div class="bg-gray-100 rounded-lg p-8 text-center">
                        <i class="fas fa-user-circle text-gray-400 text-6xl mb-4"></i>
                        <p class="text-gray-500 text-sm">No profile image uploaded</p>
                    </div>
                @endif
            </div>

            <!-- Quick Actions -->
            <div class="border-t border-gray-200 p-6 space-y-3">
                <a href="{{ route('admin.administrators.edit', $administrator) }}"
                   class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition duration-300 flex items-center justify-center">
                    <i class="fas fa-edit mr-2"></i>Edit Administrator
                </a>

                <form action="{{ route('admin.administrators.destroy', $administrator) }}"
                      method="POST"
                      id="delete-form-{{ $administrator->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                            onclick="confirmDelete('delete-form-{{ $administrator->id }}', 'Are you sure you want to delete this administrator?', 'Delete Administrator?')"
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg transition duration-300 flex items-center justify-center">
                        <i class="fas fa-trash-alt mr-2"></i>Delete Administrator
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
