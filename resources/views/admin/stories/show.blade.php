@extends('layouts.admin')

@section('title', 'View Story')

@section('header')
<div class="mb-6"><div class="flex items-center justify-between"><div><h1 class="text-3xl font-bold text-gray-900">Story Details</h1></div><div class="flex gap-2"><a href="{{ route('admin.stories.edit', $story) }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-semibold transition"><i class="fas fa-edit mr-2"></i>Edit</a><a href="{{ route('admin.stories.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition"><i class="fas fa-arrow-left mr-2"></i>Back</a></div></div></div>
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-md p-8">
@if($story->image)<img src="{{ asset('storage/' . $story->image) }}" alt="{{ $story->title }}" class="w-full max-w-2xl rounded-lg mb-6">@endif
<h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $story->title }}</h2>
<div class="grid grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 rounded-lg"><div><p class="text-sm text-gray-600">Student:</p><p class="font-semibold">{{ $story->student_name }}</p></div><div><p class="text-sm text-gray-600">Grade Level:</p><p class="font-semibold">{{ $story->grade_level }}</p></div></div>
<div class="prose max-w-none mb-6"><p class="text-gray-700 leading-relaxed">{{ $story->content }}</p></div>
<div class="pt-6 border-t border-gray-200 text-sm text-gray-500">Created: {{ $story->created_at->format('F d, Y') }}</div>
</div>
@endsection
