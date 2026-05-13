# 📘 Dokumentasi Pengembangan CodeIgniter 4

Dokumentasi ini berisi panduan instalasi, alur kerja pengembangan (*development*), dan standarisasi build untuk aplikasi PAUD.

## 📋 Prasyarat Sistem

Sebelum memulai, pastikan mesin pengembangan Anda memenuhi spesifikasi berikut:

* **PHP:** Versi 8.2 atau lebih tinggi.
* **Composer:** Versi 2.0 atau lebih tinggi.
* **Ekstensi PHP:** `intl`, `mbstring`, `json`, `curl`, `sqlite3` atau `mysqli`.
* **Web Server:** Apache, Nginx, atau gunakan bawaan Spark.

---

## 🚀 Instalasi Awal

Ikuti langkah-langkah berikut untuk menyiapkan proyek di lokal:

1. **Clone Repositori**
```bash
git clone https://github.com/Airmax21/SAW-PAUD.git
cd SAW-PAUD

```


2. **Instalasi Dependencies**

```bash
   composer install

```

3. **Konfigurasi Environment**
Salin file contoh environment dan sesuaikan konfigurasinya:

```bash
   cp env .env

```

Buka file `.env` dan pastikan pengaturan berikut aktif:

```env
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost:8080/'
   
   # Jika menggunakan MySQL
   database.default.hostname = localhost
   database.default.database = nama_db_paud
   database.default.username = root
   database.default.password = 
   database.default.DBDriver = MySQLi

```

4. **Migrasi Database & Seeding**
Jalankan migrasi untuk membuat tabel dan seeder untuk data awal (seperti Tabel Kelas):
```bash
php spark migrate

```

---

## 🛠️ Alur Kerja Pengembangan (Development)

### Menjalankan Server Lokal

Untuk melihat hasil koding secara *real-time*, jalankan perintah:

```bash
php spark serve

```

Akses melalui browser di: `http://localhost:8080`

### Perintah Penting (CLI Spark)

| Perintah | Deskripsi |
| --- | --- |
| `php spark make:controller <Name>` | Membuat Controller baru |
| `php spark make:model <Name>` | Membuat Model baru |
| `php spark make:migration <Name>` | Membuat file migrasi tabel |
| `php spark migrate:refresh` | Reset dan jalankan ulang semua migrasi |
| `php spark cache:clear` | Menghapus cache aplikasi |

---

## 🏗️ Panduan Build & Deployment (Production)

Saat aplikasi siap diunggah ke server produksi, ikuti protokol berikut:

### 1. Optimasi Dependensi

Hapus *development tools* agar ukuran aplikasi lebih kecil dan lebih aman:

```bash
composer install --no-dev --optimize-autoloader

```

### 2. Pengaturan Keamanan Environment

Ubah mode environment di `.env` menjadi **production**:

```env
CI_ENVIRONMENT = production

```

*Efek: Debug toolbar akan hilang dan pesan error teknis tidak akan tampil ke user.*

### 3. Struktur Folder Server

Sangat disarankan untuk mengarahkan **Document Root** web server ke folder `/public`:

* **Apache:** Pastikan `AllowOverride All` aktif agar `.htaccess` terbaca.
* **Nginx:** Arahkan `root` ke path `/project/public`.

---

## 📁 Struktur Arsitektur (Service Pattern)

Proyek ini menggunakan **Service Pattern** untuk menjaga kode tetap bersih:

* `app/Controllers`: Menangani request/response.
* `app/Services`: Tempat logika bisnis utama (Calculation, CRUD logic).
* `app/Models`: Definisi skema database.
* `app/Entities`: Representasi objek data tunggal.
* `app/Views`: Template antarmuka menggunakan Tailwind CSS.

---

> **Note:** Selalu jalankan `php spark migrate` setiap kali ada perubahan skema database dari anggota tim lain.