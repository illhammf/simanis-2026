<?php

namespace Database\Seeders;

use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama'            => '2024/2025',
                'semester'        => 'Ganjil',
                'tanggal_mulai'   => '2024-07-15',
                'tanggal_selesai' => '2024-12-21',
                'is_aktif'        => false,
            ],
            [
                'nama'            => '2024/2025',
                'semester'        => 'Genap',
                'tanggal_mulai'   => '2025-01-06',
                'tanggal_selesai' => '2025-06-21',
                'is_aktif'        => false,
            ],
            [
                'nama'            => '2025/2026',
                'semester'        => 'Ganjil',
                'tanggal_mulai'   => '2025-07-14',
                'tanggal_selesai' => '2025-12-20',
                'is_aktif'        => true,
            ],
            [
                'nama'            => '2025/2026',
                'semester'        => 'Genap',
                'tanggal_mulai'   => '2026-01-05',
                'tanggal_selesai' => '2026-06-20',
                'is_aktif'        => false,
            ],
        ];

        foreach ($data as $row) {
            TahunAjaran::firstOrCreate(
                ['nama' => $row['nama'], 'semester' => $row['semester']],
                $row
            );
        }
    }
}