<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Subject;
use App\Models\Activity;
use App\Models\Facility;
use App\Models\Schedule;
use App\Models\Post;
use App\Models\Story;
use App\Models\StudentTestimonial;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Get recent announcements
        $announcements = Announcement::active()
            ->with('author')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get all courses/subjects
        $courses = Subject::active()
            ->orderBy('subject_name')
            ->take(6)
            ->get();

        // Get recent activities
        $activities = Activity::active()
            ->orderBy('date_uploaded', 'desc')
            ->take(4)
            ->get();

        // Get facilities
        $facilities = Facility::active()
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();

        // Get today's schedule
        $today = now()->format('l'); // Get day name (Monday, Tuesday, etc.)
        $todaySchedule = Schedule::where('day_of_week', $today)
            ->with(['subject', 'teacher'])
            ->orderBy('start_time')
            ->get();

        // Get this week's schedules grouped by day
        $weekSchedule = Schedule::with(['subject', 'teacher'])
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get()
            ->groupBy('day_of_week');

        // Get recent blog posts
        $posts = Post::active()
            ->with('author')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Get recent stories
        $stories = Story::active()
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Get student's own testimonials
        $myTestimonials = StudentTestimonial::active()
            ->where('student_name', $user->first_name . ' ' . $user->last_name)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Stats
        $stats = [
            'total_courses' => Subject::active()->count(),
            'total_announcements' => Announcement::active()->count(),
            'total_activities' => Activity::active()->count(),
            'total_facilities' => Facility::active()->count(),
            'total_posts' => Post::active()->count(),
            'total_stories' => Story::active()->count(),
            'today_classes' => $todaySchedule->count(),
            'my_testimonials' => StudentTestimonial::active()
                ->where('student_name', $user->first_name . ' ' . $user->last_name)
                ->count(),
            'pending_testimonials' => StudentTestimonial::active()
                ->where('student_name', $user->first_name . ' ' . $user->last_name)
                ->where('status', 'Pending')
                ->count(),
        ];

        return view('student.dashboard', compact(
            'user',
            'announcements',
            'courses',
            'activities',
            'facilities',
            'todaySchedule',
            'weekSchedule',
            'posts',
            'stories',
            'myTestimonials',
            'stats'
        ));
    }
}
