<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentTestimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'grade_level',
        'message',
        'status',
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
    public function scopeApproved($query)
    {
        return $query->where('status', 'Approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'Pending');
    }

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_date');
    }

    // Helper Methods
    public function approve()
    {
        $this->update(['status' => 'Approved']);
    }

    public function reject()
    {
        $this->update(['status' => 'Rejected']);
    }

    public function softDelete()
    {
        $this->update(['deleted_date' => now()]);
    }
}
