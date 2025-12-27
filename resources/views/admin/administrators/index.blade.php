@extends('layouts.admin')

@section('title', 'Administrators')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Administrators</h1>
        <p class="text-gray-600 mt-1">Manage school administrators and staff</p>
    </div>
    <a href="{{ route('admin.administrators.create') }}"
        class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
        <i class="fas fa-plus mr-2"></i>New Administrator
    </a>
</div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    @if($administrators->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Image
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Position
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Category
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Contact
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Order
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($administrators as $admin)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($admin->image)
                            <img src="{{ asset('storage/' . $admin->image) }}"
                                 alt="{{ $admin->name }}"
                                 class="h-16 w-16 rounded-full object-cover">
                            @else
                            <div class="h-16 w-16 bg-gray-200 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-gray-400 text-xl"></i>
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $admin->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $admin->position }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                @if($admin->category === 'Directors') bg-purple-100 text-purple-800
                                @elseif($admin->category === 'Principals') bg-blue-100 text-blue-800
                                @else bg-green-100 text-green-800
                                @endif">
                                {{ $admin->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-600">
                                @if($admin->email)
                                    <div><i class="fas fa-envelope text-gray-400 mr-1"></i>{{ $admin->email }}</div>
                                @endif
                                @if($admin->phone)
                                    <div><i class="fas fa-phone text-gray-400 mr-1"></i>{{ $admin->phone }}</div>
                                @endif
                                @if(!$admin->email && !$admin->phone)
                                    <span class="text-gray-400">N/A</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $admin->display_order }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.administrators.show', $admin) }}"
                                class="text-green-600 hover:text-green-900 mr-3"
                                title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.administrators.edit', $admin) }}"
                                class="text-blue-600 hover:text-blue-900 mr-3"
                                title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.administrators.destroy', $admin) }}"
                                method="POST"
                                class="inline"
                                id="delete-form-{{ $admin->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete('delete-form-{{ $admin->id }}', 'Are you sure you want to delete this administrator?', 'Delete Administrator?')" class="text-red-600 hover:text-red-900" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-white px-6 py-4 border-t border-gray-200">
            {{ $administrators->links() }}
        </div>
    @else
        <div class="p-12 text-center">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-users text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Administrators Yet</h3>
            <p class="text-gray-600 mb-6">Start adding administrators and staff members to your school.</p>
            <a href="{{ route('admin.administrators.create') }}"
                class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                <i class="fas fa-plus mr-2"></i>Add Administrator
            </a>
        </div>
    @endif
</div>
@endsection
