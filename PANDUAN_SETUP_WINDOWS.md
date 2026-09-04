# 🏸 Panduan Setup & Menjalankan Proyek di Windows
### Sistem Informasi & CMS Ekstrakurikuler Bulu Tangkis SMKN 2 Purwakarta

Panduan ini dibuat khusus untuk memandu pengguna/klien yang menggunakan sistem operasi **Windows** agar setelah melakukan `git clone`, semua dependensi, basis data, aset frontend, serta sistem manajemen gambar/konten (CMS) langsung terpasang dan siap digunakan 100%.

---

## 📋 1. Prasyarat Sistem (Prerequisites)

Sebelum menjalankan proyek, pastikan komputer Windows Anda sudah terpasang tools berikut:

| Software | Versi Minimal | Keterangan & Link Unduh |
| :--- | :--- | :--- |
| **PHP** | **8.3+** | [windows.php.net](https://windows.php.net/download/) *(Sangat disarankan via Laragon)* |
| **Composer** | **2.x** | [getcomposer.org](https://getcomposer.org/download/) (PHP Dependency Manager) |
| **Node.js & NPM**| **18 LTS+** | [nodejs.org](https://nodejs.org/) (Frontend Bundler) |
| **Git for Windows**| **2.x** | [gitforwindows.org](https://gitforwindows.org/) |

> 💡 **Rekomendasi Terbaik untuk Windows**:
> Jika Anda belum menginstal PHP & MySQL secara manual, sangat disarankan menginstal **[Laragon](https://laragon.org/)** (Full Edition). Laragon sudah otomatis menyertakan PHP 8.3+, Composer, Node.js, dan MySQL tanpa perlu konfigurasi Path yang rumit.

### ⚙️ Memastikan Ekstensi PHP Aktif di Windows
Buka file `php.ini` Anda (di folder instalasi PHP / Laragon / XAMPP), lalu pastikan baris ekstensi berikut **tidak diawali tanda titik koma (`;`)**:
```ini
extension=fileinfo
extension=mbstring
extension=openssl
extension=pdo_sqlite
extension=sqlite3
extension=curl
extension=zip
```
*(Ekstensi `fileinfo` wajib aktif agar sistem dapat memvalidasi unggahan file foto pelatih, galeri, dan prestasi).*

---

## ⚡ METODE 1: Setup Otomatis Sekali Klik (Sangat Direkomendasikan)

Proyek ini telah dilengkapi dengan skrip otomatisasi [`setup-windows.bat`](./setup-windows.bat). Skrip ini akan melakukan seluruh tahapan instalasi dari awal hingga akhir secara otomatis.

### Langkah-langkah:
1. **Clone repositori** melalui Git Bash, PowerShell, atau Command Prompt:
   ```cmd
   git clone https://github.com/FooledGil/Ekskul-Badminton.git
   ```
2. **Buka folder proyek** di Windows Explorer:
   ```cmd
   cd Ekskul-Badminton
   ```
3. **Klik dua kali (Double-click)** file:
   👉 **`setup-windows.bat`**
4. Tunggu hingga proses selesai. Skrip akan secara otomatis:
   - ✅ Memeriksa PHP, Composer, dan Node.js/NPM.
   - ✅ Membuat file `.env` dari `.env.example`.
   - ✅ Menginstal semua dependensi backend (`composer install`).
   - ✅ Meng-generate App Key (`php artisan key:generate`).
   - ✅ Membuat database SQLite & migrasi tabel beserta data awal/seeder CMS lengkap (`php artisan migrate:fresh --seed`).
   - ✅ Menyiapkan folder media dan membuat symlink storage (`php artisan storage:link`).
   - ✅ Menginstal paket frontend & kompilasi aset Vite (`npm install` & `npm run build`).
5. Di akhir proses, Anda akan ditanya apakah ingin langsung menyalakan server. Ketik `Y` lalu tekan Enter.
6. Browser akan otomatis terbuka ke `http://127.0.0.1:8000`.

---

## 🛠️ METODE 2: Setup Manual Langkah demi Langkah (CMD / PowerShell)

Jika Anda ingin menjalankan instalasi secara manual via Terminal (CMD atau PowerShell), ikuti urutan perintah di bawah ini:

### 1. Clone & Masuk Direktori
```cmd
git clone https://github.com/FooledGil/Ekskul-Badminton.git
cd Ekskul-Badminton
```

### 2. Buat File Konfigurasi Environment (`.env`)
- **Di Command Prompt (CMD):**
  ```cmd
  copy .env.example .env
  ```
- **Di PowerShell:**
  ```powershell
  Copy-Item .env.example .env
  ```

### 3. Install Dependensi PHP
```cmd
composer install
```

### 4. Generate Kunci Enkripsi Aplikasi
```cmd
php artisan key:generate
```

### 5. Siapkan Database & Isi Data Awal (CMS Seeder)
Proyek ini secara bawaan menggunakan **SQLite** (ringan, cepat, dan tanpa perlu instalasi server database tambahan):

- **Buat file database kosong:**
  - CMD:
    ```cmd
    type nul > database\database.sqlite
    ```
  - PowerShell:
    ```powershell
    New-Item -ItemType File database\database.sqlite -Force
    ```
- **Jalankan Migrasi dan Seeder:**
  ```cmd
  php artisan migrate:fresh --seed
  ```
  *(Perintah ini akan membuat semua tabel dan mengisi data awal: pengaturan CMS foto pelatih & hero, jadwal latihan, prestasi, galeri foto, papan skor, dan sampel data pendaftar).*

> 🐬 **Jika ingin beralih menggunakan MySQL (XAMPP / Laragon):**
> 1. Buat database baru di phpMyAdmin, misal bernama `ekskul_badminton`.
> 2. Buka file `.env` dan ubah:
>    ```env
>    DB_CONNECTION=mysql
>    DB_HOST=127.0.0.1
>    DB_PORT=3306
>    DB_DATABASE=ekskul_badminton
>    DB_USERNAME=root
>    DB_PASSWORD=
>    ```
> 3. Jalankan `php artisan migrate:fresh --seed`.

### 6. Hubungkan Folder Media Unggahan (Storage Link)
```cmd
php artisan storage:link
```
*(Langkah ini penting agar berkas gambar pelatih, prestasi, dan galeri yang diunggah via Admin Panel langsung dapat diakses di browser).*

### 7. Install & Build Aset Frontend (Tailwind CSS & Vite)
```cmd
npm install
npm run build
```

---

## 🚀 Cara Menjalankan Aplikasi

Setelah setup selesai, Anda bisa menjalankan aplikasi dengan salah satu cara berikut:

### Opsi A (Super Cepat): Klik Dua Kali File Runner
Klik dua kali file:
👉 **`run-windows.bat`**
File ini akan langsung membuka browser ke `http://127.0.0.1:8000` dan menjalankan server lokal secara otomatis.

### Opsi B (Manual Terminal):
Jalankan perintah ini di Command Prompt / PowerShell:
```cmd
php artisan serve
```
Kemudian buka browser Anda dan akses:
👉 **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

### Opsi C (Mode Pengembangan / Development Live Reload):
Jika Anda ingin melakukan pengeditan desain dan kode dengan live-reload instan:
```cmd
composer run dev
```

---

## 🧭 Halaman & URL Penting

1. **Halaman Utama Portal Ekskul**:
   - URL: **`http://127.0.0.1:8000`**
   - Menampilkan: Logo resmi SMKN 2 Purwakarta, hero banner smash atlet, profil ekskul, visualisasi lapangan interaktif, jadwal latihan mingguan, galeri foto bento grid, daftar raihan medali prestasi, papan skor turnamen, serta formulir pendaftaran atlet baru dan cek status mandiri.

2. **Panel Kontrol Admin & CMS Terpadu**:
   - URL: **`http://127.0.0.1:8000/admin`**
   - Fitur Admin:
     - ⚙️ **Foto & Info Pelatih (Tentang Kami)**: Unggah foto pelatih (JPG/PNG/WEBP) atau gunakan URL gambar, ubah nama, gelar, bio, lisensi PBSI, foto aksi hero, dan kontak media sosial.
     - 📅 **Jadwal Latihan**: Tambah, edit, dan hapus jadwal latihan mingguan serta tandai sesi latihan berikutnya.
     - 🏆 **Prestasi & Medali**: Tambah dan kelola data piala/medali dengan fitur unggah foto sertifikat/trofi.
     - 📸 **Galeri Foto**: Tambah dokumentasi foto kegiatan dengan pilihan kategori (*Tim*, *Latihan*, *Pertandingan*) dan ukuran grid.
     - 🏸 **Papan Skor**: Catat skor pertandingan turnamen dan pasang sorotan (*highlight*) utama di beranda.
     - 👥 **Pendaftar Atlet**: Verifikasi calon anggota baru (Diterima / Ditolak), input catatan pelatih, dan hubungi siswa langsung lewat tombol WhatsApp.

---

## ❓ Solusi Masalah Umum (Troubleshooting di Windows)

### 1. Pesan Error: *`could not find driver`* saat migrasi
- **Penyebab**: Ekstensi SQLite pada PHP Windows belum diaktifkan di `php.ini`.
- **Solusi**: Buka file `php.ini`, cari baris `;extension=pdo_sqlite` dan `;extension=sqlite3`, hapus tanda titik koma (`;`) di depannya, lalu simpan dan restart terminal.

### 2. Gambar yang Diunggah Tidak Muncul / Error 404 pada Gambar
- **Penyebab**: Symlink storage belum terbentuk.
- **Solusi**: Jalankan perintah:
  ```cmd
  php artisan storage:link
  ```

### 3. Gagal Mengunggah Gambar (*`The fileinfo extension is required`*)
- **Penyebab**: Ekstensi `fileinfo` belum aktif di PHP Windows.
- **Solusi**: Buka file `php.ini`, hapus tanda titik koma (`;`) pada baris:
  ```ini
  extension=fileinfo
  ```
  Lalu simpan file dan jalankan ulang server.

### 4. Pesan Error: *`Unable to locate file in Vite manifest`*
- **Penyebab**: Aset CSS/JS belum dikompilasi oleh Vite.
- **Solusi**: Jalankan perintah:
  ```cmd
  npm run build
  ```

### 5. Pesan Error PowerShell: *`File ... cannot be loaded because running scripts is disabled`*
- **Penyebab**: Kebijakan keamanan ExecutionPolicy bawaan Windows PowerShell.
- **Solusi**: Buka PowerShell sebagai Administrator, ketik perintah berikut:
  ```powershell
  Set-ExecutionPolicy -Scope CurrentUser -ExecutionPolicy RemoteSigned
  ```

### 6. Pesan Error: *`Failed to listen on 127.0.0.1:8000 (reason: ...)`*
- **Penyebab**: Port 8000 sedang dipakai oleh program lain di Windows.
- **Solusi**: Jalankan Laravel di port lain, misalnya port 8080:
  ```cmd
  php artisan serve --port=8080
  ```
  Lalu akses `http://127.0.0.1:8080` di peramban Anda.
