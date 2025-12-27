<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'title',
        'content',
        'grade_level',
        'image',
        'deleted_date',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_date' => 'datetime',
        ];
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_date');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Accessors
    public function getExcerptAttribute()
    {
        return Str::limit($this->content, 150);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/stories/' . $this->image) : asset('images/default-story.jpg');
    }

    // Relationships
    public function reactions()
    {
        return $this->hasMany(StoryReaction::class);
    }

    public function comments()
    {
        return $this->hasMany(StoryComment::class);
    }

    public function approvedComments()
    {
        return $this->hasMany(StoryComment::class)->approved()->orderBy('created_at', 'asc');
    }

    // Helper Methods
    public function softDelete()
    {
        $this->update(['deleted_date' => now()]);
    }

    public function getReactionCountAttribute()
    {
        return $this->reactions()->count();
    }

    public function getApprovedCommentCountAttribute()
    {
        return $this->comments()->approved()->count();
    }

    public function hasUserReacted($identifier)
    {
        // Check if user has reacted (by IP or user ID)
        return $this->reactions()
            ->where(function($query) use ($identifier) {
                if (is_numeric($identifier)) {
                    $query->where('user_id', $identifier);
                } else {
                    $query->where('user_ip', $identifier);
                }
            })
            ->exists();
    }
}
