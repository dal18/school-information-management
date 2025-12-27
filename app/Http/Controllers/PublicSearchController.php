<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Announcement;
use App\Models\Subject;
use App\Models\Activity;

class PublicSearchController extends Controller
{
    /**
     * Handle search requests
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (empty($query)) {
            return redirect()->route('home');
        }

        // Search across different models
        $posts = Post::where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->latest()
            ->limit(5)
            ->get();

        $announcements = Announcement::active()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->latest()
            ->limit(5)
            ->get();

        $subjects = Subject::active()
            ->where(function($q) use ($query) {
                $q->where('subject_name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->limit(5)
            ->get();

        $activities = Activity::active()
            ->where(function($q) use ($query) {
                $q->where('caption', 'like', "%{$query}%")
                  ->orWhere('category', 'like', "%{$query}%");
            })
            ->latest('date_uploaded')
            ->limit(5)
            ->get();

        $totalResults = $posts->count() + $announcements->count() +
                       $subjects->count() + $activities->count();

        return view('public.search', compact(
            'query',
            'posts',
            'announcements',
            'subjects',
            'activities',
            'totalResults'
        ));
    }

    /**
     * AJAX search for autocomplete
     */
    public function autocomplete(Request $request)
    {
        $query = $request->input('q');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $results = [];

        // Get top 3 from each category
        $posts = Post::where('title', 'like', "%{$query}%")
            ->latest()
            ->limit(3)
            ->get(['id', 'title'])
            ->map(function($post) {
                return [
                    'title' => $post->title,
                    'type' => 'Blog Post',
                    'url' => route('blog.show', $post->id),
                    'icon' => 'fa-newspaper'
                ];
            });

        $announcements = Announcement::active()
            ->where('title', 'like', "%{$query}%")
            ->latest()
            ->limit(3)
            ->get(['id', 'title'])
            ->map(function($announcement) {
                return [
                    'title' => $announcement->title,
                    'type' => 'Announcement',
                    'url' => route('announcements'),
                    'icon' => 'fa-bullhorn'
                ];
            });

        $results = array_merge($posts->toArray(), $announcements->toArray());

        return response()->json($results);
    }
}
