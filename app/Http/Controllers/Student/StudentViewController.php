<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Facility;
use App\Models\Subject;
use App\Models\Activity;
use App\Models\Story;
use App\Models\Post;
use App\Models\Schedule;
use App\Models\Feedback;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class StudentViewController extends Controller
{
    public function announcements(Request $request)
    {
        $query = Announcement::active()->with('author')->orderBy('created_at', 'desc');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $announcements = $query->paginate(10)->withQueryString();

        return view('student.announcements', compact('announcements'));
    }

    public function courses()
    {
        $subjects = Subject::active()->get()->groupBy('grade_level');

        return view('student.courses', compact('subjects'));
    }

    public function facilities()
    {
        $facilities = Facility::active()->get();

        return view('student.facilities', compact('facilities'));
    }

    public function activities()
    {
        $activities = Activity::active()->orderBy('date_uploaded', 'desc')->get();

        return view('student.activities', compact('activities'));
    }

    public function stories(Request $request)
    {
        $query = Story::active()->orderBy('created_at', 'desc');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('grade_level', 'like', "%{$search}%");
            });
        }

        // Filter by grade level
        if ($request->has('grade') && $request->grade) {
            $query->where('grade_level', $request->grade);
        }

        $stories = $query->paginate(12)->withQueryString();

        return view('student.stories', compact('stories'));
    }

    public function blog(Request $request)
    {
        $query = Post::active()->with('author')->orderBy('created_at', 'desc');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(10)->withQueryString();

        return view('student.blog', compact('posts'));
    }

    public function schedules(Request $request)
    {
        $query = Schedule::with(['subject', 'teacher'])->active();

        // Filter by day if provided
        if ($request->has('day') && $request->day) {
            $query->where('day_of_week', $request->day);
        }

        // Filter by grade if provided
        if ($request->has('grade') && $request->grade) {
            $query->where('grade_level', $request->grade);
        }

        $schedules = $query->orderBy('day_of_week')->orderBy('start_time')->get();

        // Group schedules by day
        $schedulesByDay = $schedules->groupBy('day_of_week');

        // Ensure days are in correct order
        $daysOrder = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $schedulesByDay = $schedulesByDay->sortBy(function($item, $key) use ($daysOrder) {
            return array_search($key, $daysOrder);
        });

        return view('student.schedules', compact('schedulesByDay'));
    }

    public function feedback()
    {
        return view('student.feedback');
    }

    public function submitFeedback(Request $request)
    {
        $validated = $request->validate([
            'feedback_by' => 'required|string|max:255',
            'Concern' => 'required|in:Complaint,Suggestion,Compliment',
            'about' => 'required|string|min:10',
        ]);

        $validated['date_entry'] = now();

        Feedback::create($validated);

        return redirect()
            ->route('student.feedback')
            ->with('success', 'Thank you for your feedback! We will review it soon.');
    }

    public function myContactMessages()
    {
        // Get all contact messages for the current user
        $messages = ContactMessage::where(function($query) {
                $query->where('user_id', auth()->id())
                      ->orWhere('email', auth()->user()->email);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('student.contact-messages', compact('messages'));
    }

    public function showContactMessage(ContactMessage $contactMessage)
    {
        // Ensure user can only view their own messages
        // Check either user_id matches OR email matches (for messages sent before login)
        $isOwner = ($contactMessage->user_id && $contactMessage->user_id === auth()->id()) ||
                   ($contactMessage->email === auth()->user()->email);

        if (!$isOwner) {
            abort(403, 'You can only view your own contact messages.');
        }

        $contactMessage->load('repliedByUser');

        // Mark reply as seen by user
        if ($contactMessage->admin_reply && !$contactMessage->user_has_seen_reply) {
            $contactMessage->update(['user_has_seen_reply' => true]);
        }

        return view('student.contact-message-show', compact('contactMessage'));
    }
}
