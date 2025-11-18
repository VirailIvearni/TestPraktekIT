<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function() {
    return redirect()->route('dashboard.index');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Protected Routes (Require Authentication)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    
    // Profile
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    
    // Students CRUD - EXCLUDE SHOW METHOD
    Route::resource('siswa', SiswaController::class)->except(['show']);
    
    // Export Route
    Route::get('/siswa/export', [SiswaController::class, 'export'])->name('siswa.export');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});