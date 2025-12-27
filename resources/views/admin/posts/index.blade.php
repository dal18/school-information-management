@extends('layouts.admin')

@section('title', 'Posts')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Blog Posts & News</h1>
        <p class="text-gray-600 mt-1">Manage your blog posts and news articles</p>
    </div>
    <a href="{{ route('admin.posts.create') }}"
        class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
        <i class="fas fa-plus mr-2"></i>Create Post
    </a>
</div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md">
    <!-- Filters and Search -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
            <div class="flex-1 max-w-md">
                <form action="{{ route('admin.posts.index') }}" method="GET">
                    <div class="relative">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search posts..."
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </form>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-sm text-gray-600">
                    Total: <span class="font-semibold">{{ $posts->total() }}</span> posts
                </span>
            </div>
        </div>
    </div>

    <!-- Posts List -->
    <div class="p-6">
        @if($posts->count() > 0)
            <div class="space-y-4">
                @foreach($posts as $post)
                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition duration-300">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                {{ $post->title }}
                            </h3>
                            <p class="text-gray-600 mb-3 line-clamp-2">
                                {{ $post->excerpt }}
                            </p>
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span>
                                    <i class="fas fa-user mr-1"></i>
                                    {{ $post->author ? $post->author->name : 'Unknown' }}
                                </span>
                                <span>
                                    <i class="fas fa-calendar mr-1"></i>
                                    {{ $post->created_at->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 ml-4">
                            <a href="{{ route('admin.posts.show', $post) }}"
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                            <a href="{{ route('admin.posts.edit', $post) }}"
                               class="text-yellow-600 hover:text-yellow-800 text-sm font-medium">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <form id="delete-form-{{ $post->id }}" action="{{ route('admin.posts.destroy', $post) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        onclick="confirmDelete('delete-form-{{ $post->id }}', 'This will permanently delete this post!', 'Delete Post?')"
                                        class="text-red-600 hover:text-red-800 text-sm font-medium">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">No posts found</p>
                @if(!request('search'))
                <a href="{{ route('admin.posts.create') }}"
                   class="inline-block mt-4 bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                    <i class="fas fa-plus mr-2"></i>Create First Post
                </a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
