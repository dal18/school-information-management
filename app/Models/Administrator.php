<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Administrator extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'category',
        'email',
        'phone',
        'bio',
        'image',
        'display_order',
        'deleted_date',
    ];

    protected function casts(): array
    {
        return [
            'display_order' => 'integer',
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

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order', 'asc');
    }

    // Helper Methods
    public function moveUp()
    {
        $this->decrement('display_order');
    }

    public function moveDown()
    {
        $this->increment('display_order');
    }

    public function softDelete()
    {
        $this->update(['deleted_date' => now()]);
    }
}
