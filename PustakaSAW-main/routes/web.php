
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SAWController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index']);

// Data Buku
Route::resource('buku', BukuController::class)
    ->except(['show']);

// Data Anggota
Route::resource('anggota', AnggotaController::class)
    ->except(['show']);

// Data Peminjaman
Route::resource('peminjaman', PeminjamanController::class)
    ->except(['show']);

// Data Kriteria
Route::resource('kriteria', KriteriaController::class)
    ->except(['show']);

// Data Penilaian
Route::get('/penilaian', [SAWController::class, 'penilaian'])
    ->name('penilaian.index');

Route::post('/penilaian/simpan', [SAWController::class, 'simpanPenilaian'])
    ->name('penilaian.simpan');

// Hasil SAW
Route::get('/hasil-saw', [SAWController::class, 'hasil'])
    ->name('hasil-saw.index');

Route::post('/hasil-saw/hitung', [SAWController::class, 'hitung'])
    ->name('hasil-saw.hitung');
