# 🏸 SMKN 2 Badminton Portal & Management System
> **Sistem Informasi, Pendaftaran & CMS Ekstrakurikuler Bulu Tangkis SMKN 2 Purwakarta**

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-%3E%3D8.3-777BB4?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-v4-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-Bundler-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![Status](https://img.shields.io/badge/Status-Production_Ready-success?style=for-the-badge)

<p align="center">
  <img src="./screen.png" alt="Tampilan Portal SMKN 2 Badminton" width="850" style="border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
</p>

---

## 🌟 Fitur Utama (Features)

1. **Branding & Logo Resmi SMKN 2**:
   - Emblem resmi perisai SMKN 2 Purwakarta di navbar, footer, dan favicon browser.
   - Dilengkapi tema dinamis **Dark Mode** & **Light Mode**.
2. **Hero & Banner Aksi Smash Interaktif**:
   - Tampilan visual atlet bulu tangkis dengan tipografi bold, counter statistik otomatis, dan CTA pendaftaran.
3. **Interactive Court Visualizer**:
   - Visualisasi interaktif lapangan bulu tangkis yang responsif dengan animasi strategi taktik zona lapangan.
4. **Content Management System (CMS) Terpadu (`/admin`)**:
   - **Foto & Info Pelatih (Tentang Kami)**: Unggah berkas foto pelatih (JPG/PNG/WEBP) atau URL, nama, gelar, lisensi PBSI, biodata, dan spesialisasi latihan.
   - **Foto Hero & Teks**: Unggah foto atlet aksi smash dan ubah teks sambutan.
   - **Manajemen Jadwal**: Tambah, edit, hapus sesi latihan mingguan dan penanda *"Sesi Berikutnya"*.
   - **Manajemen Prestasi**: Tambah dan kelola daftar kejuaraan dengan fitur unggah foto medali/piagam.
   - **Manajemen Galeri**: Unggah foto kegiatan dengan kategori (*Tim*, *Latihan*, *Pertandingan*) dan ukuran kartu bento grid.
   - **Papan Skor**: Catat skor pertandingan terkini dan aktifkan sorotan (*highlight*) utama beranda.
5. **Formulir Pendaftaran Siswa Baru (AJAX)**:
   - Validasi instan nomor WhatsApp tanpa reload halaman dan kode registrasi otomatis (cth: `BDM-2026-001`).
   - Fitur cek status pendaftaran mandiri oleh siswa (`/cek-status`).
6. **Verifikasi Seleksi Calon Atlet**:
   - Konfirmasi status pendaftaran (*Menunggu*, *Diterima*, *Ditolak*), input catatan pelatih, dan hubungi siswa via tombol WhatsApp.

---

## 💻 Panduan Instalasi di Windows (Client Setup Guide)

Untuk pengguna sistem operasi **Windows**, Anda dapat memilih salah satu dari dua metode berikut setelah melakukan clone:

### ⚡ Metode 1: Setup Otomatis Sekali Klik (Sangat Direkomendasikan)

Proyek ini telah menyediakan berkas otomatisasi khusus Windows:
1. **Clone repositori:**
   ```cmd
   git clone https://github.com/FooledGil/Ekskul-Badminton.git
   cd Ekskul-Badminton
   ```
2. **Klik dua kali (Double-click)** file:
   👉 **`setup-windows.bat`**
3. Skrip otomatis akan:
   - Memeriksa ketersediaan PHP (>= 8.3), Composer, dan Node.js/NPM.
   - Membuat file `.env` dari template.
   - Mengunduh dependensi backend (`composer install`).
   - Menghasilkan Application Key (`php artisan key:generate`).
   - Menyiapkan database SQLite dan mengisi data awal CMS lengkap (`php artisan migrate:fresh --seed`).
   - Menghubungkan penyimpanan media publik (`php artisan storage:link`).
   - Memasang dependensi frontend & compile CSS/JS (`npm install` & `npm run build`).
4. Setelah selesai, server akan otomatis menyala dan membuka website di peramban Anda!

Untuk menjalankan server di lain waktu, cukup klik dua kali file 👉 **`run-windows.bat`**.

> 📖 **Panduan lengkap, tips Laragon/XAMPP, dan troubleshooting Windows**: Silakan buka dokumen [PANDUAN_SETUP_WINDOWS.md](./PANDUAN_SETUP_WINDOWS.md).

---

### 🛠️ Metode 2: Setup Manual Langkah demi Langkah (CMD / PowerShell)

```cmd
# 1. Masuk ke folder proyek
cd Ekskul-Badminton

# 2. Salin file environment
copy .env.example .env

# 3. Pasang paket PHP Composer
composer install

# 4. Generate App Key
php artisan key:generate

# 5. Siapkan Database SQLite & Jalankan Migrasi + Seeder CMS
type nul > database\database.sqlite
php artisan migrate:fresh --seed

# 6. Hubungkan Penyimpanan Media Unggahan (Storage Link)
php artisan storage:link

# 7. Pasang paket frontend & build assets Vite
npm install
npm run build

# 8. Jalankan Local Development Server
php artisan serve
```

Aplikasi sekarang aktif di: **`http://127.0.0.1:8000`**

---

## 🐧 Panduan Instalasi di Linux / macOS

```bash
git clone https://github.com/FooledGil/Ekskul-Badminton.git
cd Ekskul-Badminton

cp .env.example .env
composer install
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

---

## 🔗 Endpoint & Rute Navigasi

| Halaman | URL | Keterangan |
| :--- | :--- | :--- |
| **Portal Utama** | `http://127.0.0.1:8000/` | Beranda, Lapangan Interaktif, Jadwal, Prestasi, Galeri, Form Daftar |
| **Cek Status Siswa** | `http://127.0.0.1:8000/cek-status` | Fitur pelacakan status pendaftaran siswa |
| **Panel Admin & CMS**| `http://127.0.0.1:8000/admin` | Kontrol foto pelatih, hero, jadwal, prestasi, galeri, skor, dan seleksi |

---

## 🧰 Tech Stack

- **Backend**: Laravel 13.x, PHP 8.3+
- **Frontend**: Blade Templates, Tailwind CSS v4, Vanilla JavaScript, GSAP Animations
- **Database**: SQLite (Bawaan, Ringan, Zero-config) atau MySQL
- **Asset Bundler**: Vite 8.x

---

## 📄 Lisensi & Hak Cipta
Dibuat untuk Ekstrakurikuler Bulu Tangkis SMKN 2 Purwakarta.
Hak Cipta © 2026 SMKN 2 Badminton. Seluruh Hak Dilindungi.
