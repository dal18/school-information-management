@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Edit Profile</h1>
        <p class="text-gray-600 mt-1">Manage your account settings and preferences</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Profile Picture Section -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Profile Picture</h3>

            <div class="flex flex-col items-center">
                <!-- Current Profile Picture -->
                <div class="relative mb-4">
                    @if($user->profile_image)
                        <img id="profile-preview"
                             src="{{ asset('storage/' . $user->profile_image) }}"
                             alt="{{ $user->name }}"
                             class="w-32 h-32 rounded-full object-cover border-4 border-primary-500 shadow-lg">
                    @else
                        <div id="profile-preview-placeholder" class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center border-4 border-primary-500 shadow-lg">
                            <span class="text-4xl font-bold text-white">
                                {{ strtoupper(substr($user->first_name ?? $user->name, 0, 1)) }}{{ strtoupper(substr($user->last_name ?? '', 0, 1)) }}
                            </span>
                        </div>
                        <img id="profile-preview"
                             src=""
                             alt="Profile Preview"
                             class="w-32 h-32 rounded-full object-cover border-4 border-primary-500 shadow-lg hidden">
                    @endif
                    <div class="absolute bottom-0 right-0 w-10 h-10 bg-green-400 rounded-full border-4 border-white"></div>
                </div>

                <!-- Upload Form -->
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="w-full">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label for="profile_image" class="block text-sm font-medium text-gray-700 mb-2 text-center">
                            Choose New Picture
                        </label>
                        <input type="file"
                               id="profile_image"
                               name="profile_image"
                               accept="image/*"
                               class="hidden"
                               onchange="previewImage(event)">
                        <button type="button"
                                onclick="document.getElementById('profile_image').click()"
                                class="w-full bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg transition duration-300">
                            <i class="fas fa-camera mr-2"></i>Upload Photo
                        </button>
                        @error('profile_image')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-save mr-2"></i>Save Photo
                    </button>
                </form>

                @if($user->profile_image)
                <form id="remove-photo-form" action="{{ route('profile.update') }}" method="POST" class="w-full mt-3">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="remove_profile_image" value="1">
                    <button type="button"
                            onclick="confirmDelete('remove-photo-form', 'This will remove your profile picture!', 'Remove Photo?')"
                            class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-trash mr-2"></i>Remove Photo
                    </button>
                </form>
                @endif

                <p class="text-xs text-gray-500 mt-4 text-center">
                    Recommended: Square image, at least 400x400px<br>
                    Max size: 2MB (JPG, PNG, GIF)
                </p>
            </div>
        </div>

        <!-- Account Info Card -->
        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Information</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                    <span class="text-sm text-gray-600">User ID</span>
                    <span class="text-sm font-semibold text-gray-900">#{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                    <span class="text-sm text-gray-600">Role</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $user->access_rights ?? 'User' }}</span>
                </div>
                <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                    <span class="text-sm text-gray-600">Member Since</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $user->created_at->format('M d, Y') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Status</span>
                    <span class="flex items-center text-sm font-semibold text-green-600">
                        <span class="h-2 w-2 bg-green-600 rounded-full mr-2"></span>
                        Active
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Information & Settings -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Update Profile Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-user mr-2 text-primary-600"></i>Personal Information
            </h3>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
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
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('first_name') border-red-500 @enderror">
                        @error('first_name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
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
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('last_name') border-red-500 @enderror">
                        @error('last_name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
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
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="mt-2 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <p class="text-sm text-yellow-800">
                                    Your email address is unverified.
                                    <button form="send-verification" class="underline text-sm text-yellow-600 hover:text-yellow-900">
                                        Click here to re-send the verification email.
                                    </button>
                                </p>
                            </div>
                        @endif
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number
                        </label>
                        <input type="text"
                               name="phone_number"
                               id="phone_number"
                               value="{{ old('phone_number', $user->phone_number) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('phone_number') border-red-500 @enderror">
                        @error('phone_number')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.dashboard') }}"
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>Save Changes
                    </button>
                </div>
            </form>

            <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="hidden">
                @csrf
            </form>
        </div>

        <!-- Update Password -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-lock mr-2 text-primary-600"></i>Update Password
            </h3>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <!-- Current Password -->
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                            Current Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password"
                               name="current_password"
                               id="current_password"
                               autocomplete="current-password"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('current_password', 'updatePassword') border-red-500 @enderror">
                        @error('current_password', 'updatePassword')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            New Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password"
                               name="password"
                               id="password"
                               autocomplete="new-password"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('password', 'updatePassword') border-red-500 @enderror">
                        @error('password', 'updatePassword')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
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
                               autocomplete="new-password"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end">
                    <button type="submit"
                            class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition">
                        <i class="fas fa-key mr-2"></i>Update Password
                    </button>
                </div>
            </form>
        </div>

        <!-- Delete Account -->
        <div class="bg-white rounded-lg shadow-md p-6 border-2 border-red-200">
            <h3 class="text-lg font-semibold text-red-900 mb-2">
                <i class="fas fa-exclamation-triangle mr-2"></i>Danger Zone
            </h3>
            <p class="text-sm text-gray-600 mb-4">
                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
            </p>

            <button type="button"
                    onclick="document.getElementById('delete-account-modal').classList.remove('hidden')"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition">
                <i class="fas fa-trash mr-2"></i>Delete Account
            </button>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div id="delete-account-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                Are you sure you want to delete your account?
            </h3>
            <p class="text-sm text-gray-600 mb-4">
                Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="mb-4">
                    <label for="password_delete" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <input type="password"
                           name="password"
                           id="password_delete"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                           placeholder="Enter your password">
                    @error('password', 'userDeletion')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-3">
                    <button type="button"
                            onclick="document.getElementById('delete-account-modal').classList.add('hidden')"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if (session('status') === 'profile-updated')
    <div id="success-notification" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg z-50">
        <i class="fas fa-check-circle mr-2"></i>Profile updated successfully!
    </div>
@endif

@if (session('status') === 'password-updated')
    <div id="success-notification" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg z-50">
        <i class="fas fa-check-circle mr-2"></i>Password updated successfully!
    </div>
@endif
@endsection

@push('scripts')
<script>
// Image Preview
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('profile-preview');
    const placeholder = document.getElementById('profile-preview-placeholder');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            if (placeholder) {
                placeholder.classList.add('hidden');
            }
        }
        reader.readAsDataURL(file);
    }
}

// Auto-hide success notification
setTimeout(() => {
    const notification = document.getElementById('success-notification');
    if (notification) {
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.5s';
        setTimeout(() => notification.remove(), 500);
    }
}, 3000);

// Close modal on escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        document.getElementById('delete-account-modal').classList.add('hidden');
    }
});
</script>
@endpush
