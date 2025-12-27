@extends('layouts.admin')

@section('title', 'Edit Post')

@section('header')
<div class="mb-6">
    <div class="flex items-center space-x-2 text-sm text-gray-600 mb-2">
        <a href="{{ route('admin.posts.index') }}" class="hover:text-primary-600">Posts</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-gray-900 font-medium">Edit Post</span>
    </div>
    <h1 class="text-3xl font-bold text-gray-900">Edit Post</h1>
    <p class="text-gray-600 mt-1">Update your blog post or news article</p>
</div>
@endsection

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                Post Title <span class="text-red-500">*</span>
            </label>
            <input type="text"
                   id="title"
                   name="title"
                   value="{{ old('title', $post->title) }}"
                   required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('title') border-red-500 @enderror"
                   placeholder="Enter post title">
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Content -->
        <div class="mb-6">
            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                Content <span class="text-red-500">*</span>
            </label>
            <textarea id="content"
                      name="content"
                      rows="12"
                      required
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('content') border-red-500 @enderror"
                      placeholder="Write your post content here... (minimum 50 characters)">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-1 text-sm text-gray-500">
                <i class="fas fa-info-circle mr-1"></i>
                Minimum 50 characters required
            </p>
        </div>

        <!-- Post Info -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-600">Author:</span>
                    <span class="font-medium text-gray-900 ml-2">
                        {{ $post->author ? $post->author->name : 'Unknown' }}
                    </span>
                </div>
                <div>
                    <span class="text-gray-600">Created:</span>
                    <span class="font-medium text-gray-900 ml-2">
                        {{ $post->created_at->format('M d, Y - h:i A') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
            <a href="{{ route('admin.posts.index') }}"
               class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-300">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit"
                    class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                <i class="fas fa-save mr-2"></i>Update Post
            </button>
        </div>
    </form>
</div>
@endsection
