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
use App\Services\ActivityLogService;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardControllerEnhanced extends Controller
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
        ];

        // User breakdown by role
        $user_roles = [
            'admins' => User::active()->where('access_rights', 'Admin')->count(),
            'teachers' => User::active()->where('access_rights', 'Teacher')->count(),
            'students' => User::active()->where('access_rights', 'Student')->count(),
            'staff' => User::active()->where('access_rights', 'Staff')->count(),
        ];

        // Calculate KPIs
        $kpis = $this->calculateKPIs();

        // Calculate trends
        $trends = $this->calculateTrends();

        // Get pending tasks count
        $pending_tasks = $stats['pending_admissions'] + $stats['unread_messages'];

        // Get recent admissions
        $recent_admissions = Admission::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get recent contact messages
        $recent_messages = ContactMessage::orderBy('created_at', 'desc')
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
        $monthly_admissions = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('Y-m');
            $count = Admission::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$month])->count();
            $monthly_admissions[] = (object)[
                'month' => $month,
                'total' => $count
            ];
        }

        // Get user growth trend (last 30 days)
        $user_trend = ReportService::getTrendData('users', 30, 'created_at');

        // Get today's schedule
        $today = now()->format('l');
        $today_schedule = Schedule::where('day_of_week', $today)
            ->with(['subject', 'teacher'])
            ->orderBy('start_time')
            ->limit(10)
            ->get();

        // Get recent admin activities (using ActivityLogService)
        $recent_activities = $this->getRecentActivities();

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

        // Get recent feedback
        $recent_feedback = Feedback::active()
            ->orderBy('date_entry', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard-enhanced', compact(
            'stats',
            'user_roles',
            'kpis',
            'trends',
            'pending_tasks',
            'recent_admissions',
            'recent_messages',
            'admission_stats',
            'monthly_admissions',
            'user_trend',
            'today_schedule',
            'recent_activities',
            'recent_posts',
            'recent_stories',
            'recent_feedback'
        ));
    }

    /**
     * Calculate Key Performance Indicators
     */
    protected function calculateKPIs(): array
    {
        $totalAdmissions = Admission::count();
        $approvedAdmissions = Admission::where('status', 'Approved')->count();
        $approvalRate = $totalAdmissions > 0 ? round(($approvedAdmissions / $totalAdmissions) * 100, 1) : 0;

        // Calculate approval rate trend (compare with last month)
        $lastMonthTotal = Admission::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $lastMonthApproved = Admission::where('status', 'Approved')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $lastMonthRate = $lastMonthTotal > 0 ? ($lastMonthApproved / $lastMonthTotal) * 100 : 0;
        $approvalTrend = $lastMonthRate > 0 ? round($approvalRate - $lastMonthRate, 1) : 0;

        // Calculate average response time (in hours)
        // This is a placeholder - you can implement actual logic based on your requirements
        $avgResponseTime = 24; // Default 24 hours

        // Active users today (users who logged in today)
        // This is a placeholder - you might want to track login times
        $activeUsersToday = User::active()
            ->whereDate('created_at', today())
            ->count();

        // User growth percentage (compare with last month)
        $currentMonthUsers = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $lastMonthUsers = User::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $userGrowth = $lastMonthUsers > 0 ? round((($currentMonthUsers - $lastMonthUsers) / $lastMonthUsers) * 100, 1) : 0;

        // Pending items that require attention
        $pendingItems = Admission::where('status', 'Pending')->count() +
                       ContactMessage::where('status', 'unread')->count() +
                       Feedback::where('status', 'Unread')->count();

        return [
            'approval_rate' => $approvalRate,
            'approval_trend' => $approvalTrend,
            'avg_response_time' => $avgResponseTime,
            'active_users_today' => $activeUsersToday,
            'user_growth' => $userGrowth,
            'pending_items' => $pendingItems,
        ];
    }

    /**
     * Calculate trends for various metrics
     */
    protected function calculateTrends(): array
    {
        // Admission trend (compare current month with last month)
        $currentMonthAdmissions = Admission::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $lastMonthAdmissions = Admission::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $admissionTrend = $lastMonthAdmissions > 0
            ? round((($currentMonthAdmissions - $lastMonthAdmissions) / $lastMonthAdmissions) * 100, 1)
            : 0;

        // User trend
        $currentMonthUsers = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $lastMonthUsers = User::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $userTrend = $lastMonthUsers > 0
            ? round((($currentMonthUsers - $lastMonthUsers) / $lastMonthUsers) * 100, 1)
            : 0;

        return [
            'admissions' => $admissionTrend,
            'users' => $userTrend,
        ];
    }

    /**
     * Get recent admin activities from activity log
     */
    protected function getRecentActivities()
    {
        // Check if activity_logs table exists
        try {
            $activities = DB::table('activity_logs')
                ->join('users', 'activity_logs.user_id', '=', 'users.id')
                ->select(
                    'activity_logs.*',
                    'users.first_name',
                    'users.last_name',
                    'users.email'
                )
                ->orderBy('activity_logs.created_at', 'desc')
                ->limit(10)
                ->get()
                ->map(function ($activity) {
                    // Create a fake user object for the activity
                    $user = new \stdClass();
                    $user->name = $activity->first_name . ' ' . $activity->last_name;
                    $user->email = $activity->email;

                    $activity->user = $user;
                    $activity->created_at = \Carbon\Carbon::parse($activity->created_at);

                    return $activity;
                });

            return $activities;
        } catch (\Exception $e) {
            // If table doesn't exist or error occurs, return empty collection
            return collect([]);
        }
    }
}
