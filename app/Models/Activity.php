<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'caption',
        'category',
        'post_type',
        'link_image',
        'youtube_url',
        'facebook_url',
        'date_uploaded',
        'uploaded_by',
        'delete_date',
    ];

    protected function casts(): array
    {
        return [
            'date_uploaded' => 'datetime',
            'delete_date' => 'datetime',
        ];
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereNull('delete_date');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('date_uploaded', '>=', now()->toDateString())
                     ->orderBy('date_uploaded', 'asc');
    }

    // Accessors - Map old names to new columns for backwards compatibility
    public function getActivityNameAttribute()
    {
        return $this->caption;
    }

    public function getDescriptionAttribute()
    {
        return $this->caption;
    }

    public function getActivityDateAttribute()
    {
        return $this->date_uploaded;
    }

    public function getImageAttribute()
    {
        return $this->link_image;
    }

    // Helper Methods
    public function softDelete()
    {
        $this->update(['delete_date' => now()->format('Y-m-d H:i:s')]);
    }

    /**
     * Get YouTube embed code from URL
     */
    public function getYoutubeEmbedUrl()
    {
        if (!$this->youtube_url) {
            return null;
        }

        // Extract video ID from various YouTube URL formats
        $patterns = [
            '/youtube\.com\/watch\?v=([^&]+)/',
            '/youtube\.com\/embed\/([^?]+)/',
            '/youtu\.be\/([^?]+)/',
            '/youtube\.com\/v\/([^?]+)/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $this->youtube_url, $matches)) {
                return 'https://www.youtube.com/embed/' . $matches[1];
            }
        }

        return null;
    }

    /**
     * Get Facebook embed code from URL
     */
    public function getFacebookEmbedUrl()
    {
        if (!$this->facebook_url) {
            return null;
        }

        $url = $this->facebook_url;

        // If it's an iframe code, extract the src URL
        if (strpos($url, '<iframe') !== false && strpos($url, 'src=') !== false) {
            // Extract src URL from iframe code
            preg_match('/src=["\']([^"\']+)["\']/', $url, $matches);
            if (isset($matches[1])) {
                $url = $matches[1];
            }
        }

        // If it's already an embed URL (contains facebook.com/plugins), return as is
        if (strpos($url, 'facebook.com/plugins') !== false) {
            return $url;
        }

        // Otherwise, convert regular post URL to embed format
        return 'https://www.facebook.com/plugins/post.php?href=' . urlencode($url) . '&width=500&show_text=true';
    }
}
