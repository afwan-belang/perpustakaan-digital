# 📚 DigiLib SMK: The Next-Gen Library Ecosystem

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.0-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![PHP](https://img.shields.io/badge/PHP-8.5-777BB4?style=for-the-badge&logo=php)](https://php.net)

**DigiLib SMK** adalah platform manajemen perpustakaan terpadu yang dirancang untuk mendefinisikan ulang cara sekolah mengelola literasi. Menggabungkan kemudahan **Perpustakaan Digital** dengan ketegasan sistem **Sirkulasi Buku Fisik** dalam satu antarmuka yang modern, responsif, dan elegan.

---

## ✨ Fitur Unggulan

### 🏛️ Integrated Library Management (Physical & Digital)
Dual-ecosystem yang memungkinkan pengelolaan buku cetak dan buku digital (PDF) secara berdampingan tanpa tumpang tindih.

### 🛡️ Smart Borrowing Engine (SOP-Driven)
Alur peminjaman buku fisik yang mengadopsi standar operasional perpustakaan nyata:
* **Request & Approval System:** User mengajukan, Admin memverifikasi.
* **Auto-Stock Management:** Stok berkurang otomatis saat *Approved* dan bertambah saat *Returned*.
* **Borrowing Limit:** Sistem cerdas yang membatasi maksimal 3 peminjaman aktif per user untuk menjamin keadilan akses.

### 💎 Premium UI/UX Design
Antarmuka tingkat tinggi dengan pendekatan desain terkini:
* **Glassmorphism Layout:** Efek transparansi dan blur yang memberikan kesan mewah.
* **Bento Grid Catalog:** Tata letak katalog yang terorganisir dan informatif.
* **Seamless Theme Switching:** Dark & Light mode yang tersinkronisasi hingga ke komponen terkecil.

### 🔐 Enterprise-Grade Security
* **Role-Based Access Control (RBAC):** Pemisahan akses yang sangat ketat antara Admin dan Siswa.
* **Bcrypt Encryption:** Proteksi kredensial pengguna dengan algoritma hashing standar industri.

---

## 🛠️ Tech Stack

### Backend Powerhouse
* **Core Framework:** Laravel 12.x
* **Language:** PHP 8.5+
* **Authentication:** Laravel Breeze (Scaffolded)
* **Database:** MySQL with Eloquent ORM

### Frontend Excellence
* **Styling:** Tailwind CSS (Custom Theme)
* **Asset Bundler:** Vite
* **Interactivity:** Alpine.js & Vanilla JavaScript
* **Architecture:** Atomic Blade Components

### Environment & Tools
* **Version Control:** Git
* **Package Managers:** Composer & NPM
* **Storage:** Symlinked Local Disk Storage

---
## 🎥 Video Demo

https://github.com/user-attachments/assets/bf5126ff-42a4-4f91-95dd-2120e24c7f6b

## 📸 Screen Shoot
* **Landing Page**

 <table border="0">
  <tr>
    <td>
      <p align="center"><b>Dashboard Admin</b></p>
      <img src="assets/images/LandingPage.png" width="400">
    </td>
    <td>
      <p align="center"><b>Katalog User</b></p>
      <img src="docs/screenshots/user-katalog.png" width="400">
    </td>
  </tr>
  <tr>
    <td>
      <p align="center"><b>Detail Buku (Glassmorphism)</b></p>
      <img src="docs/screenshots/book-detail.png" width="400">
    </td>
    <td>
      <p align="center"><b>Riwayat Peminjaman</b></p>
      <img src="docs/screenshots/history.png" width="400">
    </td>
  </tr>
</table>
