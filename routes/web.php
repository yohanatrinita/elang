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

Route::get('/arsip/export', [ArsipController::class, 'exportPdf'])->name('arsip.export');

