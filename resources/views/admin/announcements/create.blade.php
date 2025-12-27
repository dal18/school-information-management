@extends('layouts.admin')

@section('title', 'Create Announcement')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Create Announcement</h1>
        <p class="text-gray-600 mt-1">Post a new announcement to the school website</p>
    </div>
    <a href="{{ route('admin.announcements.index') }}"
        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
        <i class="fas fa-arrow-left mr-2"></i>Back
    </a>
</div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('admin.announcements.store') }}" method="POST">
            @csrf

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Title <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    required
                    placeholder="Enter announcement title..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('title') border-red-500 @enderror">
                @error('title')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    Content <span class="text-red-500">*</span>
                </label>
                <textarea
                    name="content"
                    id="content"
                    rows="12"
                    required
                    placeholder="Write your announcement here..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
                @error('content')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">Write a clear and concise announcement. You can use multiple paragraphs.</p>
            </div>

            <!-- Info Box -->
            <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-600 mt-1 mr-3"></i>
                    <div class="text-sm text-blue-800">
                        <p class="font-semibold mb-1">Publishing Information</p>
                        <p>This announcement will be immediately visible on the public website after you publish it. Make sure all information is accurate before submitting.</p>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                <a href="{{ route('admin.announcements.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-8 py-3 rounded-lg transition duration-300">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-300">
                    <i class="fas fa-bullhorn mr-2"></i>Publish Announcement
                </button>
            </div>
        </form>
    </div>

    <!-- Preview Box -->
    <div class="bg-white rounded-lg shadow-md p-8 mt-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Preview</h3>
        <div id="preview" class="prose max-w-none">
            <h4 id="preview-title" class="text-xl font-bold text-gray-900 mb-2">Announcement Title</h4>
            <div class="flex items-center text-sm text-gray-500 mb-4">
                <i class="far fa-calendar mr-2"></i>
                <span>{{ now()->format('F d, Y') }}</span>
                <span class="mx-2">•</span>
                <i class="far fa-user mr-2"></i>
                <span>{{ auth()->user()->name }}</span>
            </div>
            <div id="preview-content" class="text-gray-700">
                Your announcement content will appear here...
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Live preview
    document.getElementById('title').addEventListener('input', function(e) {
        const previewTitle = document.getElementById('preview-title');
        previewTitle.textContent = e.target.value || 'Announcement Title';
    });

    document.getElementById('content').addEventListener('input', function(e) {
        const previewContent = document.getElementById('preview-content');
        const content = e.target.value || 'Your announcement content will appear here...';
        // Simple line break conversion
        previewContent.innerHTML = content.replace(/\n/g, '<br>');
    });
</script>
@endpush
