@extends('layouts.admin')

@section('title', 'Stories Management')

@section('header')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Student Stories</h1>
            <p class="text-gray-600 mt-1">Manage student success stories</p>
        </div>
        <a href="{{ route('admin.stories.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center shadow-lg">
            <i class="fas fa-plus mr-2"></i>Add New Story
        </a>
    </div>
</div>
@endsection

@section('content')
<!-- Search & Actions -->
<div class="bg-white rounded-xl shadow-md p-6 mb-6">
    <form method="GET" action="{{ route('admin.stories.index') }}" class="flex gap-4">
        <div class="flex-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search stories..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
        </div>
        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg transition">
            <i class="fas fa-search"></i> Search
        </button>
        @if(request('search'))
        <a href="{{ route('admin.stories.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
            <i class="fas fa-times"></i> Clear
        </a>
        @endif
    </form>
</div>

<!-- Stories Grid -->
@if($stories->count() > 0)
<form id="bulk-delete-form" method="POST" action="{{ route('admin.stories.bulk-delete') }}">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        @foreach($stories as $story)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
            @if($story->image)
            <img src="{{ asset('storage/' . $story->image) }}" alt="{{ $story->title }}" class="w-full h-48 object-cover">
            @else
            <div class="w-full h-48 bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center">
                <i class="fas fa-book-open text-white text-5xl"></i>
            </div>
            @endif
            <div class="p-6">
                <div class="flex items-center justify-between mb-2">
                    <input type="checkbox" name="ids[]" value="{{ $story->id }}" class="story-checkbox rounded border-gray-300">
                    <span class="text-xs text-gray-500">{{ $story->grade_level }}</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $story->title }}</h3>
                <p class="text-sm text-gray-600 mb-3">By {{ $story->student_name }}</p>
                <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($story->content, 120) }}</p>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500">{{ $story->created_at->format('M d, Y') }}</span>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.stories.show', $story) }}" class="text-blue-600 hover:text-blue-900" title="View"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.stories.edit', $story) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{ route('admin.stories.destroy', $story) }}" class="inline" id="delete-form-{{ $story->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete('delete-form-{{ $story->id }}', 'Are you sure you want to delete this story?', 'Delete Story?')" class="text-red-600 hover:text-red-900" title="Delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 flex items-center justify-between">
        <button type="button" onclick="if(confirm('Delete selected stories?')) document.getElementById('bulk-delete-form').submit();" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-trash mr-2"></i>Delete Selected
        </button>
        <div>{{ $stories->links() }}</div>
    </div>
</form>
@else
<div class="bg-white rounded-xl shadow-md p-12 text-center">
    <i class="fas fa-book-open text-gray-300 text-6xl mb-4"></i>
    <p class="text-gray-500 text-lg">No stories found</p>
    <a href="{{ route('admin.stories.create') }}" class="inline-block mt-4 text-primary-600 hover:text-primary-700 font-semibold">
        <i class="fas fa-plus mr-2"></i>Add your first story
    </a>
</div>
@endif
@endsection
