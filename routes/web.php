<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login'); // Force login as required
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google OAuth
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    
    // Common Dashboard - Redirects based on role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Student Routes
    Route::middleware(['role:student'])->group(function () {
        Route::get('/courses', [CourseController::class, 'index'])->name('courses.index'); // Catalog
        Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');
        Route::get('/courses/{slug}/checkout', [CourseController::class, 'checkout'])->name('courses.checkout');
        Route::post('/courses/{id}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
        Route::get('/courses/{course}/learn/{lesson?}', [\App\Http\Controllers\LessonController::class, 'show'])->name('courses.learn');
        Route::get('/my-learning', [CourseController::class, 'myLearning'])->name('my-learning');
    });

    // Instructor Routes
    Route::middleware(['role:instructor'])->prefix('instructor')->name('instructor.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'instructorDashboard'])->name('dashboard');
        Route::resource('courses', CourseController::class);
    });

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
        Route::get('/users', [DashboardController::class, 'users'])->name('users');
    });
});
