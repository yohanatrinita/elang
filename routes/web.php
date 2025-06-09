<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\SemesterReportController;


// 🌐 Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login.form');
});

// 💻 Public Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/arsip/rekap/download', [ArsipController::class, 'downloadRekap'])->name('arsip.rekap.download');
Route::get('/arsip/rekap/excel', [ArsipController::class, 'downloadExcel'])->name('arsip.rekap.excel');

Route::prefix('rekap')->group(function () {
    Route::get('/semester', [RekapController::class, 'semester'])->name('rekap.semester');
    Route::get('/pengawasan', [RekapController::class, 'pengawasan'])->name('rekap.pengawasan');
    Route::get('/emisi', [RekapController::class, 'emisi'])->name('rekap.emisi');
    Route::get('/airlimbah', [RekapController::class, 'airLimbah'])->name('rekap.airlimbah');
    Route::get('/plb3', [RekapController::class, 'plb3'])->name('rekap.plb3');
    Route::get('/pernyataan', [RekapController::class, 'pernyataan'])->name('rekap.pernyataan');
});


Route::prefix('rekap/semester')->middleware(['auth'])->group(function () {
    Route::get('/', [SemesterReportController::class, 'index'])->name('rekap.semester');
    Route::get('/create', [SemesterReportController::class, 'create'])->name('rekap.semester.create');
    Route::post('/', [SemesterReportController::class, 'store'])->name('rekap.semester.store');
    Route::get('/{id}/edit', [SemesterReportController::class, 'edit'])->name('rekap.semester.edit');
    Route::put('/{id}', [SemesterReportController::class, 'update'])->name('rekap.semester.update');
    Route::delete('/{id}', [SemesterReportController::class, 'destroy'])->name('rekap.semester.destroy');
});


// 🔒 Authenticated Routes (All roles)
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi');

    // 📁 Arsip
    Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip');
    Route::get('/upload-arsip', [ArsipController::class, 'create'])->name('arsip.create');
    Route::post('/upload-arsip', [ArsipController::class, 'store'])->name('arsip.store');

    Route::get('/arsip/{id}/edit', [ArsipController::class, 'edit'])->name('arsip.edit');
    Route::post('/arsip/{id}/update', [ArsipController::class, 'update'])->name('arsip.update');  
    Route::delete('/arsip/{id}/delete', [ArsipController::class, 'destroy'])->name('arsip.destroy');
    Route::get('/arsip/{id}/download', [ArsipController::class, 'downloadFile'])->name('arsip.download');

    Route::get('/arsip/export', [ArsipController::class, 'exportPdf'])->name('arsip.export');
    Route::get('/arsip/pdf', [ArsipController::class, 'showPdfFilter'])->name('arsip.pdf');
    Route::get('/arsip/pdf/download', [ArsipController::class, 'downloadPdf'])->name('arsip.pdf.download');

    Route::get('/arsip/rekap', [ArsipController::class, 'showRekapFilter'])->name('arsip.rekap');

    // 📤 Dashboard Export
    Route::get('/dashboard/export/excel', [DashboardController::class, 'exportExcel'])->name('dashboard.export.excel');
    Route::get('/dashboard/export/pdf', [DashboardController::class, 'exportPdf'])->name('dashboard.export.pdf');
});

// 🔐 Admin Routes (verifikasi user, kelola user)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users/{id}/verify', [UserController::class, 'verify'])->name('users.verify');
    Route::post('/users/{id}/unverify', [UserController::class, 'unverify'])->name('users.unverify');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // 🔍 Verifikasi staff yang belum diverifikasi
    Route::get('/verifikasi-user', [UserController::class, 'verifikasiUser'])->name('users.verifikasi.form');
    Route::post('/verifikasi-user/{id}', [UserController::class, 'verifikasi'])->name('users.verifikasi.process');
    Route::post('/users/{id}/secure-delete', [UserController::class, 'secureDestroy'])->name('users.secure-delete');
    Route::post('/users/{id}/secure-verify', [UserController::class, 'secureVerify'])->name('users.secure-verify');
    Route::post('/users/{id}/secure-reject', [UserController::class, 'secureReject'])->name('users.secure-reject');
    // Untuk user belum diverifikasi
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users/{id}/verify', [UserController::class, 'verify'])->name('admin.users.verify');
    Route::post('/admin/users/{id}/reject', [UserController::class, 'reject'])->name('admin.users.reject');
    Route::delete('/admin/users/{id}/delete', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::post('/users/{id}/secure-verify', [UserController::class, 'secureVerify'])->name('admin.users.secure-verify');
    Route::post('/users/{id}/secure-reject', [UserController::class, 'secureReject'])->name('admin.users.secure-reject');
    Route::post('/users/{id}/secure-delete', [UserController::class, 'secureDelete'])->name('admin.users.secure-delete');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users/{id}/secure-verify', [UserController::class, 'secureVerify'])->name('admin.users.verify');
    Route::post('/admin/users/{id}/secure-reject', [UserController::class, 'secureReject'])->name('admin.users.reject');
    Route::post('/admin/users/{id}/secure-delete', [UserController::class, 'secureDelete'])->name('admin.users.delete');
    Route::post('/admin/users/{id}/secure-delete', [UserController::class, 'secureDelete'])->name('admin.users.secureDelete');

});

});
