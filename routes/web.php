<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdmissionFormController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AdmissionController as AdminAdmissionController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\StoryCommentController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\StoryInteractionController;
use App\Http\Controllers\PublicTestimonialController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\StudentViewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/mission-vision', [PublicController::class, 'missionVision'])->name('mission-vision');
Route::get('/alma-mater', [PublicController::class, 'almaMater'])->name('alma-mater');
Route::get('/administration', [PublicController::class, 'administration'])->name('administration');
Route::get('/history', [PublicController::class, 'history'])->name('history');
Route::get('/admissions', [PublicController::class, 'admissions'])->name('admissions');
Route::post('/admissions/submit', [AdmissionFormController::class, 'store'])->name('admissions.submit');
Route::get('/facilities', [PublicController::class, 'facilities'])->name('facilities');
Route::get('/courses', [PublicController::class, 'courses'])->name('courses');
Route::get('/activities', [PublicController::class, 'activities'])->name('activities');
Route::get('/announcements', [PublicController::class, 'announcements'])->name('announcements');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'store'])->name('contact.submit');
Route::get('/stories', [PublicController::class, 'stories'])->name('stories');
Route::get('/blog', [PublicController::class, 'posts'])->name('blog');
Route::get('/schedules', [PublicController::class, 'schedules'])->name('schedules');
Route::get('/feedback', [PublicController::class, 'feedback'])->name('feedback');
Route::post('/feedback/submit', [PublicController::class, 'submitFeedback'])->name('feedback.submit');
Route::get('/testimonials', [PublicTestimonialController::class, 'index'])->name('testimonials.index');
Route::get('/testimonials/create', [PublicTestimonialController::class, 'create'])->name('testimonials.create');
Route::post('/testimonials/submit', [PublicTestimonialController::class, 'store'])->name('testimonials.store');
Route::get('/privacy-policy', [PublicController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-service', [PublicController::class, 'terms'])->name('terms');
Route::get('/sitemap', [PublicController::class, 'sitemap'])->name('sitemap');
Route::post('/newsletter/subscribe', [App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Emergency deployment fix route
Route::get('/emergency-fix-deployment-2025', function() {
    $output = [];
    $publicHtmlPath = realpath(base_path() . '/..');

    $output[] = "=== Emergency Deployment Fix ===\n";
    $output[] = "Public HTML Path: $publicHtmlPath";
    $output[] = "Laravel Path: " . base_path() . "\n";

    // Fix 1: Copy .htaccess
    $output[] = "=== Fix 1: Copying .htaccess ===";
    $htaccessSource = public_path('.htaccess');
    $htaccessDest = $publicHtmlPath . '/.htaccess';

    if (file_exists($htaccessSource)) {
        if (copy($htaccessSource, $htaccessDest)) {
            $output[] = "✅ .htaccess copied successfully";
        } else {
            $output[] = "❌ Failed to copy .htaccess";
        }
    } else {
        $output[] = "❌ Source .htaccess not found at: $htaccessSource";
    }

    // Fix 2: Clear caches
    $output[] = "\n=== Fix 2: Clearing Caches ===";
    try {
        Artisan::call('optimize:clear');
        $output[] = "✅ optimize:clear completed";
        Artisan::call('config:cache');
        $output[] = "✅ config:cache completed";
        Artisan::call('route:cache');
        $output[] = "✅ route:cache completed";
        Artisan::call('view:cache');
        $output[] = "✅ view:cache completed";
    } catch (\Exception $e) {
        $output[] = "❌ Error: " . $e->getMessage();
    }

    // Fix 3: Check .htaccess
    $output[] = "\n=== Fix 3: Verifying .htaccess ===";
    if (file_exists($htaccessDest)) {
        $output[] = "✅ .htaccess exists at root";
        $content = file_get_contents($htaccessDest);
        $output[] = "Content preview:\n" . substr($content, 0, 300);
    } else {
        $output[] = "❌ .htaccess NOT found at root";
    }

    $output[] = "\n=== ALL DONE ===";
    $output[] = "Visit: https://littleflowerhs.com";
    $output[] = "\n⚠️ IMPORTANT: Remove this route from routes/web.php after fixing!";

    return response('<pre>' . implode("\n", $output) . '</pre>');
});
Route::get('/newsletter/unsubscribe/{id}', [App\Http\Controllers\NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::get('/search/autocomplete', [App\Http\Controllers\SearchController::class, 'autocomplete'])->name('search.autocomplete');

// Story Interaction Routes (Public - accessible by all users)
Route::prefix('stories')->name('stories.')->group(function () {
    Route::post('/{story}/react', [StoryInteractionController::class, 'toggleReaction'])->name('react');
    Route::post('/{story}/comment', [StoryInteractionController::class, 'submitComment'])->name('comment');
    Route::get('/{story}/comments', [StoryInteractionController::class, 'getComments'])->name('comments');
});

// Blog Interaction Routes (Public - accessible by all users)
Route::prefix('blog')->name('blog.')->group(function () {
    Route::post('/{post}/react', [App\Http\Controllers\BlogInteractionController::class, 'toggleReaction'])->name('react');
    Route::post('/{post}/comment', [App\Http\Controllers\BlogInteractionController::class, 'submitComment'])->name('comment');
    Route::get('/{post}/comments', [App\Http\Controllers\BlogInteractionController::class, 'getComments'])->name('comments');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Smart Dashboard Redirect - redirects to appropriate dashboard based on user role
    Route::get('/dashboard', function () {
        $user = auth()->user();

        switch ($user->access_rights) {
            case 'Admin':
            case 'Teacher':
                return redirect()->route('admin.dashboard');

            case 'Student':
            case 'User':
            default:
                return redirect()->route('student.dashboard');
        }
    })->middleware('verified')->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Admissions Management
    Route::resource('admissions', AdminAdmissionController::class);
    Route::post('admissions/{admission}/update-status', [AdminAdmissionController::class, 'updateStatus'])->name('admissions.update-status');
    Route::get('admissions-export', [AdminAdmissionController::class, 'export'])->name('admissions.export');

    // Announcements Management
    Route::resource('announcements', AnnouncementController::class);

    // User Management
    Route::resource('users', UserController::class);

    // Course Management
    Route::resource('courses', CourseController::class);

    // Facility Management
    Route::post('facilities/{facility}/update-with-file', [FacilityController::class, 'updateWithFile'])->name('facilities.update-with-file');
    Route::resource('facilities', FacilityController::class);

    // Activity Management
    Route::resource('activities', ActivityController::class);

    // Administrator Management
    Route::resource('administrators', AdministratorController::class);

    // Contact Messages Management
    Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
    Route::post('contact-messages/{contactMessage}/reply', [ContactMessageController::class, 'reply'])->name('contact-messages.reply');
    Route::patch('contact-messages/{contactMessage}/mark-as-read', [ContactMessageController::class, 'markAsRead'])->name('contact-messages.mark-as-read');
    Route::post('contact-messages/bulk-delete', [ContactMessageController::class, 'bulkDelete'])->name('contact-messages.bulk-delete');

    // Testimonials Management
    Route::resource('testimonials', TestimonialController::class);
    Route::post('testimonials/{testimonial}/update-status', [TestimonialController::class, 'updateStatus'])->name('testimonials.update-status');
    Route::post('testimonials/bulk-delete', [TestimonialController::class, 'bulkDelete'])->name('testimonials.bulk-delete');

    // Stories Management
    Route::resource('stories', StoryController::class);
    Route::post('stories/bulk-delete', [StoryController::class, 'bulkDelete'])->name('stories.bulk-delete');

    // Story Comments Management
    Route::prefix('story-comments')->name('story-comments.')->group(function () {
        Route::get('/', [StoryCommentController::class, 'index'])->name('index');
        Route::post('/{comment}/approve', [StoryCommentController::class, 'approve'])->name('approve');
        Route::post('/{comment}/reject', [StoryCommentController::class, 'reject'])->name('reject');
        Route::delete('/{comment}', [StoryCommentController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-approve', [StoryCommentController::class, 'bulkApprove'])->name('bulk-approve');
        Route::post('/bulk-delete', [StoryCommentController::class, 'bulkDelete'])->name('bulk-delete');
    });
    Route::get('stories/{story}/comments', [StoryCommentController::class, 'storyComments'])->name('stories.comments');

    // Blog Comments Management
    Route::prefix('blog-comments')->name('blog-comments.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\BlogCommentController::class, 'index'])->name('index');
        Route::post('/{comment}/approve', [App\Http\Controllers\Admin\BlogCommentController::class, 'approve'])->name('approve');
        Route::post('/{comment}/reject', [App\Http\Controllers\Admin\BlogCommentController::class, 'reject'])->name('reject');
        Route::delete('/{comment}', [App\Http\Controllers\Admin\BlogCommentController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-approve', [App\Http\Controllers\Admin\BlogCommentController::class, 'bulkApprove'])->name('bulk-approve');
        Route::post('/bulk-delete', [App\Http\Controllers\Admin\BlogCommentController::class, 'bulkDelete'])->name('bulk-delete');
    });
    Route::get('posts/{post}/comments', [App\Http\Controllers\Admin\BlogCommentController::class, 'postComments'])->name('posts.comments');

    // Feedback Management
    Route::get('feedback/export', [FeedbackController::class, 'export'])->name('feedback.export');
    Route::post('feedback/bulk-delete', [FeedbackController::class, 'bulkDelete'])->name('feedback.bulk-delete');
    Route::resource('feedback', FeedbackController::class)->only(['index', 'show', 'destroy']);
    Route::post('feedback/{feedback}/reply', [FeedbackController::class, 'reply'])->name('feedback.reply');
    Route::post('feedback/{feedback}/update-status', [FeedbackController::class, 'updateStatus'])->name('feedback.update-status');

    // Posts/Blog Management
    Route::resource('posts', PostController::class);
    Route::post('posts/bulk-delete', [PostController::class, 'bulkDelete'])->name('posts.bulk-delete');

    // Schedules Management
    Route::get('schedules/export', [ScheduleController::class, 'export'])->name('schedules.export');
    Route::post('schedules/bulk-delete', [ScheduleController::class, 'bulkDelete'])->name('schedules.bulk-delete');
    Route::resource('schedules', ScheduleController::class);

    // Newsletter Subscribers Management
    Route::resource('newsletter-subscribers', App\Http\Controllers\Admin\NewsletterSubscriberController::class)->only(['index', 'destroy']);
    Route::post('newsletter-subscribers/bulk-delete', [App\Http\Controllers\Admin\NewsletterSubscriberController::class, 'bulkDelete'])->name('newsletter-subscribers.bulk-delete');
    Route::get('newsletter-subscribers/export', [App\Http\Controllers\Admin\NewsletterSubscriberController::class, 'export'])->name('newsletter-subscribers.export');
});

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');

    // Student view-only routes
    Route::get('/announcements', [StudentViewController::class, 'announcements'])->name('announcements');
    Route::get('/courses', [StudentViewController::class, 'courses'])->name('courses');
    Route::get('/facilities', [StudentViewController::class, 'facilities'])->name('facilities');
    Route::get('/activities', [StudentViewController::class, 'activities'])->name('activities');
    Route::get('/stories', [StudentViewController::class, 'stories'])->name('stories');
    Route::get('/blog', [StudentViewController::class, 'blog'])->name('blog');
    Route::get('/schedules', [StudentViewController::class, 'schedules'])->name('schedules');
    Route::get('/feedback', [StudentViewController::class, 'feedback'])->name('feedback');
    Route::post('/feedback/submit', [StudentViewController::class, 'submitFeedback'])->name('feedback.submit');

    // Contact Messages - Students can view their own messages
    Route::get('/contact-messages', [StudentViewController::class, 'myContactMessages'])->name('contact-messages.index');
    Route::get('/contact-messages/{contactMessage}', [StudentViewController::class, 'showContactMessage'])->name('contact-messages.show');
});

require __DIR__.'/auth.php';






use App\Http\Controllers\CalendarController;
use App\Http\Controllers\NotificationController;

Route::middleware(['auth'])->group(function () {
    // Calendar routes
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/events', [CalendarController::class, 'getEvents'])->name('calendar.events');

    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');
    Route::get('/notifications/recent', [NotificationController::class, 'getRecent'])->name('notifications.recent');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-as-read');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::post('/notifications/clear-read', [NotificationController::class, 'clearRead'])->name('notifications.clear-read');

    // Contact Messages - All authenticated users can view their own messages
    Route::get('/my-contact-messages', [StudentViewController::class, 'myContactMessages'])->name('my-contact-messages.index');
    Route::get('/my-contact-messages/{contactMessage}', [StudentViewController::class, 'showContactMessage'])->name('my-contact-messages.show');
});


