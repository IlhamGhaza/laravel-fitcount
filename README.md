# Laravel-Fitcount

**Laravel-Fitcount** adalah aplikasi berbasis web yang dikembangkan menggunakan **Laravel** framework. Aplikasi ini berfungsi untuk menghitung, memonitor, dan mengelola data fitness (misalnya olahraga, nutrisi, atau kebugaran) dengan efisiensi dan kemudahan penggunaan.

<!-- table of content -->

## 📋 Daftar Isi

- [Laravel-Fitcount](#laravel-fitcount)
  - [📋 Daftar Isi](#-daftar-isi)
  - [🚀 Fitur Utama](#-fitur-utama)
  - [🛠️ Prasyarat](#️-prasyarat)
  - [💻 Instalasi](#-instalasi)
    - [1. Clone Repository](#1-clone-repository)
    - [2. Konfigurasi Environment](#2-konfigurasi-environment)
    - [3. Generete Key](#3-generete-key)
    - [4. Jalankan perintah berikut untuk membuat tabel database](#4-jalankan-perintah-berikut-untuk-membuat-tabel-database)
    - [5. Set up database](#5-set-up-database)
    - [6. Jalankan server](#6-jalankan-server)
  - [🐳 Menggunakan Docker](#-menggunakan-docker)
    - [1. Install Docker dan Docker Compose](#1-install-docker-dan-docker-compose)
    - [2. Build Docker Containers](#2-build-docker-containers)
    - [3. Instalasi Dependencies](#3-instalasi-dependencies)
    - [4. Akses Aplikasi](#4-akses-aplikasi)
  - [📂 Struktur Proyek](#-struktur-proyek)
  - [🧑‍💻 Cara Penggunaan](#-cara-penggunaan)
  - [🤝 Kontribusi](#-kontribusi)
  - [📜 Lisensi](#-lisensi)
  - [📧 Kontak](#-kontak)

## 🚀 Fitur Utama

- **Manajemen Aktivitas Fitness:** Tambah, edit, dan hapus aktivitas kebugaran.  
- **Perhitungan Kalori:** Menghitung kalori berdasarkan input aktivitas pengguna.  
- **Grafik & Statistik:** Menampilkan data dalam bentuk grafik untuk memantau progres kebugaran.  
- **User Authentication:** Login, registrasi, dan autentikasi pengguna menggunakan Laravel.  
- **Manajemen Database:** Data tersimpan secara aman menggunakan MySQL atau SQLite.  
- **Docker Support:** Mudah dijalankan menggunakan **Docker** dan **Docker Compose**.  

---

## 🛠️ Prasyarat

Pastikan sistem Anda memiliki prasyarat berikut sebelum menginstal aplikasi:

- **PHP** >= 8.1  
- **Composer** (Dependency Manager for PHP)  
- **MySQL** atau **SQLite** untuk database  
- **Docker** dan **Docker Compose**  

---

## 💻 Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di sistem lokal Anda:

### 1. Clone Repository  

Clone repository dari GitHub:  

```bash
git clone https://github.com/IlhamGhaza/laravel-fitcount.git
cd laravel-fitcount
```

### 2. Konfigurasi Environment

Salin file `.env.example` ke `.env`  
linux

 ```bash
cp .env.example .env
```

windows

 ```bash
copy .env.example .env
```

### 3. Generete Key

```bash
php artisan key:generate
```

### 4. Jalankan perintah berikut untuk membuat tabel database

Instalasi dependensi Laravel dan Node.js:
    ````bash
    composer install
    npm install
    ```

### 5. Set up database

- Update the `.env` file with your database credentials
- Run migrations and seeders:

```bash
php artisan migrate:fresh --seed
```

note : ubah password user di file database/seeders/DatabaseSeeder.php

### 6. Jalankan server

```bash
composer dev
```

visit

```bash
http://localhost:8000
```

## 🐳 Menggunakan Docker

Jika Anda ingin menjalankan proyek ini menggunakan **Docker**:

### 1. Install Docker dan Docker Compose  

Pastikan Docker dan Docker Compose sudah terpasang di sistem Anda.

### 2. Build Docker Containers  

Jalankan perintah berikut untuk membangun dan menjalankan container:  

```bash
docker-compose up -d
```

### 3. Instalasi Dependencies  

Masuk ke dalam container aplikasi dan instal dependency Laravel:  

```bash
docker exec -it laravel-app bash
composer install
npm install
npm run dev
php artisan key:generate
php artisan migrate
```

### 4. Akses Aplikasi

Setelah container berjalan, buka browser dan akses:  

```bash
http://localhost:8000
```

---

## 📂 Struktur Proyek

Berikut adalah struktur utama dari proyek ini:

```plaintext
laravel-fitcount/
├── app/                # File backend Laravel (controllers, models)
├── database/           # Database migrations dan seeders
├── public/             # File statis publik (CSS, JS, images)
├── resources/          # Views dan assets
├── routes/             # Konfigurasi routes (web.php, api.php)
├── docker-compose.yml  # Konfigurasi Docker Compose
├── Dockerfile          # Dockerfile untuk aplikasi Laravel
└── .env                # Konfigurasi environment
```

---

## 🧑‍💻 Cara Penggunaan

1. **Registrasi Akun:** Daftar melalui halaman registrasi.  
2. **Login:** Masuk dengan akun yang sudah terdaftar.  
3. **Kelola Aktivitas:** Tambah aktivitas, pantau statistik, dan lihat laporan progres Anda.  

---

## 🤝 Kontribusi

Kontribusi sangat dihargai! Jika Anda ingin berkontribusi:

1. Fork repository ini  
2. Buat branch fitur baru: `git checkout -b feature-nama-fitur`  
3. Commit perubahan: `git commit -m 'Menambahkan fitur ...'`  
4. Push ke branch Anda: `git push origin feature-nama-fitur`  
5. Buat **Pull Request**

---

## 📜 Lisensi

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
Proyek ini menggunakan lisensi **MIT**. Lihat [LICENSE](LICENSE) untuk informasi lebih lanjut.

---

## 📧 Kontak

Jika Anda memiliki pertanyaan atau saran, silakan hubungi:

- **Ilham Ghaza**  
- Email: [IlhamGhaza](mailto:cb7ezeur@selenakuyang.anonaddy.com)
- GitHub: [IlhamGhaza](https://github.com/IlhamGhaza)  
