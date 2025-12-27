<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Extracurricular extends Model
{
    use HasFactory;

    protected $table = 'extracurricular';

    protected $fillable = [
        'program_name',
        'description',
        'member_count',
    ];

    protected function casts(): array
    {
        return [
            'member_count' => 'integer',
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

    // Helper Methods
    public function incrementMembers($count = 1)
    {
        $this->increment('member_count', $count);
    }

    public function decrementMembers($count = 1)
    {
        $this->decrement('member_count', $count);
    }

    public function softDelete()
    {
        $this->update(['deleted_date' => now()]);
    }
}
