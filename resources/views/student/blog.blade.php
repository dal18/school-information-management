@extends('layouts.admin')

@section('title', 'Blog Posts')

@section('header')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Blog Posts</h1>
    <p class="text-gray-600 mt-1">Read the latest news and updates</p>
</div>
@endsection

@section('content')
<div class="mb-6">
    <form action="{{ route('student.blog') }}" method="GET" class="flex gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search posts..."
               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg">
            <i class="fas fa-search mr-2"></i>Search
        </button>
    </form>
</div>

<div class="space-y-6">
    @forelse($posts as $post)
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
            <div class="flex items-start space-x-4">
                @if($post->image_path)
                    <img src="{{ \Storage::disk('public')->url($post->image_path) }}" alt="{{ $post->title }}"
                         class="w-32 h-32 rounded object-cover flex-shrink-0">
                @else
                    <div class="w-32 h-32 rounded bg-gray-200 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-newspaper text-4xl text-gray-400"></i>
                    </div>
                @endif
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $post->title }}</h2>
                    <p class="text-gray-700 mb-3">{{ Str::limit(strip_tags($post->content), 200) }}</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-calendar mr-2"></i>
                        {{ $post->created_at ? $post->created_at->format('M d, Y') : 'N/A' }}
                        @if($post->author)
                            <span class="mx-2">•</span>
                            <i class="fas fa-user mr-1"></i>
                            {{ $post->author->full_name }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">No blog posts available.</p>
        </div>
    @endforelse
</div>

@if($posts->hasPages())
    <div class="mt-6">
        {{ $posts->links() }}
    </div>
@endif
@endsection
