@extends('layouts.admin')

@section('title', 'Create Facility')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Create Facility</h1>
        <p class="text-gray-600 mt-1">Add a new school facility</p>
    </div>
    <a href="{{ route('admin.facilities.index') }}"
        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
        <i class="fas fa-arrow-left mr-2"></i>Back
    </a>
</div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('admin.facilities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Facility Name -->
            <div class="mb-6">
                <label for="caption" class="block text-sm font-medium text-gray-700 mb-2">
                    Facility Name <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="caption"
                    id="caption"
                    value="{{ old('caption') }}"
                    required
                    placeholder="e.g., Science Laboratory, Library, Gymnasium..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('caption') border-red-500 @enderror">
                @error('caption')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="detail" class="block text-sm font-medium text-gray-700 mb-2">
                    Description
                </label>
                <textarea
                    name="detail"
                    id="detail"
                    rows="6"
                    placeholder="Describe the facility, its features, capacity, and amenities..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('detail') border-red-500 @enderror">{{ old('detail') }}</textarea>
                @error('detail')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">Optional: Provide details about the facility and its purpose.</p>
            </div>

            <!-- Image -->
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    Facility Image
                </label>
                <input type="file"
                    name="image"
                    id="image"
                    accept="image/jpeg,image/jpg,image/png"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('image') border-red-500 @enderror">
                @error('image')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">Accepted formats: JPG, JPEG, PNG (Max 5MB)</p>

                <!-- Image Preview -->
                <div id="imagePreview" class="mt-4 hidden">
                    <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                    <img id="previewImage" src="" alt="Preview" class="max-w-xs rounded-lg border border-gray-300">
                </div>
            </div>

            <!-- Info Box -->
            <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-600 mt-1 mr-3"></i>
                    <div class="text-sm text-blue-800">
                        <p class="font-semibold mb-1">Display Information</p>
                        <p>This facility will be displayed on the public facilities page with its image and description.</p>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                <a href="{{ route('admin.facilities.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-8 py-3 rounded-lg transition duration-300">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-300">
                    <i class="fas fa-save mr-2"></i>Create Facility
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Image preview with file size validation
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Check file size (5MB = 5242880 bytes)
            const maxSize = 5242880; // 5MB in bytes
            const fileSize = file.size;
            const fileSizeMB = (fileSize / 1024 / 1024).toFixed(2);

            if (fileSize > maxSize) {
                alert(`File size is ${fileSizeMB}MB. Maximum allowed size is 5MB. Please choose a smaller image.`);
                this.value = ''; // Clear the file input
                document.getElementById('imagePreview').classList.add('hidden');
                return;
            }

            // Show file size info
            console.log(`File size: ${fileSizeMB}MB`);

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
