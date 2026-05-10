# SIMANIS — TODO List
> Terakhir diperbarui: 10 Mei 2026

---

## ✅ SELESAI

### Panel & Infrastruktur
- [x] Multi-panel setup: Admin (`/admin`), Akademik (`/adm`), Guru, Siswa, Orang Tua
- [x] Docker Compose: `docker compose exec php php artisan ...`
- [x] Auth: login, password reset, profil edit di Admin & Akademik
- [x] FilamentShield: roles & policies untuk semua resource
- [x] Themes (Hasnayeen), LightSwitch, FilamentProgressbar
- [x] AuthUIEnhancer: split panel login (kiri background + kanan form) di Admin & Akademik
- [x] Sidebar collapsible, font Montserrat, MaxWidth 7XL di semua panel
- [x] User menu: avatar → My Profile + Pilihan Modul di Admin & Akademik

### Dashboard Widget
- [x] OverlookWidget: desain ulang — white card, colored top accent bar, pastel icon badge
- [x] BackToModulWidget di Admin & Akademik
- [x] Columns responsive: 2 col mobile, 4 col md+

### Master Data (migrasi + model + resource)
- [x] Teacher (Guru)
- [x] Student (Siswa)
- [x] Ortu (Orang Tua)
- [x] AkademikStaff (Staff Akademik)
- [x] TahunAjaran
- [x] Stream (Jurusan/Program)
- [x] MataPelajaran
- [x] Kelas

### Profil Sekolah
- [x] Migration `sekolah` + `visi_misi` fields
- [x] Model `Sekolah` (single-row, `getInstance()`)
- [x] Admin ProfilSekolah Page — form editable
- [x] Akademik ProfilSekolah Page — read-only
- [x] Data seed: Sekolah Maleo, Tangerang Selatan
- [x] Fields: nama, npsn, nss, alamat, kota, provinsi, telepon, email, website, kepala_sekolah, akreditasi, tahun_berdiri, logo, visi, misi, tujuan, sasaran

### OBE Kurikulum Merdeka
- [x] 5 migrasi OBE: kurikulums, struktur_kurikulums, capaian_pembelajarans, alur_tujuan_pembelajarans, tujuan_pembelajaran + modul_ajars
- [x] 6 model OBE: Kurikulum, StrukturKurikulum, CapaianPembelajaran, AlurTujuanPembelajaran, TujuanPembelajaran, ModulAjar
- [x] KurikulumResource (Akademik) + Pages + RelationManagers (StrukturKurikulum, CapaianPembelajaran)
- [x] CapaianPembelajaranResource + Pages + RelationManager (ATP)
- [x] AlurTujuanPembelajaranResource + Pages + RelationManager (TP)
- [x] TujuanPembelajaranResource + Pages + RelationManager (ModulAjar)
- [x] ModulAjarResource + Pages (upload file PDF/DOCX)
- [x] Semua OBE resource ditambahkan ke Admin panel (`->resources([...])`)

### Permission & Roles
- [x] `shield:generate` — generate policies untuk semua resource (admin panel)
- [x] `AkademikRolePermissionSeeder` — assign permissions ke role `akademik` (13 resource)
- [x] NavigationGroups sinkron: Data Pengguna → Master Data → Kurikulum & Pembelajaran → Administration

---

## 🔲 BELUM SELESAI

### Panel Guru
- [ ] GuruPanelProvider — setup lengkap (saat ini kosong)
- [ ] Dashboard panel Guru
- [ ] Jadwal mengajar Guru
- [ ] Modul Ajar view (read-only, Guru lihat modul yang di-assign)
- [ ] Absensi Siswa per kelas/pertemuan
- [ ] Penilaian / Rapor input

### Panel Siswa
- [ ] SiswaPanelProvider — setup lengkap (saat ini hanya Auth/Pages)
- [ ] Dashboard panel Siswa
- [ ] Jadwal pelajaran Siswa
- [ ] Nilai / Rapor view (read-only)
- [ ] Absensi Siswa view

### Panel Orang Tua
- [ ] OrangTuaPanelProvider — setup lengkap (saat ini kosong)
- [ ] Dashboard panel Orang Tua
- [ ] Nilai anak (read-only)
- [ ] Absensi anak (read-only)

### Akademik — Penjadwalan
- [ ] Model & migration: `jadwal_pelajarans` (kelas, mata pelajaran, guru, hari, jam, semester)
- [ ] JadwalPelajaranResource di Akademik panel
- [ ] Konflik jadwal validation (guru/kelas tidak boleh dobel di waktu sama)

### Akademik — Absensi
- [ ] Model & migration: `absensis` (siswa, kelas, tanggal, status, keterangan)
- [ ] AbsensiResource di Akademik panel
- [ ] Absensi input oleh Guru

### Akademik — Penilaian
- [ ] Model & migration: `nilais` (siswa, mata pelajaran, tipe, nilai, semester, tahun ajaran)
- [ ] NilaiResource di Akademik panel
- [ ] Rekap nilai per siswa / per kelas

### Akademik — Rapor
- [ ] Model & migration: `rapors`
- [ ] Generate rapor PDF (per siswa)
- [ ] Rapor view di panel Siswa & Orang Tua

### Data Siswa — Relasi Kelas
- [ ] Tabel pivot `kelas_siswa` (student_id, kelas_id, tahun_ajaran_id)
- [ ] Assign siswa ke kelas di KelasResource (RelationManager)
- [ ] Filter siswa berdasarkan kelas aktif

### Admin — Audit & Log
- [ ] Activity log widget di Admin dashboard (sudah ada `LatestAccessLogs` widget — cek apakah sudah terhubung)
- [ ] Shield Roles & Permissions page sudah muncul di Admin → cek akses

### Profil Sekolah
- [ ] Upload logo sekolah (FileUpload → storage public)
- [ ] Isi `tujuan` dan `sasaran` data seed Sekolah Maleo (saat ini null)

### OBE — Seeder Data Contoh
- [ ] Seed Kurikulum Merdeka: SMP Fase D, SMA Fase E, SMA Fase F
- [ ] Seed beberapa CP contoh per mata pelajaran

### Infrastruktur & DevOps
- [ ] viteTheme untuk panel Akademik (saat ini hanya Admin yang pakai `resources/css/filament/admin/theme.css`)
- [ ] Shield generate untuk panel `akademik` (belum dijalankan — hanya `admin` yang di-generate)
- [ ] Tambah `AkademikRolePermissionSeeder` ke `DatabaseSeeder` agar otomatis
- [ ] Environment `.env` production hardening
- [ ] Backup strategy untuk DB

---

## 📋 CATATAN TEKNIS

| Hal | Detail |
|-----|--------|
| Docker command | `docker compose exec php php artisan ...` |
| Workspace src | `/Users/djambred/perkuliahan/simanis/src/` |
| Panel Admin | `/admin` — role `super_admin` |
| Panel Akademik | `/adm` — role `akademik` |
| Panel Guru | `/guru` — role `guru` |
| Panel Siswa | `/siswa` — role `siswa` |
| Panel Orang Tua | `/orang-tua` — role `orang_tua` |
| OBE Fase D | SMP kelas 7–9 |
| OBE Fase E | SMA kelas 10 |
| OBE Fase F | SMA kelas 11–12 |
| Permission naming | Shield pakai `model::name` → `akademik::staff`, `mata::pelajaran`, dll. |
| Seeder role akademik | `AkademikRolePermissionSeeder` — 143 permissions |