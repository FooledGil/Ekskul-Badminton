@echo off
chcp 65001 >nul
setlocal enabledelayedexpansion

title Setup & Upgrade Project - Ekskul Badminton SMKN 2 Purwakarta
color 0A

echo ======================================================================
echo    PANDUAN SETUP & UPGRADE OTOMATIS - EKSKUL BADMINTON (WINDOWS)
echo ======================================================================
echo.
echo Selamat datang! Skrip ini akan menyiapkan dan meng-upgrade semua
echo kebutuhan proyek secara otomatis (Environment, Composer, Database,
echo Seeder Konten & Gambar CMS, Storage Link, dan Frontend Assets).
echo.
pause

:: [1/7] Cek PHP
echo.
echo [1/7] Memeriksa instalasi PHP...
where php >nul 2>nul
if %errorlevel% neq 0 (
    color 0C
    echo [ERROR] PHP tidak terdeteksi di PATH sistem Windows Anda!
    echo Solusi:
    echo 1. Pastikan Anda telah menginstal PHP ^>= 8.3 (sangat disarankan via Laragon atau XAMPP).
    echo 2. Masukkan folder php ke Environment Variable PATH.
    echo 3. Pastikan ekstensi aktif di php.ini: fileinfo, pdo_sqlite, sqlite3, mbstring, curl.
    echo.
    pause
    exit /b 1
)
php -v
echo [OK] PHP terdeteksi.

:: [2/7] Cek Composer
echo.
echo [2/7] Memeriksa Composer...
where composer >nul 2>nul
if %errorlevel% neq 0 (
    color 0C
    echo [ERROR] Composer tidak ditemukan!
    echo Silakan unduh dan pasang Composer dari: https://getcomposer.org/
    echo.
    pause
    exit /b 1
)
call composer --version
echo [OK] Composer terdeteksi.

:: [3/7] Cek Node.js & NPM
echo.
echo [3/7] Memeriksa Node.js & NPM...
where node >nul 2>nul
if %errorlevel% neq 0 (
    color 0C
    echo [ERROR] Node.js tidak ditemukan!
    echo Silakan pasang Node.js ^>= 18 LTS dari: https://nodejs.org/
    echo.
    pause
    exit /b 1
)
where npm >nul 2>nul
if %errorlevel% neq 0 (
    color 0C
    echo [ERROR] NPM tidak ditemukan!
    echo.
    pause
    exit /b 1
)
node -v
npm -v
echo [OK] Node.js dan NPM terdeteksi.

:: [4/7] Salin file .env
echo.
echo [4/7] Menyiapkan file .env...
if not exist .env (
    copy .env.example .env >nul
    echo [OK] File .env berhasil dibuat dari .env.example.
) else (
    echo [INFO] File .env sudah ada, melewati pembuatan baru.
)

:: [5/7] Install Composer Dependencies
echo.
echo [5/7] Mengunduh dependensi PHP (composer install)...
echo Proses ini dapat memakan waktu beberapa menit tergantung koneksi internet...
call composer install --no-interaction --prefer-dist
if %errorlevel% neq 0 (
    color 0C
    echo [ERROR] Gagal menjalankan composer install!
    echo Periksa koneksi internet Anda atau pastikan ekstensi php (mbstring, openssl, pdo_sqlite) aktif di php.ini.
    echo.
    pause
    exit /b 1
)
echo [OK] Dependensi PHP berhasil dipasang.

:: Generate App Key
echo.
echo Menghasilkan Application Key...
call php artisan key:generate --force

:: [6/7] Setup Database (SQLite) & Migrasi + Seeder
echo.
echo [6/7] Menyiapkan Database dan Seeding data awal...
if not exist database (
    mkdir database
)
if not exist database\database.sqlite (
    type nul > database\database.sqlite
    echo [OK] File database\database.sqlite dibuat.
)

call php artisan migrate:fresh --seed --force
if %errorlevel% neq 0 (
    color 0E
    echo [PERINGATAN] Terjadi kendala saat migrasi otomatis.
    echo Pastikan ekstensi 'pdo_sqlite' dan 'sqlite3' aktif di php.ini Anda.
    echo Atau jika ingin menggunakan MySQL (XAMPP), atur konfigurasi database di file .env.
    echo.
) else (
    echo [OK] Database berhasil dimigrasi dan diisi dengan data awal (Pengaturan CMS, Foto Pelatih, Jadwal, Prestasi, Galeri, Skor)!
)

:: Menyiapkan Storage Link untuk Unggah Berkas & Gambar
echo.
echo Menghubungkan penyimpanan media publik (storage:link)...
if not exist storage\app\public (
    mkdir storage\app\public
)
if not exist storage\app\public\uploads (
    mkdir storage\app\public\uploads
)
call php artisan storage:link >nul 2>nul
echo [OK] Penyimpanan media upload siap digunakan.

:: [7/7] Install NPM Packages & Build Frontend
echo.
echo.
echo [7/7] Memasang NPM packages dan melakukan kompilasi Vite...
call npm install --no-audit
if %errorlevel% neq 0 (
    color 0C
    echo [ERROR] Gagal memasang paket npm.
    echo.
    pause
    exit /b 1
)

call npm run build
if %errorlevel% neq 0 (
    color 0C
    echo [ERROR] Gagal melakukan build frontend (npm run build).
    echo.
    pause
    exit /b 1
)
echo [OK] Build assets frontend selesai.

color 0A
echo.
echo ======================================================================
echo    SETUP SELESAI DENGAN SUKSES! PROYEK SIAP DIGUNAKAN.
echo ======================================================================
echo.
echo Akses Aplikasi:
echo - Halaman Utama : http://127.0.0.1:8000
echo - Admin Panel   : http://127.0.0.1:8000/admin (Kelola Foto Pelatih, Hero, Jadwal, Prestasi, Galeri, Skor)
echo.
echo Cara Menjalankan Server Nanti:
echo Cukup klik dua kali file 'run-windows.bat' atau ketik di terminal:
echo   php artisan serve
echo.
set /p RUN_SERVER="Jalankan server dan buka website sekarang? (Y/N): "
if /i "!RUN_SERVER!"=="Y" (
    echo.
    echo Membuka browser di http://127.0.0.1:8000 dan menjalankan server...
    start http://127.0.0.1:8000
    call php artisan serve
) else (
    echo.
    echo Terima kasih! Tekan sembarang tombol untuk keluar.
    pause
)
