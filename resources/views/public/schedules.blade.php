@extends('layouts.public')

@section('title', 'Class Schedules')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Academics', 'url' => '#'],
    ['label' => 'Class Schedules', 'icon' => 'fas fa-calendar-alt']
]" />

<!-- Page Header -->
<section class="relative py-16 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Class Schedules</h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                View our weekly class schedules and timetables
            </p>
        </div>
    </div>
</section>

<!-- Schedules Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Day Filter -->
        <div class="mb-8 flex flex-wrap justify-center gap-2">
            <div class="inline-flex flex-wrap rounded-lg border border-gray-200 bg-white p-1 gap-1">
                <a href="{{ route('schedules') }}"
                   class="px-4 py-2 rounded-md text-sm font-medium {{ !request('day') ? 'bg-primary-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    All Days
                </a>
                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                <a href="{{ route('schedules', ['day' => $day]) }}"
                   class="px-4 py-2 rounded-md text-sm font-medium {{ request('day') == $day ? 'bg-primary-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    {{ $day }}
                </a>
                @endforeach
            </div>
        </div>

        @if($schedulesByDay->count() > 0)
            @foreach($schedulesByDay as $day => $daySchedules)
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-calendar-day text-primary-600 mr-3"></i>
                    {{ $day }}
                </h2>

                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Time
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subject
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Teacher
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Grade & Section
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Room
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($daySchedules as $schedule)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <i class="fas fa-clock text-primary-600 mr-2"></i>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ date('g:i A', strtotime($schedule->start_time)) }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    to {{ date('g:i A', strtotime($schedule->end_time)) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ $schedule->subject->subject_name ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            @if($schedule->teacher)
                                                {{ $schedule->teacher->first_name }} {{ $schedule->teacher->last_name }}
                                            @else
                                                <span class="text-gray-400">Not assigned</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $schedule->grade_level }}</div>
                                        <div class="text-xs text-gray-500">Section {{ $schedule->section }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($schedule->room)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-door-open mr-1"></i>
                                            {{ $schedule->room }}
                                        </span>
                                        @else
                                        <span class="text-gray-400 text-sm">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="text-center py-16">
                <i class="fas fa-calendar-week text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">
                    @if(request('day'))
                        No schedules available for {{ request('day') }}.
                    @else
                        No schedules available at the moment.
                    @endif
                </p>
            </div>
        @endif
    </div>
</section>

<!-- Info Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-100 text-primary-600 mb-4">
                    <i class="fas fa-calendar-check text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Weekly Schedules</h3>
                <p class="text-gray-600">
                    View complete class schedules organized by day of the week
                </p>
            </div>
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-100 text-primary-600 mb-4">
                    <i class="fas fa-chalkboard-teacher text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Teacher Information</h3>
                <p class="text-gray-600">
                    Each schedule includes the assigned teacher for every class
                </p>
            </div>
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-100 text-primary-600 mb-4">
                    <i class="fas fa-door-open text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Room Locations</h3>
                <p class="text-gray-600">
                    Find out where each class is held throughout the week
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
