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
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/registrasi/{id}/status', [AdminController::class, 'updateStatus'])->name('registration.status');

    // Pengaturan Gambar & Konten (Pelatih/Tentang Kami, Hero, Kontak)
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

    // Manajemen Jadwal Latihan
    Route::post('/schedules', [AdminController::class, 'storeSchedule'])->name('schedules.store');
    Route::put('/schedules/{id}', [AdminController::class, 'updateSchedule'])->name('schedules.update');
    Route::delete('/schedules/{id}', [AdminController::class, 'destroySchedule'])->name('schedules.destroy');

    // Manajemen Prestasi
    Route::post('/achievements', [AdminController::class, 'storeAchievement'])->name('achievements.store');
    Route::put('/achievements/{id}', [AdminController::class, 'updateAchievement'])->name('achievements.update');
    Route::delete('/achievements/{id}', [AdminController::class, 'destroyAchievement'])->name('achievements.destroy');

    // Manajemen Galeri Kegiatan
    Route::post('/galleries', [AdminController::class, 'storeGallery'])->name('galleries.store');
    Route::put('/galleries/{id}', [AdminController::class, 'updateGallery'])->name('galleries.update');
    Route::delete('/galleries/{id}', [AdminController::class, 'destroyGallery'])->name('galleries.destroy');

    // Manajemen Skor Pertandingan
    Route::post('/scores', [AdminController::class, 'storeScore'])->name('scores.store');
    Route::put('/scores/{id}', [AdminController::class, 'updateScore'])->name('scores.update');
    Route::delete('/scores/{id}', [AdminController::class, 'destroyScore'])->name('scores.destroy');
});
