<?php

namespace Database\Seeders;

use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Ruangan;
use App\Models\TahunAjaran;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class JadwalPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $tahun = TahunAjaran::where('is_aktif', true)->first();
        if (! $tahun) {
            $this->command->warn('Tidak ada tahun ajaran aktif. JadwalPelajaranSeeder dilewati.');
            return;
        }

        $kelas7A = Kelas::where('nama', '7A')->where('tahun_ajaran_id', $tahun->id)->first();
        if (! $kelas7A) {
            $this->command->warn('Kelas 7A tidak ditemukan.');
            return;
        }

        $budi = Teacher::where('name', 'Budi Santoso')->first();
        $siti = Teacher::where('name', 'Siti Rahayu')->first();

        // Mata pelajaran
        $mtk    = MataPelajaran::where('kode', 'MTK')->first();
        $bin    = MataPelajaran::where('kode', 'BIN')->first();
        $big    = MataPelajaran::where('kode', 'BIG')->first();
        $ipa    = MataPelajaran::where('kode', 'IPA')->first();
        $ips    = MataPelajaran::where('kode', 'IPS')->first();
        $pai    = MataPelajaran::where('kode', 'PAI')->first();
        $penjas = MataPelajaran::where('kode', 'PENJAS')->first();
        $info   = MataPelajaran::where('kode', 'INFO-SMP')->first();

        // Ruangan
        $rk7A = Ruangan::where('kode', 'RK-7A')->first();
        $labIpa = Ruangan::where('kode', 'LAB-IPA')->first();
        $labKom = Ruangan::where('kode', 'LAB-KOM1')->first();
        $lap    = Ruangan::where('kode', 'LAP')->first();

        /**
         * Jam pelajaran SMP:
         * 1: 07:00–07:45
         * 2: 07:45–08:30
         * 3: 08:45–09:30  (istirahat 1: 08:30–08:45)
         * 4: 09:30–10:15
         * 5: 10:15–11:00
         * 6: 11:15–12:00  (istirahat 2: 11:00–11:15)
         * 7: 12:45–13:30  (istirahat 3: 12:00–12:45)
         */
        $jamConfig = [
            1 => ['mulai' => '07:00', 'selesai' => '07:45'],
            2 => ['mulai' => '07:45', 'selesai' => '08:30'],
            3 => ['mulai' => '08:45', 'selesai' => '09:30'],
            4 => ['mulai' => '09:30', 'selesai' => '10:15'],
            5 => ['mulai' => '10:15', 'selesai' => '11:00'],
            6 => ['mulai' => '11:15', 'selesai' => '12:00'],
            7 => ['mulai' => '12:45', 'selesai' => '13:30'],
        ];

        // Jadwal kelas 7A per hari [hari, jam_ke, mapel, guru, ruangan]
        $jadwal = [
            // Senin
            ['Senin', 1, $mtk,    $budi, $rk7A],
            ['Senin', 2, $mtk,    $budi, $rk7A],
            ['Senin', 3, $bin,    $siti, $rk7A],
            ['Senin', 4, $bin,    $siti, $rk7A],
            ['Senin', 5, $pai,    $siti, $rk7A],
            ['Senin', 6, $big,    $budi, $rk7A],
            // Selasa
            ['Selasa', 1, $ipa,   $budi, $rk7A],
            ['Selasa', 2, $ipa,   $budi, $rk7A],
            ['Selasa', 3, $ipa,   $budi, $labIpa],
            ['Selasa', 4, $ips,   $siti, $rk7A],
            ['Selasa', 5, $ips,   $siti, $rk7A],
            ['Selasa', 6, $penjas,$budi, $lap],
            // Rabu
            ['Rabu', 1, $mtk,    $budi, $rk7A],
            ['Rabu', 2, $mtk,    $budi, $rk7A],
            ['Rabu', 3, $big,    $budi, $rk7A],
            ['Rabu', 4, $big,    $budi, $rk7A],
            ['Rabu', 5, $info,   $siti, $labKom],
            ['Rabu', 6, $info,   $siti, $labKom],
            // Kamis
            ['Kamis', 1, $bin,   $siti, $rk7A],
            ['Kamis', 2, $bin,   $siti, $rk7A],
            ['Kamis', 3, $ips,   $siti, $rk7A],
            ['Kamis', 4, $ips,   $siti, $rk7A],
            ['Kamis', 5, $pai,   $siti, $rk7A],
            ['Kamis', 6, $ipa,   $budi, $rk7A],
            // Jumat
            ['Jumat', 1, $mtk,   $budi, $rk7A],
            ['Jumat', 2, $mtk,   $budi, $rk7A],
            ['Jumat', 3, $ipa,   $budi, $rk7A],
            ['Jumat', 4, $bin,   $siti, $rk7A],
            ['Jumat', 5, $penjas,$budi, $lap],
        ];

        foreach ($jadwal as [$hari, $jamKe, $mapel, $teacher, $ruangan]) {
            if (! $mapel || ! $teacher) continue;

            JadwalPelajaran::firstOrCreate(
                [
                    'tahun_ajaran_id'   => $tahun->id,
                    'kelas_id'          => $kelas7A->id,
                    'mata_pelajaran_id' => $mapel->id,
                    'hari'              => $hari,
                    'jam_ke'            => $jamKe,
                ],
                [
                    'teacher_id'  => $teacher->id,
                    'ruangan_id'  => $ruangan?->id,
                    'jam_mulai'   => $jamConfig[$jamKe]['mulai'],
                    'jam_selesai' => $jamConfig[$jamKe]['selesai'],
                    'is_aktif'    => true,
                ]
            );
        }

        $this->command->info('JadwalPelajaran kelas 7A seeded: ' . count($jadwal) . ' slot.');
    }
}