<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/arsip', function () {
    return view('arsip');
});

use App\Http\Controllers\ArsipController;

Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip');

Route::get('/upload-arsip', [ArsipController::class, 'create'])->name('arsip.create');

Route::post('/upload-arsip', [ArsipController::class, 'store'])->name('arsip.store');

Route::get('/arsip/{id}/edit', [ArsipController::class, 'edit'])->name('arsip.edit');
Route::post('/arsip/{id}/update', [ArsipController::class, 'update'])->name('arsip.update');
Route::post('/arsip/{id}/delete', [ArsipController::class, 'destroy'])->name('arsip.destroy');

Route::get('/arsip/export', [ArsipController::class, 'exportPdf'])->name('arsip.export');

use App\Http\Controllers\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');

Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

