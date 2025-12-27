@extends('layouts.admin')

@section('title', 'Facilities')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Facilities</h1>
        <p class="text-gray-600 mt-1">Manage school facilities and infrastructure</p>
    </div>
    <a href="{{ route('admin.facilities.create') }}"
        class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
        <i class="fas fa-plus mr-2"></i>New Facility
    </a>
</div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    @if($facilities->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
            @foreach($facilities as $facility)
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
                @if($facility->image_path)
                <div class="h-48 bg-gray-200 overflow-hidden">
                    <img src="{{ asset('storage/' . $facility->image_path) }}"
                        alt="{{ $facility->facility_name }}"
                        class="w-full h-full object-cover">
                </div>
                @else
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-building text-6xl text-gray-400"></i>
                </div>
                @endif

                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $facility->facility_name }}</h3>
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $facility->description ?: 'No description provided.' }}</p>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.facilities.edit', $facility) }}"
                            class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <form id="delete-form-{{ $facility->id }}" action="{{ route('admin.facilities.destroy', $facility) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete('delete-form-{{ $facility->id }}', 'This will permanently delete this facility!', 'Delete Facility?')" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                <i class="fas fa-trash mr-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="bg-white px-6 py-4 border-t border-gray-200">
            {{ $facilities->links() }}
        </div>
    @else
        <div class="p-12 text-center">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-building text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Facilities Yet</h3>
            <p class="text-gray-600 mb-6">Start adding facilities to showcase your school's infrastructure.</p>
            <a href="{{ route('admin.facilities.create') }}"
                class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                <i class="fas fa-plus mr-2"></i>Create Facility
            </a>
        </div>
    @endif
</div>
@endsection
