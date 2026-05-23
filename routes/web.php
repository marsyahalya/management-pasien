<?php

use App\Http\Controllers\KesehatanController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', [KesehatanController::class, 'dashboard'])->name('dashboard');

// Pasien
Route::get('/pasien', [KesehatanController::class, 'pasien'])->name('pasien');
Route::post('/pasien', [KesehatanController::class, 'storePasien']);
Route::delete('/pasien/{id}', [KesehatanController::class, 'destroyPasien']);

// Dokter
Route::get('/dokter', [KesehatanController::class, 'dokter'])->name('dokter');
Route::post('/dokter', [KesehatanController::class, 'storeDokter']);
Route::delete('/dokter/{id}', [KesehatanController::class, 'destroyDokter']);

// Obat
Route::get('/obat', [KesehatanController::class, 'obat'])->name('obat');
Route::post('/obat', [KesehatanController::class, 'storeObat']);
Route::delete('/obat/{id}', [KesehatanController::class, 'destroyObat']);

// Riwayat Kesehatan
Route::get('/riwayat', [KesehatanController::class, 'riwayat'])->name('riwayat');
Route::post('/riwayat', [KesehatanController::class, 'storeRiwayat']);
Route::delete('/riwayat/{id}', [KesehatanController::class, 'destroyRiwayat']);

// Resep Obat
Route::get('/resep', [KesehatanController::class, 'resep'])->name('resep');
Route::post('/resep', [KesehatanController::class, 'storeResep']);
Route::delete('/resep/{id}', [KesehatanController::class, 'destroyResep']);

// Item Resep Obat
Route::get('/resep-item', [KesehatanController::class, 'resepItem'])->name('resep_item');
Route::post('/resep-item', [KesehatanController::class, 'storeResepItem']);
Route::delete('/resep-item/{id}', [KesehatanController::class, 'destroyResepItem']);
