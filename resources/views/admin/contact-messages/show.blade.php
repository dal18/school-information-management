@extends('layouts.admin')

@section('title', 'View Contact Message')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <a href="{{ route('admin.contact-messages.index') }}"
           class="text-primary-600 hover:text-primary-800 mb-2 inline-block">
            <i class="fas fa-arrow-left mr-2"></i>Back to Messages
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Contact Message Details</h1>
        <p class="text-gray-600 mt-1">View and respond to this contact message</p>
    </div>
    <div class="flex items-center space-x-2">
        <!-- Status Badge -->
        @if($contactMessage->status === 'unread')
            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                <i class="fas fa-circle text-red-500 mr-1 text-xs"></i> Unread
            </span>
        @elseif($contactMessage->status === 'read')
            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                <i class="fas fa-eye mr-1"></i> Read
            </span>
        @else
            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                <i class="fas fa-check-circle mr-1"></i> Replied
            </span>
        @endif

        <!-- Delete Button -->
        <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}"
              method="POST"
              class="inline"
              id="delete-form-{{ $contactMessage->id }}">
            @csrf
            @method('DELETE')
            <button type="button"
                    onclick="confirmDelete('delete-form-{{ $contactMessage->id }}', 'Are you sure you want to delete this message?', 'Delete Message?')"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-trash mr-2"></i>Delete
            </button>
        </form>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content - Message Details -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Original Message -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">
                    <i class="fas fa-envelope mr-2 text-primary-600"></i>{{ $contactMessage->subject }}
                </h2>
            </div>

            <div class="p-6">
                <!-- Message Content -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <div class="bg-gray-50 rounded-lg p-4 text-gray-800 whitespace-pre-wrap">{{ $contactMessage->message }}</div>
                </div>

                <!-- Message Metadata -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-gray-200">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Received</label>
                        <p class="text-gray-900">
                            <i class="fas fa-calendar mr-2 text-gray-400"></i>
                            {{ $contactMessage->created_at->format('F d, Y \a\t h:i A') }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            ({{ $contactMessage->created_at->diffForHumans() }})
                        </p>
                    </div>
                    @if($contactMessage->ip_address)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">IP Address</label>
                        <p class="text-gray-900">
                            <i class="fas fa-network-wired mr-2 text-gray-400"></i>
                            {{ $contactMessage->ip_address }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Admin Reply Section -->
        @if($contactMessage->admin_reply)
            <!-- Existing Reply -->
            <div class="bg-green-50 border border-green-200 rounded-lg shadow-md">
                <div class="p-6 border-b border-green-200">
                    <h2 class="text-xl font-bold text-green-900">
                        <i class="fas fa-reply mr-2"></i>Your Reply
                    </h2>
                </div>

                <div class="p-6">
                    <div class="bg-white rounded-lg p-4 text-gray-800 whitespace-pre-wrap mb-4">{{ $contactMessage->admin_reply }}</div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-green-200">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Replied By</label>
                            <p class="text-gray-900">
                                <i class="fas fa-user mr-2 text-gray-400"></i>
                                {{ $contactMessage->repliedByUser->name ?? 'Unknown' }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Replied At</label>
                            <p class="text-gray-900">
                                <i class="fas fa-clock mr-2 text-gray-400"></i>
                                {{ $contactMessage->replied_at->format('F d, Y \a\t h:i A') }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                ({{ $contactMessage->replied_at->diffForHumans() }})
                            </p>
                        </div>
                    </div>

                    @if($contactMessage->user_has_seen_reply)
                        <div class="mt-4 p-3 bg-blue-50 rounded-lg text-sm text-blue-800">
                            <i class="fas fa-check-double mr-2"></i>User has seen this reply
                        </div>
                    @else
                        <div class="mt-4 p-3 bg-yellow-50 rounded-lg text-sm text-yellow-800">
                            <i class="fas fa-clock mr-2"></i>User has not seen this reply yet
                        </div>
                    @endif
                </div>
            </div>
        @else
            <!-- Reply Form -->
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-reply mr-2 text-primary-600"></i>Send Reply
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Compose your response to {{ $contactMessage->name }}</p>
                </div>

                <form action="{{ route('admin.contact-messages.reply', $contactMessage) }}" method="POST" class="p-6">
                    @csrf

                    <div class="mb-4">
                        <label for="admin_reply" class="block text-sm font-medium text-gray-700 mb-2">
                            Your Reply <span class="text-red-500">*</span>
                        </label>
                        <textarea name="admin_reply"
                                  id="admin_reply"
                                  rows="8"
                                  required
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('admin_reply') border-red-500 @enderror"
                                  placeholder="Type your reply here...">{{ old('admin_reply') }}</textarea>
                        @error('admin_reply')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                        <p class="text-sm text-blue-800">
                            <i class="fas fa-info-circle mr-2"></i>
                            <strong>Note:</strong> This reply will be sent to <strong>{{ $contactMessage->email }}</strong> via email notification.
                        </p>
                    </div>

                    <div class="flex items-center justify-end space-x-3">
                        <a href="{{ route('admin.contact-messages.index') }}"
                           class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition">
                            <i class="fas fa-paper-plane mr-2"></i>Send Reply
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>

    <!-- Sidebar - Contact Information -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-md sticky top-6">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900">
                    <i class="fas fa-user mr-2 text-primary-600"></i>Contact Information
                </h3>
            </div>

            <div class="p-6 space-y-4">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <p class="text-gray-900 font-medium">{{ $contactMessage->name }}</p>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <a href="mailto:{{ $contactMessage->email }}"
                       class="text-primary-600 hover:text-primary-800 font-medium">
                        <i class="fas fa-envelope mr-2"></i>{{ $contactMessage->email }}
                    </a>
                </div>

                <!-- Phone -->
                @if($contactMessage->phone)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <a href="tel:{{ $contactMessage->phone }}"
                       class="text-primary-600 hover:text-primary-800 font-medium">
                        <i class="fas fa-phone mr-2"></i>{{ $contactMessage->phone }}
                    </a>
                </div>
                @endif

                <!-- Registered User -->
                @if($contactMessage->user)
                <div class="pt-4 border-t border-gray-200">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Registered User</label>
                    <div class="flex items-center space-x-2">
                        <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center">
                            @if($contactMessage->user->profile_image)
                                <img src="{{ asset('storage/' . $contactMessage->user->profile_image) }}"
                                     alt="{{ $contactMessage->user->name }}"
                                     class="w-10 h-10 rounded-full object-cover">
                            @else
                                <i class="fas fa-user text-primary-600"></i>
                            @endif
                        </div>
                        <div>
                            <p class="text-gray-900 font-medium">{{ $contactMessage->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ ucfirst($contactMessage->user->role) }}</p>
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
@endsection
