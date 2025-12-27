<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TempUser extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'full_name',
        'user_name',
        'email',
        'password',
        'verification_code',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    // Check if verification code is still valid (30 minutes)
    public function isVerificationCodeValid()
    {
        return $this->created_at->diffInMinutes(Carbon::now()) <= 30;
    }

    // Verify the code
    public function verifyCode($code)
    {
        return $this->verification_code === $code && $this->isVerificationCodeValid();
    }
}
