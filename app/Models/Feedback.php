<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    // Disable timestamps since table uses date_entry instead
    public $timestamps = false;

    protected $fillable = [
        'about',
        'Concern',
        'date_entry',
        'feedback_by',
        'accepted_by',
        'status',
        'reply',
        'reply_by',
        'reply_date',
        'deleted_date',
        'delete_date',
        'email',
    ];

    protected function casts(): array
    {
        return [
            'date_entry' => 'datetime',
            'deleted_date' => 'datetime',
            'delete_date' => 'datetime',
            'reply_date' => 'datetime',
        ];
    }

    // Relationships
    public function repliedBy()
    {
        return $this->belongsTo(User::class, 'reply_by');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_date')->whereNull('delete_date');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('Concern', $type);
    }

    public function scopeComplaints($query)
    {
        return $query->where('Concern', 'Complaint');
    }

    public function scopeSuggestions($query)
    {
        return $query->where('Concern', 'Suggestion');
    }

    public function scopeCompliments($query)
    {
        return $query->where('Concern', 'Compliment');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'New');
    }

    public function scopeReplied($query)
    {
        return $query->whereNotNull('reply');
    }

    public function scopeUnreplied($query)
    {
        return $query->whereNull('reply');
    }

    // Helper Methods
    public function softDelete()
    {
        $this->update(['deleted_date' => now()]);
    }

    // Accessor for name (maps to feedback_by)
    public function getNameAttribute()
    {
        return $this->feedback_by;
    }

    // Accessor for type (maps to Concern)
    public function getTypeAttribute()
    {
        return $this->Concern;
    }

    // Accessor for message (maps to about)
    public function getMessageAttribute()
    {
        return $this->about;
    }

    // Accessor for created_at (maps to date_entry)
    public function getCreatedAtAttribute()
    {
        return $this->date_entry;
    }

    // Accessor for email (doesn't exist in table)
    public function getEmailAttribute()
    {
        return null; // Table doesn't have email column
    }
}
