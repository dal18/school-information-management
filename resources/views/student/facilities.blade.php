@extends('layouts.admin')

@section('title', 'Facilities')

@section('header')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">School Facilities</h1>
    <p class="text-gray-600 mt-1">Explore our campus and learning spaces</p>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($facilities as $facility)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
            @if($facility->image_path)
                <img src="{{ asset('storage/facilities/' . $facility->image_path) }}"
                     alt="{{ $facility->caption }}"
                     class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-building text-6xl text-gray-400"></i>
                </div>
            @endif
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $facility->caption }}</h3>
                @if($facility->detail)
                    <p class="text-gray-600">{{ $facility->detail }}</p>
                @endif
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-building text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">No facilities information available.</p>
        </div>
    @endforelse
</div>
@endsection
