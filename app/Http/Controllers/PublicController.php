<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Facility;
use App\Models\Subject;
use App\Models\Activity;
use App\Models\StudentTestimonial;
use App\Models\Administrator;
use App\Models\Story;
use App\Models\Post;
use App\Models\Schedule;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function index()
    {
        $announcements = Announcement::active()->recent()->limit(5)->get();
        $testimonials = StudentTestimonial::approved()->active()->latest()->limit(3)->get();

        // Get active students count
        $activeStudentsCount = User::where('access_rights', 'student')
            ->where('is_active', 1)
            ->count();

        // Fetch recent activity logs
        $recentActivities = DB::table('activity_logs')
            ->leftJoin('users', 'activity_logs.user_id', '=', 'users.id')
            ->select(
                'activity_logs.action',
                'activity_logs.model_type',
                'activity_logs.model_id',
                'activity_logs.created_at',
                DB::raw('CONCAT(users.first_name, " ", COALESCE(users.middle_name, ""), " ", users.last_name) as user_name')
            )
            ->whereIn('activity_logs.action', ['create', 'update'])
            ->whereIn('activity_logs.model_type', ['Admission', 'Post', 'Story', 'Announcement', 'Activity'])
            ->orderBy('activity_logs.created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($log) {
                return [
                    'icon' => $this->getActivityIcon($log->model_type, $log->action),
                    'text' => $this->getActivityText($log),
                    'time' => $this->getTimeAgo($log->created_at),
                    'color' => $this->getActivityColor($log->model_type)
                ];
            });

        return view('public.index', compact('announcements', 'testimonials', 'recentActivities', 'activeStudentsCount'));
    }

    private function getActivityIcon($modelType, $action)
    {
        $icons = [
            'Admission' => 'fa-graduation-cap',
            'Post' => 'fa-file-alt',
            'Story' => 'fa-book',
            'Announcement' => 'fa-bullhorn',
            'Activity' => 'fa-calendar-check',
        ];

        return $icons[$modelType] ?? 'fa-circle';
    }

    private function getActivityText($log)
    {
        $userName = $log->user_name ? explode(' ', $log->user_name)[0] . ' ' . substr(explode(' ', $log->user_name)[1] ?? '', 0, 1) . '.' : 'Someone';

        $actions = [
            'Admission' => 'New admission application submitted',
            'Post' => 'New blog post published',
            'Story' => 'New student story shared',
            'Announcement' => 'New announcement posted',
            'Activity' => 'New activity scheduled',
        ];

        if ($log->action === 'update') {
            $actions = [
                'Admission' => 'Admission application updated',
                'Post' => 'Blog post updated',
                'Story' => 'Student story updated',
                'Announcement' => 'Announcement updated',
                'Activity' => 'Activity details updated',
            ];
        }

        return $actions[$log->model_type] ?? 'New activity';
    }

    private function getTimeAgo($datetime)
    {
        $now = now();
        $created = \Carbon\Carbon::parse($datetime);

        $diffInMinutes = $created->diffInMinutes($now);

        if ($diffInMinutes < 1) {
            return 'Just now';
        } elseif ($diffInMinutes < 60) {
            return $diffInMinutes . ' min ago';
        } elseif ($diffInMinutes < 1440) {
            $hours = floor($diffInMinutes / 60);
            return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
        } else {
            $days = floor($diffInMinutes / 1440);
            return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
        }
    }

    private function getActivityColor($modelType)
    {
        $colors = [
            'Admission' => 'primary',
            'Post' => 'accent',
            'Story' => 'secondary',
            'Announcement' => 'accent',
            'Activity' => 'primary',
        ];

        return $colors[$modelType] ?? 'primary';
    }

    public function about()
    {
        return view('public.about');
    }

    public function admissions()
    {
        return view('public.admissions');
    }

    public function facilities()
    {
        $facilities = Facility::active()->get();

        return view('public.facilities', compact('facilities'));
    }

    public function courses()
    {
        $subjects = Subject::active()->get()->groupBy('grade_level');

        return view('public.courses', compact('subjects'));
    }

    public function activities(Request $request)
    {
        $query = Activity::active();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('activity_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from) {
            $query->where('date_uploaded', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->where('date_uploaded', '<=', $request->date_to);
        }

        $activities = $query->orderBy('date_uploaded', 'desc')->paginate(12)->withQueryString();

        return view('public.activities', compact('activities'));
    }

    public function announcements(Request $request)
    {
        $query = Announcement::active()->recent();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $announcements = $query->paginate(10)->withQueryString();

        return view('public.announcements', compact('announcements'));
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function missionVision()
    {
        return view('public.mission-vision');
    }

    public function almaMater()
    {
        return view('public.alma-mater');
    }

    public function administration()
    {
        $directors = Administrator::active()
            ->byCategory('Directors')
            ->ordered()
            ->get();

        $principals = Administrator::active()
            ->byCategory('Principals')
            ->ordered()
            ->get();

        $staff = Administrator::active()
            ->byCategory('Administrative Staff')
            ->ordered()
            ->get();

        return view('public.administration', compact('directors', 'principals', 'staff'));
    }

    public function history()
    {
        return view('public.history');
    }

    public function stories(Request $request)
    {
        $query = Story::active()->recent()->withCount('reactions');

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

        // Add reaction status for current user (by IP or user ID)
        $userIdentifier = auth()->check() ? auth()->id() : $request->ip();
        $stories->getCollection()->transform(function ($story) use ($userIdentifier) {
            $story->reaction_count = $story->reactions_count;
            $story->has_user_reacted = $story->hasUserReacted($userIdentifier);
            return $story;
        });

        return view('public.stories', compact('stories'));
    }

    public function posts(Request $request)
    {
        $query = Post::active()->with('author')->recent()->withCount('reactions');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(10)->withQueryString();

        // Add reaction status for current user (by IP + user agent or user ID)
        $userIdentifier = auth()->check() ? auth()->id() : $request->ip() . '_' . $request->userAgent();
        $posts->getCollection()->transform(function ($post) use ($userIdentifier) {
            $post->reaction_count = $post->reactions_count;
            $post->has_user_reacted = $post->hasUserReacted($userIdentifier);
            return $post;
        });

        return view('public.posts', compact('posts'));
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

        return view('public.schedules', compact('schedulesByDay'));
    }

    public function feedback()
    {
        return view('public.feedback');
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
            ->route('feedback')
            ->with('success', 'Thank you for your feedback! We will review it soon.');
    }

    public function privacy()
    {
        return view('public.privacy');
    }

    public function terms()
    {
        return view('public.terms');
    }

    public function sitemap()
    {
        return view('public.sitemap');
    }
}
