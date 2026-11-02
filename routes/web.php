<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Redirect root ke halaman login
Route::redirect('/', '/login');

// Auth Routes (Login, Register, Password Reset, dll)
Auth::routes();

// Proteksi seluruh rute internal aplikasi dengan middleware auth
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Rute Laporan & Cetak Nota (Didefinisikan sebelum resource agar tidak tertabrak route param {id})
    Route::get('paket/laporan', [PaketController::class, 'laporan'])->name('paket.laporan');
    Route::get('pelanggan/laporan', [PelangganController::class, 'laporan'])->name('pelanggan.laporan');
    Route::get('transaksi/laporan', [TransaksiController::class, 'laporan'])->name('transaksi.laporan');
    Route::get('transaksi/{id}/nota', [TransaksiController::class, 'nota'])->name('transaksi.nota');

    // Resource Routes
    Route::resource('paket', PaketController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('transaksi', TransaksiController::class);

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
