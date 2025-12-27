<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommunityInvolvement extends Model
{
    use HasFactory;

    protected $table = 'community_involvement';

    protected $fillable = [
        'activity_name',
        'description',
        'participants',
        'activity_date',
    ];

    protected function casts(): array
    {
        return [
            'participants' => 'integer',
            'activity_date' => 'date',
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
        return $query->orderBy('activity_date', 'desc');
    }

    // Helper Methods
    public function incrementParticipants($count = 1)
    {
        $this->increment('participants', $count);
    }

    public function softDelete()
    {
        $this->update(['deleted_date' => now()]);
    }
}
