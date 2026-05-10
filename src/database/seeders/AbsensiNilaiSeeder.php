<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Student;
use App\Models\TahunAjaran;
use App\Models\Teacher;
use App\Models\Tugas;
use Illuminate\Database\Seeder;

class AbsensiNilaiSeeder extends Seeder
{
    public function run(): void
    {
        $student = Student::where('nis', 'NIS-000001')->first();
        $tahun   = TahunAjaran::where('is_aktif', true)->first();

        if (! $student || ! $tahun) {
            $this->command->warn('Student atau TahunAjaran tidak ditemukan. AbsensiNilaiSeeder dilewati.');
            return;
        }

        $kelas7A = Kelas::where('nama', '7A')->where('tahun_ajaran_id', $tahun->id)->first();
        $jadwals = JadwalPelajaran::where('kelas_id', $kelas7A?->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->get();

        if ($jadwals->isEmpty()) {
            $this->command->warn('Jadwal pelajaran 7A kosong. AbsensiSeeder dilewati.');
            return;
        }

        // ── Absensi: 4 minggu terakhir ──────────────────────────────────
        $hariMap = [
            'Senin'  => 1,
            'Selasa' => 2,
            'Rabu'   => 3,
            'Kamis'  => 4,
            'Jumat'  => 5,
            'Sabtu'  => 6,
        ];

        // Hasilkan 4 pekan ke belakang
        $tanggalList = [];
        for ($week = 3; $week >= 0; $week--) {
            foreach ($hariMap as $hariNama => $hariNum) {
                $offset    = ($hariNum - date('N')) - ($week * 7);
                $tanggal   = date('Y-m-d', strtotime("{$offset} days"));
                // Jangan lewati hari ini atau ke depan
                if ($tanggal > date('Y-m-d')) continue;
                $tanggalList[$hariNama][] = $tanggal;
            }
        }

        // Status dominan hadir, sesekali izin/sakit/alpha
        $statusPattern = [
            'hadir', 'hadir', 'hadir', 'hadir', 'hadir',  // 5 hadir
            'hadir', 'hadir', 'hadir', 'izin',  'hadir',  // 1 izin
            'hadir', 'hadir', 'sakit', 'hadir', 'hadir',  // 1 sakit
            'hadir', 'hadir', 'hadir', 'hadir', 'alpha',  // 1 alpha
        ];
        $patternIdx = 0;

        foreach ($jadwals as $jadwal) {
            $dates = $tanggalList[$jadwal->hari] ?? [];
            foreach ($dates as $tanggal) {
                $status = $statusPattern[$patternIdx % count($statusPattern)];
                $patternIdx++;

                Absensi::firstOrCreate(
                    [
                        'student_id'          => $student->id,
                        'jadwal_pelajaran_id' => $jadwal->id,
                        'tanggal'             => $tanggal,
                    ],
                    [
                        'status'      => $status,
                        'keterangan'  => match ($status) {
                            'izin'  => 'Izin keperluan keluarga',
                            'sakit' => 'Sakit demam, ada surat dokter',
                            'alpha' => null,
                            default => null,
                        },
                    ]
                );
            }
        }

        $this->command->info('Absensi seeded untuk Ahmad Fauzi.');

        // ── Nilai ────────────────────────────────────────────────────────
        $teacher = Teacher::where('name', 'Budi Santoso')->first();
        if (! $teacher) return;

        $tugasList = Tugas::all();
        if ($tugasList->isEmpty()) {
            $this->command->warn('Tidak ada tugas ditemukan. NilaiSeeder dilewati.');
            return;
        }

        // Ambil jadwal per mata pelajaran untuk mendapat jadwal_pelajaran_id
        $jadwalByMapel = $jadwals->keyBy('mata_pelajaran_id');

        // Nilai sample: bervariasi antara 65–98
        $sampleNilai = [95, 88, 72, 90, 85, 78, 92, 65, 88, 75, 80, 70, 95, 88, 82];
        $nilaiIdx    = 0;

        foreach ($tugasList as $tugas) {
            // Ambil modul ajar untuk mengetahui mata_pelajaran_id
            $modulAjar = $tugas->modulAjar ?? $tugas->load('modulAjar')->modulAjar;
            if (! $modulAjar) continue;

            $jadwalPelajaran = $jadwalByMapel->get($modulAjar->mata_pelajaran_id);
            if (! $jadwalPelajaran) continue;

            $nilaiAngka = $sampleNilai[$nilaiIdx % count($sampleNilai)];
            $nilaiIdx++;

            Nilai::firstOrCreate(
                [
                    'student_id' => $student->id,
                    'tugas_id'   => $tugas->id,
                ],
                [
                    'jadwal_pelajaran_id' => $jadwalPelajaran->id,
                    'teacher_id'         => $jadwalPelajaran->teacher_id,
                    'nilai'              => $nilaiAngka,
                    'keterangan'         => match (true) {
                        $nilaiAngka >= 85 => 'Sangat baik',
                        $nilaiAngka >= 70 => 'Baik',
                        default           => 'Perlu perbaikan',
                    },
                ]
            );
        }

        $this->command->info('Nilai seeded untuk Ahmad Fauzi.');
    }
}