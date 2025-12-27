<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of schedules
     */
    public function index(Request $request)
    {
        $query = Schedule::with(['subject', 'teacher'])->active();

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('grade_level', 'like', "%{$search}%")
                  ->orWhere('section', 'like', "%{$search}%")
                  ->orWhere('room', 'like', "%{$search}%")
                  ->orWhereHas('subject', function($sq) use ($search) {
                      $sq->where('subject_name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('teacher', function($tq) use ($search) {
                      $tq->where('first_name', 'like', "%{$search}%")
                         ->orWhere('last_name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by day
        if ($request->has('day') && $request->day !== 'all') {
            $query->where('day_of_week', $request->day);
        }

        // Filter by grade
        if ($request->has('grade') && $request->grade !== 'all') {
            $query->where('grade_level', $request->grade);
        }

        $schedules = $query->orderBy('day_of_week')
                          ->orderBy('start_time')
                          ->paginate(15);

        return view('admin.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new schedule
     */
    public function create()
    {
        $subjects = Subject::active()->orderBy('subject_name')->get();
        $teachers = User::active()->where('access_rights', 'Teacher')->orderBy('first_name')->get();

        return view('admin.schedules.create', compact('subjects', 'teachers'));
    }

    /**
     * Store a newly created schedule
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:users,id',
            'grade_level' => 'required|string|max:50',
            'section' => 'required|string|max:50',
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room' => 'nullable|string|max:255',
        ]);

        Schedule::create($validated);

        return redirect()
            ->route('admin.schedules.index')
            ->with('success', 'Schedule created successfully!');
    }

    /**
     * Display the specified schedule
     */
    public function show(Schedule $schedule)
    {
        $schedule->load(['subject', 'teacher']);
        return view('admin.schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified schedule
     */
    public function edit(Schedule $schedule)
    {
        $subjects = Subject::active()->orderBy('subject_name')->get();
        $teachers = User::active()->where('access_rights', 'Teacher')->orderBy('first_name')->get();

        return view('admin.schedules.edit', compact('schedule', 'subjects', 'teachers'));
    }

    /**
     * Update the specified schedule
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:users,id',
            'grade_level' => 'required|string|max:50',
            'section' => 'required|string|max:50',
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room' => 'nullable|string|max:255',
        ]);

        $schedule->update($validated);

        return redirect()
            ->route('admin.schedules.index')
            ->with('success', 'Schedule updated successfully!');
    }

    /**
     * Remove the specified schedule
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->softDelete();

        return redirect()
            ->route('admin.schedules.index')
            ->with('success', 'Schedule deleted successfully!');
    }

    /**
     * Bulk delete schedules
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:schedules,id',
        ]);

        try {
            $deletedCount = Schedule::whereIn('id', $request->ids)->update(['deleted_date' => now()]);

            return redirect()
                ->route('admin.schedules.index')
                ->with('success', $deletedCount . ' schedule(s) deleted successfully!');

        } catch (\Exception $e) {
            \Log::error('Bulk delete schedules failed: ' . $e->getMessage());

            return redirect()
                ->route('admin.schedules.index')
                ->with('error', 'An error occurred while deleting schedules. Please try again.');
        }
    }

    /**
     * Export schedules to PDF
     */
    public function export(Request $request)
    {
        $query = Schedule::with(['subject', 'teacher'])->active();

        // Apply same filters as index
        if ($request->has('day') && $request->day) {
            $query->where('day_of_week', $request->day);
        }

        if ($request->has('grade') && $request->grade) {
            $query->where('grade_level', $request->grade);
        }

        if ($request->has('section') && $request->section) {
            $query->where('section', $request->section);
        }

        $schedules = $query->orderBy('day_of_week')->orderBy('start_time')->get();

        // Group schedules by day
        $schedulesByDay = $schedules->groupBy('day_of_week');

        $pdf = \PDF::loadView('admin.schedules.pdf', compact('schedulesByDay'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('class-schedules-' . now()->format('Y-m-d') . '.pdf');
    }
}
