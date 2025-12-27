@extends('layouts.admin')

@section('title', 'View Feedback')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <a href="{{ route('admin.feedback.index') }}"
           class="text-primary-600 hover:text-primary-800 mb-2 inline-block">
            <i class="fas fa-arrow-left mr-2"></i>Back to Feedback
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Feedback Details</h1>
        <p class="text-gray-600 mt-1">View feedback submission details</p>
    </div>
    <div class="flex items-center space-x-2">
        <!-- Type Badge -->
        @if($feedback->type === 'Complaint')
            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                <i class="fas fa-exclamation-circle mr-1"></i> Complaint
            </span>
        @elseif($feedback->type === 'Suggestion')
            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                <i class="fas fa-lightbulb mr-1"></i> Suggestion
            </span>
        @else
            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                <i class="fas fa-thumbs-up mr-1"></i> Compliment
            </span>
        @endif

        <!-- Delete Button -->
        <form action="{{ route('admin.feedback.destroy', $feedback) }}"
              method="POST"
              class="inline"
              id="delete-form-{{ $feedback->id }}">
            @csrf
            @method('DELETE')
            <button type="button"
                    onclick="confirmDelete('delete-form-{{ $feedback->id }}', 'Are you sure you want to delete this feedback?', 'Delete Feedback?')"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-trash mr-2"></i>Delete
            </button>
        </form>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content - Feedback Details -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">
                    <i class="fas fa-comment-dots mr-2 text-primary-600"></i>Feedback Message
                </h2>
            </div>

            <div class="p-6">
                <!-- Message Content -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <div class="bg-gray-50 rounded-lg p-4 text-gray-800 whitespace-pre-wrap">{{ $feedback->message }}</div>
                </div>

                <!-- Message Metadata -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-gray-200">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Submitted</label>
                        <p class="text-gray-900">
                            <i class="fas fa-calendar mr-2 text-gray-400"></i>
                            {{ $feedback->created_at->format('F d, Y \a\t h:i A') }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            ({{ $feedback->created_at->diffForHumans() }})
                        </p>
                    </div>
                    @if($feedback->ip_address)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">IP Address</label>
                        <p class="text-gray-900">
                            <i class="fas fa-network-wired mr-2 text-gray-400"></i>
                            {{ $feedback->ip_address }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar - Contact Information -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-md sticky top-6">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900">
                    <i class="fas fa-user mr-2 text-primary-600"></i>Submitted By
                </h3>
            </div>

            <div class="p-6 space-y-4">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <p class="text-gray-900 font-medium">{{ $feedback->name }}</p>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <a href="mailto:{{ $feedback->email }}"
                       class="text-primary-600 hover:text-primary-800 font-medium">
                        <i class="fas fa-envelope mr-2"></i>{{ $feedback->email }}
                    </a>
                </div>

                <!-- Feedback Type -->
                <div class="pt-4 border-t border-gray-200">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Feedback Type</label>
                    <p class="text-gray-900 font-medium capitalize">{{ $feedback->type }}</p>
                </div>

                <!-- Registered User -->
                @if($feedback->user)
                <div class="pt-4 border-t border-gray-200">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Registered User</label>
                    <div class="flex items-center space-x-2">
                        <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center">
                            @if($feedback->user->profile_image)
                                <img src="{{ asset('storage/' . $feedback->user->profile_image) }}"
                                     alt="{{ $feedback->user->name }}"
                                     class="w-10 h-10 rounded-full object-cover">
                            @else
                                <i class="fas fa-user text-primary-600"></i>
                            @endif
                        </div>
                        <div>
                            <p class="text-gray-900 font-medium">{{ $feedback->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ ucfirst($feedback->user->role) }}</p>
                        </div>
                    </div>
                </div>
                @else
                <div class="pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">
                        <i class="fas fa-user-slash mr-2 text-gray-400"></i>Guest (Not a registered user)
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Reply Section -->
<div class="mt-6">
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900">
                <i class="fas fa-reply mr-2 text-primary-600"></i>
                @if($feedback->reply)
                    Admin Reply
                @else
                    Reply to Feedback
                @endif
            </h3>
        </div>

        @if($feedback->reply)
            <!-- Show existing reply -->
            <div class="p-6">
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        <span class="font-semibold text-green-900">Reply Sent</span>
                    </div>
                    <div class="text-sm text-gray-700 whitespace-pre-wrap">{{ $feedback->reply }}</div>
                    <div class="mt-3 pt-3 border-t border-green-200 text-xs text-gray-600">
                        Replied by: <span class="font-semibold">{{ $feedback->repliedBy ? $feedback->repliedBy->first_name . ' ' . $feedback->repliedBy->last_name : 'Admin' }}</span> on {{ $feedback->reply_date ? $feedback->reply_date->format('M d, Y \a\t h:i A') : 'N/A' }}
                    </div>
                </div>

                <!-- Current Status -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Status</label>
                    @if($feedback->status === 'New')
                        <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            <i class="fas fa-star mr-1"></i> New
                        </span>
                    @elseif($feedback->status === 'In Progress')
                        <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                            <i class="fas fa-spinner mr-1"></i> In Progress
                        </span>
                    @elseif($feedback->status === 'Resolved')
                        <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i> Resolved
                        </span>
                    @else
                        <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-gray-100 text-gray-800">
                            <i class="fas fa-times-circle mr-1"></i> Closed
                        </span>
                    @endif
                </div>

                <!-- Update Status Form -->
                <form action="{{ route('admin.feedback.update-status', $feedback) }}" method="POST" class="mt-4">
                    @csrf
                    <label class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                    <div class="flex items-center space-x-2">
                        <select name="status" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            <option value="New" {{ $feedback->status === 'New' ? 'selected' : '' }}>New</option>
                            <option value="In Progress" {{ $feedback->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Resolved" {{ $feedback->status === 'Resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="Closed" {{ $feedback->status === 'Closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg transition">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        @else
            <!-- Reply Form -->
            <form action="{{ route('admin.feedback.reply', $feedback) }}" method="POST" class="p-6">
                @csrf

                <!-- Reply Message -->
                <div class="mb-4">
                    <label for="reply" class="block text-sm font-medium text-gray-700 mb-2">
                        Your Reply <span class="text-red-500">*</span>
                    </label>
                    <textarea id="reply"
                              name="reply"
                              rows="6"
                              required
                              placeholder="Type your reply here... (minimum 10 characters)"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('reply') border-red-500 @enderror">{{ old('reply') }}</textarea>
                    @error('reply')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Selection -->
                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Update Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status"
                            name="status"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('status') border-red-500 @enderror">
                        <option value="In Progress" {{ old('status', $feedback->status) === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Resolved" {{ old('status', $feedback->status) === 'Resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="Closed" {{ old('status', $feedback->status) === 'Closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        Status will be updated when you send the reply.
                    </p>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.feedback.index') }}"
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit"
                            class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded-lg transition">
                        <i class="fas fa-paper-plane mr-2"></i>Send Reply
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection
