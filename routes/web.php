<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChurchController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', fn() => redirect()->route('churches.index'));
Route::resource('churches', ChurchController::class);
Route::get('/churches/{slug}', [ChurchController::class, 'show'])->name('church.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('churches', ChurchController::class)
     ->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
