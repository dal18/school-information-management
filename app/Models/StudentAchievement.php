<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAchievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'achievement',
        'description',
        'date_achieved',
    ];

    protected function casts(): array
    {
        return [
            'date_achieved' => 'date',
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
        return $query->orderBy('date_achieved', 'desc');
    }

    public function scopeThisYear($query)
    {
        return $query->whereYear('date_achieved', now()->year);
    }

    // Helper Methods
    public function softDelete()
    {
        $this->update(['deleted_date' => now()]);
    }
}
