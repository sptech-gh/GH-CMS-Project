<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DonationController;

// --------------------
// Landing Page / Home
// --------------------
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : view('welcome');
})->name('home');

// --------------------
// Protected Routes
// --------------------
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // --------------------
    // Global Resources
    // --------------------
    Route::resources([
        'events'    => EventController::class,
        'members'   => MemberController::class,
        'donations' => DonationController::class,
    ]);

    // Alias for donations (optional, for UI)
    Route::get('/donations-all', [DonationController::class, 'index'])
        ->name('donations.all');

    // --------------------
    // Church-specific Resources
    // --------------------
    Route::prefix('churches/{church}')->name('churches.')->group(function () {
        Route::resources([
            'events'    => EventController::class,
            'members'   => MemberController::class,
            'donations' => DonationController::class,
        ]);
    });
});

// --------------------
// Auth Routes
// --------------------
require __DIR__.'/auth.php';
