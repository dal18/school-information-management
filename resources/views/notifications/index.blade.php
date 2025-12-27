@extends('layouts.admin')

@section('title', 'Notifications')

@section('header')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Notifications</h1>
        <p class="text-gray-600 mt-1">Manage your notifications</p>
    </div>
    <div class="flex gap-2">
        <form action="{{ route('notifications.mark-all-as-read') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm transition">
                <i class="fas fa-check-double mr-2"></i>Mark All Read
            </button>
        </form>
        <form id="clear-read-form" action="{{ route('notifications.clear-read') }}" method="POST" class="inline">
            @csrf
            <button type="button" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm transition" onclick="confirmDelete('clear-read-form', 'This will clear all read notifications!', 'Clear Read Notifications?')">
                <i class="fas fa-trash mr-2"></i>Clear Read
            </button>
        </form>
    </div>
</div>
@endsection

@section('content')
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
        <i class="fas fa-check-circle mr-2"></i>
        {{ session('success') }}
    </div>
@endif

<div class="space-y-4">
    @forelse($notifications as $notification)
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition {{ $notification->is_read ? 'opacity-75' : '' }}">
            <div class="p-6">
                <div class="flex items-start space-x-4">
                    <!-- Icon -->
                    <div class="flex-shrink-0">
                        <div class="{{ $notification->color }} rounded-full p-3">
                            <i class="fas {{ $notification->icon }} text-xl"></i>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 {{ $notification->is_read ? '' : 'font-bold' }}">
                                    {{ $notification->title }}
                                    @if(!$notification->is_read)
                                        <span class="inline-block w-2 h-2 bg-blue-600 rounded-full ml-2"></span>
                                    @endif
                                </h3>
                                <p class="text-gray-600 mt-1">{{ $notification->message }}</p>
                                <p class="text-sm text-gray-500 mt-2">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center space-x-2 ml-4">
                                @if(!$notification->is_read)
                                    <form action="{{ route('notifications.mark-as-read', $notification->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-indigo-600 hover:text-indigo-800 p-2" title="Mark as read">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @endif
                                <form id="delete-form-{{ $notification->id }}" action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="text-red-600 hover:text-red-800 p-2" title="Delete" onclick="confirmDelete('delete-form-{{ $notification->id }}', 'This will permanently delete this notification!', 'Delete Notification?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        @if($notification->link)
                            <a href="{{ $notification->link }}" class="inline-block mt-3 text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                View Details <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-bell-slash text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">No notifications yet.</p>
        </div>
    @endforelse
</div>

@if($notifications->hasPages())
    <div class="mt-6">
        {{ $notifications->links() }}
    </div>
@endif
@endsection
