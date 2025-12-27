@extends('layouts.admin')

@section('title', 'User Details')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">User Details</h1>
        <p class="text-gray-600 mt-1">View user information and activity</p>
    </div>
    <div class="flex space-x-3">
        <a href="{{ route('admin.users.edit', $user) }}"
            class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
            <i class="fas fa-edit mr-2"></i>Edit User
        </a>
        <a href="{{ route('admin.users.index') }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
            <i class="fas fa-arrow-left mr-2"></i>Back
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- User Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="text-center mb-6">
                    <div class="w-24 h-24 rounded-full bg-primary-100 flex items-center justify-center mx-auto mb-4">
                        <span class="text-4xl font-bold text-primary-700">
                            {{ strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1)) }}
                        </span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ $user->first_name }} {{ $user->midle_name }} {{ $user->last_name }}
                    </h2>
                    <p class="text-gray-600 mt-1">@{{ $user->user_name }}</p>
                    <div class="mt-3">
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                            @if($user->access_rights === 'Admin') bg-purple-100 text-purple-800
                            @elseif($user->access_rights === 'Teacher') bg-blue-100 text-blue-800
                            @elseif($user->access_rights === 'Student') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ $user->access_rights }}
                        </span>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6 space-y-4">
                    <div>
                        <div class="text-sm text-gray-600 mb-1">Email</div>
                        <div class="font-medium text-gray-900">{{ $user->email }}</div>
                        @if($user->email_verified)
                        <div class="text-xs text-green-600 mt-1">
                            <i class="fas fa-check-circle mr-1"></i>Verified {{ $user->email_verified->format('M d, Y') }}
                        </div>
                        @else
                        <div class="text-xs text-gray-500 mt-1">Not verified</div>
                        @endif
                    </div>

                    <div>
                        <div class="text-sm text-gray-600 mb-1">Account Status</div>
                        @if($user->is_active)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>Active
                        </span>
                        @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            <i class="fas fa-times-circle mr-1"></i>Inactive
                        </span>
                        @endif
                    </div>

                    <div>
                        <div class="text-sm text-gray-600 mb-1">User ID</div>
                        <div class="font-medium text-gray-900">#{{ $user->id }}</div>
                    </div>

                    <div>
                        <div class="text-sm text-gray-600 mb-1">Member Since</div>
                        <div class="font-medium text-gray-900">
                            {{ $user->created_at ? $user->created_at->format('F d, Y') : 'N/A' }}
                        </div>
                        @if($user->created_at)
                        <div class="text-xs text-gray-500 mt-1">
                            {{ $user->created_at->diffForHumans() }}
                        </div>
                        @endif
                    </div>

                    <div>
                        <div class="text-sm text-gray-600 mb-1">Last Updated</div>
                        <div class="font-medium text-gray-900">
                            {{ $user->updated_at ? $user->updated_at->format('F d, Y h:i A') : 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Details and Activity -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Account Information -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-user-circle mr-2 text-gray-600"></i>Account Information
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Username</label>
                            <p class="mt-1 text-gray-900">{{ $user->user_name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Email Address</label>
                            <p class="mt-1 text-gray-900">{{ $user->email }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">First Name</label>
                            <p class="mt-1 text-gray-900">{{ $user->first_name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Middle Name</label>
                            <p class="mt-1 text-gray-900">{{ $user->midle_name ?: 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Last Name</label>
                            <p class="mt-1 text-gray-900">{{ $user->last_name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Role / Access Rights</label>
                            <p class="mt-1 text-gray-900">{{ $user->access_rights }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Role Permissions -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-shield-alt mr-2 text-gray-600"></i>Role & Permissions
                    </h3>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <span class="text-sm font-medium text-gray-600">Assigned Role:</span>
                        <span class="ml-2 px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                            @if($user->access_rights === 'Admin') bg-purple-100 text-purple-800
                            @elseif($user->access_rights === 'Teacher') bg-blue-100 text-blue-800
                            @elseif($user->access_rights === 'Student') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ $user->access_rights }}
                        </span>
                    </div>

                    <div class="space-y-3">
                        @if($user->access_rights === 'Admin')
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                            <div>
                                <p class="font-medium text-gray-900">Full Admin Access</p>
                                <p class="text-sm text-gray-600">Complete control over all system features and settings</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                            <div>
                                <p class="font-medium text-gray-900">User Management</p>
                                <p class="text-sm text-gray-600">Create, edit, and delete user accounts</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                            <div>
                                <p class="font-medium text-gray-900">Content Management</p>
                                <p class="text-sm text-gray-600">Manage all content including announcements, courses, and facilities</p>
                            </div>
                        </div>
                        @elseif($user->access_rights === 'Teacher')
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                            <div>
                                <p class="font-medium text-gray-900">Course Management</p>
                                <p class="text-sm text-gray-600">Create and manage courses and curriculum</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                            <div>
                                <p class="font-medium text-gray-900">Student Records</p>
                                <p class="text-sm text-gray-600">View and manage student information</p>
                            </div>
                        </div>
                        @elseif($user->access_rights === 'Student')
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                            <div>
                                <p class="font-medium text-gray-900">Student Portal Access</p>
                                <p class="text-sm text-gray-600">View courses, grades, and announcements</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                            <div>
                                <p class="font-medium text-gray-900">Profile Management</p>
                                <p class="text-sm text-gray-600">Update personal information and settings</p>
                            </div>
                        </div>
                        @else
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                            <div>
                                <p class="font-medium text-gray-900">Limited Access</p>
                                <p class="text-sm text-gray-600">Access to specific system features based on role</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-tasks mr-2 text-gray-600"></i>Quick Actions
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('admin.users.edit', $user) }}"
                            class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-300">
                            <i class="fas fa-edit text-blue-600 mr-2"></i>
                            <span class="font-medium text-gray-900">Edit User</span>
                        </a>
                        <button
                            onclick="alert('Feature coming soon: Send password reset email')"
                            class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-300">
                            <i class="fas fa-key text-yellow-600 mr-2"></i>
                            <span class="font-medium text-gray-900">Reset Password</span>
                        </button>
                        @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $user) }}"
                            method="POST"
                            id="delete-form-{{ $user->id }}"
                            class="md:col-span-2">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                onclick="confirmDelete('delete-form-{{ $user->id }}', 'Are you sure you want to delete this user?', 'Delete User?')"
                                class="w-full flex items-center justify-center px-4 py-3 border border-red-300 rounded-lg hover:bg-red-50 transition duration-300">
                                <i class="fas fa-trash text-red-600 mr-2"></i>
                                <span class="font-medium text-red-600">Delete User</span>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
