@extends('layouts.admin')

@section('title', 'Edit Facility')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Edit Facility</h1>
        <p class="text-gray-600 mt-1">Update facility details</p>
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
        <form action="{{ route('admin.facilities.update', $facility) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Facility Name -->
            <div class="mb-6">
                <label for="caption" class="block text-sm font-medium text-gray-700 mb-2">
                    Facility Name <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="caption"
                    id="caption"
                    value="{{ old('caption', $facility->caption) }}"
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
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('detail') border-red-500 @enderror">{{ old('detail', $facility->detail) }}</textarea>
                @error('detail')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">Optional: Provide details about the facility and its purpose.</p>
            </div>

            <!-- Current Image -->
            @if($facility->image_path)
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Current Image
                </label>
                <div class="relative inline-block">
                    <img src="{{ asset('storage/' . $facility->image_path) }}"
                        alt="{{ $facility->caption }}"
                        class="max-w-xs rounded-lg border border-gray-300">
                </div>
            </div>
            @endif

            <!-- New Image -->
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $facility->image_path ? 'Replace Image' : 'Facility Image' }}
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
                    {{ $facility->image_path ? 'Upload a new image to replace the current one. ' : '' }}Accepted formats: JPG, JPEG, PNG (Max 5MB)
                </p>

                <!-- Image Preview -->
                <div id="imagePreview" class="mt-4 hidden">
                    <p class="text-sm font-medium text-gray-700 mb-2">New Image Preview:</p>
                    <img id="previewImage" src="" alt="Preview" class="max-w-xs rounded-lg border border-gray-300">
                </div>
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label for="is_active" class="block text-sm font-medium text-gray-700 mb-2">
                    Status
                </label>
                <select name="is_active" id="is_active"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <option value="1" {{ old('is_active', $facility->is_active) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', $facility->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                <p class="mt-2 text-sm text-gray-500">Inactive facilities will not be visible on the public website.</p>
            </div>

            <!-- Meta Information -->
            <div class="mb-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Facility Information</h4>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Created:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $facility->created_at ? $facility->created_at->format('F d, Y') : 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Last Updated:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $facility->updated_at ? $facility->updated_at->diffForHumans() : 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-between pt-6 border-t">
                <button type="button"
                    onclick="confirmDelete('delete-form-{{ $facility->id }}', 'This will permanently delete this facility. This action cannot be undone!', 'Delete Facility?')"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                    <i class="fas fa-trash mr-2"></i>Delete
                </button>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.facilities.index') }}"
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

        <!-- Separate Delete Form (outside update form) -->
        <form id="delete-form-{{ $facility->id }}" action="{{ route('admin.facilities.destroy', $facility) }}"
            method="POST" class="hidden">
            @csrf
            @method('DELETE')
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
            console.log('File name:', file.name);
            console.log('File type:', file.type);

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

    // Debug form submission
    document.querySelector('form').addEventListener('submit', function(e) {
        const fileInput = document.getElementById('image');
        const file = fileInput.files[0];

        console.log('=== FORM SUBMIT DEBUG ===');
        console.log('File input element:', fileInput);
        console.log('Has file?', fileInput.files.length > 0);
        console.log('File object:', file);
        console.log('Form enctype:', this.enctype);
        console.log('Form method:', this.method);
        console.log('Form action:', this.action);

        if (!file) {
            console.log('INFO: No new file selected - keeping existing image');
        } else {
            console.log('File will be uploaded:', file.name, 'Size:', (file.size / 1024 / 1024).toFixed(2) + 'MB');
        }
    });
</script>
@endpush
