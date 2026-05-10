# PRD - Sistem Akademik & Informasi Siswa Yayasan Maleo

## 1. Latar Belakang
Yayasan Maleo menyelenggarakan pendidikan gratis SMP dan SMA dengan pendekatan Kurikulum Merdeka dan Outcome-Based Education (OBE). Saat ini, proses pencatatan akademik, pelacakan capaian siswa (CPL), portofolio keterampilan, pemilihan stream, serta tracer study lulusan masih dilakukan secara manual atau terpisah-pisah. Dibutuhkan sistem informasi akademik yang terintegrasi untuk mendukung:
- Pencatatan capaian pembelajaran berbasis CPL dan milestone.
- Pemantauan perkembangan literasi & numerasi (level AN).
- Pengelolaan portofolio digital siswa.
- Pendampingan stream (Akademik, Vokasi, Wirausaha).
- Pelaporan kepada orang tua, relawan, dan mitra yayasan.

## 2. Tujuan
1. Menyediakan satu sumber data terpusat untuk semua informasi akademik dan non-akademik siswa.
2. Memudahkan guru/relawan dalam merekam dan melacak capaian siswa terhadap CPL.
3. Membantu siswa dan orang tua memantau perkembangan belajar, portofolio, dan pilihan stream.
4. Mendukung asesmen OBE (berbasis rubrik, portofolio, proyek).
5. Menghasilkan laporan tracer study lulusan untuk mengukur outcome (bekerja, kuliah, wirausaha).

## 3. Pengguna (User Persona)

| Peran | Kebutuhan Utama |
|-------|----------------|
| **Siswa** | Lihat nilai, portofolio, progres CPL, pilih stream, unduh sertifikat, isi tracer. |
| **Orang Tua/Wali** | Pantau nilai, kehadiran, portofolio anak, dapat notifikasi. |
| **Guru/Relawan** | Input nilai, isi rubrik asesmen, komentari portofolio, cetak rapor OBE. |
| **Wali Kelas / Konselor** | Kelola stream siswa, beri rekomendasi, lihat progres per kelas. |
| **Kepala Sekolah / Pengurus Yayasan** | Lihat dashboard capaian (CPL, milestone, outcome lulusan), ekspor laporan. |
| **Admin / Operator** | Kelola data master: kelas, mata pelajaran, periode, akun pengguna. |

## 4. Fitur Utama (Prioritas Tinggi, Sedang, Rendah)

### P1 – Wajib ada di rilis pertama
| Fitur | Deskripsi |
|-------|------------|
| **Manajemen Data Siswa** | CRUD data pribadi, kelas, status (aktif/lulus/keluar). |
| **Manajemen Kelas & Mata Pelajaran** | Kelas, jadwal, pengampu, periode tahun ajaran. |
| **Input Nilai & Capaian CPL per Mata Pelajaran** | Guru input nilai (0-100) dan capaian setiap CPL (misal: belum, mulai, berkembang, mahir). |
| **Rapor Digital (format OBE)** | Cetak rapor yang menampilkan nilai plus capaian CPL dan deskripsi skill. |
| **Portofolio Sederhana** | Siswa unggah file (PDF, gambar) dan guru/ortu lihat. |
| **Dashboard Ringkas untuk Siswa** | Tampilkan jadwal, nilai terbaru, capaian CPL, pengumuman. |
| **Autentikasi Peran** | Login dengan perbedaan akses. |

### P2 – Rilis kedua (1-3 bulan setelah rilis)
| Fitur | Deskripsi |
|-------|------------|
| **Pelacakan Milestone per Kelas & Stream** | Sistem otomatis mencatat capaian milestone (misal: kelas 8 sudah ikut bazar). |
| **Modul Asesmen Rubrik OBE** | Guru buat rubrik (kriteria level), nilai langsung di rubrik, hasil masuk ke CPL. |
| **Pemilihan Stream & Konseling** | Siswa pilih stream (Akademik/Vokasi/Wirausaha) di kelas 9, konselor beri rekomendasi. |
| **Notifikasi (WA/Email)** | Info nilai baru, pengumuman, batas tugas. |
| **Laporan Kehadiran** | Rekap kehadiran per siswa/kelas. |
| **Ekspor Data (CSV/PDF)** | Untuk pengurus yayasan. |

### P3 – Rilis ketiga (3-6 bulan)
| Fitur | Deskripsi |
|-------|------------|
| **Tracer Study Lulusan** | Form online untuk alumni, otomatis update status (kerja/kuliah/wirausaha), dashboard outcome. |
| **Integrasi dengan Perpustakaan/TBM** | Catatan peminjaman buku, kunjungan. |
| **Modul Unit Usaha Sekolah** | Catatan keterlibatan siswa, peran, laba unit usaha. |
| **Mobile App (minimal web responsif)** | Akses via HP. |

## 5. Alur Data & Proses Kunci

### 5.1 Alur Penilaian OBE
1. Guru membuat rubrik untuk suatu tugas/proyek (terkait CPL tertentu).
2. Guru menilai siswa per kriteria rubrik.
3. Sistem mengakumulasi nilai rubrik menjadi capaian CPL dan nilai akhir.
4. Siswa dan orang tua melihat capaian CPL dalam bentuk visual (misal: bar progress).

### 5.2 Alur Portofolio Siswa
1. Siswa unggah karya (foto produk, laporan, video presentasi).
2. Guru memberi komentar dan status (draft/submit/approved).
3. Portofolio muncul di rapor dan bisa dicetak.

### 5.3 Alur Pemilihan Stream
1. Di kelas 9, siswa mengisi minat dan mengumpulkan portofolio.
2. Konselor melihat nilai, capaian CPL, dan portofolio.
3. Konselor memberikan rekomendasi di sistem.
4. Siswa memilih salah satu stream (Akademik/Vokasi/Wirausaha).
5. Sistem membuat kelas 10 berdasarkan stream (jika perlu grouping).

## 6. Asumsi & Batasan
- **Asumsi**: Yayasan memiliki akses internet stabil di sekolah; siswa sebagian besar memiliki HP/komputer bersama; tim IT minimal 1 orang atau outsourced.
- **Batasan**: Aplikasi akan berbasis web (bisa diakses via HP) karena tidak ada anggaran untuk native mobile. Data disimpan di cloud (misal: Google Cloud atau local server jika ada).

## 7. Kebutuhan Non-Fungsional

| Aspek | Deskripsi |
|-------|------------|
| **Keamanan** | Password hashed, role-based access, log aktivitas. Data siswa tidak boleh diakses publik. |
| **Ketersediaan** | Uptime 99% pada jam sekolah (07.00-17.00). Backup harian. |
| **Kemudahan Penggunaan** | Antarmuka sederhana, minimal teks, bisa diakses via HP dengan koneksi lambat. |
| **Skalabilitas** | Mampu menampung hingga 500 siswa aktif, 50 guru, dan 1000 alumni. |
| **Kepatuhan** | Mematuhi UU Perlindungan Data Pribadi (tidak menjual data siswa). |

## 8. Metrik Keberhasilan (KPI Sistem)
| Metrik | Target |
|--------|--------|
| Persentase guru aktif menggunakan sistem (>1x/minggu) | 90% setelah 2 bulan |
| Persentase siswa dan orang tua login rutin (>1x/bulan) | 70% |
| Waktu cetak rapor per siswa | < 2 menit |
| Response time dashboard | < 3 detik |
| Jumlah laporan tracer yang terkumpul per angkatan | >80% |

## 9. Rencana Implementasi (Rough Timeline)

| Fase | Durasi | Output |
|------|--------|--------|
| **Fase 1: Analisis & Desain** | 2 minggu | Mockup, database schema, flow diagram |
| **Fase 2: Prototipe (P1)** | 4 minggu | CRUD siswa, kelas, nilai, rapor sederhana bisa diakses |
| **Fase 3: UAT & Pelatihan** | 2 minggu | Pelatihan guru, perbaikan bug |
| **Fase 4: Go Live P1** | 1 minggu | Sistem dipakai untuk semester berjalan |
| **Fase 5: P2 & P3** | Bertahap 3-6 bulan | Fitur milestone, rubrik, tracer |

## 10. Lampiran – Contoh Antarmuka Sederhana (Deskripsi)

- **Dashboard Siswa**: Kartu "Capaian CPL saya" (progress bar per CPL), daftar tugas terbaru, portofolio.
- **Halaman Nilai**: Tabel mata pelajaran + nilai + deskripsi capaian CPL (misal: "Mahir" / "Perlu Pendampingan").
- **Halaman Portofolio**: Galeri unggahan dengan filter per jenis (proyek, keterampilan, hasil lomba).
- **Halaman Stream**: Tampilan 3 pilihan dengan rekomendasi dari konselor. Siswa bisa memilih dan mengirim.

---

**Catatan:** PRD ini dapat disederhanakan jika Yayasan Maleo memutuskan menggunakan platform siap pakai (seperti Google Classroom + Sheets + Form + Looker Studio). Namun, untuk mendukung OBE, portofolio terstruktur, dan tracer, sistem custom atau LMS khusus (seperti Moodle dengan modifikasi) lebih dianjurkan.