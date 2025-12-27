@extends('layouts.admin')

@section('title', 'View Schedule')

@section('header')
<div class="mb-6">
    <div class="flex items-center space-x-2 text-sm text-gray-600 mb-2">
        <a href="{{ route('admin.schedules.index') }}" class="hover:text-primary-600">Schedules</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-gray-900 font-medium">View Schedule</span>
    </div>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $schedule->subject->subject_name ?? 'Schedule Details' }}</h1>
            <p class="text-gray-600 mt-1">{{ $schedule->grade_level }} - Section {{ $schedule->section }}</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.schedules.edit', $schedule) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                <i class="fas fa-edit mr-2"></i>Edit Schedule
            </a>
            <form action="{{ route('admin.schedules.destroy', $schedule) }}"
                  method="POST"
                  id="delete-form-{{ $schedule->id }}">
                @csrf
                @method('DELETE')
                <button type="button"
                        onclick="confirmDelete('delete-form-{{ $schedule->id }}', 'Are you sure you want to delete this schedule?', 'Delete Schedule?')"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                    <i class="fas fa-trash mr-2"></i>Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl">
    <!-- Schedule Information -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">
            <i class="fas fa-info-circle mr-2 text-blue-600"></i>Schedule Information
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-book text-blue-600"></i>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Subject</p>
                    <p class="font-semibold text-gray-900 text-lg">{{ $schedule->subject->subject_name ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chalkboard-teacher text-green-600"></i>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Teacher</p>
                    <p class="font-medium text-gray-900">
                        @if($schedule->teacher)
                            {{ $schedule->teacher->first_name }} {{ $schedule->teacher->last_name }}
                        @else
                            <span class="text-gray-400">Not assigned</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-purple-600"></i>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Grade Level</p>
                    <p class="font-medium text-gray-900">{{ $schedule->grade_level }}</p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-yellow-600"></i>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Section</p>
                    <p class="font-medium text-gray-900">{{ $schedule->section }}</p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-day text-indigo-600"></i>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Day of Week</p>
                    <p class="font-medium text-gray-900">{{ $schedule->day_of_week }}</p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-red-600"></i>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Time</p>
                    <p class="font-medium text-gray-900">
                        {{ date('g:i A', strtotime($schedule->start_time)) }} - {{ date('g:i A', strtotime($schedule->end_time)) }}
                    </p>
                </div>
            </div>

            @if($schedule->room)
            <div class="flex items-center space-x-3 md:col-span-2">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-door-open text-orange-600"></i>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Room</p>
                    <p class="font-medium text-gray-900">{{ $schedule->room }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Metadata -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">
            <i class="fas fa-database mr-2 text-blue-600"></i>Metadata
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
            <div>
                <p class="text-gray-500 mb-1">Schedule ID</p>
                <p class="font-medium text-gray-900">#{{ str_pad($schedule->id, 5, '0', STR_PAD_LEFT) }}</p>
            </div>
            <div>
                <p class="text-gray-500 mb-1">Created</p>
                <p class="font-medium text-gray-900">{{ $schedule->created_at->format('M d, Y') }}</p>
                <p class="text-xs text-gray-500">{{ $schedule->created_at->format('h:i A') }}</p>
            </div>
            <div>
                <p class="text-gray-500 mb-1">Last Updated</p>
                <p class="font-medium text-gray-900">{{ $schedule->updated_at->format('M d, Y') }}</p>
                <p class="text-xs text-gray-500">{{ $schedule->updated_at->format('h:i A') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
