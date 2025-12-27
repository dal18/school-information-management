<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Post;
use App\Models\Story;
use App\Models\Subject;
use App\Models\Facility;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return redirect()->back();
        }

        // Search across different content types
        $announcements = Announcement::active()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->recent()
            ->limit(5)
            ->get();

        $posts = Post::active()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->recent()
            ->limit(5)
            ->get();

        $stories = Story::active()
            ->where(function($q) use ($query) {
                $q->where('student_name', 'like', "%{$query}%")
                  ->orWhere('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->recent()
            ->limit(5)
            ->get();

        $subjects = Subject::active()
            ->where(function($q) use ($query) {
                $q->where('subject_name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->limit(5)
            ->get();

        $facilities = Facility::active()
            ->where(function($q) use ($query) {
                $q->where('caption', 'like', "%{$query}%")
                  ->orWhere('detail', 'like', "%{$query}%");
            })
            ->limit(5)
            ->get();

        $totalResults = $announcements->count() + $posts->count() + $stories->count() +
                       $subjects->count() + $facilities->count();

        return view('public.search', compact(
            'query',
            'announcements',
            'posts',
            'stories',
            'subjects',
            'facilities',
            'totalResults'
        ));
    }

    /**
     * AJAX autocomplete for search
     */
    public function autocomplete(Request $request)
    {
        $query = $request->input('q');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $results = [];

        // Get top results from each category
        $posts = Post::active()
            ->where('title', 'like', "%{$query}%")
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

        $subjects = Subject::active()
            ->where('subject_name', 'like', "%{$query}%")
            ->limit(2)
            ->get(['id', 'subject_name'])
            ->map(function($subject) {
                return [
                    'title' => $subject->subject_name,
                    'type' => 'Course',
                    'url' => route('courses'),
                    'icon' => 'fa-book'
                ];
            });

        $results = array_merge(
            $posts->toArray(),
            $announcements->toArray(),
            $subjects->toArray()
        );

        return response()->json($results);
    }
}
