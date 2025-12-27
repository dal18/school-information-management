<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\BlogReaction;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogInteractionController extends Controller
{
    /**
     * Toggle reaction on a blog post
     */
    public function toggleReaction(Request $request, Post $post)
    {
        $userIdentifier = Auth::id() ?? $request->ip() . '_' . $request->userAgent();

        $reactionData = [
            'post_id' => $post->id,
            'reaction_type' => $request->input('type', 'like'),
        ];

        if (Auth::check()) {
            $reactionData['user_id'] = Auth::id();
            $existing = BlogReaction::where('post_id', $post->id)
                ->where('user_id', Auth::id())
                ->first();
        } else {
            $reactionData['guest_identifier'] = $userIdentifier;
            $existing = BlogReaction::where('post_id', $post->id)
                ->where('guest_identifier', $userIdentifier)
                ->first();
        }

        if ($existing) {
            $existing->delete();
            $reacted = false;
        } else {
            BlogReaction::create($reactionData);
            $reacted = true;
        }

        $reactionCount = $post->reactions()->count();

        return response()->json([
            'success' => true,
            'reacted' => $reacted,
            'count' => $reactionCount,
        ]);
    }

    /**
     * Submit a comment on a blog post
     */
    public function submitComment(Request $request, Post $post)
    {
        $rules = [
            'comment' => 'required|string|max:1000',
        ];

        if (!Auth::check()) {
            $rules['commenter_name'] = 'required|string|max:255';
            $rules['commenter_email'] = 'nullable|email|max:255';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $commentData = [
            'post_id' => $post->id,
            'comment' => $request->comment,
            'is_approved' => false,
        ];

        if (Auth::check()) {
            $commentData['user_id'] = Auth::id();
        } else {
            $commentData['commenter_name'] = $request->commenter_name;
            $commentData['commenter_email'] = $request->commenter_email;
        }

        BlogComment::create($commentData);

        return response()->json([
            'success' => true,
            'message' => 'Your comment has been submitted and is awaiting approval.',
        ]);
    }

    /**
     * Get approved comments for a blog post
     */
    public function getComments(Post $post)
    {
        $comments = $post->approvedComments()
            ->with('user')
            ->get()
            ->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'commenter_name' => $comment->user
                        ? $comment->user->name
                        : $comment->commenter_name,
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
