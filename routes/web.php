<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\StimulationController;
use App\Http\Controllers\TrackerController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\DoctorManagementController;

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\FacebookAuthController;

use App\Http\Controllers\Auth\OtpAuthController;

// =======================
// HOME / LANDING
// =======================
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        // Parent/Doctor
        return view('welcome');
    }
    return view('home');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Test admin route
Route::get('/test-admin', function () {
    return view('test-admin');
})->middleware('auth');

// =======================
// AUTH (EMAIL/PASSWORD)
// =======================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =======================
// WHATSAPP OTP (HANYA UNTUK USER / ORANG TUA)
// HARUS guest (sebelum login)
// =======================
Route::middleware('guest')->group(function () {
    Route::get('/otp', [OtpAuthController::class, 'showRequestForm'])
        ->name('otp.request.form');

    Route::post('/otp', [OtpAuthController::class, 'requestOtp'])
        ->name('otp.request');

    Route::get('/otp/verify', [OtpAuthController::class, 'showVerifyForm'])
        ->name('otp.verify.form');

    Route::post('/otp/verify', [OtpAuthController::class, 'verifyOtp'])
        ->name('otp.verify');
});

// =======================
// OAUTH
// =======================
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::get('/auth/facebook', [FacebookAuthController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [FacebookAuthController::class, 'handleFacebookCallback'])->name('auth.facebook.callback');

// =======================
// PUBLIC CONTENT
// =======================
// Artikel
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/articles/{id}/like', [ArticleController::class, 'like'])
    ->middleware('auth')
    ->name('articles.like');

// Resep
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/{slug}', [RecipeController::class, 'show'])->name('recipes.show');
Route::post('/recipes/{id}/like', [RecipeController::class, 'like'])
    ->middleware('auth')
    ->name('recipes.like');

// Stimulasi
Route::get('/stimulations', [StimulationController::class, 'index'])->name('stimulations.index');
Route::get('/stimulations/{slug}', [StimulationController::class, 'show'])->name('stimulations.show');
Route::post('/stimulations/{id}/like', [StimulationController::class, 'like'])
    ->middleware('auth')
    ->name('stimulations.like');

// Milestones (Public)
Route::get('/milestones', [MilestoneController::class, 'index'])->name('milestones.index');
Route::get('/milestones/{slug}', [MilestoneController::class, 'show'])->name('milestones.show');

// Forum Diskusi (Public)
Route::get('/discussions', [DiscussionController::class, 'index'])->name('discussions.index');
Route::get('/discussions/{slug}', [DiscussionController::class, 'show'])->name('discussions.show');
Route::post('/discussions/{id}/like', [DiscussionController::class, 'like'])->name('discussions.like');
Route::post('/discussions/replies/{id}/like', [DiscussionController::class, 'likeReply'])->name('discussions.reply.like');

// =======================
// AUTH REQUIRED (SEMUA ROLE YANG LOGIN)
// =======================
Route::middleware('auth')->group(function () {

    // Tracker (perlu login)
    Route::get('/tracker', [TrackerController::class, 'index'])->name('tracker.index');
    Route::get('/tracker/{milestone}', [TrackerController::class, 'show'])->name('tracker.show');
    Route::post('/tracker/{milestone}/toggle', [TrackerController::class, 'toggleProgress'])->name('tracker.toggle');
    Route::post('/tracker/{milestone}/notes', [TrackerController::class, 'updateNotes'])->name('tracker.notes');

    // Diskusi yang perlu login
    Route::get('/discussions/create', [DiscussionController::class, 'create'])->name('discussions.create');
    Route::post('/discussions', [DiscussionController::class, 'store'])->name('discussions.store');
    Route::post('/discussions/{id}/reply', [DiscussionController::class, 'reply'])->name('discussions.reply');
    Route::post('/discussions/{id}/close', [DiscussionController::class, 'close'])->name('discussions.close');
    Route::delete('/discussions/{id}', [DiscussionController::class, 'destroy'])->name('discussions.destroy');
    Route::delete('/discussions/replies/{id}', [DiscussionController::class, 'destroyReply'])->name('discussions.reply.destroy');

    // Profile (user login, termasuk dokter/parent)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/doctor', [ProfileController::class, 'updateDoctorProfile'])->name('profile.doctor.update');

    Route::post('/profile/child', [ProfileController::class, 'addChild'])->name('profile.child.add');
    Route::put('/profile/child/{id}', [ProfileController::class, 'updateChild'])->name('profile.child.update');
    Route::delete('/profile/child/{id}', [ProfileController::class, 'deleteChild'])->name('profile.child.delete');
});

// =======================
// ADMIN ONLY
// =======================
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Artikel Admin
    Route::get('/articles/create/new', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    // Resep Admin
    Route::get('/recipes/create/new', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes/store', [RecipeController::class, 'store'])->name('recipes.store');
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');

    // Stimulasi Admin
    Route::get('/stimulations/create/new', [StimulationController::class, 'create'])->name('stimulations.create');
    Route::post('/stimulations/store', [StimulationController::class, 'store'])->name('stimulations.store');
    Route::get('/stimulations/{stimulation}/edit', [StimulationController::class, 'edit'])->name('stimulations.edit');
    Route::put('/stimulations/{stimulation}', [StimulationController::class, 'update'])->name('stimulations.update');
    Route::delete('/stimulations/{stimulation}', [StimulationController::class, 'destroy'])->name('stimulations.destroy');

    // Milestone Admin
    Route::get('/milestones/create/new', [MilestoneController::class, 'create'])->name('milestones.create');
    Route::post('/milestones/store', [MilestoneController::class, 'store'])->name('milestones.store');
    Route::get('/milestones/{milestone}/edit', [MilestoneController::class, 'edit'])->name('milestones.edit');
    Route::put('/milestones/{milestone}', [MilestoneController::class, 'update'])->name('milestones.update');
    Route::delete('/milestones/{milestone}', [MilestoneController::class, 'destroy'])->name('milestones.destroy');

    // Manajemen Dokter Admin
    Route::get('/admin/doctors', [DoctorManagementController::class, 'index'])->name('admin.doctors.index');
    Route::get('/admin/doctors/create', [DoctorManagementController::class, 'create'])->name('admin.doctors.create');
    Route::post('/admin/doctors', [DoctorManagementController::class, 'store'])->name('admin.doctors.store');
    Route::delete('/admin/doctors/{id}', [DoctorManagementController::class, 'destroy'])->name('admin.doctors.destroy');
    Route::post('/admin/doctors/{id}/reset-password', [DoctorManagementController::class, 'resetPassword'])->name('admin.doctors.reset-password');

    // Admin Tracker Monitoring
    Route::get('/admin/tracker/progress', [TrackerController::class, 'progress'])->name('admin.tracker.progress');
    Route::get('/admin/tracker/detail/{user}', [TrackerController::class, 'detail'])->name('admin.tracker.detail');
});

// =======================
// STATIC PAGES
// =======================
Route::view('/privacy-policy', 'privacy-policy')->name('privacy.policy');
Route::view('/delete-user-data', 'delete-user-data')->name('delete.user.data');
Route::view('/terms', 'terms')->name('terms');
