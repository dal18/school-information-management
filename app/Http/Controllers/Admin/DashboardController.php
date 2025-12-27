<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Announcement;
use App\Models\ContactMessage;
use App\Models\User;
use App\Models\Facility;
use App\Models\Subject;
use App\Models\Activity;
use App\Models\Administrator;
use App\Models\Post;
use App\Models\Story;
use App\Models\Schedule;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics with proper null handling
        $stats = [
            'total_admissions' => Admission::count(),
            'pending_admissions' => Admission::where('status', 'Pending')->count(),
            'approved_admissions' => Admission::where('status', 'Approved')->count(),
            'total_users' => User::active()->count(),
            'active_users' => User::active()->count(),
            'total_announcements' => Announcement::active()->count(),
            'unread_messages' => ContactMessage::where('status', 'unread')->count(),
            'total_facilities' => Facility::active()->count(),
            'total_courses' => Subject::active()->count(),
            'total_activities' => Activity::active()->count(),
            'total_admins' => Administrator::active()->count(),
            'total_posts' => Post::active()->count(),
            'total_stories' => Story::active()->count(),
            'total_schedules' => Schedule::count(),
            'total_feedback' => Feedback::active()->count(),
            'pending_feedback' => Feedback::active()->where('Concern', 'Complaint')->count(),
        ];

        // User breakdown by role (using active scope)
        $user_roles = [
            'admins' => User::active()->where('access_rights', 'Admin')->count(),
            'teachers' => User::active()->where('access_rights', 'Teacher')->count(),
            'students' => User::active()->where('access_rights', 'Student')->count(),
            'staff' => User::active()->where('access_rights', 'Staff')->count(),
        ];

        // Get recent admissions
        $recent_admissions = Admission::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get recent contact messages
        $recent_messages = ContactMessage::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get recent announcements
        $recent_announcements = Announcement::active()
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Admission statistics by status
        $admission_stats = [
            'pending' => Admission::where('status', 'Pending')->count(),
            'under_review' => Admission::where('status', 'Under Review')->count(),
            'approved' => Admission::where('status', 'Approved')->count(),
            'rejected' => Admission::where('status', 'Rejected')->count(),
        ];

        // Monthly admission trend (last 6 months)
        // Ensure we always have 6 months of data
        $monthly_admissions = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('Y-m');
            $count = Admission::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$month])->count();
            $monthly_admissions[] = (object)[
                'month' => $month,
                'total' => $count
            ];
        }

        // Recent user activities (properly selecting users with first_name and last_name)
        $recent_user_activities = User::active()
            ->whereNotNull('first_name')
            ->whereNotNull('last_name')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get recent blog posts
        $recent_posts = Post::active()
            ->with('author')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Get recent stories
        $recent_stories = Story::active()
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Get today's schedule
        $today = now()->format('l');
        $today_schedule = Schedule::where('day_of_week', $today)
            ->with(['subject', 'teacher'])
            ->orderBy('start_time')
            ->limit(5)
            ->get();

        // Get recent feedback
        $recent_feedback = Feedback::active()
            ->orderBy('date_entry', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'user_roles',
            'recent_admissions',
            'recent_messages',
            'recent_announcements',
            'admission_stats',
            'monthly_admissions',
            'recent_user_activities',
            'recent_posts',
            'recent_stories',
            'today_schedule',
            'recent_feedback'
        ));
    }
}
