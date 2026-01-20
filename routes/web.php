<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseApplicationController;
use App\Http\Controllers\AdminController;

// Главная страница
Route::get('/', function () {
    return view('welcome');
});

// Маршруты аутентификации
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

// Защищенные маршруты для пользователей
Route::middleware('auth')->group(function () {
    Route::resource('applications', CourseApplicationController::class);
    Route::post('/applications/{application}/review', [CourseApplicationController::class, 'updateReview'])->name('applications.review');
});

// Маршруты для администратора
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminController::class, 'login'])->name('authenticate');
    });

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/applications/{application}/status', [AdminController::class, 'updateStatus'])->name('applications.status');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});
