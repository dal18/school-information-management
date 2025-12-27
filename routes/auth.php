<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationCodeController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\PasswordResetCodeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Password Reset with Code (New System)
    Route::get('forgot-password-code', [PasswordResetCodeController::class, 'requestForm'])
        ->name('password.code.request');

    Route::post('forgot-password-code', [PasswordResetCodeController::class, 'sendCode'])
        ->name('password.code.send');

    Route::get('reset-password-code', [PasswordResetCodeController::class, 'verifyForm'])
        ->name('password.code.verify');

    Route::post('reset-password-code', [PasswordResetCodeController::class, 'reset'])
        ->name('password.code.reset');

    Route::post('reset-password-code/resend', [PasswordResetCodeController::class, 'resendCode'])
        ->middleware('throttle:3,1')
        ->name('password.code.resend');

    // Old Link-based Password Reset (Keep for backwards compatibility)
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    // Verification Code Routes (New System)
    Route::get('verify-code', [EmailVerificationCodeController::class, 'show'])
        ->name('verification.code');

    Route::post('verify-code', [EmailVerificationCodeController::class, 'verify'])
        ->middleware('throttle:6,1')
        ->name('verification.verify');

    Route::post('verify-code/resend', [EmailVerificationCodeController::class, 'resend'])
        ->middleware('throttle:3,1')
        ->name('verification.resend');

    // Old Link-based Verification (Keep for backwards compatibility)
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify.link');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
