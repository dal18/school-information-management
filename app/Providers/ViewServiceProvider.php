<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\ContactMessage;
use App\Models\NewsletterSubscriber;
use App\Models\StudentTestimonial;
use App\Models\StoryComment;
use App\Models\BlogComment;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share sidebar statistics with admin-sidebar and public-navigation views
        View::composer(['layouts.admin-sidebar', 'layouts.public-navigation'], function ($view) {
            // Cache statistics for 2 minutes to reduce database queries
            $stats = Cache::remember('admin_sidebar_stats', 120, function () {
                return [
                    'unread_contact_messages' => ContactMessage::where('status', 'unread')->count(),
                    'active_newsletter_subscribers' => NewsletterSubscriber::where('status', 'active')->count(),
                    'pending_testimonials' => StudentTestimonial::where('status', 'Pending')->whereNull('deleted_date')->count(),
                    'pending_story_comments' => StoryComment::where('is_approved', false)->count(),
                    'pending_blog_comments' => BlogComment::where('is_approved', false)->count(),
                ];
            });

            // For student-specific stats (per user), use shorter cache with user ID
            if (auth()->check() && auth()->user()->access_rights === 'Student') {
                $userId = auth()->id();
                $userEmail = auth()->user()->email;

                $stats['unseen_replies'] = Cache::remember("student_{$userId}_unseen_replies", 60, function () use ($userId, $userEmail) {
                    return ContactMessage::where(function($q) use ($userId, $userEmail) {
                            $q->where('user_id', $userId)
                              ->orWhere('email', $userEmail);
                        })
                        ->where('status', 'responded')
                        ->where('user_has_seen_reply', false)
                        ->count();
                });
            }

            $view->with('sidebarStats', $stats);
        });
    }
}
