@extends('layouts.admin')

@section('title', 'Add New Story')

@section('header')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Add New Story</h1>
            <p class="text-gray-600 mt-1">Create a new student success story</p>
        </div>
        <a href="{{ route('admin.stories.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-300">
            <i class="fas fa-arrow-left mr-2"></i>Back to List
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-md p-8">
    <form method="POST" action="{{ route('admin.stories.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="student_name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Student Name <span class="text-red-500">*</span>
                </label>
                <input type="text" id="student_name" name="student_name" value="{{ old('student_name') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('student_name') border-red-500 @enderror">
                @error('student_name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="grade_level" class="block text-sm font-semibold text-gray-700 mb-2">
                    Grade Level <span class="text-red-500">*</span>
                </label>
                <select id="grade_level" name="grade_level" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Select Grade Level</option>
                    <option value="Grade 7">Grade 7</option>
                    <option value="Grade 8">Grade 8</option>
                    <option value="Grade 9">Grade 9</option>
                    <option value="Grade 10">Grade 10</option>
                    <option value="Alumni">Alumni</option>
                </select>
                @error('grade_level')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                Story Title <span class="text-red-500">*</span>
            </label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('title') border-red-500 @enderror">
            @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                Story Content <span class="text-red-500">*</span>
            </label>
            <textarea id="content" name="content" rows="8" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('content') border-red-500 @enderror" placeholder="Tell the student's story...">{{ old('content') }}</textarea>
            @error('content')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Story Image</label>
            <input type="file" id="image" name="image" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            @error('image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                <i class="fas fa-save mr-2"></i>Create Story
            </button>
            <a href="{{ route('admin.stories.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-8 py-3 rounded-lg font-semibold transition duration-300">Cancel</a>
        </div>
    </form>
</div>
@endsection
