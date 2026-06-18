# ☁️ Tugas Besar Komputasi Awan 2026 - Kelompok SI4703

Proyek ini adalah implementasi **Arsitektur Cloud Multi-Instance** di Amazon Web Services (AWS). Sistem ini dirancang untuk mendemonstrasikan fungsi pembagian beban (*Load Balancing*) pada aplikasi web dinamis yang terhubung ke *Database* terpusat.

## 👥 Tim Pengembang (SI4703)
- **Muhammad Fadli Deandri Putra** (102022300018) - Project Manager
- **Naswa Gyna Sahira** (102022300287) - UI Front-End
- **Muhammad Varel Arifianta** (102022300088) - Backend & DB
- **Mellafesa Rofida** (102022330095) - Cloud Web Tier
- **Andi Meuthia Rionawita** (102022300011) - Cloud Network & DB Tier

---

## 🏗️ Arsitektur Sistem

Proyek ini menggunakan 3 *Virtual Machine* (EC2) dan 1 *Load Balancer* di AWS:
1. **AWS Application Load Balancer (ALB):** Berfungsi sebagai pintu masuk utama yang membagi trafik HTTP secara bergantian (Round-Robin) ke Web Server 1 dan Web Server 2.
2. **2x EC2 Web Server (Apache + PHP):** Menjalankan *source code* aplikasi web dan logika *Load Balancer Indicator*.
3. **1x EC2 Database Server (MySQL):** *Dedicated Server* yang hanya menyimpan *database* secara terpusat agar data tetap sinkron diakses dari berbagai *web server*.

---

## 📂 Struktur Folder
```text
/
├── actions/                  # Logika PHP Backend (Login, Logout)
├── database/                 # Berisi schema.sql untuk inisialisasi Database
├── includes/                 # File koneksi DB dan Simulator Server ID
├── assets/images/            # Penyimpanan foto lokal anggota kelompok
├── index.php                 # Halaman utama (Form Login)
├── dashboard.php             # Halaman Beranda setelah Login
└── anggota.php               # Menampilkan data fetch dari Database
```

---

## 🚀 Panduan Deployment Cloud (AWS)
*Bagian ini ditujukan untuk Tim Infrastruktur Cloud (Mella & Meuthia).*

### 1. Tahap Database (Oleh: Meuthia)
1. Buka AWS Console, *launch* **1 EC2 Instance** (Ubuntu/Linux).
2. Install MySQL Server: `sudo apt update && sudo apt install mysql-server`.
3. Buat database `db_cloud`.
4. Import *file* `database/schema.sql` ke dalam MySQL.
5. Buat *user* MySQL (misal: `admin_cloud`) dengan akses jarak jauh (remote access) dan beri hak akses penuh ke `db_cloud`.
6. Catat **IP Private** EC2 ini.

### 2. Tahap Webserver (Oleh: Mella)
1. *Launch* **2 EC2 Instance** terpisah (Web 1 & Web 2).
2. Install Apache & PHP: `sudo apt update && sudo apt install apache2 php php-mysql`.
3. *Clone/Copy* seluruh isi repositori ini ke folder `/var/www/html/` di kedua instance.
4. Buka `includes/config.php` dengan teks editor. Ubah `localhost` menjadi **IP Private** dari server *database* milik Meuthia.
5. Konfigurasi Server ID secara hardcode:
   - Di Web 1, edit `includes/check-id.php`: isi `$server_id = "1";`
   - Di Web 2, edit `includes/check-id.php`: isi `$server_id = "2";`

### 3. Tahap Load Balancer (Oleh: Meuthia)
1. Masuk ke EC2 Dashboard > **Load Balancers**.
2. Buat Application Load Balancer (ALB) untuk *Internet-facing*.
3. Buat *Target Group* berisikan **EC2 Web 1** dan **EC2 Web 2**.
4. Arahkan ALB ke *Target Group* tersebut.
5. Tunggu status *Target Group* menjadi **Healthy**.

### 4. Tahap Pengujian
Buka **DNS Name** milik ALB di *browser*.
Coba *refresh* halaman berulang kali. Jika Anda melihat tulisan **"Server Instance: 1"** berubah menjadi **"Server Instance: 2"**, maka arsitektur *Load Balancer* sudah berhasil berjalan sempurna! 🎉

---
*Dibuat menggunakan PHP Native & Bootstrap 5 untuk Tugas Besar Komputasi Awan 2026.*