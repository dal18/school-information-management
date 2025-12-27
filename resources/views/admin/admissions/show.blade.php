@extends('layouts.admin')

@section('title', 'View Admission')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Admission Details</h1>
        <p class="text-gray-600 mt-1">View admission application details</p>
    </div>
    <div class="flex space-x-3">
        <a href="{{ route('admin.admissions.edit', $admission) }}"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
            <i class="fas fa-edit mr-2"></i>Edit
        </a>
        <a href="{{ route('admin.admissions.index') }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
            <i class="fas fa-arrow-left mr-2"></i>Back
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Applicant Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">Applicant Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Full Name</label>
                    <p class="text-gray-900 font-medium">{{ $admission->full_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Date of Birth</label>
                    <p class="text-gray-900">{{ $admission->date_of_birth->format('F d, Y') }} ({{ $admission->age }} years old)</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Gender</label>
                    <p class="text-gray-900">{{ $admission->gender }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Grade Level</label>
                    <p class="text-gray-900 font-medium">{{ $admission->grade_level }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Previous School</label>
                    <p class="text-gray-900">{{ $admission->previous_school ?: 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">Contact Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                    <p class="text-gray-900">
                        <a href="mailto:{{ $admission->email }}" class="text-blue-600 hover:text-blue-800">
                            {{ $admission->email }}
                        </a>
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Phone</label>
                    <p class="text-gray-900">
                        <a href="tel:{{ $admission->phone }}" class="text-blue-600 hover:text-blue-800">
                            {{ $admission->phone }}
                        </a>
                    </p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Address</label>
                    <p class="text-gray-900">{{ $admission->address }}</p>
                </div>
            </div>
        </div>

        <!-- Guardian Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">Guardian Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Guardian Name</label>
                    <p class="text-gray-900 font-medium">{{ $admission->guardian_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Relationship</label>
                    <p class="text-gray-900">{{ $admission->guardian_relationship }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Guardian Contact</label>
                    <p class="text-gray-900">
                        <a href="tel:{{ $admission->guardian_contact }}" class="text-blue-600 hover:text-blue-800">
                            {{ $admission->guardian_contact }}
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Documents -->
        @if($admission->birth_certificate_path || $admission->report_card_path || $admission->photo_path)
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">Uploaded Documents</h3>
            <div class="space-y-3">
                @if($admission->birth_certificate_path)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-600 text-xl mr-3"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Birth Certificate</p>
                            <p class="text-xs text-gray-500">{{ basename($admission->birth_certificate_path) }}</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $admission->birth_certificate_path) }}"
                        target="_blank"
                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        <i class="fas fa-download mr-1"></i>View
                    </a>
                </div>
                @endif

                @if($admission->report_card_path)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-600 text-xl mr-3"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Report Card</p>
                            <p class="text-xs text-gray-500">{{ basename($admission->report_card_path) }}</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $admission->report_card_path) }}"
                        target="_blank"
                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        <i class="fas fa-download mr-1"></i>View
                    </a>
                </div>
                @endif

                @if($admission->photo_path)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-image text-green-600 text-xl mr-3"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Student Photo</p>
                            <p class="text-xs text-gray-500">{{ basename($admission->photo_path) }}</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $admission->photo_path) }}"
                        target="_blank"
                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        <i class="fas fa-download mr-1"></i>View
                    </a>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Notes -->
        @if($admission->notes)
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">Notes</h3>
            <p class="text-gray-700">{{ $admission->notes }}</p>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Status Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Status</h3>
            <div class="mb-4">
                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                    {{ $admission->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                    {{ $admission->status === 'Under Review' ? 'bg-blue-100 text-blue-800' : '' }}
                    {{ $admission->status === 'Approved' ? 'bg-green-100 text-green-800' : '' }}
                    {{ $admission->status === 'Rejected' ? 'bg-red-100 text-red-800' : '' }}">
                    {{ $admission->status }}
                </span>
            </div>

            <form action="{{ route('admin.admissions.update-status', $admission) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                    <select name="status" id="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <option value="Pending" {{ $admission->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Under Review" {{ $admission->status === 'Under Review' ? 'selected' : '' }}>Under Review</option>
                        <option value="Approved" {{ $admission->status === 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Rejected" {{ $admission->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes (optional)</label>
                    <textarea name="notes" id="notes" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        placeholder="Add notes about this status change..."></textarea>
                </div>

                <button type="submit"
                    class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                    <i class="fas fa-save mr-2"></i>Update Status
                </button>
            </form>
        </div>

        <!-- Application Info -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Application Info</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Application ID</span>
                    <span class="font-medium text-gray-900">#{{ $admission->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Submitted</span>
                    <span class="font-medium text-gray-900">{{ $admission->created_at->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Last Updated</span>
                    <span class="font-medium text-gray-900">{{ $admission->updated_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>

        <!-- Status History -->
        @if($admission->statusHistory && $admission->statusHistory->count() > 0)
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Status History</h3>
            <div class="space-y-3">
                @foreach($admission->statusHistory as $history)
                <div class="border-l-2 border-gray-300 pl-4 pb-3 last:pb-0">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm font-medium text-gray-900">{{ $history->new_status }}</span>
                        <span class="text-xs text-gray-500">{{ optional($history->created_at)->format('M d, Y') ?? 'N/A' }}</span>
                    </div>
                    @if($history->notes)
                    <p class="text-xs text-gray-600">{{ $history->notes }}</p>
                    @endif
                    @if($history->user)
                    <p class="text-xs text-gray-500 mt-1">by {{ $history->user->first_name }} {{ $history->user->last_name }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Actions -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
            <div class="space-y-3">
                <form id="delete-form-{{ $admission->id }}" action="{{ route('admin.admissions.destroy', $admission) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                        onclick="confirmDelete('delete-form-{{ $admission->id }}', 'This will permanently delete this admission application and all associated data. This action cannot be undone!', 'Delete Application?')"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                        <i class="fas fa-trash mr-2"></i>Delete Application
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
