<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class VerificationCode extends Model
{
    protected $fillable = [
        'email',
        'code',
        'type',
        'expires_at',
        'verified_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    /**
     * Generate a random 6-digit verification code
     */
    public static function generateCode(): string
    {
        return str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Create and send a verification code
     */
    public static function createAndSend(string $email, string $type): self
    {
        // Delete any existing codes for this email and type
        self::where('email', $email)
            ->where('type', $type)
            ->delete();

        // Generate new code
        $code = self::generateCode();

        // Create verification code record
        $verificationCode = self::create([
            'email' => $email,
            'code' => $code,
            'type' => $type,
            'expires_at' => now()->addMinutes(15), // Code expires in 15 minutes
        ]);

        // Send email with code
        $verificationCode->sendEmail();

        return $verificationCode;
    }

    /**
     * Send the verification code via email
     */
    public function sendEmail(): void
    {
        $subject = $this->type === 'email_verification'
            ? 'Email Verification Code'
            : 'Password Reset Code';

        $message = $this->type === 'email_verification'
            ? "Your email verification code is: {$this->code}\n\nThis code will expire in 15 minutes.\n\nIf you didn't request this code, please ignore this email."
            : "Your password reset code is: {$this->code}\n\nThis code will expire in 15 minutes.\n\nIf you didn't request this code, please ignore this email and your password will remain unchanged.";

        Mail::raw($message, function ($mail) use ($subject) {
            $mail->to($this->email)
                ->subject($subject . ' - SIMS');
        });
    }

    /**
     * Verify a code
     */
    public static function verify(string $email, string $code, string $type): bool
    {
        $verificationCode = self::where('email', $email)
            ->where('code', $code)
            ->where('type', $type)
            ->whereNull('verified_at')
            ->where('expires_at', '>', now())
            ->first();

        if (!$verificationCode) {
            return false;
        }

        // Mark as verified
        $verificationCode->update(['verified_at' => now()]);

        return true;
    }

    /**
     * Check if code is valid (not expired and not used)
     */
    public function isValid(): bool
    {
        return $this->verified_at === null && $this->expires_at->isFuture();
    }

    /**
     * Get remaining time until expiration
     */
    public function getRemainingTime(): string
    {
        if ($this->expires_at->isPast()) {
            return 'Expired';
        }

        $minutes = now()->diffInMinutes($this->expires_at);
        return $minutes . ' minute' . ($minutes !== 1 ? 's' : '');
    }
}
