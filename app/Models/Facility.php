<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facility extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'caption',
        'detail',
        'image_path',
        'delete_date',
    ];

    protected function casts(): array
    {
        return [
            'delete_date' => 'datetime',
        ];
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereNull('delete_date');
    }

    // Accessors - Map old names to new columns for backwards compatibility
    public function getFacilityNameAttribute()
    {
        return $this->caption;
    }

    public function getDescriptionAttribute()
    {
        return $this->detail;
    }

    public function getImageAttribute()
    {
        return $this->image_path;
    }

    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('storage/facilities/' . $this->image_path) : null;
    }

    // Helper Methods
    public function softDelete()
    {
        $this->update(['delete_date' => now()->format('Y-m-d H:i:s')]);
    }
}
