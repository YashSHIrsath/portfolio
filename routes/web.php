<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    $experiences = \App\Models\Experience::where('is_active', true)->orderBy('sort_order')->orderBy('created_at', 'desc')->get();
    $stats = \App\Models\KeyValue::where('is_active', true)->where('type', 'stat')->orderBy('sort_order')->get();
    $techStacks = \App\Models\TechStack::where('active', true)->orderBy('sort_order')->get();
    $contactInfos = \App\Models\ContactInfo::where('active', true)->orderBy('sort_order')->get();
    
    return view('home', compact('experiences', 'stats', 'techStacks', 'contactInfos'));
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('projects');

Route::get('/experience', function () {
    $experiences = \App\Models\Experience::where('is_active', true)->orderBy('sort_order')->orderBy('created_at', 'desc')->get();
    return view('experience', compact('experiences'));
})->name('experience');

Route::get('/experience/{experience}', [\App\Http\Controllers\ExperienceController::class, 'show'])->name('experience.show');
Route::view('/experience-prototype', 'experience_prototype')->name('experience.prototype');

Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

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
    Route::get('/settings/about', [App\Http\Controllers\Admin\SettingController::class, 'editAbout'])->name('settings.about');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    // Social Links
    Route::resource('social-links', App\Http\Controllers\Admin\SocialLinkController::class);

    // Typing Texts
    Route::resource('typing-texts', App\Http\Controllers\Admin\TypingTextController::class);

    // Contact Info
    Route::resource('contact-infos', App\Http\Controllers\Admin\ContactInfoController::class);

    // Tech Stacks
    Route::resource('tech-stacks', App\Http\Controllers\Admin\TechStackController::class);

    // Experiences
    Route::resource('experiences', App\Http\Controllers\Admin\ExperienceController::class);

    // Key Values (Stats)
    Route::resource('key-values', App\Http\Controllers\Admin\KeyValueController::class);

    // Bios
    Route::resource('bios', App\Http\Controllers\Admin\BioController::class);

    // Cat Stacks (JSON Section)
    Route::resource('cat-stacks', App\Http\Controllers\Admin\CatStackController::class);


    // Projects
    Route::resource('projects', App\Http\Controllers\Admin\ProjectController::class);

    // Contact Settings
    Route::get('/contact-settings', [App\Http\Controllers\Admin\ContactSettingController::class, 'edit'])->name('contact-settings.edit');
    Route::put('/contact-settings', [App\Http\Controllers\Admin\ContactSettingController::class, 'update'])->name('contact-settings.update');

    // Contact Submissions
    Route::resource('contact-submissions', App\Http\Controllers\Admin\ContactSubmissionController::class);

    // GitHub Settings
    Route::get('/github-settings', [App\Http\Controllers\Admin\GitHubSettingController::class, 'edit'])->name('github-settings.edit');
    Route::put('/github-settings', [App\Http\Controllers\Admin\GitHubSettingController::class, 'update'])->name('github-settings.update');
});