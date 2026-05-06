# SIMANIS
>sistem management siswa

***

# Rancangan Sistem Manajemen Sekolah (5 Panel)

Sistem ini dirancang dengan arsitektur **Multi-Role Access Control**, di mana satu database melayani lima antarmuka yang berbeda sesuai kebutuhan masing-masing pengguna.

---

## 🎯 Konsep Dasar
Setiap panel bertindak sebagai **gerbang masuk (gate)** yang berbeda ke dalam sistem yang sama. Hak akses dibatasi agar data tetap aman dan alur kerja teratur.

## 👥 Peran dan Tanggung Jawab

| Panel | Pengguna | Fungsi Utama |
| :--- | :--- | :--- |
| **Super Admin** | Tim IT / Pimpinan | Manajemen sistem, backup data, dan kontrol semua akun. |
| **Akademik** | Staff Kurikulum | Pengaturan jadwal, kelas, semester, dan administrasi rapor. |
| **Guru** | Pengajar | Input nilai, presensi siswa, dan manajemen materi ajar. |
| **Siswa** | Murid | Cek jadwal, melihat nilai, presensi, dan unduh materi. |
| **Orang Tua** | Wali Murid | Monitoring nilai dan kehadiran anak secara real-time. |

---

## 🔐 Hirarki Akses



1. **Super Admin**: Memiliki kontrol penuh atas seluruh sistem.
2. **Akademik**: Mengatur infrastruktur data (kelas & jadwal).
3. **Guru**: Operator data (input nilai & absen).
4. **Siswa & Orang Tua**: Konsumen data (hanya melihat/read-only).

---

## 📋 Struktur Menu Per Panel

### 🟢 1. Panel Super Admin (System Controller)
* **Dashboard:** Statistik penggunaan sistem.
* **User Management:** Tambah, edit, nonaktifkan akun (semua role).
* **Audit Log:** Catatan riwayat aktivitas login dan perubahan data.
* **System Settings:** Backup database dan konfigurasi sekolah.

### 🔵 2. Panel Akademik (Curriculum Manager)
* **Tahun Ajaran:** Pengaturan semester aktif.
* **Manajemen Kelas:** Plotting wali kelas dan pembagian siswa.
* **Penjadwalan:** Input jadwal mata pelajaran per kelas.
* **Pusat Rapor:** Validasi nilai akhir dan cetak rapor massal.

### 🟠 3. Panel Guru (Instructional Operator)
* **Jadwal Mengajar:** Daftar kelas yang diampu.
* **E-Presensi:** Input kehadiran siswa per jam pelajaran.
* **E-Nilai:** Input nilai tugas, UTS, dan UAS.
* **Materi:** Upload modul pembelajaran.

### 🟡 4. Panel Siswa (Learning Portal)
* **Jadwal Pelajaran:** Kalender mingguan personal.
* **Transkrip Nilai:** Melihat progres nilai per semester.
* **Rekap Absensi:** Laporan kehadiran mandiri.
* **LMS:** Download materi dari guru.

### 🔴 5. Panel Orang Tua (Monitoring Tool)
* **Switch Student:** Pilih anak (jika memiliki lebih dari satu anak di sekolah).
* **Monitoring:** Grafik kehadiran dan perkembangan nilai anak.
* **Notifikasi:** Alert jika anak tidak hadir (Alfa).

---

## 🛠️ Panduan Implementasi (Teknis)

### 1. Struktur Database Minimal
* `users` (id, email, password, **role**)
* `teachers` (id, user_id, nip, nama)
* `students` (id, user_id, nis, parent_id, kelas_id)
* `schedules` (id, kelas_id, mapel_id, teacher_id, hari, jam)
* `grades` (id, student_id, mapel_id, nilai)

### 2. Alur Pengembangan
1.  **Auth System:** Gunakan Middleware untuk membatasi akses URL berdasarkan `role`.
2.  **Panel Guru:** Fokus pada CRUD Nilai dan Absensi (fitur utama).
3.  **Panel Akademik:** Buat relasi antara guru, siswa, dan kelas.
4.  **Panel Monitoring:** Hubungkan `parent_id` ke data `students`.

---

## 💡 Prinsip Keamanan
* **One Account, One Role:** Menghindari kerancuan data.
* **Read-Only Access:** Siswa dan Orang Tua dilarang keras memiliki fungsi *Update/Delete* pada data nilai.
* **Impersonation:** Super Admin memiliki fitur "Login As" untuk membantu user yang mengalami kendala teknis.

***