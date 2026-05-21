# 💰 Sistem Penggajian Karyawan (Payroll System)

![CodeIgniter](https://img.shields.io/badge/Framework-CodeIgniter%203-EE4323?style=for-the-badge&logo=codeigniter&logoColor=white)
![PHP](https://img.shields.io/badge/Language-PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

Sistem Penggajian Karyawan berbasis web ini dibangun khusus untuk memenuhi persyaratan kelulusan Skripsi. Dikembangkan menggunakan framework **CodeIgniter 3**, sistem ini dirancang untuk mengotomatisasi dan menyederhanakan proses perhitungan gaji, pengelolaan absensi, pajak, hingga cetak slip gaji secara efisien.

---

## 👤 Profil Pengembang

- **Nama:** Zayyan Dzulfalah
- **Program Studi:** S1 Sistem Informasi
- **Fakultas:** Teknologi & Informatika
- **Institusi:** Universitas Bina Sarana Informatika

---

## 🛠️ Fitur Utama Sistem

Sistem ini menggunakan konsep _Multi-User Role_ yang memisahkan hak akses antara bagian Keuangan (Finance) dan Personalia (HRD).

### 💵 1. Fitur Staff (Finance)

Fokus pada pengelolaan administrasi keuangan, perhitungan, dan pemrosesan hak finansial karyawan:

- [x] **Manajemen Gaji:** Memperbarui (_update_) data komponen gaji karyawan.
- [x] **Manajemen Pajak & Lembur:** Mengelola potongan pajak dan kalkulasi lembur harian/bulanan.
- [x] **Pelaporan Efisien:** Mencetak Laporan Lembur, Laporan Gaji Bulanan, dan **Slip Gaji Karyawan**.

### 👥 2. Fitur HRD

Fokus pada pengelolaan data SDM dan operasional sebagai dasar utama perhitungan payroll:

- [x] **Master Data:** Mengelola data detail karyawan dan struktur jabatan.
- [x] **Manajemen Operasional:** Mengelola rekap absensi harian dan memantau status data gaji terkini.
- [x] **Pelaporan SDM:** Mencetak Laporan Absensi karyawan secara periodik.

---

## 🔐 Akun Demonstrasi (Gunakan untuk Login)

| Role                | Username | Password | Otoritas                                 |
| :------------------ | :------- | :------- | :--------------------------------------- |
| **HRD**             | `hrd`    | `123456` | Kelola Karyawan, Jabatan, & Absensi      |
| **Staff (Finance)** | `budi`   | `123`    | Kelola Gaji, Lembur, Pajak, & Cetak Slip |

---

## 🚀 Alur Penggunaan Sistem

1.  **Autentikasi:** Masuk ke sistem menggunakan akun resmi yang terdaftar melalui halaman Login.
2.  **Navigasi Dashboard:** Pilih menu pada _sidebar_ sesuai dengan hak akses (Role) Anda.
3.  **Input Data:** Isi formulir data yang diperlukan (Karyawan/Absensi/Lembur) dengan valid.
4.  **Eksekusi & Cetak:** Lakukan pemrosesan data atau langsung cetak laporan yang dibutuhkan.
5.  **Selesai:** Sistem akan memperbarui database secara _real-time_.

---

## 🤝 Kontribusi & Pengembangan

Proyek ini bersifat terbuka untuk siapa saja yang ingin berkontribusi—baik dalam bentuk optimasi kode (_refactoring_), pembuatan _User Manual Book_, maupun pemanfaatan sistem sebagai bahan ajar mahasiswa untuk memperkecil kesenjangan pendidikan teknologi.

> 💡 **Tertarik berkontribusi?** Silakan buat postingan baru pada menu **Issues** di repositori ini untuk mendiskusikan pengembangan lebih lanjut.

---

## 📩 Kritik & Saran

Jika Anda menemukan _bug_, memiliki pertanyaan, atau ingin memberikan saran yang membangun, jangan ragu untuk menghubungi saya melalui:

- **Email:** [zayyandzul@gmail.com](mailto:zayyandzul@gmail.com)

---

Copyright © 2026 Zayyan Dzulfalah. Built with 💻 and ☕.
