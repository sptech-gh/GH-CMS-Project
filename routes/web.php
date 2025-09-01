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
    // Redirect authenticated users to dashboard
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome'); // Blade view for landing page
})->name('home');

// --------------------
// Dashboard
// --------------------
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// --------------------
// Global Events (not tied to any church)
// --------------------
Route::resource('events', EventController::class)
    ->middleware(['auth']); // protect routes if needed

// --------------------
// Church-specific Events
// --------------------
Route::prefix('churches/{church}')->middleware(['auth'])->group(function () {
    Route::resource('events', EventController::class)->names('churches.events');
});

// --------------------
// Members (Global + Church-specific)
// --------------------

// ✅ Global members (general, not tied to a single church)
Route::resource('members', MemberController::class)->middleware(['auth']);

// ✅ Church-specific members
Route::prefix('churches/{church}')->middleware(['auth'])->group(function () {
    Route::resource('members', MemberController::class)->names('churches.members');
});

// --------------------
// Donations (Global + Church-specific)
// --------------------

// ✅ Global donations
Route::resource('donations', DonationController::class)->middleware(['auth']);

// ✅ Alias for dashboard usage (so route('donations.all') works)
Route::get('/donations-all', [DonationController::class, 'index'])
    ->middleware(['auth'])
    ->name('donations.all');

// ✅ Church-specific donations
Route::prefix('churches/{church}')->middleware(['auth'])->group(function () {
    Route::resource('donations', DonationController::class)->names('churches.donations');
});

// --------------------
// Auth routes
// --------------------
require __DIR__.'/auth.php';
