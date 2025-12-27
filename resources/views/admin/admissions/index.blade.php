@extends('layouts.admin')

@section('title', 'Admissions')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Admissions</h1>
        <p class="text-gray-600 mt-1">Manage student admission applications</p>
    </div>
</div>
@endsection

@section('content')
<!-- Filters and Search -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <form method="GET" action="{{ route('admin.admissions.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Search -->
        <div class="md:col-span-2">
            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}"
                placeholder="Search by name, email, or phone..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
        </div>

        <!-- Status Filter -->
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select name="status" id="status"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>All Status</option>
                <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Under Review" {{ request('status') === 'Under Review' ? 'selected' : '' }}>Under Review</option>
                <option value="Approved" {{ request('status') === 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Rejected" {{ request('status') === 'Rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <!-- Actions -->
        <div class="flex items-end space-x-2">
            <button type="submit"
                class="flex-1 bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                <i class="fas fa-search mr-2"></i>Filter
            </button>
            <a href="{{ route('admin.admissions.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
                <i class="fas fa-times"></i>
            </a>
        </div>
    </form>

    <!-- Export Button -->
    <div class="mt-4 flex justify-end">
        <a href="{{ route('admin.admissions.export', request()->query()) }}"
            class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300 inline-flex items-center">
            <i class="fas fa-file-pdf mr-2"></i>Export to PDF
        </a>
    </div>
</div>

<!-- Admissions Table -->
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    @if($admissions->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Applicant
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Grade Level
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Contact
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Applied Date
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($admissions as $admission)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-primary-600 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ substr($admission->first_name, 0, 1) }}{{ substr($admission->last_name, 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $admission->full_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $admission->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $admission->grade_level }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $admission->phone }}</div>
                            <div class="text-sm text-gray-500">{{ $admission->guardian_name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                {{ $admission->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $admission->status === 'Under Review' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $admission->status === 'Approved' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $admission->status === 'Rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ $admission->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $admission->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.admissions.show', $admission) }}"
                                class="text-blue-600 hover:text-blue-900 mr-3">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.admissions.edit', $admission) }}"
                                class="text-green-600 hover:text-green-900 mr-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="delete-form-{{ $admission->id }}" action="{{ route('admin.admissions.destroy', $admission) }}"
                                method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete('delete-form-{{ $admission->id }}', 'This will permanently delete this admission application!', 'Delete Admission?')" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-6 py-4 border-t border-gray-200">
            {{ $admissions->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="p-12 text-center">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-graduate text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Admissions Found</h3>
            <p class="text-gray-600">
                @if(request('search') || request('status') !== 'all')
                    No admissions match your search criteria. Try adjusting your filters.
                @else
                    There are no admission applications yet.
                @endif
            </p>
        </div>
    @endif
</div>
@endsection
