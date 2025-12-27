@extends('layouts.admin')

@section('title', 'Edit Administrator')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Edit Administrator</h1>
        <p class="text-gray-600 mt-1">Update administrator details</p>
    </div>
    <a href="{{ route('admin.administrators.index') }}"
        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
        <i class="fas fa-arrow-left mr-2"></i>Back
    </a>
</div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('admin.administrators.update', $administrator) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $administrator->name) }}"
                    required
                    placeholder="e.g., Dr. John Doe"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('name') border-red-500 @enderror">
                @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Position -->
            <div class="mb-6">
                <label for="position" class="block text-sm font-medium text-gray-700 mb-2">
                    Position/Title <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="position"
                    id="position"
                    value="{{ old('position', $administrator->position) }}"
                    required
                    placeholder="e.g., School Director, Principal, Administrative Officer"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('position') border-red-500 @enderror">
                @error('position')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-6">
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                    Category <span class="text-red-500">*</span>
                </label>
                <select name="category" id="category" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('category') border-red-500 @enderror">
                    <option value="">Select Category</option>
                    <option value="Directors" {{ old('category', $administrator->category) == 'Directors' ? 'selected' : '' }}>Directors</option>
                    <option value="Principals" {{ old('category', $administrator->category) == 'Principals' ? 'selected' : '' }}>Principals</option>
                    <option value="Administrative Staff" {{ old('category', $administrator->category) == 'Administrative Staff' ? 'selected' : '' }}>Administrative Staff</option>
                </select>
                @error('category')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email Address
                </label>
                <input type="email"
                    name="email"
                    id="email"
                    value="{{ old('email', $administrator->email) }}"
                    placeholder="johndoe@example.com"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('email') border-red-500 @enderror">
                @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div class="mb-6">
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                    Phone Number
                </label>
                <input type="text"
                    name="phone"
                    id="phone"
                    value="{{ old('phone', $administrator->phone) }}"
                    placeholder="e.g., +63 912 345 6789"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('phone') border-red-500 @enderror">
                @error('phone')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bio -->
            <div class="mb-6">
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">
                    Biography
                </label>
                <textarea
                    name="bio"
                    id="bio"
                    rows="6"
                    placeholder="Provide a brief biography, qualifications, and achievements..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('bio') border-red-500 @enderror">{{ old('bio', $administrator->bio) }}</textarea>
                @error('bio')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">Optional: Add educational background, experience, and notable achievements.</p>
            </div>

            <!-- Current Image -->
            @if($administrator->image)
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Current Image
                </label>
                <div class="relative inline-block">
                    <img src="{{ asset('storage/' . $administrator->image) }}"
                        alt="{{ $administrator->name }}"
                        class="max-w-xs rounded-lg border border-gray-300">
                </div>
            </div>
            @endif

            <!-- New Image -->
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $administrator->image ? 'Replace Image' : 'Profile Image' }}
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
                    {{ $administrator->image ? 'Upload a new image to replace the current one. ' : '' }}Accepted formats: JPG, JPEG, PNG (Max 5MB)
                </p>

                <!-- Image Preview -->
                <div id="imagePreview" class="mt-4 hidden">
                    <p class="text-sm font-medium text-gray-700 mb-2">New Image Preview:</p>
                    <img id="previewImage" src="" alt="Preview" class="max-w-xs rounded-lg border border-gray-300">
                </div>
            </div>

            <!-- Display Order -->
            <div class="mb-6">
                <label for="display_order" class="block text-sm font-medium text-gray-700 mb-2">
                    Display Order
                </label>
                <input type="number"
                    name="display_order"
                    id="display_order"
                    value="{{ old('display_order', $administrator->display_order) }}"
                    min="0"
                    placeholder="0"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('display_order') border-red-500 @enderror">
                @error('display_order')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">Lower numbers appear first.</p>
            </div>

            <!-- Meta Information -->
            <div class="mb-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Administrator Information</h4>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Created:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $administrator->created_at->format('F d, Y') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Last Updated:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $administrator->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-between pt-6 border-t">
                <button type="button"
                    onclick="confirmDelete('{{ $administrator->id }}')"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                    <i class="fas fa-trash mr-2"></i>Delete
                </button>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.administrators.index') }}"
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
    </div>
</div>

<!-- Separate Delete Form (Hidden) -->
<form id="delete-form-{{ $administrator->id }}"
    action="{{ route('admin.administrators.destroy', $administrator) }}"
    method="POST"
    style="display: none;">
    @csrf
    @method('DELETE')
</form>
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

    // Confirm delete function
    function confirmDelete(administratorId) {
        if (confirm('Are you sure you want to delete this administrator? This action cannot be undone.')) {
            document.getElementById('delete-form-' + administratorId).submit();
        }
    }
</script>
@endpush