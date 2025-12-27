<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_name',
        'first_name',
        'midle_name',
        'middle_name',
        'last_name',
        'full_name',
        'email',
        'phone_number',
        'password',
        'access_rights',
        'profile_image',
        'profile_picture',
        'is_active',
        'email_verified',
        'deleted_date',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'email_verified' => 'boolean',
            'is_active' => 'boolean',
            'password' => 'hashed',
            'deleted_date' => 'datetime',
        ];
    }

    // Relationships
    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'posted_by');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'teacher_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class)->orderBy('created_at', 'desc');
    }

    public function unreadNotifications()
    {
        return $this->hasMany(Notification::class)->where('is_read', false)->orderBy('created_at', 'desc');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_date');
    }

    public function scopeAdmins($query)
    {
        return $query->where('access_rights', 'Admin');
    }

    public function scopeStudents($query)
    {
        return $query->where('access_rights', 'Student');
    }

    public function scopeTutors($query)
    {
        return $query->where('access_rights', 'Tutor');
    }

    public function scopeTeachers($query)
    {
        return $query->where('access_rights', 'Teacher');
    }

    // Accessors
    public function getFullNameAttribute()
    {
        $middleName = $this->middle_name ?? '';
        return trim("{$this->first_name} {$middleName} {$this->last_name}");
    }

    public function getNameAttribute()
    {
        return $this->full_name ?: $this->getFullNameAttribute();
    }

    // Helper Methods
    public function isAdmin()
    {
        return $this->access_rights === 'Admin';
    }

    public function isStudent()
    {
        return $this->access_rights === 'Student';
    }

    public function isTutor()
    {
        return $this->access_rights === 'Tutor';
    }

    public function isTeacher()
    {
        return $this->access_rights === 'Teacher';
    }

    public function isAdminOrTeacher()
    {
        return in_array($this->access_rights, ['Admin', 'Teacher']);
    }

    public function softDelete()
    {
        $this->update(['deleted_date' => now()]);
    }

    public function restore()
    {
        $this->update(['deleted_date' => null]);
    }
}