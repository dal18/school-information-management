@extends('layouts.admin')

@section('title', 'View Message')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Contact Message Details</h1>
        <p class="text-gray-600 mt-1">View your message and admin reply</p>
    </div>
    <a href="{{ route('student.contact-messages.index') }}"
        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
        <i class="fas fa-arrow-left mr-2"></i>Back to Messages
    </a>
</div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Your Message -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-envelope mr-2 text-gray-600"></i>Your Message
            </h3>
        </div>
        <div class="p-6">
            <!-- Subject -->
            <div class="mb-4">
                <label class="text-sm font-medium text-gray-600">Subject</label>
                <p class="mt-1 text-lg font-semibold text-gray-900">{{ $contactMessage->subject }}</p>
            </div>

            <!-- Message Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="text-sm font-medium text-gray-600">Name</label>
                    <p class="mt-1 text-gray-900">{{ $contactMessage->name }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600">Email</label>
                    <p class="mt-1 text-gray-900">{{ $contactMessage->email }}</p>
                </div>
                @if($contactMessage->phone)
                <div>
                    <label class="text-sm font-medium text-gray-600">Phone</label>
                    <p class="mt-1 text-gray-900">{{ $contactMessage->phone }}</p>
                </div>
                @endif
                <div>
                    <label class="text-sm font-medium text-gray-600">Date Sent</label>
                    <p class="mt-1 text-gray-900">
                        {{ $contactMessage->created_at ? $contactMessage->created_at->format('F d, Y g:i A') : 'N/A' }}
                    </p>
                </div>
            </div>

            <!-- Message Content -->
            <div>
                <label class="text-sm font-medium text-gray-600">Message</label>
                <div class="mt-2 p-4 bg-gray-50 rounded-lg">
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $contactMessage->message }}</p>
                </div>
            </div>

            <!-- Status Badge -->
            <div class="mt-4">
                <label class="text-sm font-medium text-gray-600">Status</label>
                <div class="mt-1">
                    @if($contactMessage->status === 'responded')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>Replied
                        </span>
                    @elseif($contactMessage->status === 'read')
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            <i class="fas fa-eye mr-1"></i>Read
                        </span>
                    @else
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            <i class="fas fa-clock mr-1"></i>Pending Response
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Reply -->
    @if($contactMessage->admin_reply)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-50 px-6 py-4 border-b border-blue-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-reply mr-2 text-blue-600"></i>Admin Reply
                </h3>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        @if($contactMessage->repliedByUser)
                            <span class="font-medium text-gray-700 mr-2">
                                {{ $contactMessage->repliedByUser->first_name }} {{ $contactMessage->repliedByUser->last_name }}
                            </span>
                            <span class="mx-2">•</span>
                        @endif
                        <i class="far fa-clock mr-1"></i>
                        <span>{{ $contactMessage->replied_at ? $contactMessage->replied_at->format('F d, Y g:i A') : 'N/A' }}</span>
                    </div>
                </div>

                <div class="p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $contactMessage->admin_reply }}</p>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-8 text-center">
                <i class="fas fa-hourglass-half text-4xl text-gray-300 mb-4"></i>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Waiting for Reply</h4>
                <p class="text-gray-600">Our team will respond to your message soon.</p>
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="mt-6 flex items-center justify-between">
        <a href="{{ route('student.contact-messages.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-3 rounded-lg transition duration-300">
            <i class="fas fa-list mr-2"></i>Back to All Messages
        </a>
        <a href="{{ route('contact') }}"
           class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
            <i class="fas fa-plus mr-2"></i>Send New Message
        </a>
    </div>
</div>
@endsection
