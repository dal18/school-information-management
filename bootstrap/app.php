<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'student' => \App\Http\Middleware\StudentMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Custom exception handling

        // Handle 404 Not Found
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Resource not found'], 404);
            }

            return response()->view('errors.404', [], 404);
        });

        // Handle 403 Forbidden
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Access denied'], 403);
            }

            return response()->view('errors.403', ['message' => $e->getMessage()], 403);
        });

        // Handle 500 Server Errors
        $exceptions->render(function (\Throwable $e, $request) {
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                return null; // Let other handlers process HTTP exceptions
            }

            // Log the error
            \Log::error('Server Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'url' => $request->fullUrl(),
                'user' => auth()->id(),
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'error' => app()->environment('production')
                        ? 'An error occurred. Please try again.'
                        : $e->getMessage()
                ], 500);
            }

            if (app()->environment('production')) {
                return response()->view('errors.500', [], 500);
            }

            return null; // Show default error page in development
        });

        // Handle Database Errors
        $exceptions->render(function (\Illuminate\Database\QueryException $e, $request) {
            \Log::error('Database Error: ' . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json(['error' => 'Database error occurred'], 500);
            }

            return back()->with('error', 'A database error occurred. Please try again.');
        });

        // Handle Model Not Found
        $exceptions->render(function (\Illuminate\Database\Eloquent\ModelNotFoundException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Record not found'], 404);
            }

            return redirect()->route('dashboard')->with('error', 'The requested record was not found.');
        });
    })->create();
