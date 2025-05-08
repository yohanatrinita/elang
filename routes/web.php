<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Models\Dashboard;

Route::get('/tes-alert', function () {
    session(['warning' => '🎉 Ini alert yang muncul terus-terusan sampai kamu hapus']);
    return redirect()->route('login.form');
});

//halaman dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Halaman depan (home, bisa diakses siapa saja)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Login & Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Semua rute ini hanya bisa diakses kalau sudah login
Route::middleware('auth')->group(function () {
    

    // Halaman arsip
    Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip');

    // Upload arsip
    Route::get('/upload-arsip', [ArsipController::class, 'create'])->name('arsip.create');
    Route::post('/upload-arsip', [ArsipController::class, 'store'])->name('arsip.store');

    // Edit arsip
    Route::get('/arsip/{id}/edit', [ArsipController::class, 'edit'])->name('arsip.edit');
    Route::post('/arsip/{id}/update', [ArsipController::class, 'update'])->name('arsip.update');

    // Hapus arsip
    Route::post('/arsip/{id}/delete', [ArsipController::class, 'destroy'])->name('arsip.destroy');

    // Export PDF
    Route::get('/arsip/export', [ArsipController::class, 'exportPdf'])->name('arsip.export');
});
