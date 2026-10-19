<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PageController;
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
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/my-biodata/create', [BiodataController::class, 'create'])->name('my-biodata.create');
    Route::post('/my-biodata', [BiodataController::class, 'store'])->name('my-biodata.store');
    Route::get('/my-biodata/{biodata}/edit', [BiodataController::class, 'edit'])->whereNumber('biodata')->name('my-biodata.edit');
    Route::put('/my-biodata/{biodata}', [BiodataController::class, 'update'])->whereNumber('biodata')->name('my-biodata.update');
    Route::delete('/my-biodata/{biodata}', [BiodataController::class, 'destroy'])->whereNumber('biodata')->name('my-biodata.destroy');
});

Route::post('/language', [LanguageController::class, 'update'])->name('language.update');
