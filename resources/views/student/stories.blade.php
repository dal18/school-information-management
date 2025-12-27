@extends('layouts.admin')

@section('title', 'Success Stories')

@section('header')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Success Stories</h1>
    <p class="text-gray-600 mt-1">Read inspiring stories from our students</p>
</div>
@endsection

@section('content')
<div class="mb-6">
    <form action="{{ route('student.stories') }}" method="GET" class="flex gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search stories..."
               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg">
            <i class="fas fa-search mr-2"></i>Search
        </button>
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @forelse($stories as $story)
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
            <div class="flex items-start space-x-4">
                @if($story->image)
                    <img src="{{ asset('storage/' . $story->image) }}" alt="{{ $story->student_name }}"
                         class="w-20 h-20 rounded-full object-cover flex-shrink-0">
                @else
                    <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user text-2xl text-gray-400"></i>
                    </div>
                @endif
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-gray-900">{{ $story->title }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ $story->student_name }} - {{ $story->grade_level }}</p>
                    <p class="text-gray-700 line-clamp-3">{{ Str::limit($story->content, 150) }}</p>
                    <p class="text-sm text-gray-500 mt-3">
                        <i class="fas fa-calendar mr-1"></i>
                        {{ $story->created_at ? $story->created_at->format('M d, Y') : 'N/A' }}
                    </p>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-star text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">No success stories available.</p>
        </div>
    @endforelse
</div>

@if($stories->hasPages())
    <div class="mt-6">
        {{ $stories->links() }}
    </div>
@endif
@endsection
