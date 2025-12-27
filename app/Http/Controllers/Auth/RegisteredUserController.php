<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            // Use database transaction to ensure all operations succeed or none do
            $user = DB::transaction(function () use ($request) {
                // Split name into first and last name
                $nameParts = explode(' ', trim($request->name), 2);
                $firstName = $nameParts[0];
                $lastName = isset($nameParts[1]) ? $nameParts[1] : $nameParts[0];

                // Generate username from email
                $userName = explode('@', $request->email)[0];

                // Ensure username is unique
                $baseUserName = $userName;
                $counter = 1;
                while (User::where('user_name', $userName)->exists()) {
                    $userName = $baseUserName . $counter;
                    $counter++;
                }

                $user = User::create([
                    'user_name' => $userName,
                    'first_name' => $firstName,
                    'middle_name' => '',
                    'last_name' => $lastName,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'access_rights' => 'Student',
                    'is_active' => true,
                    'email_verified' => false,
                ]);

                return $user;
            });

            // Send verification code AFTER transaction completes
            // This way, if email fails, registration still succeeds
            try {
                VerificationCode::createAndSend($user->email, 'email_verification');
                $successMessage = 'Registration successful! We sent a 6-digit verification code to your email.';
            } catch (\Exception $emailError) {
                // Log email error but don't fail registration
                Log::warning('Verification email failed to send: ' . $emailError->getMessage(), [
                    'email' => $user->email
                ]);
                $successMessage = 'Registration successful! However, we could not send the verification email. You can request a new code later.';
            }

            // Log the user in after successful registration
            Auth::login($user);

            // Redirect to code input page
            return redirect()->route('verification.code')
                ->with('status', $successMessage);

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Registration failed: ' . $e->getMessage(), [
                'email' => $request->email ?? 'N/A',
                'trace' => $e->getTraceAsString()
            ]);

            // Redirect back with error message
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['registration' => 'Registration failed: ' . $e->getMessage()]);
        }
    }
}
