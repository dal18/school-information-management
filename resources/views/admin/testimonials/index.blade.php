@extends('layouts.admin')

@section('title', 'Testimonials Management')

@section('header')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Student Testimonials</h1>
            <p class="text-gray-600 mt-1">Manage student testimonials and feedback</p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center shadow-lg">
            <i class="fas fa-plus mr-2"></i>Add New Testimonial
        </a>
    </div>
</div>
@endsection

@section('content')
<!-- Status Filters -->
<div class="bg-white rounded-xl shadow-md p-6 mb-6">
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.testimonials.index', ['status' => 'all']) }}"
           class="px-4 py-2 rounded-lg {{ !request('status') || request('status') == 'all' ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition">
            All ({{ $counts['all'] }})
        </a>
        <a href="{{ route('admin.testimonials.index', ['status' => 'Pending']) }}"
           class="px-4 py-2 rounded-lg {{ request('status') == 'Pending' ? 'bg-yellow-600 text-white' : 'bg-yellow-50 text-yellow-700 hover:bg-yellow-100' }} transition">
            Pending ({{ $counts['pending'] }})
        </a>
        <a href="{{ route('admin.testimonials.index', ['status' => 'Approved']) }}"
           class="px-4 py-2 rounded-lg {{ request('status') == 'Approved' ? 'bg-green-600 text-white' : 'bg-green-50 text-green-700 hover:bg-green-100' }} transition">
            Approved ({{ $counts['approved'] }})
        </a>
        <a href="{{ route('admin.testimonials.index', ['status' => 'Rejected']) }}"
           class="px-4 py-2 rounded-lg {{ request('status') == 'Rejected' ? 'bg-red-600 text-white' : 'bg-red-50 text-red-700 hover:bg-red-100' }} transition">
            Rejected ({{ $counts['rejected'] }})
        </a>
    </div>
</div>

<!-- Search & Actions -->
<div class="bg-white rounded-xl shadow-md p-6 mb-6">
    <form method="GET" action="{{ route('admin.testimonials.index') }}" class="flex gap-4">
        <input type="hidden" name="status" value="{{ request('status', 'all') }}">
        <div class="flex-1">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search testimonials..."
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
        </div>
        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg transition">
            <i class="fas fa-search"></i> Search
        </button>
        @if(request('search'))
        <a href="{{ route('admin.testimonials.index', ['status' => request('status', 'all')]) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
            <i class="fas fa-times"></i> Clear
        </a>
        @endif
    </form>
</div>

<!-- Testimonials Table -->
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    @if($testimonials->count() > 0)
    <form id="bulk-delete-form" method="POST" action="{{ route('admin.testimonials.bulk-delete') }}">
        @csrf
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left">
                            <input type="checkbox" id="select-all" class="rounded border-gray-300">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($testimonials as $testimonial)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <input type="checkbox" name="ids[]" value="{{ $testimonial->id }}" class="testimonial-checkbox rounded border-gray-300">
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-900">{{ $testimonial->student_name }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $testimonial->grade_level }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-600 max-w-md truncate">{{ Str::limit($testimonial->message, 80) }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($testimonial->status == 'Approved')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i> Approved
                                </span>
                            @elseif($testimonial->status == 'Pending')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i> Pending
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i> Rejected
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $testimonial->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium space-x-2">
                            @if($testimonial->status == 'Pending')
                            <form method="POST" action="{{ route('admin.testimonials.update-status', $testimonial) }}" class="inline">
                                @csrf
                                <input type="hidden" name="status" value="Approved">
                                <button type="submit" class="text-green-600 hover:text-green-900" title="Approve">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.testimonials.update-status', $testimonial) }}" class="inline">
                                @csrf
                                <input type="hidden" name="status" value="Rejected">
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Reject">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                            @endif
                            <a href="{{ route('admin.testimonials.show', $testimonial) }}" class="text-blue-600 hover:text-blue-900" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" class="inline" id="delete-form-{{ $testimonial->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete('delete-form-{{ $testimonial->id }}', 'Are you sure you want to delete this testimonial?', 'Delete Testimonial?')" class="text-red-600 hover:text-red-900" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Bulk Actions -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
            <button type="button" onclick="if(confirm('Delete selected testimonials?')) document.getElementById('bulk-delete-form').submit();"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-trash mr-2"></i>Delete Selected
            </button>
            <div>{{ $testimonials->links() }}</div>
        </div>
    </form>
    @else
    <div class="p-12 text-center">
        <i class="fas fa-comments text-gray-300 text-6xl mb-4"></i>
        <p class="text-gray-500 text-lg">No testimonials found</p>
        <a href="{{ route('admin.testimonials.create') }}" class="inline-block mt-4 text-primary-600 hover:text-primary-700 font-semibold">
            <i class="fas fa-plus mr-2"></i>Add your first testimonial
        </a>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.getElementById('select-all')?.addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.testimonial-checkbox');
    checkboxes.forEach(checkbox => checkbox.checked = this.checked);
});
</script>
@endpush
