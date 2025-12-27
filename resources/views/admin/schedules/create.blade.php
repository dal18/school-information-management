@extends('layouts.admin')

@section('title', 'Create Schedule')

@section('header')
<div class="mb-6">
    <div class="flex items-center space-x-2 text-sm text-gray-600 mb-2">
        <a href="{{ route('admin.schedules.index') }}" class="hover:text-primary-600">Schedules</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-gray-900 font-medium">Create Schedule</span>
    </div>
    <h1 class="text-3xl font-bold text-gray-900">Create New Schedule</h1>
    <p class="text-gray-600 mt-1">Add a new class schedule to the timetable</p>
</div>
@endsection

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.schedules.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Subject -->
            <div class="md:col-span-2">
                <label for="subject_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Subject <span class="text-red-500">*</span>
                </label>
                @if($subjects->count() > 0)
                    <select id="subject_id"
                            name="subject_id"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('subject_id') border-red-500 @enderror">
                        <option value="">Select Subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->subject_name }}
                            </option>
                        @endforeach
                    </select>
                @else
                    <div class="w-full px-4 py-3 border border-yellow-300 bg-yellow-50 rounded-lg text-yellow-800">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Walang available na subjects. Mag-add muna sa <a href="{{ route('admin.courses.index') }}" class="underline font-semibold">Courses</a>.
                    </div>
                @endif
                @error('subject_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Teacher -->
            <div class="md:col-span-2">
                <label for="teacher_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Teacher <span class="text-red-500">*</span>
                </label>
                @if($teachers->count() > 0)
                    <select id="teacher_id"
                            name="teacher_id"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('teacher_id') border-red-500 @enderror">
                        <option value="">Select Teacher</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->first_name }} {{ $teacher->last_name }}
                            </option>
                        @endforeach
                    </select>
                @else
                    <div class="w-full px-4 py-3 border border-yellow-300 bg-yellow-50 rounded-lg text-yellow-800">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Walang available na teachers. Mag-add muna ng users with "Teacher" role sa <a href="{{ route('admin.users.index') }}" class="underline font-semibold">Users</a>.
                    </div>
                @endif
                @error('teacher_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Grade Level -->
            <div>
                <label for="grade_level" class="block text-sm font-medium text-gray-700 mb-2">
                    Grade Level <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       id="grade_level"
                       name="grade_level"
                       value="{{ old('grade_level') }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('grade_level') border-red-500 @enderror"
                       placeholder="e.g., Grade 10">
                @error('grade_level')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Section -->
            <div>
                <label for="section" class="block text-sm font-medium text-gray-700 mb-2">
                    Section <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       id="section"
                       name="section"
                       value="{{ old('section') }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('section') border-red-500 @enderror"
                       placeholder="e.g., A, B, Einstein">
                @error('section')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Day of Week -->
            <div>
                <label for="day_of_week" class="block text-sm font-medium text-gray-700 mb-2">
                    Day of Week <span class="text-red-500">*</span>
                </label>
                <select id="day_of_week"
                        name="day_of_week"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('day_of_week') border-red-500 @enderror">
                    <option value="">Select Day</option>
                    <option value="Monday" {{ old('day_of_week') == 'Monday' ? 'selected' : '' }}>Monday</option>
                    <option value="Tuesday" {{ old('day_of_week') == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                    <option value="Wednesday" {{ old('day_of_week') == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                    <option value="Thursday" {{ old('day_of_week') == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                    <option value="Friday" {{ old('day_of_week') == 'Friday' ? 'selected' : '' }}>Friday</option>
                    <option value="Saturday" {{ old('day_of_week') == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                    <option value="Sunday" {{ old('day_of_week') == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                </select>
                @error('day_of_week')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Room -->
            <div>
                <label for="room" class="block text-sm font-medium text-gray-700 mb-2">
                    Room
                </label>
                <input type="text"
                       id="room"
                       name="room"
                       value="{{ old('room') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('room') border-red-500 @enderror"
                       placeholder="e.g., Room 101, Science Lab">
                @error('room')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Start Time -->
            <div>
                <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">
                    Start Time <span class="text-red-500">*</span>
                </label>
                <input type="time"
                       id="start_time"
                       name="start_time"
                       value="{{ old('start_time') }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('start_time') border-red-500 @enderror">
                @error('start_time')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- End Time -->
            <div>
                <label for="end_time" class="block text-sm font-medium text-gray-700 mb-2">
                    End Time <span class="text-red-500">*</span>
                </label>
                <input type="time"
                       id="end_time"
                       name="end_time"
                       value="{{ old('end_time') }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('end_time') border-red-500 @enderror">
                @error('end_time')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-between pt-6 mt-6 border-t border-gray-200">
            <a href="{{ route('admin.schedules.index') }}"
               class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-300">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            @if($subjects->count() > 0 && $teachers->count() > 0)
                <button type="submit"
                        class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                    <i class="fas fa-save mr-2"></i>Create Schedule
                </button>
            @else
                <button type="button"
                        disabled
                        class="bg-gray-400 text-white font-semibold px-6 py-2 rounded-lg cursor-not-allowed"
                        title="Add subjects and teachers first">
                    <i class="fas fa-save mr-2"></i>Create Schedule
                </button>
            @endif
        </div>
    </form>
</div>
@endsection
