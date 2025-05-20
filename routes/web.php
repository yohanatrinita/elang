<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/tes-alert', function () {
    session(['warning' => '🎉 Ini alert yang muncul terus-terusan sampai kamu hapus']);
    return redirect()->route('login.form');
});

// Route ke halaman informasi
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi');

// Halaman dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Halaman muncul duluan adalah login
Route::get('/', function () {
    return redirect()->route('login.form');
});

// Login & Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

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

    // Download file PDF asli
    Route::get('/arsip/{id}/download', [ArsipController::class, 'downloadFile'])->name('arsip.download');

    // Export PDF (semua data)
    Route::get('/arsip/export', [ArsipController::class, 'exportPdf'])->name('arsip.export');

    // Halaman filter PDF dan download berdasarkan rentang waktu
    Route::get('/arsip/pdf', [ArsipController::class, 'showPdfFilter'])->name('arsip.pdf');
    Route::get('/arsip/pdf/download', [ArsipController::class, 'downloadPdf'])->name('arsip.pdf.download');

    // Export dari dashboard
    Route::get('/dashboard/export/excel', [DashboardController::class, 'exportExcel'])->name('dashboard.export.excel');
    Route::get('/dashboard/export/pdf', [DashboardController::class, 'exportPdf'])->name('dashboard.export.pdf');

    // Halaman filter dan download rekap pengawasan
    Route::get('/arsip/rekap', [ArsipController::class, 'showRekapFilter'])->name('arsip.rekap');
    Route::get('/arsip/rekap/download', [ArsipController::class, 'downloadRekap'])->name('arsip.rekap.download');

});
