<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Redirect based on user role
        $user = auth()->user();

        // Redirect to appropriate dashboard based on access rights
        switch ($user->access_rights) {
            case 'Admin':
                return redirect()->intended(route('admin.dashboard'));

            case 'Teacher':
                // Teachers go to admin dashboard (they have management access)
                return redirect()->intended(route('admin.dashboard'));

            case 'Student':
                return redirect()->intended(route('student.dashboard'));

            case 'User':
            default:
                // Default users go to student dashboard
                return redirect()->intended(route('student.dashboard'));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
