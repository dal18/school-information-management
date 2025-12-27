<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\VerificationCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationCodeController extends Controller
{
    /**
     * Display the email verification code input form.
     */
    public function show(): View
    {
        return view('auth.verify-code');
    }

    /**
     * Handle the verification code submission.
     */
    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        $user = $request->user();

        // Check if user is already verified
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('dashboard')
                ->with('status', 'Your email is already verified!');
        }

        // Verify the code
        $isValid = VerificationCode::verify(
            $user->email,
            $request->code,
            'email_verification'
        );

        if (!$isValid) {
            return back()->withErrors([
                'code' => 'Invalid or expired verification code. Please try again or request a new code.',
            ]);
        }

        // Mark email as verified
        $user->markEmailAsVerified();
        $user->update(['email_verified' => true]);

        return redirect()->route('dashboard')
            ->with('status', 'Email verified successfully! Welcome to SIMS.');
    }

    /**
     * Resend the verification code.
     */
    public function resend(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        // Generate and send new code
        VerificationCode::createAndSend($user->email, 'email_verification');

        return back()->with('status', 'A new verification code has been sent to your email!');
    }
}
