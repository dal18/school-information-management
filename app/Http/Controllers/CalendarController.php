<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Activity;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    /**
     * Display the calendar view
     */
    public function index()
    {
        return view('calendar.index');
    }

    /**
     * Get events data for calendar (JSON endpoint)
     */
    public function getEvents(Request $request)
    {
        $events = [];

        // Get schedules and convert to calendar events
        $schedules = Schedule::with(['subject', 'teacher'])
            ->whereNull('deleted_date')
            ->whereNotNull('start_time')
            ->whereNotNull('end_time')
            ->get();

        foreach ($schedules as $schedule) {
            // Skip if day_of_week is null
            if (!$schedule->day_of_week) {
                continue;
            }

            // Calculate the next occurrence of this day
            $dayOfWeek = $schedule->day_of_week;
            $startDate = $this->getNextDayOfWeek($dayOfWeek);

            // Create recurring events for the next 12 weeks
            for ($week = 0; $week < 12; $week++) {
                $eventDate = clone $startDate;
                $eventDate->addWeeks($week);

                $events[] = [
                    'id' => 'schedule-' . $schedule->id . '-week-' . $week,
                    'title' => $schedule->subject ? $schedule->subject->subject_name : 'Class',
                    'start' => $eventDate->format('Y-m-d') . 'T' . $schedule->start_time,
                    'end' => $eventDate->format('Y-m-d') . 'T' . $schedule->end_time,
                    'backgroundColor' => '#4F46E5', // Indigo for classes
                    'borderColor' => '#4338CA',
                    'extendedProps' => [
                        'type' => 'schedule',
                        'teacher' => $schedule->teacher ? $schedule->teacher->full_name : 'TBA',
                        'grade' => $schedule->grade_level ?? 'N/A',
                        'section' => $schedule->section ?? 'N/A',
                        'room' => $schedule->room ?? 'N/A',
                    ],
                ];
            }
        }

        // Get activities and convert to calendar events
        $activities = Activity::active()->get();

        foreach ($activities as $activity) {
            // Only add if date_uploaded is valid
            if ($activity->date_uploaded) {
                try {
                    $events[] = [
                        'id' => 'activity-' . $activity->id,
                        'title' => $activity->caption ?? 'Activity',
                        'start' => $activity->date_uploaded->format('Y-m-d'),
                        'allDay' => true,
                        'backgroundColor' => '#10B981', // Green for activities
                        'borderColor' => '#059669',
                        'extendedProps' => [
                            'type' => 'activity',
                            'description' => $activity->caption,
                            'category' => $activity->category ?? 'N/A',
                        ],
                    ];
                } catch (\Exception $e) {
                    // Skip activities with invalid dates
                    continue;
                }
            }
        }

        return response()->json($events);
    }

    /**
     * Get the next occurrence of a specific day of the week
     */
    private function getNextDayOfWeek($dayName)
    {
        $daysOfWeek = [
            'Monday' => 1,
            'Tuesday' => 2,
            'Wednesday' => 3,
            'Thursday' => 4,
            'Friday' => 5,
            'Saturday' => 6,
            'Sunday' => 7,
        ];

        $targetDay = $daysOfWeek[$dayName] ?? 1;
        $today = Carbon::now();
        $currentDay = $today->dayOfWeekIso;

        if ($currentDay <= $targetDay) {
            // Target day is this week
            $daysToAdd = $targetDay - $currentDay;
        } else {
            // Target day is next week
            $daysToAdd = 7 - ($currentDay - $targetDay);
        }

        return $today->copy()->addDays($daysToAdd);
    }
}