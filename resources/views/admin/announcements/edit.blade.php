@extends('layouts.admin')

@section('title', 'Edit Announcement')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Edit Announcement</h1>
        <p class="text-gray-600 mt-1">Update announcement details</p>
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
        <!-- UPDATE FORM - Closes before the buttons section -->
        <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST" id="update-form">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Title <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $announcement->title) }}"
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
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('content') border-red-500 @enderror">{{ old('content', $announcement->content) }}</textarea>
                @error('content')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">Write a clear and concise announcement. You can use multiple paragraphs.</p>
            </div>

            <!-- Meta Information -->
            <div class="mb-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Announcement Information</h4>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Created:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $announcement->created_at->format('F d, Y g:i A') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Last Updated:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $announcement->updated_at->diffForHumans() }}</span>
                    </div>
                    @if($announcement->author)
                    <div class="col-span-2">
                        <span class="text-gray-600">Posted by:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $announcement->author->name }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </form>
        <!-- UPDATE FORM ENDS HERE - Before the buttons -->

        <!-- Submit Buttons Section - OUTSIDE all forms -->
        <div class="flex items-center justify-between pt-6 border-t">
            <!-- DELETE FORM - Separate and independent -->
            <form id="delete-form-{{ $announcement->id }}" action="{{ route('admin.announcements.destroy', $announcement) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <button type="button"
                    onclick="confirmDelete('delete-form-{{ $announcement->id }}', 'This will permanently delete this announcement. This action cannot be undone!', 'Delete Announcement?')"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                    <i class="fas fa-trash mr-2"></i>Delete
                </button>
            </form>

            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.announcements.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-8 py-3 rounded-lg transition duration-300">
                    Cancel
                </a>
                <!-- Save button connected to update-form via form attribute -->
                <button type="submit"
                    form="update-form"
                    class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-300">
                    <i class="fas fa-save mr-2"></i>Save Changes
                </button>
            </div>
        </div>
    </div>

    <!-- Preview Box -->
    <div class="bg-white rounded-lg shadow-md p-8 mt-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Preview</h3>
        <div id="preview" class="prose max-w-none">
            <h4 id="preview-title" class="text-xl font-bold text-gray-900 mb-2">{{ $announcement->title }}</h4>
            <div class="flex items-center text-sm text-gray-500 mb-4">
                <i class="far fa-calendar mr-2"></i>
                <span>{{ $announcement->created_at->format('F d, Y') }}</span>
                <span class="mx-2">•</span>
                <i class="far fa-user mr-2"></i>
                <span>{{ $announcement->author ? $announcement->author->name : 'Admin' }}</span>
            </div>
            <div id="preview-content" class="text-gray-700">
                {!! nl2br(e($announcement->content)) !!}
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