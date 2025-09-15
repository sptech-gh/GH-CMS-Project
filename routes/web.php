<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\{
    DashboardController,
    ChurchController,
    MemberController,
    EventController,
    ProfileController,
    DonationController,
    Auth\RegisteredUserController,
    Auth\AdminRegisterController
};
use App\Http\Middleware\SetCurrentChurch;
use App\Http\Middleware\RedirectMemberToChurch;

// ---------------------------------------------------------
// Public homepage
// ---------------------------------------------------------
Route::get('/', function () {
    if (!auth()->check()) {
        return view('welcome');
    }

    $user = auth()->user();

    if ($user->role === 'member') {
        $memberChurch = $user->church;
        if ($memberChurch) {
            session(['current_church_id' => $memberChurch->id]);
            return redirect()->route('dashboard');
        }

        return view('auth.select-church', [
            'churches' => collect(),
            'message' => '🚫 You are not assigned to any church. Please contact your church admin.'
        ]);
    }

    if (!session()->has('current_church_id')) {
        return redirect()->route('select-church');
    }

    return redirect()->route('dashboard');
})->name('home');

// ---------------------------------------------------------
// Authentication routes (login, password reset, etc.)
// ---------------------------------------------------------
require __DIR__ . '/auth.php';

// ---------------------------------------------------------
// Registration routes
// ---------------------------------------------------------
Route::middleware('guest')->group(function () {
    // Default member registration
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    // Admin registration
    Route::get('/admin/register', [AdminRegisterController::class, 'create'])->name('admin.register');
    Route::post('/admin/register', [AdminRegisterController::class, 'store'])->name('admin.register.store');
});

// ---------------------------------------------------------
// Authenticated routes
// ---------------------------------------------------------
Route::middleware(['auth'])->group(function () {

    // Church selection
    Route::get('/select-church', [ChurchController::class, 'select'])->name('select-church');
    Route::post('/select-church', [ChurchController::class, 'setActive'])->name('select-church.post');

    // Dashboard (always exists, never 404s)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware([SetCurrentChurch::class, RedirectMemberToChurch::class]);

    // -----------------------------------------------------
    // Church-specific resources
    // -----------------------------------------------------
    Route::middleware([SetCurrentChurch::class])->group(function () {
        Route::resource('members', MemberController::class);
        Route::resource('events', EventController::class);
        Route::resource('donations', DonationController::class)
            ->only(['index', 'create', 'store', 'show', 'destroy']);
    });

    // -----------------------------------------------------
    // Profile
    // -----------------------------------------------------
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // -----------------------------------------------------
    // Churches (Admins/Pastors only)
    // -----------------------------------------------------
    Route::middleware(['admin.pastor'])->group(function () {
        Route::get('/churches/create', [ChurchController::class, 'create'])->name('churches.create');
        Route::post('/churches', [ChurchController::class, 'storeNew'])->name('churches.store');
        Route::get('/churches', [ChurchController::class, 'index'])->name('churches.index');

        // Invite link generator
        Route::get('/churches/{church:slug}/invite', [ChurchController::class, 'inviteLink'])
            ->name('churches.invite');
    });
});
=======
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
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
