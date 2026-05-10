# BRD - Sistem Akademik & Informasi Siswa Yayasan Maleo

## 1. Ringkasan Eksekutif
Yayasan Maleo menyelenggarakan pendidikan gratis SMP dan SMA dengan pendekatan Kurikulum Merdeka dan Outcome-Based Education (OBE). Saat ini, proses pencatatan akademik, pelacakan capaian siswa terhadap Profil Lulusan (PL) dan Capaian Pembelajaran Lulusan (CPL), pemilihan stream (Akademik, Vokasi, Wirausaha), serta pemantauan milestone masih dilakukan secara manual (kertas, spreadsheet terpisah). Hal ini menyulitkan guru, orang tua, dan pengurus yayasan dalam memantau perkembangan siswa secara akurat dan tepat waktu.

**Tujuan bisnis** dari pengembangan sistem ini adalah:
- Meningkatkan efektivitas pelaksanaan Kurikulum Merdeka & OBE di Yayasan Maleo.
- Memudahkan pencatatan dan pelaporan capaian siswa berbasis CPL.
- Mendukung proses pemilihan stream yang objektif dan terdokumentasi.
- Menyediakan data outcome lulusan (tracer study) untuk evaluasi yayasan.
- Meningkatkan transparansi kepada orang tua siswa.

Sistem akan diimplementasikan secara bertahap dalam 6-9 bulan, dengan prioritas pada fitur pencatatan capaian CPL, rapor digital, dan portofolio siswa.

## 2. Tujuan Bisnis (Business Objectives)

| No | Tujuan Bisnis | Indikator Keberhasilan |
|----|---------------|------------------------|
| 1 | Meningkatkan akurasi pencatatan capaian CPL siswa | 95% data CPL siswa tercatat lengkap per semester |
| 2 | Mempercepat proses pelaporan rapor | Waktu cetak rapor turun dari 5 hari/minggu menjadi < 1 hari |
| 3 | Mendukung pemilihan stream yang tepat | 90% siswa memilih stream berdasarkan rekomendasi sistem + konselor |
| 4 | Meningkatkan keterlibatan orang tua | 70% orang tua aktif login minimal 1x per bulan |
| 5 | Mengukur outcome lulusan | 80% alumni memberikan respons tracer study dalam 1 tahun setelah lulus |

## 3. Lingkup Proyek (In-Scope & Out-of-Scope)

### In-Scope (Wajib dikerjakan)
- Manajemen data siswa, guru, kelas, mata pelajaran, periode tahun ajaran.
- Pencatatan capaian CPL per siswa per mata pelajaran (mengacu pada CPL SMP & SMA yang sudah dirumuskan).
- Input nilai akademik dan rubrik asesmen OBE (sederhana).
- Rapor digital yang menampilkan nilai + capaian CPL + deskripsi.
- Portofolio digital siswa (unggah file, komentar guru).
- Modul pemilihan stream (untuk siswa kelas 9) dengan rekomendasi konselor.
- Dashboard untuk siswa, orang tua, guru, kepala sekolah.
- Notifikasi dasar (email atau WhatsApp).
- Laporan ekspor (Excel/PDF) untuk pengurus yayasan.
- Tracer study (form online + dashboard outcome).

### Out-of-Scope (Tidak dikerjakan di tahap awal)
- Aplikasi mobile native (cukup web responsif).
- Integrasi dengan sistem keuangan yayasan (SPP, donasi).
- Sistem manajemen perpustakaan/TBM (akan terpisah atau integrasi tahap lanjutan).
- Chat atau forum diskusi antar siswa.
- Pembuatan konten pembelajaran (LMS penuh). Fokus pada pencatatan dan pelaporan.

## 4. Pemangku Kepentingan (Stakeholders) & Kebutuhan Mereka

| Stakeholder | Peran | Kebutuhan Bisnis |
|-------------|------|------------------|
| **Siswa** | Pengguna utama | Melihat nilai, capaian CPL, portofolio, jadwal, memilih stream, mengisi tracer. |
| **Orang Tua/Wali** | Pemantau | Melihat perkembangan anak (nilai, kehadiran, portofolio), mendapat notifikasi. |
| **Guru / Relawan** | Pengisi data | Mencatat nilai, mengisi rubrik capaian CPL, memberi komentar portofolio, mencetak rapor per siswa. |
| **Wali Kelas / Konselor** | Pembimbing | Memberi rekomendasi stream, memantau progres kelas, memoderasi portofolio. |
| **Kepala Sekolah** | Pengelola | Melihat dashboard capaian CPL per kelas/angkatan, laporan milestone, outcome lulusan. |
| **Pengurus Yayasan** | Penjamin visi | Memantau efektivitas kurikulum (data outcome lulusan, persentase capaian CPL, serapan kerja/kuliah). |
| **Admin / Operator** | Pengelola teknis | Mengelola akun, kelas, mata pelajaran, periode, dan backup data. |

## 5. Kebutuhan Bisnis (Business Requirements) – Daftar BR

Setiap BR memiliki kode unik dan prioritas (High/Medium/Low).

| Kode | Kebutuhan Bisnis | Prioritas | Terkait Tujuan Bisnis |
|------|------------------|-----------|------------------------|
| BR-01 | Sistem harus mampu mencatat profil siswa (nama, NIS, kelas, orang tua, kontak) secara terpusat. | High | 1 |
| BR-02 | Sistem harus mendukung pencatatan capaian CPL (SMP 6 CPL, SMA 7 CPL) per siswa per mata pelajaran per periode. | High | 1 |
| BR-03 | Sistem harus menyediakan rapor digital yang mencetak nilai angka (0-100) plus tingkat capaian CPL (Belum, Mulai, Berkembang, Mahir) dan deskripsi naratif. | High | 2 |
| BR-04 | Siswa harus bisa mengunggah portofolio (file gambar/PDF/video) yang dapat dilihat dan dikomentari guru. | Medium | 1 |
| BR-05 | Sistem harus menyediakan modul pemilihan stream untuk siswa kelas 9, yang menampilkan rekomendasi otomatis berdasarkan nilai, capaian CPL, dan minat yang diisi. Konselor dapat memberi rekomendasi tambahan. | High | 3 |
| BR-06 | Orang tua harus memiliki akun terpisah yang hanya dapat melihat data anaknya sendiri. | High | 4 |
| BR-07 | Sistem harus mengirim notifikasi ke email atau WhatsApp (via gateway) untuk nilai baru, pengumuman, atau batas tugas. | Medium | 4 |
| BR-08 | Kepala sekolah dan pengurus yayasan dapat melihat dashboard yang menampilkan ringkasan capaian CPL per kelas, persentase siswa yang mencapai level AN (literasi/numerasi), dan progres milestone (misal: kelas 8 sudah ikut bazar). | High | 1,5 |
| BR-09 | Alumni dapat mengisi tracer study online (status bekerja, kuliah, wirausaha, lokasi, pendapatan). Sistem harus mencatat respons per angkatan. | High | 5 |
| BR-10 | Sistem harus menghasilkan laporan outcome lulusan: persentase bekerja, kuliah, wirausaha per tahun angkatan. | High | 5 |
| BR-11 | Data harus dapat diekspor ke Excel/CSV untuk kebutuhan pelaporan ke donatur atau pemerintah. | Medium | 5 |
| BR-12 | Sistem harus memiliki kontrol akses berbasis peran (admin, guru, wali kelas, konselor, kepala sekolah, orang tua, siswa). | High | 1 |

## 6. Proses Bisnis Utama (Gambaran Alur)

### Proses 1: Pencatatan Capaian CPL oleh Guru
1. Guru login, pilih kelas dan mata pelajaran.
2. Untuk setiap tugas/ulangan/proyek, guru memilih CPL yang relevan.
3. Guru menilai siswa menggunakan rubrik (atau nilai langsung).
4. Sistem mengakumulasi menjadi capaian akhir CPL per siswa per periode.
5. Guru dapat melihat ringkasan dan mencetak rapor kapan saja.

### Proses 2: Pemilihan Stream di Kelas 9
1. Siswa mengisi formulir minat (bisa online).
2. Sistem menghitung skor rekomendasi berdasar nilai, capaian CPL-5 (kewirausahaan), CPL-4 (keterampilan), CPL-3 (numerasi), dan minat.
3. Konselor melihat hasil, memberi rekomendasi final.
4. Siswa memilih stream (Akademik/Vokasi/Wirausaha) di sistem.
5. Sistem mencatat pilihan dan mempersiapkan penempatan kelas 10.

### Proses 3: Tracer Study Alumni
1. Setelah kelulusan (6 bulan), sistem mengirim notifikasi ke email/WA alumni.
2. Alumni mengisi form sederhana (pekerjaan, kuliah, wirausaha, dll).
3. Orang tua atau guru juga dapat mengisi jika alumni tidak responsif.
4. Dashboard yayasan menampilkan outcome secara real-time.

## 7. Asumsi & Ketergantungan

| Asumsi | Risiko jika tidak terpenuhi |
|--------|----------------------------|
| Yayasan memiliki akses internet yang stabil di sekolah (minimal 10 Mbps). | Sistem tidak bisa diakses; perlu fallback offline (misal: input via spreadsheet lalu sinkronisasi). |
| Guru dan staf memiliki perangkat (laptop/HP) dan mau menggunakan sistem. | Perlu pelatihan intensif dan pendampingan. |
| Data siswa dan orang tua (nomor HP, email) tersedia dan valid. | Notifikasi gagal terkirim. |
| Yayasan memiliki anggaran untuk hosting dan maintenance (minimal Rp 1-2 juta/bulan jika pakai cloud). | Sistem bisa berhenti beroperasi. |

## 8. Kriteria Keberhasilan (Business Success Metrics)

| Metrik | Target | Cara Ukur |
|--------|--------|-----------|
| Adopsi sistem oleh guru | 90% guru aktif input nilai minimal 1x per minggu setelah 2 bulan | Log aktivitas sistem |
| Adopsi oleh orang tua | 70% orang tua login minimal 1x per bulan | Log login |
| Kelengkapan data CPL | 95% siswa memiliki data capaian CPL untuk semua mata pelajaran setiap semester | Laporan sistem |
| Waktu penyusunan rapor | Rapor dapat dicetak dalam < 5 menit per kelas | Simulasi |
| Respons tracer study | 80% alumni angkatan terakhir terisi dalam 6 bulan setelah kelulusan | Dashboard tracer |
| Pemilihan stream tepat | 90% siswa yang memilih stream tidak mengubah di tahun berikutnya | Data historis |

## 9. Batasan & Risiko Bisnis

| Risiko | Dampak | Mitigasi |
|--------|--------|----------|
| Guru enggan beralih dari kertas ke sistem | Data tidak terisi, rapor tidak akurat | Beri insentif non-finansial (penghargaan), pelatihan intensif, buat antarmuka sesederhana mungkin |
| Koneksi internet tidak stabil di lokasi tertentu | Siswa tidak bisa akses portofolio | Sediakan mode offline (misal: input via Google Form yang bisa diisi offline) |
| Keamanan data siswa bocor | Kepercayaan orang tua hilang | Gunakan enkripsi, akses berbasis peran, dan hosting yang aman (ISO 27001) |
| Anggaran terbatas | Hosting dan pengembangan terhambat | Mulai dengan open source (Moodle) + Google Workspace, alokasikan minimal |

## 10. Rekomendasi Pendekatan Implementasi (Non-Teknis)

- **Fase 0 (Persiapan, 1 minggu)**: Sosialisasi ke orang tua dan guru, kumpulkan data siswa & kontak.
- **Fase 1 (Bulan 1-2)**: Gunakan kombinasi **Google Classroom + Spreadsheet + Form** sebagai prototipe untuk menguji alur.
- **Fase 2 (Bulan 3-4)**: Implementasi sistem custom atau Moodle dengan modul CPL dan portofolio (sesuai PRD).
- **Fase 3 (Bulan 5-6)**: UAT, pelatihan, dan go live untuk satu angkatan terlebih dahulu (misal kelas 7).
- **Fase 4 (Bulan 7-9)**: Evaluasi, perluasan ke semua kelas, dan peluncuran tracer study.

## 11. Persetujuan

| Stakeholder | Nama | Tanda Tangan | Tanggal |
|-------------|------|--------------|---------|
| Kepala Sekolah SMP |  |  |  |
| Kepala Sekolah SMA |  |  |  |
| Pengurus Yayasan |  |  |  |
| Perwakilan Guru |  |  |  |
| Perwakilan Orang Tua |  |  |  |

---

**Dokumen ini bersifat hidup dan dapat direvisi sesuai kebutuhan bisnis yang berubah.**