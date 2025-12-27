<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogCommentController extends Controller
{
    /**
     * Display a listing of blog comments
     */
    public function index(Request $request)
    {
        $query = BlogComment::with(['post', 'user', 'approver']);

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'pending') {
                $query->where('is_approved', false);
            } elseif ($request->status === 'approved') {
                $query->where('is_approved', true);
            }
        }

        // Filter by post
        if ($request->filled('post_id')) {
            $query->where('post_id', $request->post_id);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('comment', 'like', "%{$search}%")
                  ->orWhere('commenter_name', 'like', "%{$search}%")
                  ->orWhere('commenter_email', 'like', "%{$search}%");
            });
        }

        $comments = $query->orderBy('created_at', 'desc')->paginate(20);
        $posts = Post::active()->orderBy('title')->get();

        return view('admin.blog-comments.index', compact('comments', 'posts'));
    }

    /**
     * Approve a comment
     */
    public function approve(BlogComment $comment)
    {
        $comment->update([
            'is_approved' => true,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Comment approved successfully.',
            ]);
        }

        return redirect()->back()->with('success', 'Comment approved successfully.');
    }

    /**
     * Reject (unapprove) a comment
     */
    public function reject(BlogComment $comment)
    {
        $comment->update([
            'is_approved' => false,
            'approved_by' => null,
            'approved_at' => null,
        ]);

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Comment rejected successfully.',
            ]);
        }

        return redirect()->back()->with('success', 'Comment rejected successfully.');
    }

    /**
     * Delete a comment
     */
    public function destroy(BlogComment $comment)
    {
        $comment->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Comment deleted successfully.',
            ]);
        }

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    /**
     * Bulk approve comments
     */
    public function bulkApprove(Request $request)
    {
        $request->validate([
            'comment_ids' => 'required|array',
            'comment_ids.*' => 'exists:blog_comments,id',
        ]);

        BlogComment::whereIn('id', $request->comment_ids)->update([
            'is_approved' => true,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Selected comments approved successfully.');
    }

    /**
     * Bulk delete comments
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'comment_ids' => 'required|array',
            'comment_ids.*' => 'exists:blog_comments,id',
        ]);

        BlogComment::whereIn('id', $request->comment_ids)->delete();

        return redirect()->back()->with('success', 'Selected comments deleted successfully.');
    }

    /**
     * View comments for a specific blog post
     */
    public function postComments(Post $post)
    {
        $comments = $post->comments()->with(['user', 'approver'])->orderBy('created_at', 'desc')->paginate(20);
        $posts = Post::active()->orderBy('title')->get();

        return view('admin.blog-comments.index', compact('comments', 'post', 'posts'));
    }
}
