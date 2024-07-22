<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\KelompokController;

// Rute untuk menampilkan halaman utama
Route::get('/', [KelompokController::class, 'index'])->name('kelompok.index');

// Rute untuk halaman input
Route::get('/input', [KelompokController::class, 'create'])->name('kelompok.create');

// Rute untuk menyimpan data dari halaman input
Route::post('/input', [KelompokController::class, 'store'])->name('kelompok.store');

// Rute untuk menyimpan data baru
Route::post('/kelompok/store', [KelompokController::class, 'store'])->name('kelompok.store');

// Rute untuk halaman tentang
Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');

// Rute untuk halaman petunjuk
Route::get('/petunjuk', [PageController::class, 'petunjuk'])->name('petunjuk');

// Rute untuk menampilkan halaman edit
Route::get('/edit/{id}', [KelompokController::class, 'edit'])->name('kelompok.edit');

// Rute untuk mengupdate data
Route::put('/update/{id}', [KelompokController::class, 'update'])->name('kelompok.update');
