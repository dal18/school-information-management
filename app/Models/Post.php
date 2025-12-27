<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author_id',
        'image_path',
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

    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function reactions()
    {
        return $this->hasMany(BlogReaction::class);
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function approvedComments()
    {
        return $this->hasMany(BlogComment::class)->where('is_approved', true)->orderBy('created_at', 'desc');
    }

    // Helper Methods for Reactions
    public function hasUserReacted($identifier)
    {
        if (is_numeric($identifier)) {
            return $this->reactions()->where('user_id', $identifier)->exists();
        }
        return $this->reactions()->where('guest_identifier', $identifier)->exists();
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
        return Str::limit($this->content, 200);
    }

    // Helper Methods
    public function softDelete()
    {
        $this->update(['deleted_date' => now()]);
    }
}
