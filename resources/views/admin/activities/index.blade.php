@extends('layouts.admin')

@section('title', 'Activities')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Activities & Events</h1>
        <p class="text-gray-600 mt-1">Manage school activities and events</p>
    </div>
    <a href="{{ route('admin.activities.create') }}"
        class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
        <i class="fas fa-plus mr-2"></i>Add Activity
    </a>
</div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md">
    <!-- Filters and Search -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
            <div class="flex-1 max-w-md">
                <form action="{{ route('admin.activities.index') }}" method="GET">
                    <div class="relative">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search activities..."
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </form>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-sm text-gray-600">
                    Total: <span class="font-semibold">{{ $activities->total() }}</span> activities
                </span>
            </div>
        </div>
    </div>

    <!-- Activities List -->
    <div class="p-6">
        @if($activities->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($activities as $activity)
                <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
                    <!-- Activity Image -->
                    @if($activity->link_image)
                        <img src="{{ asset('storage/' . $activity->link_image) }}"
                             alt="{{ $activity->caption }}"
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-6xl text-blue-400"></i>
                        </div>
                    @endif

                    <!-- Activity Info -->
                    <div class="p-4">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-900 line-clamp-2">
                                {{ $activity->caption }}
                            </h3>
                        </div>

                        @if($activity->category)
                        <span class="inline-block px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full mb-2">
                            {{ $activity->category }}
                        </span>
                        @endif

                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="fas fa-calendar mr-2"></i>
                            {{ $activity->date_uploaded ? $activity->date_uploaded->format('M d, Y') : 'N/A' }}
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                            <a href="{{ route('admin.activities.show', $activity) }}"
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('admin.activities.edit', $activity) }}"
                                   class="text-yellow-600 hover:text-yellow-800 text-sm font-medium">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.activities.destroy', $activity) }}"
                                      method="POST"
                                      id="delete-form-{{ $activity->id }}"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            onclick="confirmDelete('delete-form-{{ $activity->id }}', 'Are you sure you want to delete this activity?', 'Delete Activity?')"
                                            class="text-red-600 hover:text-red-800 text-sm font-medium">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $activities->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-calendar-alt text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">No activities found</p>
                <a href="{{ route('admin.activities.create') }}"
                   class="inline-block mt-4 bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                    <i class="fas fa-plus mr-2"></i>Add First Activity
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
