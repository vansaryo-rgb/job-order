<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\LaporanController;

// Alamat untuk menampilkan halaman formulir laporan
Route::get('/laporan/baru', function () {
    return view('buat_laporan');
});


// Jalur untuk menampilkan form
Route::get('/laporan/baru', function () {
    return view('buat_laporan');
});

// 🛣️ JALUR BARU: Jalur untuk memproses kiriman data dari form
Route::post('/laporan/baru', [LaporanController::class, 'simpan'])->name('laporan.simpan');

// Alamat untuk melihat Dashboard Admin
Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan');

// Jalur untuk memproses update status laporan oleh admin
Route::put('/admin/laporan/{id}/status', [LaporanController::class, 'updateStatus'])->name('admin.laporan.status');