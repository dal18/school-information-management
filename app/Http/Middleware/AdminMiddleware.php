<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized access - Please login');
        }

        $user = auth()->user();

        // Allow Admin and Teacher to access admin panel
        if (!in_array($user->access_rights, ['Admin', 'Teacher'])) {
            abort(403, 'Unauthorized access - Admin or Teacher role required');
        }

        return $next($request);
    }
}
