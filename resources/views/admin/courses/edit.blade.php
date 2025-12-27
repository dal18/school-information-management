@extends('layouts.admin')

@section('title', 'Edit Course')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Edit Course</h1>
        <p class="text-gray-600 mt-1">Update course details</p>
    </div>
    <a href="{{ route('admin.courses.index') }}"
        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
        <i class="fas fa-arrow-left mr-2"></i>Back
    </a>
</div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <!-- UPDATE FORM -->
        <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Subject Name -->
            <div class="mb-6">
                <label for="subject_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Subject Name <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="subject_name"
                    id="subject_name"
                    value="{{ old('subject_name', $course->subject_name) }}"
                    required
                    placeholder="e.g., Mathematics, English, Science..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('subject_name') border-red-500 @enderror">
                @error('subject_name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Grade Level -->
            <div class="mb-6">
                <label for="grade_level" class="block text-sm font-medium text-gray-700 mb-2">
                    Grade Level <span class="text-red-500">*</span>
                </label>
                <select name="grade_level" id="grade_level" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('grade_level') border-red-500 @enderror">
                    <option value="">Select Grade Level</option>
                    <option value="Grade 7" {{ old('grade_level', $course->grade_level) == 'Grade 7' ? 'selected' : '' }}>Grade 7</option>
                    <option value="Grade 8" {{ old('grade_level', $course->grade_level) == 'Grade 8' ? 'selected' : '' }}>Grade 8</option>
                    <option value="Grade 9" {{ old('grade_level', $course->grade_level) == 'Grade 9' ? 'selected' : '' }}>Grade 9</option>
                    <option value="Grade 10" {{ old('grade_level', $course->grade_level) == 'Grade 10' ? 'selected' : '' }}>Grade 10</option>
                    <option value="Grade 11" {{ old('grade_level', $course->grade_level) == 'Grade 11' ? 'selected' : '' }}>Grade 11</option>
                    <option value="Grade 12" {{ old('grade_level', $course->grade_level) == 'Grade 12' ? 'selected' : '' }}>Grade 12</option>
                    <option value="All Grades" {{ old('grade_level', $course->grade_level) == 'All Grades' ? 'selected' : '' }}>All Grades</option>
                </select>
                @error('grade_level')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Description
                </label>
                <textarea
                    name="description"
                    id="description"
                    rows="6"
                    placeholder="Provide a brief description of the course, topics covered, and learning objectives..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description', $course->description) }}</textarea>
                @error('description')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">Optional: Add course details, curriculum overview, or key topics.</p>
            </div>

            <!-- Current Image -->
            @if($course->image_path)
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Current Image
                </label>
                <div class="relative inline-block">
                    <img src="{{ asset('storage/' . $course->image_path) }}"
                        alt="{{ $course->subject_name }}"
                        class="max-w-xs rounded-lg border border-gray-300">
                </div>
            </div>
            @endif

            <!-- New Image -->
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $course->image_path ? 'Replace Image' : 'Course Image' }}
                </label>
                <input type="file"
                    name="image"
                    id="image"
                    accept="image/jpeg,image/jpg,image/png"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('image') border-red-500 @enderror">
                @error('image')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">
                    {{ $course->image_path ? 'Upload a new image to replace the current one. ' : '' }}Accepted formats: JPG, JPEG, PNG (Max 5MB)
                </p>

                <!-- Image Preview -->
                <div id="imagePreview" class="mt-4 hidden">
                    <p class="text-sm font-medium text-gray-700 mb-2">New Image Preview:</p>
                    <img id="previewImage" src="" alt="Preview" class="max-w-xs rounded-lg border border-gray-300">
                </div>
            </div>

            <!-- Meta Information -->
            <div class="mb-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Course Information</h4>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Created:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $course->created_at->format('F d, Y') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Last Updated:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $course->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-between pt-6 border-t">
                <button type="button"
                    onclick="confirmDelete('delete-form-{{ $course->id }}', 'Are you sure you want to delete this course?', 'Delete Course?')"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                    <i class="fas fa-trash mr-2"></i>Delete
                </button>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.courses.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-8 py-3 rounded-lg transition duration-300">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-300">
                        <i class="fas fa-save mr-2"></i>Save Changes
                    </button>
                </div>
            </div>
        </form>

        <!-- DELETE FORM (Separate, Hidden) -->
        <form action="{{ route('admin.courses.destroy', $course) }}"
            method="POST"
            id="delete-form-{{ $course->id }}"
            class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('imagePreview').classList.add('hidden');
        }
    });
</script>
@endpush
