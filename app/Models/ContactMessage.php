<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactMessage extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'ip_address',
        'status',
        'admin_reply',
        'replied_at',
        'replied_by',
        'user_has_seen_reply',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'replied_at' => 'datetime',
            'user_has_seen_reply' => 'boolean',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function repliedByUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'replied_by');
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    // Backwards compatibility accessors
    public function getIsReadAttribute()
    {
        return $this->status !== 'unread';
    }

    public function getIsRepliedAttribute()
    {
        return $this->status === 'responded';
    }

    // Helper Methods
    public function markAsRead()
    {
        $this->update(['status' => 'read']);
    }

    public function markAsReplied()
    {
        $this->update(['status' => 'responded']);
    }
}
