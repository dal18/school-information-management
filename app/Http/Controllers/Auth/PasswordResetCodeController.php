<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class PasswordResetCodeController extends Controller
{
    /**
     * Display the password reset request form.
     */
    public function requestForm(): View
    {
        return view('auth.forgot-password-code');
    }

    /**
     * Send password reset code via email.
     */
    public function sendCode(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'We could not find a user with that email address.',
            ]);
        }

        // Generate and send reset code
        VerificationCode::createAndSend($user->email, 'password_reset');

        return redirect()->route('password.code.verify')
            ->with('email', $request->email)
            ->with('status', 'We sent a 6-digit reset code to your email!');
    }

    /**
     * Display the password reset code verification form.
     */
    public function verifyForm(): View
    {
        return view('auth.reset-password-code');
    }

    /**
     * Verify the code and reset the password.
     */
    public function reset(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'code' => ['required', 'string', 'size:6'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Verify the code
        $isValid = VerificationCode::verify(
            $request->email,
            $request->code,
            'password_reset'
        );

        if (!$isValid) {
            return back()->withErrors([
                'code' => 'Invalid or expired reset code. Please request a new code.',
            ])->withInput($request->only('email'));
        }

        // Find user and update password
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'We could not find a user with that email address.',
            ]);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')
            ->with('status', 'Your password has been reset successfully! You can now login with your new password.');
    }

    /**
     * Resend the password reset code.
     */
    public function resendCode(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'We could not find a user with that email address.',
            ]);
        }

        // Generate and send new code
        VerificationCode::createAndSend($user->email, 'password_reset');

        return back()->with('status', 'A new reset code has been sent to your email!');
    }
}
