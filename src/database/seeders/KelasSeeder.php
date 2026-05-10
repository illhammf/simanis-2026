<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Stream;
use App\Models\TahunAjaran;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $tahunAktif = TahunAjaran::where('is_aktif', true)->first();

        if (! $tahunAktif) {
            $this->command->warn('Tidak ada tahun ajaran aktif. KelasSeeder dilewati.');
            return;
        }

        $streamAkademik  = Stream::where('nama', 'Akademik')->first();
        $streamVokasi    = Stream::where('nama', 'Vokasi')->first();
        $streamWirausaha = Stream::where('nama', 'Wirausaha')->first();

        // SMP: kelas 7, 8, 9 (tidak ada stream)
        $kelasSMP = [
            ['nama' => '7A', 'jenjang' => 'SMP', 'tingkat' => '7', 'stream_id' => null],
            ['nama' => '7B', 'jenjang' => 'SMP', 'tingkat' => '7', 'stream_id' => null],
            ['nama' => '8A', 'jenjang' => 'SMP', 'tingkat' => '8', 'stream_id' => null],
            ['nama' => '8B', 'jenjang' => 'SMP', 'tingkat' => '8', 'stream_id' => null],
            ['nama' => '9A', 'jenjang' => 'SMP', 'tingkat' => '9', 'stream_id' => null],
            ['nama' => '9B', 'jenjang' => 'SMP', 'tingkat' => '9', 'stream_id' => null],
        ];

        // SMA kelas 10, 11, 12 dengan stream
        $kelasSMA = [
            // Kelas 10
            ['nama' => '10 Akademik 1',  'jenjang' => 'SMA', 'tingkat' => '10', 'stream_id' => $streamAkademik?->id],
            ['nama' => '10 Akademik 2',  'jenjang' => 'SMA', 'tingkat' => '10', 'stream_id' => $streamAkademik?->id],
            ['nama' => '10 Vokasi 1',    'jenjang' => 'SMA', 'tingkat' => '10', 'stream_id' => $streamVokasi?->id],
            ['nama' => '10 Wirausaha 1', 'jenjang' => 'SMA', 'tingkat' => '10', 'stream_id' => $streamWirausaha?->id],
            // Kelas 11
            ['nama' => '11 Akademik 1',  'jenjang' => 'SMA', 'tingkat' => '11', 'stream_id' => $streamAkademik?->id],
            ['nama' => '11 Vokasi 1',    'jenjang' => 'SMA', 'tingkat' => '11', 'stream_id' => $streamVokasi?->id],
            ['nama' => '11 Wirausaha 1', 'jenjang' => 'SMA', 'tingkat' => '11', 'stream_id' => $streamWirausaha?->id],
            // Kelas 12
            ['nama' => '12 Akademik 1',  'jenjang' => 'SMA', 'tingkat' => '12', 'stream_id' => $streamAkademik?->id],
            ['nama' => '12 Vokasi 1',    'jenjang' => 'SMA', 'tingkat' => '12', 'stream_id' => $streamVokasi?->id],
            ['nama' => '12 Wirausaha 1', 'jenjang' => 'SMA', 'tingkat' => '12', 'stream_id' => $streamWirausaha?->id],
        ];

        foreach (array_merge($kelasSMP, $kelasSMA) as $kelas) {
            Kelas::firstOrCreate(
                [
                    'nama'           => $kelas['nama'],
                    'tahun_ajaran_id' => $tahunAktif->id,
                ],
                array_merge($kelas, ['tahun_ajaran_id' => $tahunAktif->id])
            );
        }

        // Assign wali kelas: Siti Rahayu → 7A, Budi Santoso → 8A
        $siti = Teacher::where('name', 'Siti Rahayu')->first();
        $budi = Teacher::where('name', 'Budi Santoso')->first();

        if ($siti) {
            Kelas::where('nama', '7A')->where('tahun_ajaran_id', $tahunAktif->id)
                ->update(['wali_kelas_id' => $siti->id]);
        }
        if ($budi) {
            Kelas::where('nama', '8A')->where('tahun_ajaran_id', $tahunAktif->id)
                ->update(['wali_kelas_id' => $budi->id]);
        }
    }
}