<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of posts
     */
    public function index(Request $request)
    {
        $query = Post::query();

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created post
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:50',
        ]);

        // Set the author_id to the current logged-in user
        $validated['author_id'] = auth()->id();

        $post = Post::create($validated);

        // Send notification to all students
        NotificationService::notifyNewPost($post);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified post
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified post
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:50',
        ]);

        $post->update($validated);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified post
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post deleted successfully!');
    }

    /**
     * Bulk delete posts
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:posts,id',
        ]);

        try {
            $deletedCount = Post::whereIn('id', $request->ids)->delete();

            return redirect()
                ->route('admin.posts.index')
                ->with('success', $deletedCount . ' post(s) deleted successfully!');

        } catch (\Exception $e) {
            \Log::error('Bulk delete posts failed: ' . $e->getMessage());

            return redirect()
                ->route('admin.posts.index')
                ->with('error', 'An error occurred while deleting posts. Please try again.');
        }
    }
}
