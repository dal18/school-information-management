@extends('layouts.admin')

@section('title', 'View Announcement')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Announcement Details</h1>
        <p class="text-gray-600 mt-1">View announcement information</p>
    </div>
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.announcements.edit', $announcement) }}"
            class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
            <i class="fas fa-edit mr-2"></i>Edit
        </a>
        <a href="{{ route('admin.announcements.index') }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
            <i class="fas fa-arrow-left mr-2"></i>Back
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Announcement Image -->
        @if($announcement->image_path)
            <div class="w-full h-96 bg-gray-100">
                <img src="{{ asset('storage/' . $announcement->image_path) }}"
                     alt="{{ $announcement->title }}"
                     class="w-full h-full object-cover">
            </div>
        @else
            <div class="w-full h-96 bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center">
                <i class="fas fa-bullhorn text-9xl text-purple-300"></i>
            </div>
        @endif

        <!-- Announcement Information -->
        <div class="p-8">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $announcement->title }}</h2>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="far fa-calendar mr-2"></i>
                    <span>{{ $announcement->created_at ? $announcement->created_at->format('F d, Y g:i A') : 'N/A' }}</span>
                    @if($announcement->author)
                    <span class="mx-2">•</span>
                    <i class="far fa-user mr-2"></i>
                    <span>{{ $announcement->author->first_name }} {{ $announcement->author->last_name }}</span>
                    @endif
                </div>
            </div>

            <!-- Content -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">
                    <i class="fas fa-align-left text-gray-600 mr-2"></i>Content
                </h3>
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    {!! nl2br(e($announcement->content)) !!}
                </div>
            </div>

            <!-- Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Posted By -->
                @if($announcement->author)
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-blue-100 rounded-full p-3 mr-4">
                            <i class="fas fa-user text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Posted By</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $announcement->author->first_name }} {{ $announcement->author->last_name }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Created At -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-green-100 rounded-full p-3 mr-4">
                            <i class="fas fa-clock text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Created At</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $announcement->created_at ? $announcement->created_at->format('M d, Y g:i A') : 'N/A' }}
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
                                {{ $announcement->updated_at ? $announcement->updated_at->diffForHumans() : 'N/A' }}
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
                                Published
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <div>
                    <form id="delete-form-{{ $announcement->id }}" action="{{ route('admin.announcements.destroy', $announcement) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                                onclick="confirmDelete('delete-form-{{ $announcement->id }}', 'This will permanently delete this announcement. This action cannot be undone!', 'Delete Announcement?')"
                                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                            <i class="fas fa-trash mr-2"></i>Delete Announcement
                        </button>
                    </form>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.announcements.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-list mr-2"></i>View All Announcements
                    </a>
                    <a href="{{ route('admin.announcements.edit', $announcement) }}"
                       class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-edit mr-2"></i>Edit Announcement
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
