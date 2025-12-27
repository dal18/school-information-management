@extends('layouts.admin')

@section('title', 'Courses')

@section('header')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Available Courses</h1>
    <p class="text-gray-600 mt-1">Browse our academic programs and subjects</p>
</div>
@endsection

@section('content')
<div class="space-y-8">
    @foreach($subjects->sortKeys() as $gradeLevel => $gradeSubjects)
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 pb-3 border-b">{{ $gradeLevel }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($gradeSubjects as $subject)
                    <div class="border border-gray-200 rounded-lg p-5 hover:shadow-lg transition">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-primary-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-book text-white text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $subject->subject_name }}</h3>
                                @if($subject->description)
                                    <p class="text-gray-600 text-sm mt-2 line-clamp-3">{{ $subject->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    @if($subjects->isEmpty())
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-book text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">No courses available at this time.</p>
        </div>
    @endif
</div>
@endsection
