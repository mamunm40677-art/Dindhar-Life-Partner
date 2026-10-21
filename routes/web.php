<?php

use App\Http\Controllers\Admin\BiodataController as AdminBiodataController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MutualMatchController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SettingsController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/guide', [PageController::class, 'guide'])->name('guide');
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');
Route::get('/biodatas', [BiodataController::class, 'index'])->name('biodatas.index');
Route::get('/biodatas/{biodata}', [BiodataController::class, 'show'])->whereNumber('biodata')->name('biodatas.show');

Route::get('/register', [AuthController::class, 'registerForm'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest')->name('register.store');
Route::get('/login', [AuthController::class, 'loginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware(['guest', 'throttle:5,1'])->name('login.store');
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->middleware('guest')->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->middleware('guest')->name('google.callback');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/mutual-matches', [MutualMatchController::class, 'index'])->name('mutual-matches');
    Route::get('/preference-matches', [MutualMatchController::class, 'preferenceMatches'])->name('preference-matches');
    Route::get('/online-users', [MutualMatchController::class, 'onlineUsers'])->name('online-users');
    Route::get('/unlocked-contacts', [MutualMatchController::class, 'contactInfo'])->name('unlocked-contacts');
    Route::get('/my-biodata/create', [BiodataController::class, 'create'])->name('my-biodata.create');
    Route::post('/my-biodata', [BiodataController::class, 'store'])->name('my-biodata.store');
    Route::get('/my-biodata/{biodata}/edit', [BiodataController::class, 'edit'])->whereNumber('biodata')->name('my-biodata.edit');
    Route::put('/my-biodata/{biodata}', [BiodataController::class, 'update'])->whereNumber('biodata')->name('my-biodata.update');
    Route::delete('/my-biodata/{biodata}', [BiodataController::class, 'destroy'])->whereNumber('biodata')->name('my-biodata.destroy');

    // Settings Routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
    Route::post('/settings/biodata/delete', [SettingsController::class, 'deleteBiodata'])->name('settings.biodata.delete');
});

// Admin Panel Routes
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Users management
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('users.toggle-admin');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Biodatas management
    Route::get('/biodatas', [AdminBiodataController::class, 'index'])->name('biodatas.index');
    Route::post('/biodatas/{biodata}/toggle-publish', [AdminBiodataController::class, 'togglePublish'])->name('biodatas.toggle-publish');
    Route::delete('/biodatas/{biodata}', [AdminBiodataController::class, 'destroy'])->name('biodatas.destroy');

    // Messages management
    Route::get('/messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
    Route::delete('/messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');
});

Route::post('/language', [LanguageController::class, 'update'])->name('language.update');
