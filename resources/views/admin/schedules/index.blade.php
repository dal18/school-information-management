@extends('layouts.admin')

@section('title', 'Schedules')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Class Schedules</h1>
        <p class="text-gray-600 mt-1">Manage class timetables and schedules</p>
    </div>
    <a href="{{ route('admin.schedules.create') }}"
        class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
        <i class="fas fa-plus mr-2"></i>Add Schedule
    </a>
</div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md">
    <!-- Filters and Search -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
            <div class="flex-1 max-w-md">
                <form action="{{ route('admin.schedules.index') }}" method="GET" class="flex space-x-3">
                    <div class="relative flex-1">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search by subject, teacher, grade, section, or room..."
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <select name="day"
                            onchange="this.form.submit()"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <option value="all" {{ request('day') == 'all' || !request('day') ? 'selected' : '' }}>All Days</option>
                        <option value="Monday" {{ request('day') == 'Monday' ? 'selected' : '' }}>Monday</option>
                        <option value="Tuesday" {{ request('day') == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                        <option value="Wednesday" {{ request('day') == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                        <option value="Thursday" {{ request('day') == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                        <option value="Friday" {{ request('day') == 'Friday' ? 'selected' : '' }}>Friday</option>
                        <option value="Saturday" {{ request('day') == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                        <option value="Sunday" {{ request('day') == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                    </select>
                    <select name="grade"
                            onchange="this.form.submit()"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <option value="all" {{ request('grade') == 'all' || !request('grade') ? 'selected' : '' }}>All Grades</option>
                        <option value="Grade 7" {{ request('grade') == 'Grade 7' ? 'selected' : '' }}>Grade 7</option>
                        <option value="Grade 8" {{ request('grade') == 'Grade 8' ? 'selected' : '' }}>Grade 8</option>
                        <option value="Grade 9" {{ request('grade') == 'Grade 9' ? 'selected' : '' }}>Grade 9</option>
                        <option value="Grade 10" {{ request('grade') == 'Grade 10' ? 'selected' : '' }}>Grade 10</option>
                        <option value="Grade 11" {{ request('grade') == 'Grade 11' ? 'selected' : '' }}>Grade 11</option>
                        <option value="Grade 12" {{ request('grade') == 'Grade 12' ? 'selected' : '' }}>Grade 12</option>
                    </select>
                </form>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-sm text-gray-600">
                    Total: <span class="font-semibold">{{ $schedules->total() }}</span> schedules
                </span>
                <a href="{{ route('admin.schedules.export', request()->query()) }}"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg transition duration-300 inline-flex items-center text-sm">
                    <i class="fas fa-file-pdf mr-2"></i>Export PDF
                </a>
            </div>
        </div>
    </div>

    <!-- Schedules List -->
    <div class="p-6">
        @if($schedules->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Day</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Time</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Subject</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Teacher</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Grade & Section</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Room</th>
                            <th class="text-right py-3 px-4 font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schedules as $schedule)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="py-4 px-4">
                                <span class="inline-block px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">
                                    {{ $schedule->day_of_week }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-700">
                                <i class="fas fa-clock text-gray-400 mr-1"></i>
                                {{ date('g:i A', strtotime($schedule->start_time)) }}
                                <span class="text-gray-400">-</span>
                                {{ date('g:i A', strtotime($schedule->end_time)) }}
                            </td>
                            <td class="py-4 px-4">
                                <span class="font-semibold text-gray-900">
                                    {{ $schedule->subject->subject_name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-700">
                                @if($schedule->teacher)
                                    {{ $schedule->teacher->first_name }} {{ $schedule->teacher->last_name }}
                                @else
                                    <span class="text-gray-400">Not assigned</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-sm">
                                <div class="text-gray-900 font-medium">{{ $schedule->grade_level }}</div>
                                <div class="text-gray-500 text-xs">Section {{ $schedule->section }}</div>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-600">
                                @if($schedule->room)
                                    <i class="fas fa-door-open text-gray-400 mr-1"></i>{{ $schedule->room }}
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="{{ route('admin.schedules.show', $schedule) }}"
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium"
                                       title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.schedules.edit', $schedule) }}"
                                       class="text-yellow-600 hover:text-yellow-800 text-sm font-medium"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.schedules.destroy', $schedule) }}"
                                          method="POST"
                                          id="delete-form-{{ $schedule->id }}"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                onclick="confirmDelete('delete-form-{{ $schedule->id }}', 'Are you sure you want to delete this schedule?', 'Delete Schedule?')"
                                                class="text-red-600 hover:text-red-800 text-sm font-medium"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $schedules->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-calendar-week text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">No schedules found</p>
                @if(!request('search') && (request('day') == 'all' || !request('day')) && (request('grade') == 'all' || !request('grade')))
                <a href="{{ route('admin.schedules.create') }}"
                   class="inline-block mt-4 bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                    <i class="fas fa-plus mr-2"></i>Create First Schedule
                </a>
                @else
                <p class="text-gray-400 mt-2">Try adjusting your filters or search terms</p>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
