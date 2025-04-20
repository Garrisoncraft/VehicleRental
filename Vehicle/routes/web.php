<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/signup', [AuthController::class, 'signup_function'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');
    Route::get('/login', [AuthController::class, 'login_function'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Public Routes
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::post('/contact-submit', [PageController::class, 'contactSubmit'])->name('contact.submit');

// Vehicle Management Routes (accessible to all users)
Route::get('/vehicles/search', [VehicleController::class, 'search'])->name('vehicles.search');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/home_page', [AuthController::class, 'home_page'])->name('home_page');
    Route::get('/logout', [AuthController::class, 'logout_page'])->name('logout');
    
    Route::resource('vehicles', VehicleController::class);
    Route::get('/vehicle-image/{filename}', [VehicleController::class, 'getImage'])->name('vehicle.image');

    // Admin Dashboard Route
    Route::middleware('can:isAdmin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });
});

// Redirect root to home page if authenticated, or login if not
Route::get('/', function () {
    return Auth::check() ? redirect()->route('home_page') : redirect()->route('login');
});


