@extends('layouts.admin')

@section('title', 'Feedback')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Feedback</h1>
        <p class="text-gray-600 mt-1">View and manage user feedback submissions</p>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md">
    <!-- Type Filters and Search -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
            <!-- Type Filter Tabs -->
            <div class="flex items-center space-x-2 overflow-x-auto">
                <a href="{{ route('admin.feedback.index', ['type' => 'all']) }}"
                   class="px-4 py-2 rounded-lg font-medium transition {{ request('type', 'all') === 'all' ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    All <span class="ml-1 px-2 py-0.5 text-xs rounded-full {{ request('type', 'all') === 'all' ? 'bg-white text-primary-600' : 'bg-gray-200' }}">{{ $counts['all'] }}</span>
                </a>
                <a href="{{ route('admin.feedback.index', ['type' => 'Complaint']) }}"
                   class="px-4 py-2 rounded-lg font-medium transition {{ request('type') === 'Complaint' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Complaints <span class="ml-1 px-2 py-0.5 text-xs rounded-full {{ request('type') === 'Complaint' ? 'bg-white text-red-600' : 'bg-gray-200' }}">{{ $counts['Complaint'] }}</span>
                </a>
                <a href="{{ route('admin.feedback.index', ['type' => 'Suggestion']) }}"
                   class="px-4 py-2 rounded-lg font-medium transition {{ request('type') === 'Suggestion' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Suggestions <span class="ml-1 px-2 py-0.5 text-xs rounded-full {{ request('type') === 'Suggestion' ? 'bg-white text-blue-600' : 'bg-gray-200' }}">{{ $counts['Suggestion'] }}</span>
                </a>
                <a href="{{ route('admin.feedback.index', ['type' => 'Compliment']) }}"
                   class="px-4 py-2 rounded-lg font-medium transition {{ request('type') === 'Compliment' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Compliments <span class="ml-1 px-2 py-0.5 text-xs rounded-full {{ request('type') === 'Compliment' ? 'bg-white text-green-600' : 'bg-gray-200' }}">{{ $counts['Compliment'] }}</span>
                </a>
            </div>

            <!-- Search -->
            <div class="flex-1 max-w-md ml-0 md:ml-4">
                <form action="{{ route('admin.feedback.index') }}" method="GET">
                    <input type="hidden" name="type" value="{{ request('type', 'all') }}">
                    <div class="relative">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search feedback..."
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </form>
            </div>

            <!-- Export Button -->
            <div>
                <a href="{{ route('admin.feedback.export', request()->query()) }}"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg transition duration-300 inline-flex items-center text-sm">
                    <i class="fas fa-file-pdf mr-2"></i>Export PDF
                </a>
            </div>
        </div>
    </div>

    <!-- Bulk Actions -->
    @if($feedbacks->count() > 0)
    <div class="p-4 border-b border-gray-200 bg-gray-50">
        <form action="{{ route('admin.feedback.bulk-delete') }}" method="POST" id="bulk-delete-form">
            @csrf
            @method('DELETE')
            <div class="flex items-center space-x-3">
                <input type="checkbox" id="select-all" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                <label for="select-all" class="text-sm text-gray-700 font-medium">Select All</label>
                <button type="button" onclick="confirmDelete('bulk-delete-form', 'Are you sure you want to delete the selected feedback?', 'Delete Selected Feedback?')" class="ml-4 text-red-600 hover:text-red-800 text-sm font-medium">
                    <i class="fas fa-trash mr-1"></i>Delete Selected
                </button>
            </div>
        </form>
    </div>
    @endif

    <!-- Feedback List -->
    <div class="overflow-x-auto">
        @if($feedbacks->count() > 0)
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12">
                            <input type="checkbox" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500" disabled>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            From
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Message Preview
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($feedbacks as $item)
                    <tr class="hover:bg-gray-50">
                        <!-- Checkbox -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" name="feedback_ids[]" value="{{ $item->id }}" form="bulk-delete-form" class="feedback-checkbox rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                        </td>

                        <!-- Type Badge -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->type === 'Complaint')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-exclamation-circle mr-1"></i> Complaint
                                </span>
                            @elseif($item->type === 'Suggestion')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <i class="fas fa-lightbulb mr-1"></i> Suggestion
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-thumbs-up mr-1"></i> Compliment
                                </span>
                            @endif
                        </td>

                        <!-- From -->
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $item->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $item->email }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Message Preview -->
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-600">
                                {{ Str::limit($item->message, 80) }}
                            </div>
                        </td>

                        <!-- Status Badge -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->status === 'New')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-star mr-1"></i> New
                                </span>
                            @elseif($item->status === 'In Progress')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <i class="fas fa-spinner mr-1"></i> In Progress
                                </span>
                            @elseif($item->status === 'Resolved')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i> Resolved
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    <i class="fas fa-times-circle mr-1"></i> Closed
                                </span>
                            @endif
                        </td>

                        <!-- Date -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>{{ $item->created_at->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-400">{{ $item->created_at->format('h:i A') }}</div>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.feedback.show', $item) }}"
                                   class="text-primary-600 hover:text-primary-900"
                                   title="View Feedback">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.feedback.destroy', $item) }}"
                                      method="POST"
                                      class="inline"
                                      id="delete-form-{{ $item->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            onclick="confirmDelete('delete-form-{{ $item->id }}', 'Are you sure you want to delete this feedback?', 'Delete Feedback?')"
                                            class="text-red-600 hover:text-red-900"
                                            title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $feedbacks->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <i class="fas fa-comments text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No feedback found</h3>
                <p class="text-gray-500">
                    @if(request('search'))
                        No feedback matches your search criteria.
                    @elseif(request('type') && request('type') !== 'all')
                        No {{ request('type') }} feedback at this time.
                    @else
                        There is no feedback yet.
                    @endif
                </p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Select all functionality
    document.getElementById('select-all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.feedback-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Update select all when individual checkboxes change
    document.querySelectorAll('.feedback-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const selectAll = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.feedback-checkbox');
            const checkedBoxes = document.querySelectorAll('.feedback-checkbox:checked');
            selectAll.checked = checkboxes.length === checkedBoxes.length;
        });
    });
</script>
@endpush
