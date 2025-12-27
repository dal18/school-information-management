@extends('layouts.admin')

@section('title', 'Announcements')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Announcements</h1>
        <p class="text-gray-600 mt-1">Manage school announcements</p>
    </div>
    <a href="{{ route('admin.announcements.create') }}"
        class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
        <i class="fas fa-plus mr-2"></i>New Announcement
    </a>
</div>
@endsection

@section('content')
<!-- Announcements List -->
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    @if($announcements->count() > 0)
        <div class="divide-y divide-gray-200">
            @foreach($announcements as $announcement)
            <div class="p-6 hover:bg-gray-50 transition duration-200">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $announcement->title }}</h3>
                        </div>

                        <p class="text-gray-600 mb-3 line-clamp-2">{{ Str::limit($announcement->content, 200) }}</p>

                        <div class="flex items-center text-sm text-gray-500 space-x-4">
                            <div class="flex items-center">
                                <i class="far fa-calendar mr-2"></i>
                                <span>{{ $announcement->created_at->format('F d, Y') }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="far fa-clock mr-2"></i>
                                <span>{{ $announcement->created_at->format('g:i A') }}</span>
                            </div>
                            @if($announcement->author)
                            <div class="flex items-center">
                                <i class="far fa-user mr-2"></i>
                                <span>{{ $announcement->author->name }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 ml-4">
                        <a href="{{ route('admin.announcements.edit', $announcement) }}"
                            class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition duration-200"
                            title="Edit">
                            <i class="fas fa-edit text-lg"></i>
                        </a>
                        <form id="delete-form-{{ $announcement->id }}" action="{{ route('admin.announcements.destroy', $announcement) }}"
                            method="POST"
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                onclick="confirmDelete('delete-form-{{ $announcement->id }}', 'This will permanently delete this announcement!', 'Delete Announcement?')"
                                class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition duration-200"
                                title="Delete">
                                <i class="fas fa-trash text-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="bg-white px-6 py-4 border-t border-gray-200">
            {{ $announcements->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="p-12 text-center">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-bullhorn text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Announcements Yet</h3>
            <p class="text-gray-600 mb-6">Create your first announcement to share important updates with students and parents.</p>
            <a href="{{ route('admin.announcements.create') }}"
                class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                <i class="fas fa-plus mr-2"></i>Create Announcement
            </a>
        </div>
    @endif
</div>
@endsection
