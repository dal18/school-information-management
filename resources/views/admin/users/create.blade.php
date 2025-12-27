@extends('layouts.admin')

@section('title', 'Create User')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Create User</h1>
        <p class="text-gray-600 mt-1">Add a new user to the system</p>
    </div>
    <a href="{{ route('admin.users.index') }}"
        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
        <i class="fas fa-arrow-left mr-2"></i>Back
    </a>
</div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Username -->
                <div>
                    <label for="user_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Username <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        name="user_name"
                        id="user_name"
                        value="{{ old('user_name') }}"
                        required
                        placeholder="e.g., jsmith, john.doe"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('user_name') border-red-500 @enderror">
                    @error('user_name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Unique username for login</p>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="user@example.com"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('email') border-red-500 @enderror">
                    @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- First Name -->
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                        First Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        name="first_name"
                        id="first_name"
                        value="{{ old('first_name') }}"
                        required
                        placeholder="John"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('first_name') border-red-500 @enderror">
                    @error('first_name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Middle Name -->
                <div>
                    <label for="midle_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Middle Name
                    </label>
                    <input type="text"
                        name="midle_name"
                        id="midle_name"
                        value="{{ old('midle_name') }}"
                        placeholder="Michael"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('midle_name') border-red-500 @enderror">
                    @error('midle_name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Last Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        name="last_name"
                        id="last_name"
                        value="{{ old('last_name') }}"
                        required
                        placeholder="Smith"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('last_name') border-red-500 @enderror">
                    @error('last_name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password"
                        name="password"
                        id="password"
                        required
                        placeholder="••••••••"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('password') border-red-500 @enderror">
                    @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirm Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        required
                        placeholder="••••••••"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
            </div>

            <!-- Profile Image Upload -->
            <div class="mb-6">
                <label for="profile_image" class="block text-sm font-medium text-gray-700 mb-2">
                    Profile Image
                </label>
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <img id="profile_image_preview"
                            src="{{ asset('images/default-avatar.png') }}"
                            alt="Profile Preview"
                            class="w-24 h-24 rounded-full object-cover border-2 border-gray-300">
                    </div>
                    <div class="flex-grow">
                        <input type="file"
                            name="profile_image"
                            id="profile_image"
                            accept="image/jpeg,image/jpg,image/png,image/gif,image/webp"
                            class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-lg file:border-0
                                file:text-sm file:font-semibold
                                file:bg-primary-50 file:text-primary-700
                                hover:file:bg-primary-100
                                cursor-pointer border border-gray-300 rounded-lg
                                focus:ring-2 focus:ring-primary-500 focus:border-transparent
                                @error('profile_image') border-red-500 @enderror">
                        @error('profile_image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">
                            JPG, PNG, GIF or WEBP. Max size: 2MB. Recommended: 400x400px
                        </p>
                    </div>
                </div>
            </div>

            <script>
                // Image preview functionality
                document.getElementById('profile_image').addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('profile_image_preview').src = e.target.result;
                        }
                        reader.readAsDataURL(file);
                    }
                });
            </script>

            <!-- Access Rights / Role -->
            <div class="mb-6">
                <label for="access_rights" class="block text-sm font-medium text-gray-700 mb-2">
                    Role / Access Rights <span class="text-red-500">*</span>
                </label>
                <select name="access_rights" id="access_rights" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('access_rights') border-red-500 @enderror">
                    <option value="">Select Role</option>
                    <option value="Admin" {{ old('access_rights') == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Teacher" {{ old('access_rights') == 'Teacher' ? 'selected' : '' }}>Teacher</option>
                    <option value="Student" {{ old('access_rights') == 'Student' ? 'selected' : '' }}>Student</option>
                    <option value="Staff" {{ old('access_rights') == 'Staff' ? 'selected' : '' }}>Staff</option>
                </select>
                @error('access_rights')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Checkboxes -->
            <div class="mb-6 space-y-3">
                <div class="flex items-center">
                    <input type="checkbox"
                        name="is_active"
                        id="is_active"
                        value="1"
                        {{ old('is_active', true) ? 'checked' : '' }}
                        class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-3 text-sm font-medium text-gray-700">
                        Active Account
                    </label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox"
                        name="email_verified"
                        id="email_verified"
                        value="1"
                        {{ old('email_verified') ? 'checked' : '' }}
                        class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                    <label for="email_verified" class="ml-3 text-sm font-medium text-gray-700">
                        Email Verified
                    </label>
                </div>
            </div>

            <!-- Info Box -->
            <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-600 mt-1 mr-3"></i>
                    <div class="text-sm text-blue-800">
                        <p class="font-semibold mb-1">User Account Information</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Admin users have full access to the admin panel</li>
                            <li>Teacher users can manage courses and student records</li>
                            <li>Student users have access to the student portal</li>
                            <li>Staff users have limited administrative access</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                <a href="{{ route('admin.users.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-8 py-3 rounded-lg transition duration-300">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-300">
                    <i class="fas fa-save mr-2"></i>Create User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
