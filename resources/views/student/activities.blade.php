@extends('layouts.admin')

@section('title', 'Activities')

@section('header')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Activities & Events</h1>
    <p class="text-gray-600 mt-1">Explore our school events and activities</p>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($activities as $activity)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
            @if($activity->link_image)
                <img src="{{ asset('storage/' . $activity->link_image) }}"
                     alt="{{ $activity->caption }}"
                     class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-6xl text-gray-400"></i>
                </div>
            @endif
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $activity->caption }}</h3>
                @if($activity->date_uploaded)
                    <p class="text-sm text-gray-500 flex items-center">
                        <i class="fas fa-calendar mr-2"></i>
                        {{ $activity->date_uploaded->format('F d, Y') }}
                    </p>
                @endif
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-calendar-alt text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">No activities available at this time.</p>
        </div>
    @endforelse
</div>
@endsection
