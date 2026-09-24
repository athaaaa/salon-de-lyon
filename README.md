# 💇‍♀️ Salon De Lyon - Sistem Booking

Aplikasi web berbasis Laravel untuk manajemen booking layanan salon, jadwal stylist, dan laporan transaksi.

---

## Cara Menjalankan Project di Device/Laptop Baru

Jika ingin menjalankan project ini di laptop/device baru, ikuti langkah-langkah berikut:

### 1. Prasyarat
Pastikan laptop sudah terinstall:
- PHP (v8.1 atau yang lebih baru)
- Composer
- Git
- Web Server & Database (Laragon atau XAMPP)

---

### 2. Langkah Instalasi

1. **Clone Repository dari GitHub**
   Buka terminal/CMD di folder web server kamu (misal: `C:\laragon\www\`), lalu jalankan:
   ```bash
   git clone [https://github.com/athaaaa/salon-de-lyon.git](https://github.com/athaaaa/salon-de-lyon.git)
   cd salon-de-lyon
   ```
   ```bash
   cd salon-de-lyon
   ```

a. **Install Package Composer**
   ```bash
   composer install
```
b. **Buat File Konfigurasi Environment (.env)**
Duplikat file .env.example menjadi .env:
```bash
copy .env.example .env
```
c. Generate Application Key
```bash
php artisan key:generate
```

d. **Setup & Import Database**

Buka HeidiSQL / phpMyAdmin, lalu buat database baru bernama salon_de_lyon.
Buka file .env di project, pastikan pengaturannya sesuai:
Cuplikan kode
```bash
DB_DATABASE=salon_de_lyon
DB_USERNAME=root
DB_PASSWORD=
```
Import file database.sql (yang tersedia di dalam folder utama project ini) ke dalam database salon_de_lyon yang baru dibuat.

e. **Jalankan Aplikasi**
```bash
php artisan serve
```
Buka browser dan akses link: http://127.0.0.1:8000


---

---

## 🌐 Cara Instalasi & Penggunaan ngrok (Akses HP dari Jaringan Lain)

Menggunakan ngrok memungkinkan aplikasi diakses dari HP tanpa harus berada di jaringan Wi-Fi yang sama dengan laptop.

### 1. Download & Instalasi ngrok

1. **Download ngrok**
   Unduh installer ngrok untuk Windows di situs resminya: [https://ngrok.com/download](https://ngrok.com/download)
2. **Ekstrak File**
   Ekstrak file `.zip` yang diunduh. Pindahkan file `ngrok.exe` ke folder yang mudah diakses (misal: `C:\ngrok` atau langsung ke folder `C:\Windows\System32` agar bisa dipanggil di CMD dari mana saja).

---

### 2. Hubungkan Akun (Authtoken)

1. Buat akun gratis di [https://dashboard.ngrok.com/signup](https://dashboard.ngrok.com/signup).
2. Setelah login, buka menu **Your Authtoken** di dashboard.
3. Buka CMD/Terminal di laptop, lalu jalankan perintah berikut untuk menyimpan token kamu:
   ```bash
   ngrok config add-authtoken TOKEN_KAMU_DI_SINI

---

### 3. Cara Menjalankan ngrok

a. **Jalankan Server Laravel**

Buka terminal/CMD pertama dan jalankan:

```bash
php artisan serve
```

b. ***Jalankan ngrok***

Buka jendela CMD/Terminal baru, lalu jalankan perintah ngrok mengarah ke port 8000:

```bash
ngrok http 8000
```
c. ***Akses dari HP***

Salin URL publik HTTPS yang muncul di terminal ngrok (contoh: https://xxxx-xxxx.ngrok-free.app).

Buka browser di HP kamu dan tempelkan URL tersebut.
