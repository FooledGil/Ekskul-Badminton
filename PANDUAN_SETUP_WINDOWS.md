# 🏸 Panduan Setup & Menjalankan Proyek di Windows
### Sistem Informasi Ekstrakurikuler Bulu Tangkis SMKN 2 Purwakarta

Panduan ini dibuat khusus untuk memandu pengguna/klien yang menggunakan sistem operasi **Windows** agar setelah melakukan `git clone`, semua dependensi, basis data, dan aset frontend langsung terpasang (ter-upgrade) secara sempurna dan siap digunakan.

---

## 📋 1. Prasyarat Sistem (Prerequisites)

Sebelum menjalankan proyek, pastikan komputer Windows Anda sudah terpasang tools berikut:

| Software | Versi Minimal | Keterangan & Link Unduh |
| :--- | :--- | :--- |
| **PHP** | **8.3+** | [windows.php.net](https://windows.php.net/download/) *(Disarankan via Laragon)* |
| **Composer** | **2.x** | [getcomposer.org](https://getcomposer.org/download/) (PHP Dependency Manager) |
| **Node.js & NPM**| **18 LTS+** | [nodejs.org](https://nodejs.org/) (Frontend Bundler) |
| **Git for Windows**| **2.x** | [gitforwindows.org](https://gitforwindows.org/) |

> 💡 **Rekomendasi Terbaik untuk Windows**:
> Jika Anda belum menginstal PHP & MySQL secara manual, sangat disarankan menginstal **[Laragon](https://laragon.org/)** (Full Edition). Laragon sudah otomatis menyertakan PHP, Composer, Node.js, dan MySQL tanpa perlu konfigurasi Path yang rumit.

### ⚙️ Memastikan Ekstensi PHP Aktif di Windows
Buka file `php.ini` Anda (di folder PHP / Laragon / XAMPP), lalu pastikan baris ekstensi berikut **tidak diawali tanda titik koma (`;`)**:
```ini
extension=fileinfo
extension=mbstring
extension=openssl
extension=pdo_sqlite
extension=sqlite3
extension=curl
extension=zip
```

---

## ⚡ METODE 1: Setup Otomatis Sekali Klik (Sangat Direkomendasikan)

Proyek ini telah dilengkapi dengan skrip otomatisasi `setup-windows.bat`. Skrip ini akan melakukan seluruh tahapan instalasi dari awal hingga akhir tanpa perlu mengetik banyak perintah di terminal.

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
   👉 `setup-windows.bat`
4. Tunggu hingga proses selesai. Skrip akan secara otomatis:
   - ✅ Memeriksa PHP, Composer, dan Node.js/NPM.
   - ✅ Membuat file `.env` dari `.env.example`.
   - ✅ Menginstal semua dependensi backend (`composer install`).
   - ✅ Meng-generate App Key (`php artisan key:generate`).
   - ✅ Membuat database SQLite & migrasi tabel beserta data awal/seeder (`php artisan migrate:fresh --seed`).
   - ✅ Membuat symlink storage (`php artisan storage:link`).
   - ✅ Menginstal paket frontend & kompilasi aset (`npm install` & `npm run build`).
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

### 5. Siapkan Database & Isi Data Awal (Seeder)
Proyek ini secara bawaan menggunakan **SQLite** (ringan, cepat, dan tanpa perlu setup server database tambahan):

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
  *(Perintah ini akan membuat semua tabel dan mengisi data jadwal latihan, daftar prestasi, galeri foto, papan skor, dan sampel data pendaftar).*

> 🐬 **Jika ingin menggunakan MySQL (XAMPP / Laragon):**
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

### 6. Hubungkan Folder Storage
```cmd
php artisan storage:link
```

### 7. Install & Build Aset Frontend (Tailwind CSS & Vite)
```cmd
npm install
npm run build
```

---

## 🚀 Cara Menjalankan Aplikasi

Setelah setup selesai, Anda bisa menjalankan aplikasi dengan salah satu cara berikut:

### Opsi A (Mudah): Klik Dua Kali File Runner
Klik dua kali file:
👉 `run-windows.bat`
File ini akan langsung membuka browser dan menjalankan server lokal.

### Opsi B (Manual Terminal):
Jalankan perintah ini di Command Prompt / PowerShell:
```cmd
php artisan serve
```
Kemudian buka browser Anda dan akses:
👉 **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

### Opsi C (Mode Pengembangan / Development Live Reload):
Jika Anda ingin melakukan pengeditan tampilan dan kode dengan live-reload:
```cmd
composer run dev
```
*(Atau buka 2 terminal: Terminal 1 jalankan `php artisan serve`, Terminal 2 jalankan `npm run dev`)*.

---

## 🧭 Halaman & URL Penting

1. **Halaman Utama Portal Ekskul**:
   - URL: `http://127.0.0.1:8000`
   - Menampilkan: Profil ekskul, visualisasi lapangan badminton interaktif, jadwal latihan mingguan, prestasi atlet, galeri momen latihan & tanding, papan skor, serta formulir pendaftaran anggota baru dan fitur cek status registrasi.

2. **Panel Admin Pengurus Ekskul**:
   - URL: `http://127.0.0.1:8000/admin`
   - Fitur Admin:
     - Dashboard statistik pendaftaran (Menunggu, Diterima, Ditolak).
     - Filter data pendaftar.
     - Aksi approval/reject pendaftaran disertai catatan pelatih (*coach notes*).

---

## ❓ Solusi Masalah Umum (Troubleshooting di Windows)

### 1. Pesan Error: *`could not find driver`* saat migrasi
- **Penyebab**: Ekstensi SQLite pada PHP Windows belum aktif.
- **Solusi**: Buka file `php.ini`, cari baris `;extension=pdo_sqlite` dan `;extension=sqlite3`, hapus tanda titik koma (`;`) di depannya, lalu simpan file dan restart terminal/server.

### 2. Pesan Error: *`Unable to locate file in Vite manifest`*
- **Penyebab**: Folder `public/build` belum dihasilkan.
- **Solusi**: Jalankan perintah berikut di terminal:
  ```cmd
  npm run build
  ```

### 3. Pesan Error PowerShell: *`File ... cannot be loaded because running scripts is disabled`*
- **Penyebab**: Kebijakan keamanan ExecutionPolicy bawaan Windows PowerShell.
- **Solusi**: Buka PowerShell as Administrator, ketik perintah berikut:
  ```powershell
  Set-ExecutionPolicy -Scope CurrentUser -ExecutionPolicy RemoteSigned
  ```

### 4. Pesan Error: *`Failed to listen on 127.0.0.1:8000 (reason: ...)`*
- **Penyebab**: Port 8000 sedang digunakan oleh aplikasi lain.
- **Solusi**: Jalankan Laravel pada port lain, misalnya:
  ```cmd
  php artisan serve --port=8080
  ```
  Lalu buka `http://127.0.0.1:8080` di browser.
