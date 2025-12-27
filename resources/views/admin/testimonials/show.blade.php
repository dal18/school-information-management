@extends('layouts.admin')

@section('title', 'View Testimonial')

@section('header')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Testimonial Details</h1>
            <p class="text-gray-600 mt-1">View testimonial information</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-300">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i>Back
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-md p-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-2">Student Name</label>
            <p class="text-lg text-gray-900">{{ $testimonial->student_name }}</p>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-2">Grade Level</label>
            <p class="text-lg text-gray-900">{{ $testimonial->grade_level }}</p>
        </div>
    </div>

    <div class="mb-8">
        <label class="block text-sm font-semibold text-gray-600 mb-2">Status</label>
        @if($testimonial->status == 'Approved')
            <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                <i class="fas fa-check-circle mr-2"></i> Approved
            </span>
        @elseif($testimonial->status == 'Pending')
            <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                <i class="fas fa-clock mr-2"></i> Pending
            </span>
        @else
            <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full bg-red-100 text-red-800">
                <i class="fas fa-times-circle mr-2"></i> Rejected
            </span>
        @endif
    </div>

    <div class="mb-8">
        <label class="block text-sm font-semibold text-gray-600 mb-2">Testimonial Message</label>
        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
            <p class="text-gray-900 leading-relaxed">{{ $testimonial->message }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-gray-200">
        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-2">Created At</label>
            <p class="text-gray-900">{{ $testimonial->created_at->format('F d, Y h:i A') }}</p>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-2">Last Updated</label>
            <p class="text-gray-900">{{ $testimonial->updated_at->format('F d, Y h:i A') }}</p>
        </div>
    </div>
</div>
@endsection
