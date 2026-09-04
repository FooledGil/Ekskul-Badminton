<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

// Public Home Portal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Pendaftaran Anggota Baru & Cek Status
Route::post('/daftar', [RegistrationController::class, 'store'])->name('register.store');
Route::get('/cek-status', [RegistrationController::class, 'checkStatus'])->name('register.status');

// Admin Panel Pengurus Ekskul
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/registrasi/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.registration.status');
