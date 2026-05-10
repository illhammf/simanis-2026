<?php

namespace Database\Seeders;

use App\Models\HariLibur;
use Illuminate\Database\Seeder;

class HariLiburSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // ── Libur Nasional 2025 ──
            ['tanggal' => '2025-01-01', 'nama' => 'Tahun Baru Masehi 2025',           'jenis' => 'nasional'],
            ['tanggal' => '2025-01-29', 'nama' => 'Tahun Baru Imlek 2576',             'jenis' => 'nasional'],
            ['tanggal' => '2025-03-29', 'nama' => 'Wafat Yesus Kristus',               'jenis' => 'nasional'],
            ['tanggal' => '2025-03-31', 'nama' => 'Hari Paskah',                       'jenis' => 'nasional'],
            ['tanggal' => '2025-03-30', 'nama' => 'Idul Fitri 1446 H (Hari 1)',        'jenis' => 'nasional'],
            ['tanggal' => '2025-03-31', 'nama' => 'Idul Fitri 1446 H (Hari 2)',        'jenis' => 'nasional'],
            ['tanggal' => '2025-04-18', 'nama' => 'Cuti Bersama Idul Fitri',           'jenis' => 'nasional'],
            ['tanggal' => '2025-05-01', 'nama' => 'Hari Buruh Internasional',          'jenis' => 'nasional'],
            ['tanggal' => '2025-05-12', 'nama' => 'Waisak 2569',                       'jenis' => 'nasional'],
            ['tanggal' => '2025-05-29', 'nama' => 'Kenaikan Yesus Kristus',            'jenis' => 'nasional'],
            ['tanggal' => '2025-06-01', 'nama' => 'Hari Lahir Pancasila',              'jenis' => 'nasional'],
            ['tanggal' => '2025-06-06', 'nama' => 'Idul Adha 1446 H',                 'jenis' => 'nasional'],
            ['tanggal' => '2025-06-27', 'nama' => 'Tahun Baru Islam 1447 H',           'jenis' => 'nasional'],
            ['tanggal' => '2025-08-17', 'nama' => 'Hari Kemerdekaan RI',               'jenis' => 'nasional'],
            ['tanggal' => '2025-09-05', 'nama' => 'Maulid Nabi Muhammad SAW',          'jenis' => 'nasional'],
            ['tanggal' => '2025-12-25', 'nama' => 'Hari Natal',                        'jenis' => 'nasional'],
            ['tanggal' => '2025-12-26', 'nama' => 'Cuti Bersama Natal',                'jenis' => 'nasional'],

            // ── Libur Nasional 2026 ──
            ['tanggal' => '2026-01-01', 'nama' => 'Tahun Baru Masehi 2026',           'jenis' => 'nasional'],
            ['tanggal' => '2026-02-17', 'nama' => 'Tahun Baru Imlek 2577',             'jenis' => 'nasional'],
            ['tanggal' => '2026-03-19', 'nama' => 'Idul Fitri 1447 H (Hari 1)',        'jenis' => 'nasional'],
            ['tanggal' => '2026-03-20', 'nama' => 'Idul Fitri 1447 H (Hari 2)',        'jenis' => 'nasional'],
            ['tanggal' => '2026-04-03', 'nama' => 'Wafat Yesus Kristus',               'jenis' => 'nasional'],
            ['tanggal' => '2026-05-01', 'nama' => 'Hari Buruh Internasional',          'jenis' => 'nasional'],
            ['tanggal' => '2026-05-14', 'nama' => 'Kenaikan Yesus Kristus',            'jenis' => 'nasional'],
            ['tanggal' => '2026-05-27', 'nama' => 'Idul Adha 1447 H',                 'jenis' => 'nasional'],
            ['tanggal' => '2026-06-01', 'nama' => 'Hari Lahir Pancasila',              'jenis' => 'nasional'],
            ['tanggal' => '2026-08-17', 'nama' => 'Hari Kemerdekaan RI',               'jenis' => 'nasional'],
            ['tanggal' => '2026-12-25', 'nama' => 'Hari Natal',                        'jenis' => 'nasional'],

            // ── Libur Kalender Sekolah 2025/2026 ──
            ['tanggal' => '2025-07-14', 'nama' => 'Hari Pertama Masuk Sekolah',       'jenis' => 'sekolah', 'keterangan' => 'MPLS/MOS'],
            ['tanggal' => '2025-12-15', 'nama' => 'Libur Semester Ganjil (Awal)',     'jenis' => 'sekolah', 'keterangan' => 'Persiapan PAS'],
            ['tanggal' => '2025-12-22', 'nama' => 'Libur Semester Ganjil',            'jenis' => 'sekolah', 'keterangan' => 'Libur akhir semester 1'],
            ['tanggal' => '2026-01-05', 'nama' => 'Hari Pertama Semester Genap',      'jenis' => 'sekolah'],
            ['tanggal' => '2026-06-15', 'nama' => 'Libur Kenaikan Kelas',             'jenis' => 'sekolah', 'keterangan' => 'Libur akhir tahun ajaran'],

            // ── Libur Lokal ──
            ['tanggal' => '2025-10-20', 'nama' => 'Hari Jadi Kota / Daerah',         'jenis' => 'lokal'],
        ];

        foreach ($data as $row) {
            HariLibur::firstOrCreate(
                ['tanggal' => $row['tanggal']],
                array_merge(['keterangan' => null, 'is_aktif' => true], $row)
            );
        }
    }
}