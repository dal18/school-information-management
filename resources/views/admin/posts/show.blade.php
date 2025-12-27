@extends('layouts.admin')

@section('title', 'View Post')

@section('header')
<div class="mb-6">
    <div class="flex items-center space-x-2 text-sm text-gray-600 mb-2">
        <a href="{{ route('admin.posts.index') }}" class="hover:text-primary-600">Posts</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-gray-900 font-medium">View Post</span>
    </div>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $post->title }}</h1>
            <p class="text-gray-600 mt-1">Post details and content</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.posts.edit', $post) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                <i class="fas fa-edit mr-2"></i>Edit Post
            </a>
            <form action="{{ route('admin.posts.destroy', $post) }}"
                  method="POST"
                  id="delete-form-{{ $post->id }}">
                @csrf
                @method('DELETE')
                <button type="button"
                        onclick="confirmDelete('delete-form-{{ $post->id }}', 'Are you sure you want to delete this post?', 'Delete Post?')"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                    <i class="fas fa-trash mr-2"></i>Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl">
    <!-- Post Meta Information -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">
            <i class="fas fa-info-circle mr-2 text-blue-600"></i>Post Information
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user text-blue-600"></i>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Author</p>
                    <p class="font-medium text-gray-900">
                        {{ $post->author ? $post->author->name : 'Unknown' }}
                    </p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar text-green-600"></i>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Published Date</p>
                    <p class="font-medium text-gray-900">{{ $post->created_at->format('M d, Y - h:i A') }}</p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-purple-600"></i>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Last Updated</p>
                    <p class="font-medium text-gray-900">{{ $post->updated_at->format('M d, Y - h:i A') }}</p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-hashtag text-orange-600"></i>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Post ID</p>
                    <p class="font-medium text-gray-900">#{{ str_pad($post->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Post Content -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">
            <i class="fas fa-file-alt mr-2 text-blue-600"></i>Content
        </h2>
        <div class="prose max-w-none">
            <div class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $post->content }}</div>
        </div>
    </div>
</div>
@endsection
