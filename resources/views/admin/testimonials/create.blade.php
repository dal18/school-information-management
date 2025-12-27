@extends('layouts.admin')

@section('title', 'Add New Testimonial')

@section('header')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Add New Testimonial</h1>
            <p class="text-gray-600 mt-1">Create a new student testimonial</p>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-300">
            <i class="fas fa-arrow-left mr-2"></i>Back to List
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-md p-8">
    <form method="POST" action="{{ route('admin.testimonials.store') }}">
        @csrf

        <!-- Student Name -->
        <div class="mb-6">
            <label for="student_name" class="block text-sm font-semibold text-gray-700 mb-2">
                Student Name <span class="text-red-500">*</span>
            </label>
            <input type="text"
                   id="student_name"
                   name="student_name"
                   value="{{ old('student_name') }}"
                   required
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('student_name') border-red-500 @enderror">
            @error('student_name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Grade Level -->
        <div class="mb-6">
            <label for="grade_level" class="block text-sm font-semibold text-gray-700 mb-2">
                Grade Level <span class="text-red-500">*</span>
            </label>
            <select id="grade_level"
                    name="grade_level"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('grade_level') border-red-500 @enderror">
                <option value="">Select Grade Level</option>
                <option value="Grade 7" {{ old('grade_level') == 'Grade 7' ? 'selected' : '' }}>Grade 7</option>
                <option value="Grade 8" {{ old('grade_level') == 'Grade 8' ? 'selected' : '' }}>Grade 8</option>
                <option value="Grade 9" {{ old('grade_level') == 'Grade 9' ? 'selected' : '' }}>Grade 9</option>
                <option value="Grade 10" {{ old('grade_level') == 'Grade 10' ? 'selected' : '' }}>Grade 10</option>
                <option value="Alumni" {{ old('grade_level') == 'Alumni' ? 'selected' : '' }}>Alumni</option>
            </select>
            @error('grade_level')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Message -->
        <div class="mb-6">
            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                Testimonial Message <span class="text-red-500">*</span>
            </label>
            <textarea id="message"
                      name="message"
                      rows="6"
                      required
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('message') border-red-500 @enderror"
                      placeholder="Enter the student's testimonial...">{{ old('message') }}</textarea>
            @error('message')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-1 text-sm text-gray-500">Minimum 20 characters</p>
        </div>

        <!-- Status -->
        <div class="mb-6">
            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                Status <span class="text-red-500">*</span>
            </label>
            <select id="status"
                    name="status"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ old('status', 'Approved') == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Rejected" {{ old('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex gap-4">
            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                <i class="fas fa-save mr-2"></i>Create Testimonial
            </button>
            <a href="{{ route('admin.testimonials.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-8 py-3 rounded-lg font-semibold transition duration-300">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
