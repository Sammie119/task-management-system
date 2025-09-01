<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

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
    Route::prefix('system_admin')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/users', 'index')->name('users');
            Route::post('/register', 'store')->name('register');
            Route::put('/register', 'update')->name('register');
            Route::post('/destroy_user', 'destroy')->name('destroy_user');
        });

        Route::controller(DropdownController::class)->group(function () {
            Route::get('/dropdowns', 'index')->name('dropdowns');
            Route::post('/dropdown_category', 'store')->name('dropdown_category');
            Route::put('/dropdown_category', 'update')->name('dropdown_category');
            Route::post('/destroy_category', 'destroy')->name('destroy_category');
            Route::post('/dropdowns', 'storeDropdowns')->name('dropdowns');
            Route::get('/destroy_dropdown', 'destroyDropdowns')->name('destroy_dropdown');
        });

        Route::controller(AreaController::class)->group(function () {
            Route::get('/areas', 'index')->name('areas');
            Route::post('/area', 'store')->name('area');
            Route::put('/area', 'update')->name('area');
            Route::post('/destroy_area', 'destroy')->name('destroy_area');
            Route::post('/districts', 'storeDistrict')->name('districts');
            Route::get('/destroy_district', 'destroyDistrict')->name('destroy_district');
        });
    });


    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    //Modal URL
    Route::get('/modal/{form}', function ($form) {
        return view($form);
    });

    Route::get('/modal/{form}/{data}', function ($form, $data) {
        $data = json_decode($data);
        return view($form, ['data' => $data]);
    });
});
