@extends('layouts.admin')

@section('title', 'Send Feedback')

@section('header')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Send Feedback</h1>
    <p class="text-gray-600 mt-1">Share your thoughts, suggestions, or concerns with us</p>
</div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md p-8 max-w-3xl">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('student.feedback.submit') }}" method="POST">
        @csrf

        <div class="mb-6">
            <label for="feedback_by" class="block text-sm font-medium text-gray-700 mb-2">
                Your Name <span class="text-red-500">*</span>
            </label>
            <input type="text" name="feedback_by" id="feedback_by" value="{{ auth()->user()->full_name }}" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 @error('feedback_by') border-red-500 @enderror">
            @error('feedback_by')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="Concern" class="block text-sm font-medium text-gray-700 mb-2">
                Feedback Type <span class="text-red-500">*</span>
            </label>
            <select name="Concern" id="Concern" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 @error('Concern') border-red-500 @enderror">
                <option value="">Select Type</option>
                <option value="Complaint">Complaint</option>
                <option value="Suggestion">Suggestion</option>
                <option value="Compliment">Compliment</option>
            </select>
            @error('Concern')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="about" class="block text-sm font-medium text-gray-700 mb-2">
                Message <span class="text-red-500">*</span>
            </label>
            <textarea name="about" id="about" rows="6" required
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 @error('about') border-red-500 @enderror"
                      placeholder="Share your feedback here (minimum 10 characters)...">{{ old('about') }}</textarea>
            @error('about')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end">
            <button type="submit"
                    class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-300">
                <i class="fas fa-paper-plane mr-2"></i>Submit Feedback
            </button>
        </div>
    </form>
</div>
@endsection
