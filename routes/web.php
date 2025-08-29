<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChurchController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ Landing page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ✅ Dashboard (requires auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ✅ Churches resource routes (use slug instead of id)
    Route::resource('churches', ChurchController::class)
        ->parameters(['churches' => 'church:slug']);

    // ✅ Members resource routes (still uses id unless you switch to slugs)
    Route::resource('members', MemberController::class);

    // ✅ Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Auth routes (Laravel Breeze / Jetstream / Fortify)
require __DIR__.'/auth.php';
