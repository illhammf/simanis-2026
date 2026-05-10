<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // ── Roles & Users ──
            RoleSeeder::class,
            UserSeeder::class,
            AkademikStaffSeeder::class,
            TeacherSeeder::class,

            // ── Master Data ──
            StreamSeeder::class,
            TahunAjaranSeeder::class,
            KelasSeeder::class,         // butuh stream + tahun ajaran; assign wali kelas
            MataPelajaranSeeder::class,
            RuanganSeeder::class,

            // ── Pengguna (butuh kelas & stream) ──
            StudentSeeder::class,       // Ahmad Fauzi → 7A, Akademik
            OrtuSeeder::class,          // Hendra Wijaya → linked ke Ahmad Fauzi

            // ── Kurikulum OBE ──
            KurikulumSeeder::class,

            // ── Jadwal & Pembelajaran ──
            JadwalPelajaranSeeder::class,   // jadwal kelas 7A
            ModulAjarTugasSeeder::class,    // modul ajar + tugas

            // ── Transaksi ──
            AbsensiNilaiSeeder::class,      // absensi & nilai Ahmad Fauzi
            KonsultasiSeeder::class,        // konsultasi siswa–wali kelas

            // ── Referensi ──
            HariLiburSeeder::class,         // hari libur nasional + sekolah
            StreamMilestoneSeeder::class,   // milestone tiap semester per stream

            // ── Permissions ──
            AkademikRolePermissionSeeder::class,
        ]);
    }
}