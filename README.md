# Laravel-Fitcount

**Laravel-Fitcount** adalah aplikasi berbasis web yang dikembangkan menggunakan **Laravel** framework. Aplikasi ini berfungsi untuk menghitung, memonitor, dan mengelola data fitness (misalnya olahraga, nutrisi, atau kebugaran) dengan efisiensi dan kemudahan penggunaan.

---

## 📋 Daftar Isi

- [Laravel-Fitcount](#laravel-fitcount)
  - [📋 Daftar Isi](#-daftar-isi)
  - [🚀 Fitur Utama](#-fitur-utama)
  - [🛠️ Prasyarat](#️-prasyarat)
  - [💻 Instalasi](#-instalasi)
    - [1. Clone Repository](#1-clone-repository)
    - [2. Konfigurasi Environment](#2-konfigurasi-environment)
  - [🐳 Menggunakan Docker](#-menggunakan-docker)
    - [1. Build Docker Images](#1-build-docker-images)
    - [2. Konfigurasi Environment](#2-konfigurasi-environment-1)
    - [3. Jalankan Aplikasi](#3-jalankan-aplikasi)
    - [4. Auto SSL dan Reverse Proxy](#4-auto-ssl-dan-reverse-proxy)
  - [📂 Struktur Proyek](#-struktur-proyek)
  - [🧑‍💻 Cara Penggunaan](#-cara-penggunaan)
  - [🤝 Kontribusi](#-kontribusi)
  - [📜 Lisensi](#-lisensi)
  - [📧 Kontak](#-kontak)

---

## 🚀 Fitur Utama

- **Manajemen Aktivitas Fitness:** Tambah, edit, dan hapus aktivitas kebugaran.
- **Perhitungan Kalori:** Menghitung kalori berdasarkan input aktivitas pengguna.
- **Grafik & Statistik:** Menampilkan progres kebugaran dalam bentuk visual.
- **User Authentication:** Sistem autentikasi menggunakan Laravel.
- **Docker Multi-Stage Build:** Optimalisasi ukuran image Docker.
- **Nginx Integration:** Menggunakan Nginx sebagai server web untuk production.
- **Auto SSL (Let's Encrypt):** Konfigurasi otomatis SSL untuk keamanan HTTPS.

---

## 🛠️ Prasyarat

Pastikan sistem Anda memiliki:

- **Docker** dan **Docker Compose**
- **Git** untuk cloning repository
- **Node.js & NPM** (jika ingin build manual)
- **Domain** (untuk fitur Auto SSL dengan Nginx)

---

## 💻 Instalasi

### 1. Clone Repository  

Clone repository dari GitHub:

```bash
git clone https://github.com/IlhamGhaza/laravel-fitcount.git
cd laravel-fitcount
```

### 2. Konfigurasi Environment

Salin file `.env.example` ke `.env`:

```bash
cp .env.example .env
```

Perbarui konfigurasi **database** dan pengaturan lainnya sesuai kebutuhan.

---

## 🐳 Menggunakan Docker

Laravel-Fitcount menggunakan **multi-stage build** di Dockerfile untuk mengoptimalkan ukuran image dan performa di production.

### 1. Build Docker Images  

Bangun dan jalankan container:

```bash
docker-compose up --build -d
```

### 2. Konfigurasi Environment

- Sesuaikan konfigurasi Nginx di `deploy/nginx.conf` jika diperlukan.  
- File konfigurasi **PHP** dapat diubah di `deploy/php.ini`.

---

### 3. Jalankan Aplikasi  

Setelah build selesai, aplikasi bisa diakses di:

```bash
http://localhost:8000
```

Untuk production (dengan domain dan SSL), pastikan domain diarahkan ke server Anda.

---

### 4. Auto SSL dan Reverse Proxy  

Jika Anda menggunakan domain dan ingin mengaktifkan SSL secara otomatis:

1. Tambahkan domain di konfigurasi Nginx (`nginx.conf`).
2. Pastikan **Certbot** diatur untuk mengelola SSL.  
   Jalankan perintah Certbot:

```bash
docker-compose run certbot
```

---

## 📂 Struktur Proyek

```plaintext
laravel-fitcount/
├── app/                # Controllers, Models, Middleware
├── database/           # Migrations dan Seeders
├── public/             # Akses file statis
├── resources/          # Views dan Assets
├── routes/             # Routing aplikasi
├── docker-compose.yml  # Konfigurasi Docker
├── Dockerfile          # Multi-stage Dockerfile
├── deploy/             # Konfigurasi Nginx & PHP
│   ├── nginx.conf      # Konfigurasi Nginx
│   └── php.ini         # Konfigurasi PHP
└── .env                # Environment file
```

---

## 🧑‍💻 Cara Penggunaan

1. **Registrasi Akun:** Daftar menggunakan halaman registrasi.
2. **Login:** Masuk ke sistem dengan akun yang telah dibuat.
3. **Kelola Aktivitas:** Tambahkan aktivitas kebugaran, pantau progres, dan lihat statistik.

---

## 🤝 Kontribusi

Kontribusi sangat dihargai! Berikut cara Anda dapat berkontribusi:

1. Fork repository ini.
2. Buat branch baru:  
   ```bash
   git checkout -b feature-nama-fitur
   ```
3. Commit perubahan Anda:  
   ```bash
   git commit -m "Menambahkan fitur baru"
   ```
4. Push ke branch Anda:  
   ```bash
   git push origin feature-nama-fitur
   ```
5. Buat **Pull Request** di GitHub.

---

## 📜 Lisensi

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Proyek ini dilisensikan di bawah **MIT License**. Lihat file [LICENSE](LICENSE) untuk detailnya.

---

## 📧 Kontak

Jika ada pertanyaan atau saran, silakan hubungi:

- **Ilham Ghaza**  
- Email: [IlhamGhaza](mailto:cb7ezeur@selenakuyang.anonaddy.com)  
- GitHub: [IlhamGhaza](https://github.com/IlhamGhaza)  

---

**Selamat menggunakan Laravel-Fitcount dengan Docker! 🚀**
