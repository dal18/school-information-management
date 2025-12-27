<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\StoryComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoryCommentController extends Controller
{
    /**
     * Display a listing of story comments
     */
    public function index(Request $request)
    {
        $query = StoryComment::with(['story', 'user']);

        // Filter by approval status
        if ($request->has('status')) {
            if ($request->status === 'pending') {
                $query->pending();
            } elseif ($request->status === 'approved') {
                $query->approved();
            }
        }

        // Filter by story
        if ($request->has('story_id') && $request->story_id) {
            $query->where('story_id', $request->story_id);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('comment', 'like', "%{$search}%")
                  ->orWhere('commenter_name', 'like', "%{$search}%")
                  ->orWhere('commenter_email', 'like', "%{$search}%");
            });
        }

        $comments = $query->recent()->paginate(20);
        $stories = Story::active()->orderBy('title')->get();

        return view('admin.story-comments.index', compact('comments', 'stories'));
    }

    /**
     * Approve a comment
     */
    public function approve(StoryComment $comment)
    {
        $comment->update([
            'is_approved' => true,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment approved successfully.',
        ]);
    }

    /**
     * Reject (unapprove) a comment
     */
    public function reject(StoryComment $comment)
    {
        $comment->update([
            'is_approved' => false,
            'approved_by' => null,
            'approved_at' => null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment rejected successfully.',
        ]);
    }

    /**
     * Delete a comment
     */
    public function destroy(StoryComment $comment)
    {
        $comment->delete();

        return redirect()
            ->route('admin.story-comments.index')
            ->with('success', 'Comment deleted successfully!');
    }

    /**
     * Bulk approve comments
     */
    public function bulkApprove(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:story_comments,id',
        ]);

        StoryComment::whereIn('id', $request->ids)->update([
            'is_approved' => true,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return redirect()
            ->route('admin.story-comments.index')
            ->with('success', count($request->ids) . ' comment(s) approved successfully!');
    }

    /**
     * Bulk delete comments
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:story_comments,id',
        ]);

        StoryComment::whereIn('id', $request->ids)->delete();

        return redirect()
            ->route('admin.story-comments.index')
            ->with('success', count($request->ids) . ' comment(s) deleted successfully!');
    }

    /**
     * Show all comments for a specific story
     */
    public function storyComments(Story $story)
    {
        $comments = StoryComment::where('story_id', $story->id)
            ->with(['user'])
            ->recent()
            ->paginate(20);

        return view('admin.story-comments.story', compact('story', 'comments'));
    }
}
