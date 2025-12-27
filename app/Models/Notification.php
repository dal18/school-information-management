<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'link',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the notification
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get unread notifications
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope to get read notifications
     */
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    /**
     * Scope to get recent notifications
     */
    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    /**
     * Mark notification as unread
     */
    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null,
        ]);
    }

    /**
     * Get icon class based on notification type
     */
    public function getIconAttribute()
    {
        return match($this->type) {
            'admission' => 'fa-user-graduate',
            'schedule' => 'fa-calendar-alt',
            'announcement' => 'fa-bullhorn',
            'feedback' => 'fa-comment-dots',
            'activity' => 'fa-calendar-check',
            'post' => 'fa-newspaper',
            'story' => 'fa-book-open',
            default => 'fa-bell',
        };
    }

    /**
     * Get color class based on notification type
     */
    public function getColorAttribute()
    {
        return match($this->type) {
            'admission' => 'text-blue-600 bg-blue-100',
            'schedule' => 'text-purple-600 bg-purple-100',
            'announcement' => 'text-yellow-600 bg-yellow-100',
            'feedback' => 'text-green-600 bg-green-100',
            'activity' => 'text-indigo-600 bg-indigo-100',
            'post' => 'text-pink-600 bg-pink-100',
            'story' => 'text-orange-600 bg-orange-100',
            default => 'text-gray-600 bg-gray-100',
        };
    }
}
