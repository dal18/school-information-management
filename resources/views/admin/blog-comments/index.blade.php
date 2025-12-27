@extends('layouts.admin')

@section('title', 'Blog Comments Management')

@section('header')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Blog Comments</h1>
            <p class="text-gray-600 mt-1">Manage and moderate blog post comments</p>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center shadow-lg">
            <i class="fas fa-newspaper mr-2"></i>Back to Blog Posts
        </a>
    </div>
</div>
@endsection

@section('content')
<!-- Filters & Search -->
<div class="bg-white rounded-xl shadow-md p-6 mb-6">
    <form method="GET" action="{{ route('admin.blog-comments.index') }}" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search -->
            <div class="md:col-span-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search comments..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            </div>

            <!-- Status Filter -->
            <div>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                </select>
            </div>

            <!-- Post Filter -->
            <div>
                <select name="post_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">All Posts</option>
                    @foreach($posts as $post)
                    <option value="{{ $post->id }}" {{ request('post_id') == $post->id ? 'selected' : '' }}>{{ $post->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg transition">
                <i class="fas fa-filter"></i> Apply Filters
            </button>
            @if(request()->hasAny(['search', 'status', 'post_id']))
            <a href="{{ route('admin.blog-comments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                <i class="fas fa-times"></i> Clear
            </a>
            @endif
        </div>
    </form>
</div>

<!-- Comments List -->
@if($comments->count() > 0)
<form id="bulk-approve-form" method="POST" action="{{ route('admin.blog-comments.bulk-approve') }}">
    @csrf
    <input type="hidden" name="comment_ids" value="">
</form>

<form id="bulk-delete-form" method="POST" action="{{ route('admin.blog-comments.bulk-delete') }}">
    @csrf
    <input type="hidden" name="comment_ids" value="">
</form>

<div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <input type="checkbox" id="select-all" class="rounded border-gray-300">
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Commenter</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comment</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Blog Post</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($comments as $comment)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                    <input type="checkbox" name="comment_ids[]" value="{{ $comment->id }}" class="comment-checkbox rounded border-gray-300">
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-medium text-gray-900">
                        {{ $comment->user ? $comment->user->name : $comment->commenter_name }}
                    </div>
                    @if($comment->commenter_email || ($comment->user && $comment->user->email))
                    <div class="text-sm text-gray-500">
                        {{ $comment->commenter_email ?? $comment->user->email }}
                    </div>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900 max-w-md">{{ Str::limit($comment->comment, 150) }}</div>
                </td>
                <td class="px-6 py-4">
                    @if($comment->post)
                    <div class="text-sm text-primary-600">
                        {{ Str::limit($comment->post->title, 30) }}
                    </div>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($comment->is_approved)
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Approved
                    </span>
                    @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                        Pending
                    </span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $comment->created_at->format('M d, Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex gap-2">
                        @if(!$comment->is_approved)
                        <button type="button" onclick="approveComment({{ $comment->id }})" class="text-green-600 hover:text-green-900" title="Approve">
                            <i class="fas fa-check-circle"></i>
                        </button>
                        @else
                        <button type="button" onclick="rejectComment({{ $comment->id }})" class="text-yellow-600 hover:text-yellow-900" title="Unapprove">
                            <i class="fas fa-times-circle"></i>
                        </button>
                        @endif
                        <form method="POST" action="{{ route('admin.blog-comments.destroy', $comment) }}" class="inline" id="delete-form-{{ $comment->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete('delete-form-{{ $comment->id }}', 'Are you sure you want to delete this comment?', 'Delete Comment?')" class="text-red-600 hover:text-red-900" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Bulk Actions & Pagination -->
<div class="bg-white rounded-xl shadow-md p-6 flex flex-col md:flex-row items-center justify-between gap-4">
    <div class="flex gap-2">
        <button type="button" onclick="bulkApprove()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-check mr-2"></i>Approve Selected
        </button>
        <button type="button" onclick="bulkDelete()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-trash mr-2"></i>Delete Selected
        </button>
    </div>
    <div>{{ $comments->links() }}</div>
</div>

@else
<div class="bg-white rounded-xl shadow-md p-12 text-center">
    <i class="fas fa-comments text-gray-300 text-6xl mb-4"></i>
    <p class="text-gray-500 text-lg">No comments found</p>
    @if(request()->hasAny(['search', 'status', 'post_id']))
    <a href="{{ route('admin.blog-comments.index') }}" class="inline-block mt-4 text-primary-600 hover:text-primary-700 font-semibold">
        <i class="fas fa-times mr-2"></i>Clear filters
    </a>
    @endif
</div>
@endif

@push('scripts')
<script>
// Select all checkboxes
document.getElementById('select-all')?.addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.comment-checkbox');
    checkboxes.forEach(checkbox => checkbox.checked = this.checked);
});

// Approve comment
function approveComment(commentId) {
    if (!confirm('Approve this comment?')) return;

    fetch(`/admin/blog-comments/${commentId}/approve`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}

// Reject comment
function rejectComment(commentId) {
    if (!confirm('Unapprove this comment?')) return;

    fetch(`/admin/blog-comments/${commentId}/reject`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}

// Bulk approve
function bulkApprove() {
    const checkboxes = document.querySelectorAll('.comment-checkbox:checked');
    if (checkboxes.length === 0) {
        alert('Please select at least one comment');
        return;
    }

    if (!confirm(`Approve ${checkboxes.length} comment(s)?`)) return;

    const form = document.getElementById('bulk-approve-form');
    const ids = Array.from(checkboxes).map(cb => cb.value);
    const input = form.querySelector('input[name="comment_ids"]');
    input.value = JSON.stringify(ids);

    // Create individual inputs for each ID
    ids.forEach(id => {
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'comment_ids[]';
        hiddenInput.value = id;
        form.appendChild(hiddenInput);
    });

    form.submit();
}

// Bulk delete
function bulkDelete() {
    const checkboxes = document.querySelectorAll('.comment-checkbox:checked');
    if (checkboxes.length === 0) {
        alert('Please select at least one comment');
        return;
    }

    if (!confirm(`Delete ${checkboxes.length} comment(s)?`)) return;

    const form = document.getElementById('bulk-delete-form');
    const ids = Array.from(checkboxes).map(cb => cb.value);

    // Create individual inputs for each ID
    ids.forEach(id => {
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'comment_ids[]';
        hiddenInput.value = id;
        form.appendChild(hiddenInput);
    });

    form.submit();
}
</script>
@endpush
@endsection
