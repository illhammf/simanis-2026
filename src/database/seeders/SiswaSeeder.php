<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $map = [
            'SMP' => [
                ['kode' => 'UMUM', 'nama' => 'Umum'],
            ],
            'SMA' => [
                ['kode' => 'IPA',  'nama' => 'IPA'],
                ['kode' => 'IPS',  'nama' => 'IPS'],
                ['kode' => 'BHS',  'nama' => 'Bahasa'],
            ],
        ];

        foreach ($map as $tingkatNama => $jurusanList) {
            $tingkatId = DB::table('tingkat')->insertGetId([
                'kode'       => $tingkatNama,
                'nama'       => $tingkatNama,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($jurusanList as $j) {
                $jurusanId = DB::table('jurusan')->insertGetId([
                    'tingkat_id' => $tingkatId,
                    'kode'       => $j['kode'],
                    'nama'       => $j['nama'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);


                $kelasMap = [

                    'UMUM' => ['VII-A','VII-B','VII-C','VIII-A','VIII-B','VIII-C','IX-A','IX-B','IX-C'],
                    'IPA'  => ['X-IPA-1','X-IPA-2','XI-IPA-1','XI-IPA-2','XII-IPA-1','XII-IPA-2'],
                    'IPS'  => ['X-IPS-1','X-IPS-2','XI-IPS-1','XI-IPS-2','XII-IPS-1'],
                    'BHS'  => ['X-BHS-1','XI-BHS-1','XII-BHS-1'],
                ];

                foreach ($kelasMap[$j['kode']] ?? [] as $namaKelas) {
                    DB::table('kelas')->insert([
                        'tingkat_id' => $tingkatId,
                        'jurusan_id' => $jurusanId,
                        'nama'       => $namaKelas,
                        'kapasitas'  => 32,
                        'aktif'      => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // ── Tahun Ajaran ──────────────────────────────────────────────────────
        $tahunAjaran = [
            '2022/2023', '2023/2024', '2024/2025', '2025/2026',
        ];

        foreach ($tahunAjaran as $index => $nama) {
            DB::table('tahun_ajaran')->insert([
                'nama'       => $nama,
                'aktif'      => $index === count($tahunAjaran) - 1, // aktif = tahun terakhir
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

}