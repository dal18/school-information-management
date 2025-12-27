<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * Create a notification for a specific user
     */
    public static function createForUser($userId, $type, $title, $message, $link = null)
    {
        return Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'link' => $link,
            'is_read' => false,
        ]);
    }

    /**
     * Create notifications for multiple users
     */
    public static function createForUsers($userIds, $type, $title, $message, $link = null)
    {
        $notifications = [];
        foreach ($userIds as $userId) {
            $notifications[] = [
                'user_id' => $userId,
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'link' => $link,
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Notification::insert($notifications);
    }

    /**
     * Create notification for all users with specific access rights
     */
    public static function createForUsersByRole($accessRights, $type, $title, $message, $link = null)
    {
        $users = User::whereIn('access_rights', (array)$accessRights)
            ->whereNull('deleted_date')
            ->pluck('id')
            ->toArray();

        if (!empty($users)) {
            self::createForUsers($users, $type, $title, $message, $link);
        }
    }

    /**
     * Create notification for all admins
     */
    public static function notifyAdmins($type, $title, $message, $link = null)
    {
        self::createForUsersByRole('Admin', $type, $title, $message, $link);
    }

    /**
     * Create notification for all students
     */
    public static function notifyStudents($type, $title, $message, $link = null)
    {
        self::createForUsersByRole('Student', $type, $title, $message, $link);
    }

    /**
     * Create notification for all teachers
     */
    public static function notifyTeachers($type, $title, $message, $link = null)
    {
        self::createForUsersByRole('Teacher', $type, $title, $message, $link);
    }

    /**
     * Create notification for all users
     */
    public static function notifyAll($type, $title, $message, $link = null)
    {
        $users = User::whereNull('deleted_date')->pluck('id')->toArray();

        if (!empty($users)) {
            self::createForUsers($users, $type, $title, $message, $link);
        }
    }

    /**
     * Notify about admission status change
     */
    public static function notifyAdmissionStatusChange($admission, $oldStatus)
    {
        // Notify admins
        self::notifyAdmins(
            'admission',
            'Admission Status Updated',
            "Application for {$admission->first_name} {$admission->last_name} changed from {$oldStatus} to {$admission->status}",
            route('admin.admissions.show', $admission->id)
        );
    }

    /**
     * Notify about new announcement
     */
    public static function notifyNewAnnouncement($announcement)
    {
        // Notify all students and teachers
        self::createForUsersByRole(
            ['Student', 'Teacher'],
            'announcement',
            'New Announcement: ' . $announcement->title,
            strip_tags(substr($announcement->content, 0, 100)) . '...',
            null
        );
    }

    /**
     * Notify about new schedule
     */
    public static function notifyNewSchedule($schedule)
    {
        // Notify teacher assigned to the schedule
        if ($schedule->teacher_id) {
            self::createForUser(
                $schedule->teacher_id,
                'schedule',
                'New Schedule Assignment',
                "You have been assigned to teach {$schedule->subject->subject_name} on {$schedule->day_of_week}",
                route('admin.schedules.show', $schedule->id)
            );
        }
    }

    /**
     * Notify about new activity
     */
    public static function notifyNewActivity($activity)
    {
        // Notify all students
        self::notifyStudents(
            'activity',
            'New Activity Posted',
            $activity->caption ?? 'Check out our latest activity!',
            null
        );
    }

    /**
     * Notify about new blog post
     */
    public static function notifyNewPost($post)
    {
        // Notify all students
        self::notifyStudents(
            'post',
            'New Blog Post: ' . $post->title,
            strip_tags(substr($post->content, 0, 100)) . '...',
            null
        );
    }

    /**
     * Notify about new feedback response
     */
    public static function notifyFeedbackResponse($feedback)
    {
        // Find user by email or name
        $user = User::where('email', $feedback->email)
            ->orWhere('full_name', $feedback->feedback_by)
            ->first();

        if ($user) {
            self::createForUser(
                $user->id,
                'feedback',
                'Response to Your Feedback',
                'We have responded to your feedback. Check it out!',
                null
            );
        }
    }
}
