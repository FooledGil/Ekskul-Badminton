@echo off
chcp 65001 >nul
title Server Ekskul Badminton SMKN 2 Purwakarta
color 0B

echo ======================================================================
echo      MENJALANKAN SERVER EKSKUL BULU TANGKIS SMKN 2 PURWAKARTA
echo ======================================================================
echo.
echo Server lokal akan berjalan di:
echo - Halaman Utama : http://127.0.0.1:8000
echo - Admin Panel   : http://127.0.0.1:8000/admin
echo.
echo Browser akan otomatis dibuka.
echo Tekan tombol CTRL + C di jendela ini untuk mematikan server.
echo ======================================================================
echo.

start http://127.0.0.1:8000
php artisan serve

pause
