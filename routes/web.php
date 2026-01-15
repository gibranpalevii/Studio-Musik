<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\HomeController;

// 1. HALAMAN DEPAN (PENGUNJUNG)
Route::get('/', [HomeController::class, 'index']); 

// 2. AUTH & DASHBOARD ADMIN
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login-proses', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/dashboard', [DashboardController::class, 'index']);

// 3. DATA STUDIO (CRUD)
Route::get('/studio', [StudioController::class, 'index']);
Route::get('/studio/create', [StudioController::class, 'create']);
Route::post('/studio', [StudioController::class, 'store']); 
Route::get('/studio/edit/{id}', [StudioController::class, 'edit']);
Route::post('/studio/update/{id}', [StudioController::class, 'update']);
Route::get('/studio/hapus/{id}', [StudioController::class, 'destroy']);

// 4. DATA ALAT MUSIK (CRUD)
Route::get('/alat', [AlatController::class, 'index']); 
Route::get('/alat/create', [AlatController::class, 'create']); 
Route::post('/alat/store', [AlatController::class, 'store']); 
Route::get('/alat/edit/{id}', [AlatController::class, 'edit']); 
Route::put('/alat/update/{id}', [AlatController::class, 'update']); 
Route::delete('/alat/hapus/{id}', [AlatController::class, 'destroy']); 

// 5. DATA PELANGGAN
Route::get('/pelanggan', [PelangganController::class, 'index']);
Route::get('/pelanggan/tambah', [PelangganController::class, 'create']);
Route::post('/pelanggan', [PelangganController::class, 'store']);
Route::get('/pelanggan/edit/{id}', [PelangganController::class, 'edit']);
Route::put('/pelanggan/update/{id}', [PelangganController::class, 'update']);
Route::get('/pelanggan/hapus/{id}', [PelangganController::class, 'destroy']);

// 6. TRANSAKSI
Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::get('/transaksi/tambah', [TransaksiController::class, 'create']);
Route::post('/transaksi', [TransaksiController::class, 'store']);
Route::get('/transaksi/status/{id}/{status}', [TransaksiController::class, 'updateStatus']);
Route::get('/transaksi/bayar/{id}', [TransaksiController::class, 'updateBayar']);
Route::get('/transaksi/hapus/{id}', [TransaksiController::class, 'destroy']);

// 7. LAPORAN KEUANGAN
Route::get('/laporan', [LaporanController::class, 'index']);
Route::get('/laporan/cetak', [LaporanController::class, 'cetak']);