<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\StoryReaction;
use App\Models\StoryComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoryInteractionController extends Controller
{
    /**
     * Toggle reaction on a story
     */
    public function toggleReaction(Request $request, Story $story)
    {
        $userIdentifier = Auth::check() ? Auth::id() : $request->ip();
        $isUserId = Auth::check();

        // Check if user already reacted
        $existingReaction = StoryReaction::where('story_id', $story->id)
            ->where(function($query) use ($userIdentifier, $isUserId) {
                if ($isUserId) {
                    $query->where('user_id', $userIdentifier);
                } else {
                    $query->where('user_ip', $userIdentifier);
                }
            })
            ->first();

        if ($existingReaction) {
            // Remove reaction
            $existingReaction->delete();
            $reacted = false;
        } else {
            // Add reaction
            StoryReaction::create([
                'story_id' => $story->id,
                'user_id' => $isUserId ? $userIdentifier : null,
                'user_ip' => $isUserId ? null : $userIdentifier,
                'reaction_type' => $request->input('type', 'like'),
            ]);
            $reacted = true;
        }

        // Return updated count
        $reactionCount = $story->reactions()->count();

        return response()->json([
            'success' => true,
            'reacted' => $reacted,
            'count' => $reactionCount,
        ]);
    }

    /**
     * Submit a comment on a story (requires admin approval)
     */
    public function submitComment(Request $request, Story $story)
    {
        $validated = $request->validate([
            'comment' => 'required|string|min:3|max:1000',
            'commenter_name' => 'required_unless:user_id,!=,null|string|max:255',
            'commenter_email' => 'nullable|email|max:255',
        ]);

        $comment = StoryComment::create([
            'story_id' => $story->id,
            'user_id' => Auth::check() ? Auth::id() : null,
            'commenter_name' => Auth::check() ? null : $validated['commenter_name'],
            'commenter_email' => $validated['commenter_email'] ?? null,
            'comment' => $validated['comment'],
            'is_approved' => false, // Requires admin approval
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your comment has been submitted and is pending approval.',
        ]);
    }

    /**
     * Get approved comments for a story
     */
    public function getComments(Story $story)
    {
        $comments = $story->approvedComments()
            ->with(['user'])
            ->get()
            ->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'commenter_name' => $comment->commenter_display_name,
                    'comment' => $comment->comment,
                    'created_at' => $comment->created_at->diffForHumans(),
                ];
            });

        return response()->json([
            'success' => true,
            'comments' => $comments,
        ]);
    }
}
