<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Admission extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'gender',
        'email',
        'phone',
        'address',
        'grade_level',
        'previous_school',
        'guardian_name',
        'guardian_relationship',
        'guardian_contact',
        'status',
        'documents',
        'notes',
        'birth_certificate_path',
        'report_card_path',
        'photo_path',
        'submission_date',
        'deleted_date',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'submission_date' => 'datetime',
            'documents' => 'array',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_date' => 'datetime',
        ];
    }

    // Relationships
    public function statusHistory()
    {
        return $this->hasMany(AdmissionStatusHistory::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'Pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'Approved');
    }

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_date');
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }

    public function getAgeAttribute()
    {
        return $this->date_of_birth ? Carbon::parse($this->date_of_birth)->age : null;
    }

    // Helper Methods
    public function updateStatus($newStatus, $notes = null, $userId = null)
    {
        $oldStatus = $this->status;

        $this->update([
            'status' => $newStatus,
            'notes' => $notes ?? $this->notes,
        ]);

        AdmissionStatusHistory::create([
            'admission_id' => $this->id,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'notes' => $notes,
            'user_id' => $userId, // FIXED: Changed from 'changed_by' to 'user_id'
            // FIXED: Removed 'created_at' - let Laravel handle it automatically
        ]);

        // Send email notification if email is provided and status changed
        if ($this->email && $oldStatus !== $newStatus) {
            try {
                \Mail::to($this->email)->send(new \App\Mail\AdmissionStatusUpdated($this, $oldStatus));
            } catch (\Exception $e) {
                \Log::error('Failed to send admission status email: ' . $e->getMessage());
            }
        }

        return $this;
    }

    public function softDelete()
    {
        $this->update(['deleted_date' => now()]);
    }
}
