<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        $ruangans = [
            // Ruang Kelas SMP — Gedung A
            ['kode' => 'RK-7A', 'nama' => 'Ruang Kelas 7A', 'jenis' => 'kelas', 'kapasitas' => 32, 'gedung' => 'Gedung A', 'lantai' => 'Lantai 1'],
            ['kode' => 'RK-7B', 'nama' => 'Ruang Kelas 7B', 'jenis' => 'kelas', 'kapasitas' => 32, 'gedung' => 'Gedung A', 'lantai' => 'Lantai 1'],
            ['kode' => 'RK-8A', 'nama' => 'Ruang Kelas 8A', 'jenis' => 'kelas', 'kapasitas' => 32, 'gedung' => 'Gedung A', 'lantai' => 'Lantai 2'],
            ['kode' => 'RK-8B', 'nama' => 'Ruang Kelas 8B', 'jenis' => 'kelas', 'kapasitas' => 32, 'gedung' => 'Gedung A', 'lantai' => 'Lantai 2'],
            ['kode' => 'RK-9A', 'nama' => 'Ruang Kelas 9A', 'jenis' => 'kelas', 'kapasitas' => 32, 'gedung' => 'Gedung A', 'lantai' => 'Lantai 3'],
            ['kode' => 'RK-9B', 'nama' => 'Ruang Kelas 9B', 'jenis' => 'kelas', 'kapasitas' => 32, 'gedung' => 'Gedung A', 'lantai' => 'Lantai 3'],

            // Ruang Kelas SMA — Gedung B
            ['kode' => 'RK-10AK', 'nama' => 'Ruang Kelas 10 Akademik', 'jenis' => 'kelas', 'kapasitas' => 36, 'gedung' => 'Gedung B', 'lantai' => 'Lantai 1'],
            ['kode' => 'RK-10VK', 'nama' => 'Ruang Kelas 10 Vokasi', 'jenis' => 'kelas', 'kapasitas' => 36, 'gedung' => 'Gedung B', 'lantai' => 'Lantai 1'],
            ['kode' => 'RK-10WR', 'nama' => 'Ruang Kelas 10 Wirausaha', 'jenis' => 'kelas', 'kapasitas' => 36, 'gedung' => 'Gedung B', 'lantai' => 'Lantai 1'],
            ['kode' => 'RK-11AK', 'nama' => 'Ruang Kelas 11 Akademik', 'jenis' => 'kelas', 'kapasitas' => 36, 'gedung' => 'Gedung B', 'lantai' => 'Lantai 2'],
            ['kode' => 'RK-11VK', 'nama' => 'Ruang Kelas 11 Vokasi', 'jenis' => 'kelas', 'kapasitas' => 36, 'gedung' => 'Gedung B', 'lantai' => 'Lantai 2'],
            ['kode' => 'RK-11WR', 'nama' => 'Ruang Kelas 11 Wirausaha', 'jenis' => 'kelas', 'kapasitas' => 36, 'gedung' => 'Gedung B', 'lantai' => 'Lantai 2'],
            ['kode' => 'RK-12AK', 'nama' => 'Ruang Kelas 12 Akademik', 'jenis' => 'kelas', 'kapasitas' => 36, 'gedung' => 'Gedung B', 'lantai' => 'Lantai 3'],
            ['kode' => 'RK-12VK', 'nama' => 'Ruang Kelas 12 Vokasi', 'jenis' => 'kelas', 'kapasitas' => 36, 'gedung' => 'Gedung B', 'lantai' => 'Lantai 3'],
            ['kode' => 'RK-12WR', 'nama' => 'Ruang Kelas 12 Wirausaha', 'jenis' => 'kelas', 'kapasitas' => 36, 'gedung' => 'Gedung B', 'lantai' => 'Lantai 3'],

            // Laboratorium — Gedung C
            ['kode' => 'LAB-IPA', 'nama' => 'Laboratorium IPA', 'jenis' => 'lab_ipa', 'kapasitas' => 30, 'gedung' => 'Gedung C', 'lantai' => 'Lantai 1'],
            ['kode' => 'LAB-KOM1', 'nama' => 'Laboratorium Komputer 1', 'jenis' => 'lab_komputer', 'kapasitas' => 30, 'gedung' => 'Gedung C', 'lantai' => 'Lantai 2'],
            ['kode' => 'LAB-KOM2', 'nama' => 'Laboratorium Komputer 2', 'jenis' => 'lab_komputer', 'kapasitas' => 30, 'gedung' => 'Gedung C', 'lantai' => 'Lantai 2'],
            ['kode' => 'LAB-BHS', 'nama' => 'Laboratorium Bahasa', 'jenis' => 'lab_bahasa', 'kapasitas' => 30, 'gedung' => 'Gedung C', 'lantai' => 'Lantai 3'],

            // Fasilitas umum
            ['kode' => 'AULA', 'nama' => 'Aula Utama', 'jenis' => 'aula', 'kapasitas' => 300, 'gedung' => 'Gedung D', 'lantai' => 'Lantai 1'],
            ['kode' => 'PERP', 'nama' => 'Perpustakaan', 'jenis' => 'perpustakaan', 'kapasitas' => 60, 'gedung' => 'Gedung D', 'lantai' => 'Lantai 1'],
            ['kode' => 'LAP', 'nama' => 'Lapangan Olahraga', 'jenis' => 'lapangan', 'kapasitas' => 200, 'gedung' => null, 'lantai' => null],
        ];

        foreach ($ruangans as $data) {
            Ruangan::firstOrCreate(
                ['kode' => $data['kode']],
                array_merge($data, ['is_aktif' => true])
            );
        }

        $this->command->info('Ruangan seeded: ' . count($ruangans) . ' ruangan.');
    }
}