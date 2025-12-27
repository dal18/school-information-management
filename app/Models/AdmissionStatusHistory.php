<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionStatusHistory extends Model
{
    public $timestamps = false;

    protected $table = 'admission_status_history';

    protected $fillable = [
        'admission_id',
        'old_status',
        'new_status',
        'notes',
        'changed_by',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    // Relationships
    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
