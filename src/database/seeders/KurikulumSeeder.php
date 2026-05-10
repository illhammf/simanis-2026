<?php

namespace Database\Seeders;

use App\Models\CapaianPembelajaran;
use App\Models\Kurikulum;
use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;

class KurikulumSeeder extends Seeder
{
    public function run(): void
    {
        // --- Kurikulum Merdeka SMP (Fase D: kelas 7-9) ---
        $smpD = Kurikulum::firstOrCreate(
            ['nama' => 'Kurikulum Merdeka', 'jenjang' => 'SMP', 'fase' => 'D'],
            [
                'tahun_mulai' => 2022,
                'is_active'   => true,
                'deskripsi'   => 'Kurikulum Merdeka jenjang SMP Fase D (kelas 7–9). Berbasis kompetensi, fleksibel, dan berpusat pada murid.',
            ]
        );

        // --- Kurikulum Merdeka SMA Fase E (kelas 10) ---
        $smaE = Kurikulum::firstOrCreate(
            ['nama' => 'Kurikulum Merdeka', 'jenjang' => 'SMA', 'fase' => 'E'],
            [
                'tahun_mulai' => 2022,
                'is_active'   => true,
                'deskripsi'   => 'Kurikulum Merdeka jenjang SMA Fase E (kelas 10). Masa eksplorasi minat dan bakat.',
            ]
        );

        // --- Kurikulum Merdeka SMA Fase F (kelas 11-12) ---
        $smaF = Kurikulum::firstOrCreate(
            ['nama' => 'Kurikulum Merdeka', 'jenjang' => 'SMA', 'fase' => 'F'],
            [
                'tahun_mulai' => 2022,
                'is_active'   => true,
                'deskripsi'   => 'Kurikulum Merdeka jenjang SMA Fase F (kelas 11–12). Pendalaman peminatan.',
            ]
        );

        // Seed contoh CP Matematika untuk Fase D (SMP)
        $matSMP = MataPelajaran::where('kode', 'MTK')->first();
        if ($matSMP) {
            $cpMatSMP = [
                [
                    'kode_cp'        => 'CP.MTK.D.1',
                    'elemen'         => 'Bilangan',
                    'urutan'         => 1,
                    'deskripsi_cp'   => 'Peserta didik dapat membaca, menulis, dan membandingkan bilangan bulat, bilangan rasional dan irasional, bilangan desimal, bilangan berpangkat bulat dan akar, bilangan dalam notasi ilmiah.',
                ],
                [
                    'kode_cp'        => 'CP.MTK.D.2',
                    'elemen'         => 'Aljabar',
                    'urutan'         => 2,
                    'deskripsi_cp'   => 'Peserta didik dapat mengenali, memprediksi dan menggeneralisasi pola dalam bentuk susunan benda dan bilangan.',
                ],
                [
                    'kode_cp'        => 'CP.MTK.D.3',
                    'elemen'         => 'Geometri',
                    'urutan'         => 3,
                    'deskripsi_cp'   => 'Peserta didik dapat menjelaskan ciri-ciri bangun datar segiempat dan segitiga, menentukan keliling dan luas, serta mengidentifikasi garis simetri.',
                ],
                [
                    'kode_cp'        => 'CP.MTK.D.4',
                    'elemen'         => 'Analisis Data dan Peluang',
                    'urutan'         => 4,
                    'deskripsi_cp'   => 'Peserta didik dapat merumuskan pertanyaan, mengumpulkan, menyajikan, dan menginterpretasi data menggunakan diagram batang dan lingkaran.',
                ],
            ];

            foreach ($cpMatSMP as $cp) {
                CapaianPembelajaran::firstOrCreate(
                    ['kurikulum_id' => $smpD->id, 'mata_pelajaran_id' => $matSMP->id, 'kode_cp' => $cp['kode_cp']],
                    array_merge($cp, ['kurikulum_id' => $smpD->id, 'mata_pelajaran_id' => $matSMP->id])
                );
            }
        }

        // Seed contoh CP Bahasa Indonesia untuk Fase D (SMP)
        $binSMP = MataPelajaran::where('kode', 'BIN')->first();
        if ($binSMP) {
            $cpBinSMP = [
                [
                    'kode_cp'        => 'CP.BIN.D.1',
                    'elemen'         => 'Menyimak',
                    'urutan'         => 1,
                    'deskripsi_cp'   => 'Peserta didik mampu menganalisis dan memaknai informasi berupa gagasan, pikiran, perasaan, pandangan, arahan atau pesan yang tepat dari berbagai teks audiovisual.',
                ],
                [
                    'kode_cp'        => 'CP.BIN.D.2',
                    'elemen'         => 'Membaca dan Memirsa',
                    'urutan'         => 2,
                    'deskripsi_cp'   => 'Peserta didik memahami informasi berupa gagasan, pikiran, pandangan, arahan atau pesan dari berbagai jenis teks.',
                ],
                [
                    'kode_cp'        => 'CP.BIN.D.3',
                    'elemen'         => 'Berbicara dan Mempresentasikan',
                    'urutan'         => 3,
                    'deskripsi_cp'   => 'Peserta didik mampu menyampaikan gagasan, pikiran, pandangan, arahan atau pesan untuk tujuan pengajuan usul, pemecahan masalah, dan pemberian solusi.',
                ],
                [
                    'kode_cp'        => 'CP.BIN.D.4',
                    'elemen'         => 'Menulis',
                    'urutan'         => 4,
                    'deskripsi_cp'   => 'Peserta didik mampu menulis gagasan, pikiran, pandangan, arahan atau pesan tertulis untuk berbagai tujuan secara logis, kritis, dan kreatif.',
                ],
            ];

            foreach ($cpBinSMP as $cp) {
                CapaianPembelajaran::firstOrCreate(
                    ['kurikulum_id' => $smpD->id, 'mata_pelajaran_id' => $binSMP->id, 'kode_cp' => $cp['kode_cp']],
                    array_merge($cp, ['kurikulum_id' => $smpD->id, 'mata_pelajaran_id' => $binSMP->id])
                );
            }
        }
    }
}