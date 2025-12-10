<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/projects', function () {
    return view('projects');
})->name('projects');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Admin authentication routes (no middleware)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// Admin protected routes (with IsAdmin middleware)
Route::prefix('admin')->name('admin.')->middleware([IsAdmin::class])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    // Social Links
    Route::resource('social-links', App\Http\Controllers\Admin\SocialLinkController::class);

    // Typing Texts
    Route::resource('typing-texts', App\Http\Controllers\Admin\TypingTextController::class);

    // Contact Info
    Route::resource('contact-infos', App\Http\Controllers\Admin\ContactInfoController::class);

    // Tech Stacks
    Route::resource('tech-stacks', App\Http\Controllers\Admin\TechStackController::class);
});