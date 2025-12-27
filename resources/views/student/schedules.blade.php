@extends('layouts.admin')

@section('title', 'Class Schedules')

@section('header')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Class Schedules</h1>
    <p class="text-gray-600 mt-1">View weekly class timetables</p>
</div>
@endsection

@section('content')
<div class="mb-6">
    <form action="{{ route('student.schedules') }}" method="GET" class="flex gap-4">
        <select name="day" class="px-4 py-2 border border-gray-300 rounded-lg">
            <option value="">All Days</option>
            <option value="Monday" {{ request('day') == 'Monday' ? 'selected' : '' }}>Monday</option>
            <option value="Tuesday" {{ request('day') == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
            <option value="Wednesday" {{ request('day') == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
            <option value="Thursday" {{ request('day') == 'Thursday' ? 'selected' : '' }}>Thursday</option>
            <option value="Friday" {{ request('day') == 'Friday' ? 'selected' : '' }}>Friday</option>
        </select>
        <select name="grade" class="px-4 py-2 border border-gray-300 rounded-lg">
            <option value="">All Grades</option>
            @for($i = 7; $i <= 12; $i++)
                <option value="Grade {{ $i }}" {{ request('grade') == "Grade $i" ? 'selected' : '' }}>Grade {{ $i }}</option>
            @endfor
        </select>
        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg">
            <i class="fas fa-filter mr-2"></i>Filter
        </button>
    </form>
</div>

<div class="space-y-6">
    @forelse($schedulesByDay as $day => $schedules)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-primary-600 text-white px-6 py-4">
                <h2 class="text-xl font-bold">{{ $day }}</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($schedules as $schedule)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                            <div class="flex items-start">
                                <div class="bg-primary-100 rounded-lg p-3">
                                    <i class="fas fa-book text-primary-600 text-xl"></i>
                                </div>
                                <div class="ml-3 flex-1">
                                    <h3 class="font-bold text-gray-900">{{ $schedule->subject ? $schedule->subject->subject_name : 'N/A' }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">
                                        <i class="fas fa-user-tie mr-1"></i>
                                        {{ $schedule->teacher ? $schedule->teacher->full_name : 'TBA' }}
                                    </p>
                                    <p class="text-sm text-primary-700 mt-1">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ date('g:i A', strtotime($schedule->start_time)) }} - {{ date('g:i A', strtotime($schedule->end_time)) }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        <i class="fas fa-graduation-cap mr-1"></i>
                                        {{ $schedule->grade_level }} - Section {{ $schedule->section }}
                                    </p>
                                    @if($schedule->room)
                                        <p class="text-sm text-gray-600 mt-1">
                                            <i class="fas fa-door-open mr-1"></i>
                                            Room {{ $schedule->room }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-calendar-week text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">No schedules available.</p>
        </div>
    @endforelse
</div>
@endsection
