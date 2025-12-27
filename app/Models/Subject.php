<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_name',
        'description',
        'grade_level',
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
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_date');
    }

    public function scopeByGradeLevel($query, $gradeLevel)
    {
        return $query->where('grade_level', 'LIKE', "%{$gradeLevel}%");
    }

    // Helper Methods
    public function softDelete()
    {
        $this->update(['deleted_date' => now()]);
    }
}
