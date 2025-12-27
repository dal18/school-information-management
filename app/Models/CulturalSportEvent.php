<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CulturalSportEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'description',
        'event_date',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
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

    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now()->toDateString())
                     ->orderBy('event_date', 'asc');
    }

    public function scopePast($query)
    {
        return $query->where('event_date', '<', now()->toDateString())
                     ->orderBy('event_date', 'desc');
    }

    // Accessors
    public function getIsUpcomingAttribute()
    {
        return $this->event_date >= now()->toDateString();
    }

    // Helper Methods
    public function softDelete()
    {
        $this->update(['deleted_date' => now()]);
    }
}
