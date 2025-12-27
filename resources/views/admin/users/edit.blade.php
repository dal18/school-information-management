@extends('layouts.admin')

@section('title', 'Edit User')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Edit User</h1>
        <p class="text-gray-600 mt-1">Update user information</p>
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
        <!-- UPDATE FORM - Closes before the buttons section -->
        <form action="{{ route('admin.users.update', $user) }}" method="POST" id="update-user-form">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Username -->
                <div>
                    <label for="user_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Username <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        name="user_name"
                        id="user_name"
                        value="{{ old('user_name', $user->user_name) }}"
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
                        value="{{ old('email', $user->email) }}"
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
                        value="{{ old('first_name', $user->first_name) }}"
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
                        value="{{ old('midle_name', $user->midle_name) }}"
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
                        value="{{ old('last_name', $user->last_name) }}"
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
                        New Password
                    </label>
                    <input type="password"
                        name="password"
                        id="password"
                        placeholder="Leave blank to keep current password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('password') border-red-500 @enderror">
                    @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Leave blank to keep existing password</p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirm New Password
                    </label>
                    <input type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        placeholder="Confirm new password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
            </div>

            <!-- Access Rights / Role -->
            <div class="mb-6">
                <label for="access_rights" class="block text-sm font-medium text-gray-700 mb-2">
                    Role / Access Rights <span class="text-red-500">*</span>
                </label>
                <select name="access_rights" id="access_rights" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('access_rights') border-red-500 @enderror">
                    <option value="">Select Role</option>
                    <option value="Admin" {{ old('access_rights', $user->access_rights) == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Teacher" {{ old('access_rights', $user->access_rights) == 'Teacher' ? 'selected' : '' }}>Teacher</option>
                    <option value="Student" {{ old('access_rights', $user->access_rights) == 'Student' ? 'selected' : '' }}>Student</option>
                    <option value="Staff" {{ old('access_rights', $user->access_rights) == 'Staff' ? 'selected' : '' }}>Staff</option>
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
                        {{ old('is_active', $user->is_active) ? 'checked' : '' }}
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
                        {{ old('email_verified', $user->email_verified) ? 'checked' : '' }}
                        class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                    <label for="email_verified" class="ml-3 text-sm font-medium text-gray-700">
                        Email Verified
                    </label>
                </div>
            </div>

            <!-- Meta Information -->
            <div class="mb-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Account Information</h4>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">User ID:</span>
                        <span class="font-medium text-gray-900 ml-2">#{{ $user->id }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Created:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $user->created_at ? $user->created_at->format('F d, Y') : 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Last Updated:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $user->updated_at ? $user->updated_at->diffForHumans() : 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Last Login:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $user->last_login_at ?? 'Never' }}</span>
                    </div>
                </div>
            </div>

            @if($user->id === auth()->id())
            <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-3"></i>
                    <div class="text-sm text-yellow-800">
                        <p class="font-semibold mb-1">Editing Your Own Account</p>
                        <p>Be careful when modifying your own role or status. You may lose access to the admin panel.</p>
                    </div>
                </div>
            </div>
            @endif
        </form>
        <!-- UPDATE FORM ENDS HERE - Before the buttons -->

        <!-- Submit Buttons Section - OUTSIDE all forms -->
        <div class="flex items-center justify-between pt-6 border-t">
            @if($user->id !== auth()->id())
            <!-- DELETE FORM - Separate and independent -->
            <form action="{{ route('admin.users.destroy', $user) }}"
                method="POST"
                id="delete-form-{{ $user->id }}">
                @csrf
                @method('DELETE')
                <button type="button"
                    onclick="confirmDelete('delete-form-{{ $user->id }}', 'Are you sure you want to delete this user?', 'Delete User?')"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                    <i class="fas fa-trash mr-2"></i>Delete
                </button>
            </form>
            @else
            <div></div>
            @endif

            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.users.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-8 py-3 rounded-lg transition duration-300">
                    Cancel
                </a>
                <!-- Save button connected to update-user-form via form attribute -->
                <button type="submit"
                    form="update-user-form"
                    class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-300">
                    <i class="fas fa-save mr-2"></i>Save Changes
                </button>
            </div>
        </div>
    </div>
</div>
@endsection