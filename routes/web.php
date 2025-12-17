<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\PetunjukController;

// Rute untuk menampilkan halaman utama
Route::get('/', [KelompokController::class, 'index'])->name('kelompok.index');

// Rute untuk halaman input
Route::get('/input', [KelompokController::class, 'create'])->name('kelompok.create');

// Rute untuk menyimpan data baru
Route::post('/kelompok/store', [KelompokController::class, 'store'])->name('kelompok.store');

// Rute untuk halaman tentang
Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');

// Rute untuk halaman petunjuk
Route::get('/petunjuk', [PageController::class, 'petunjuk'])->name('petunjuk');

// Rute untuk menampilkan halaman data
Route::get('/data', [KelompokController::class, 'showData'])->name('data.show');

// Rute untuk menampilkan halaman edit
Route::get('/edit/{id}', [KelompokController::class, 'edit'])->name('kelompok.edit');

// Rute untuk mengupdate data
Route::put('/update/{id}', [KelompokController::class, 'update'])->name('kelompok.update');

// Rute untuk login dan logout
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/edit/{id}', [KelompokController::class, 'edit'])->middleware('auth');

Route::delete('/kelompok/{id}', [KelompokController::class, 'destroy'])->name('kelompok.destroy');
Route::delete('/kelompok', [KelompokController::class, 'destroyMultiple'])->name('kelompok.destroyMultiple');

Route::get('/tentang', [TentangController::class, 'showTentang'])->name('tentang.show');
Route::post('/tentang/update', [TentangController::class, 'updateContent'])->name('tentang.update');

Route::get('/petunjuk', [PetunjukController::class, 'showPetunjuk'])->name('petunjuk.show');
Route::post('/petunjuk/update', [PetunjukController::class, 'updateContent'])->name('petunjuk.update');

Route::get('/petunjuk', [PetunjukController::class, 'showPetunjuk'])->name('petunjuk.show');
Route::post('/petunjuk/update', [PetunjukController::class, 'updateContent'])->name('petunjuk.update');