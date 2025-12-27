@extends('layouts.admin')

@section('title', 'Calendar')

@section('header')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Calendar</h1>
    <p class="text-gray-600 mt-1">View schedules, activities, and events</p>
</div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <!-- Legend -->
    <div class="mb-6 flex flex-wrap gap-4">
        <div class="flex items-center">
            <div class="w-4 h-4 rounded bg-indigo-600 mr-2"></div>
            <span class="text-sm text-gray-700">Class Schedules</span>
        </div>
        <div class="flex items-center">
            <div class="w-4 h-4 rounded bg-green-600 mr-2"></div>
            <span class="text-sm text-gray-700">Activities & Events</span>
        </div>
    </div>

    <!-- Calendar Container -->
    <div id="calendar"></div>
</div>

<!-- Event Details Modal -->
<div id="eventModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 id="modalTitle" class="text-xl font-bold text-gray-900"></h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div id="modalContent" class="p-6">
            <!-- Content will be dynamically inserted -->
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
<style>
    #calendar {
        max-width: 100%;
        margin: 0 auto;
    }

    .fc {
        font-family: inherit;
    }

    .fc-toolbar-title {
        font-size: 1.5rem !important;
        font-weight: 700 !important;
        color: #111827;
    }

    .fc-button {
        background-color: #4F46E5 !important;
        border-color: #4F46E5 !important;
        color: white !important;
        text-transform: capitalize !important;
        padding: 0.5rem 1rem !important;
        font-weight: 500 !important;
    }

    .fc-button:hover {
        background-color: #4338CA !important;
        border-color: #4338CA !important;
    }

    .fc-button:disabled {
        background-color: #9CA3AF !important;
        border-color: #9CA3AF !important;
        opacity: 0.6;
    }

    .fc-button-active {
        background-color: #3730A3 !important;
        border-color: #3730A3 !important;
    }

    .fc-event {
        cursor: pointer;
        transition: transform 0.2s;
    }

    .fc-event:hover {
        transform: scale(1.05);
    }

    .fc-daygrid-day-number {
        color: #374151;
        font-weight: 500;
    }

    .fc-col-header-cell {
        background-color: #F3F4F6;
        font-weight: 600;
        color: #374151;
    }

    .fc-day-today {
        background-color: #EEF2FF !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            height: 'auto',
            navLinks: true,
            editable: false,
            selectable: true,
            selectMirror: true,
            dayMaxEvents: true,
            weekends: true,
            nowIndicator: true,
            events: '{{ route('calendar.events') }}',
            eventClick: function(info) {
                showEventDetails(info.event);
            },
            eventDidMount: function(info) {
                // Add tooltip
                info.el.title = info.event.title;
            }
        });

        calendar.render();
    });

    function showEventDetails(event) {
        const modal = document.getElementById('eventModal');
        const title = document.getElementById('modalTitle');
        const content = document.getElementById('modalContent');

        title.textContent = event.title;

        let html = '';

        if (event.extendedProps.type === 'schedule') {
            // Class schedule details
            html = `
                <div class="space-y-3">
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-clock w-6 text-indigo-600"></i>
                        <span>${formatTime(event.start)} - ${formatTime(event.end)}</span>
                    </div>
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-user-tie w-6 text-indigo-600"></i>
                        <span>${event.extendedProps.teacher}</span>
                    </div>
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-graduation-cap w-6 text-indigo-600"></i>
                        <span>${event.extendedProps.grade} - Section ${event.extendedProps.section}</span>
                    </div>
                    ${event.extendedProps.room ? `
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-door-open w-6 text-indigo-600"></i>
                            <span>Room ${event.extendedProps.room}</span>
                        </div>
                    ` : ''}
                </div>
            `;
        } else if (event.extendedProps.type === 'activity') {
            // Activity details
            html = `
                <div class="space-y-3">
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-calendar w-6 text-green-600"></i>
                        <span>${formatDate(event.start)}</span>
                    </div>
                    ${event.extendedProps.description ? `
                        <div class="flex items-start text-gray-700">
                            <i class="fas fa-info-circle w-6 text-green-600 mt-1"></i>
                            <span>${event.extendedProps.description}</span>
                        </div>
                    ` : ''}
                    ${event.extendedProps.location ? `
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-map-marker-alt w-6 text-green-600"></i>
                            <span>${event.extendedProps.location}</span>
                        </div>
                    ` : ''}
                </div>
            `;
        }

        content.innerHTML = html;
        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('eventModal');
        modal.classList.add('hidden');
    }

    function formatTime(date) {
        return new Date(date).toLocaleTimeString('en-US', {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        });
    }

    function formatDate(date) {
        return new Date(date).toLocaleDateString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }

    // Close modal when clicking outside
    document.getElementById('eventModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endpush
