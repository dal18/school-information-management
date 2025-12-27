@extends('layouts.admin')

@section('title', 'Courses')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Courses/Subjects</h1>
        <p class="text-gray-600 mt-1">Manage school courses and subjects</p>
    </div>
    <a href="{{ route('admin.courses.create') }}"
        class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
        <i class="fas fa-plus mr-2"></i>New Course
    </a>
</div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    @if($subjects->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Image
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Subject Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Grade Level
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Description
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($subjects as $subject)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($subject->image_path)
                            <img src="{{ asset('storage/' . $subject->image_path) }}"
                                 alt="{{ $subject->subject_name }}"
                                 class="h-16 w-16 rounded-lg object-cover">
                            @else
                            <div class="h-16 w-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-book text-gray-400 text-xl"></i>
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $subject->subject_name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $subject->grade_level }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-600">{{ Str::limit($subject->description, 100) ?: 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.courses.edit', $subject) }}"
                                class="text-blue-600 hover:text-blue-900 mr-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.courses.destroy', $subject) }}"
                                method="POST"
                                class="inline"
                                id="delete-form-{{ $subject->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete('delete-form-{{ $subject->id }}', 'Are you sure you want to delete this course?', 'Delete Course?')" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-white px-6 py-4 border-t border-gray-200">
            {{ $subjects->links() }}
        </div>
    @else
        <div class="p-12 text-center">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-book text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Courses Yet</h3>
            <p class="text-gray-600 mb-6">Start adding courses and subjects to your school curriculum.</p>
            <a href="{{ route('admin.courses.create') }}"
                class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                <i class="fas fa-plus mr-2"></i>Create Course
            </a>
        </div>
    @endif
</div>
@endsection
