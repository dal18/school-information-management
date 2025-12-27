@extends('layouts.admin')

@section('title', 'Edit Activity')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Edit Activity</h1>
        <p class="text-gray-600 mt-1">Update activity information</p>
    </div>
    <a href="{{ route('admin.activities.index') }}"
        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
        <i class="fas fa-arrow-left mr-2"></i>Back
    </a>
</div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('admin.activities.update', $activity) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Activity Name -->
            <div class="mb-6">
                <label for="caption" class="block text-sm font-medium text-gray-700 mb-2">
                    Activity Name <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="caption"
                    id="caption"
                    value="{{ old('caption', $activity->caption) }}"
                    required
                    placeholder="e.g., Science Fair 2024, Sports Day"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('caption') border-red-500 @enderror">
                @error('caption')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-6">
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                    Category
                </label>
                <select name="category"
                        id="category"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('category') border-red-500 @enderror">
                    <option value="">Select Category</option>
                    <option value="Sports" {{ old('category', $activity->category) == 'Sports' ? 'selected' : '' }}>Sports</option>
                    <option value="Academic" {{ old('category', $activity->category) == 'Academic' ? 'selected' : '' }}>Academic</option>
                    <option value="Cultural" {{ old('category', $activity->category) == 'Cultural' ? 'selected' : '' }}>Cultural</option>
                    <option value="Social" {{ old('category', $activity->category) == 'Social' ? 'selected' : '' }}>Social</option>
                    <option value="Community Service" {{ old('category', $activity->category) == 'Community Service' ? 'selected' : '' }}>Community Service</option>
                    <option value="Field Trip" {{ old('category', $activity->category) == 'Field Trip' ? 'selected' : '' }}>Field Trip</option>
                    <option value="Competition" {{ old('category', $activity->category) == 'Competition' ? 'selected' : '' }}>Competition</option>
                    <option value="Other" {{ old('category', $activity->category) == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('category')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Post Type -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    <i class="fas fa-layer-group mr-1"></i> Post Type <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Regular Post -->
                    <label class="relative flex items-center p-4 border-2 rounded-lg cursor-pointer hover:border-primary-500 transition @error('post_type') border-red-500 @enderror">
                        <input type="radio" name="post_type" value="regular" {{ old('post_type', $activity->post_type) == 'regular' ? 'checked' : '' }}
                               class="sr-only peer" onchange="togglePostTypeFields()">
                        <div class="flex-1 text-center">
                            <i class="fas fa-image text-3xl text-gray-400 mb-2"></i>
                            <p class="font-semibold text-gray-900">Regular Post</p>
                            <p class="text-xs text-gray-500 mt-1">Picture + Description</p>
                        </div>
                        <div class="absolute inset-0 border-2 border-primary-600 rounded-lg opacity-0 peer-checked:opacity-100 transition"></div>
                    </label>

                    <!-- YouTube Embed -->
                    <label class="relative flex items-center p-4 border-2 rounded-lg cursor-pointer hover:border-red-500 transition">
                        <input type="radio" name="post_type" value="youtube" {{ old('post_type', $activity->post_type) == 'youtube' ? 'checked' : '' }}
                               class="sr-only peer" onchange="togglePostTypeFields()">
                        <div class="flex-1 text-center">
                            <i class="fab fa-youtube text-3xl text-red-600 mb-2"></i>
                            <p class="font-semibold text-gray-900">YouTube Video</p>
                            <p class="text-xs text-gray-500 mt-1">Embed YouTube video</p>
                        </div>
                        <div class="absolute inset-0 border-2 border-red-600 rounded-lg opacity-0 peer-checked:opacity-100 transition"></div>
                    </label>

                    <!-- Facebook Embed -->
                    <label class="relative flex items-center p-4 border-2 rounded-lg cursor-pointer hover:border-blue-500 transition">
                        <input type="radio" name="post_type" value="facebook" {{ old('post_type', $activity->post_type) == 'facebook' ? 'checked' : '' }}
                               class="sr-only peer" onchange="togglePostTypeFields()">
                        <div class="flex-1 text-center">
                            <i class="fab fa-facebook text-3xl text-blue-600 mb-2"></i>
                            <p class="font-semibold text-gray-900">Facebook Post</p>
                            <p class="text-xs text-gray-500 mt-1">Embed Facebook post</p>
                        </div>
                        <div class="absolute inset-0 border-2 border-blue-600 rounded-lg opacity-0 peer-checked:opacity-100 transition"></div>
                    </label>
                </div>
                @error('post_type')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Activity Date -->
            <div class="mb-6">
                <label for="date_uploaded" class="block text-sm font-medium text-gray-700 mb-2">
                    Activity Date
                </label>
                <input type="date"
                    name="date_uploaded"
                    id="date_uploaded"
                    value="{{ old('date_uploaded', $activity->date_uploaded ? $activity->date_uploaded->format('Y-m-d') : date('Y-m-d')) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('date_uploaded') border-red-500 @enderror">
                @error('date_uploaded')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">
                    The date when this activity took place or will take place
                </p>
            </div>

            <!-- YouTube URL -->
            <div class="mb-6" id="youtube_field" style="display: none;">
                <label for="youtube_url" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fab fa-youtube text-red-600 mr-1"></i> YouTube Video URL
                </label>
                <input type="url"
                    name="youtube_url"
                    id="youtube_url"
                    value="{{ old('youtube_url', $activity->youtube_url) }}"
                    placeholder="https://www.youtube.com/watch?v=..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('youtube_url') border-red-500 @enderror">
                @error('youtube_url')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">
                    Paste a YouTube video link to embed it (e.g., https://www.youtube.com/watch?v=VIDEO_ID)
                </p>
            </div>

            <!-- Facebook URL -->
            <div class="mb-6" id="facebook_field" style="display: none;">
                <label for="facebook_url" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fab fa-facebook text-blue-600 mr-1"></i> Facebook Embed URL
                </label>
                <textarea
                    name="facebook_url"
                    id="facebook_url"
                    rows="3"
                    placeholder="https://www.facebook.com/plugins/post.php?href=..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent font-mono text-xs @error('facebook_url') border-red-500 @enderror">{{ old('facebook_url', $activity->facebook_url) }}</textarea>
                @error('facebook_url')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div class="mt-2 bg-blue-50 border border-blue-200 rounded-lg p-3">
                    <p class="text-xs text-blue-800 font-semibold mb-2">
                        <i class="fas fa-info-circle mr-1"></i>How to embed Facebook Post (2 Easy Ways):
                    </p>
                    <div class="text-xs text-blue-700 space-y-2">
                        <div class="bg-white rounded p-2 border border-blue-100">
                            <p class="font-semibold text-blue-800 mb-1">✅ Option 1: Paste entire iframe code (EASIEST!)</p>
                            <ol class="ml-4 list-decimal space-y-1">
                                <li>Go to your PUBLIC Facebook post</li>
                                <li>Click the 3 dots (•••) → Click "Embed"</li>
                                <li>Copy the ENTIRE iframe code shown</li>
                                <li>Paste it here (the whole thing!)</li>
                            </ol>
                        </div>
                        <div class="bg-white rounded p-2 border border-blue-100">
                            <p class="font-semibold text-blue-800 mb-1">Option 2: Paste just the URL</p>
                            <p>Copy only the URL from inside src="..." and paste it here</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Image -->
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    Activity Image
                </label>
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <img id="image_preview"
                            src="{{ $activity->link_image ? asset('storage/' . $activity->link_image) : asset('images/default-activity.png') }}"
                            alt="Preview"
                            class="w-32 h-32 object-cover border-2 border-gray-300 rounded-lg"
                            onerror="this.src='https://via.placeholder.com/128x128?text=Activity+Image'">
                    </div>
                    <div class="flex-grow">
                        <input type="file"
                            name="image"
                            id="image"
                            accept="image/jpeg,image/jpg,image/png,image/gif,image/webp"
                            class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-lg file:border-0
                                file:text-sm file:font-semibold
                                file:bg-primary-50 file:text-primary-700
                                hover:file:bg-primary-100
                                cursor-pointer border border-gray-300 rounded-lg
                                focus:ring-2 focus:ring-primary-500 focus:border-transparent
                                @error('image') border-red-500 @enderror">
                        @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">
                            JPG, PNG, GIF or WEBP. Max size: 5MB. Recommended: 1200x800px
                        </p>
                        @if($activity->link_image)
                        <p class="mt-1 text-xs text-blue-600">
                            <i class="fas fa-check-circle mr-1"></i>Current image will be replaced if you upload a new one
                        </p>
                        @endif
                    </div>
                </div>
            </div>

            <script>
                // Image preview functionality
                document.getElementById('image').addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('image_preview').src = e.target.result;
                        }
                        reader.readAsDataURL(file);
                    }
                });

                // Toggle post type fields
                function togglePostTypeFields() {
                    const postType = document.querySelector('input[name="post_type"]:checked').value;
                    const youtubeField = document.getElementById('youtube_field');
                    const facebookField = document.getElementById('facebook_field');

                    // Hide all embed fields first
                    youtubeField.style.display = 'none';
                    facebookField.style.display = 'none';

                    // Show the selected embed field
                    if (postType === 'youtube') {
                        youtubeField.style.display = 'block';
                    } else if (postType === 'facebook') {
                        facebookField.style.display = 'block';
                    }
                }

                // Initialize on page load
                document.addEventListener('DOMContentLoaded', function() {
                    togglePostTypeFields();
                });
            </script>

            <!-- Info Box -->
            <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-600 mt-1 mr-3"></i>
                    <div class="text-sm text-blue-800">
                        <p class="font-semibold mb-1">Update Activity</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Modify any fields that need updating</li>
                            <li>Upload a new image if you want to replace the current one</li>
                            <li>Leave image field empty to keep the current image</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                <a href="{{ route('admin.activities.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-8 py-3 rounded-lg transition duration-300">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-300">
                    <i class="fas fa-save mr-2"></i>Update Activity
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
