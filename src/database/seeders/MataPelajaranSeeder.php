<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use App\Models\Stream;
use Illuminate\Database\Seeder;

class MataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $streamAkademik = Stream::where('nama', 'Akademik')->first()?->id;
        $streamVokasi   = Stream::where('nama', 'Vokasi')->first()?->id;
        $streamWirausaha = Stream::where('nama', 'Wirausaha')->first()?->id;

        // Mata pelajaran umum (berlaku semua jenjang & stream)
        $umum = [
            ['kode' => 'PAI',  'nama' => 'Pendidikan Agama Islam',               'jenjang' => 'Semua', 'jam_per_minggu' => 3, 'kkm' => 75, 'stream_id' => null],
            ['kode' => 'PKN',  'nama' => 'Pendidikan Kewarganegaraan',            'jenjang' => 'Semua', 'jam_per_minggu' => 2, 'kkm' => 75, 'stream_id' => null],
            ['kode' => 'BIN',  'nama' => 'Bahasa Indonesia',                      'jenjang' => 'Semua', 'jam_per_minggu' => 4, 'kkm' => 75, 'stream_id' => null],
            ['kode' => 'BIG',  'nama' => 'Bahasa Inggris',                        'jenjang' => 'Semua', 'jam_per_minggu' => 3, 'kkm' => 75, 'stream_id' => null],
            ['kode' => 'MTK',  'nama' => 'Matematika',                            'jenjang' => 'Semua', 'jam_per_minggu' => 4, 'kkm' => 75, 'stream_id' => null],
            ['kode' => 'PENJAS', 'nama' => 'Pendidikan Jasmani Olahraga Kesehatan', 'jenjang' => 'Semua', 'jam_per_minggu' => 3, 'kkm' => 75, 'stream_id' => null],
            ['kode' => 'SENBUD', 'nama' => 'Seni Budaya',                         'jenjang' => 'Semua', 'jam_per_minggu' => 2, 'kkm' => 75, 'stream_id' => null],
            ['kode' => 'BK',   'nama' => 'Bimbingan Konseling',                   'jenjang' => 'Semua', 'jam_per_minggu' => 1, 'kkm' => 75, 'stream_id' => null],
        ];

        // Mata pelajaran SMP
        $smp = [
            ['kode' => 'IPA',  'nama' => 'Ilmu Pengetahuan Alam',   'jenjang' => 'SMP', 'jam_per_minggu' => 5, 'kkm' => 75, 'stream_id' => null],
            ['kode' => 'IPS',  'nama' => 'Ilmu Pengetahuan Sosial', 'jenjang' => 'SMP', 'jam_per_minggu' => 4, 'kkm' => 75, 'stream_id' => null],
            ['kode' => 'INFO-SMP', 'nama' => 'Informatika',          'jenjang' => 'SMP', 'jam_per_minggu' => 2, 'kkm' => 75, 'stream_id' => null],
        ];

        // Mata pelajaran SMA umum
        $smaUmum = [
            ['kode' => 'FIS',  'nama' => 'Fisika',                          'jenjang' => 'SMA', 'jam_per_minggu' => 3, 'kkm' => 75, 'stream_id' => null],
            ['kode' => 'KIM',  'nama' => 'Kimia',                           'jenjang' => 'SMA', 'jam_per_minggu' => 3, 'kkm' => 75, 'stream_id' => null],
            ['kode' => 'BIO',  'nama' => 'Biologi',                         'jenjang' => 'SMA', 'jam_per_minggu' => 3, 'kkm' => 75, 'stream_id' => null],
            ['kode' => 'SEJ',  'nama' => 'Sejarah',                         'jenjang' => 'SMA', 'jam_per_minggu' => 2, 'kkm' => 75, 'stream_id' => null],
            ['kode' => 'GEO',  'nama' => 'Geografi',                        'jenjang' => 'SMA', 'jam_per_minggu' => 2, 'kkm' => 75, 'stream_id' => null],
            ['kode' => 'EKO',  'nama' => 'Ekonomi',                         'jenjang' => 'SMA', 'jam_per_minggu' => 3, 'kkm' => 75, 'stream_id' => null],
            ['kode' => 'SOSIO','nama' => 'Sosiologi',                        'jenjang' => 'SMA', 'jam_per_minggu' => 2, 'kkm' => 75, 'stream_id' => null],
            ['kode' => 'INFO-SMA', 'nama' => 'Informatika',                  'jenjang' => 'SMA', 'jam_per_minggu' => 2, 'kkm' => 75, 'stream_id' => null],
            ['kode' => 'MTK-LANJUT', 'nama' => 'Matematika Lanjutan',        'jenjang' => 'SMA', 'jam_per_minggu' => 4, 'kkm' => 75, 'stream_id' => null],
        ];

        foreach (array_merge($umum, $smp, $smaUmum) as $mapel) {
            MataPelajaran::firstOrCreate(['kode' => $mapel['kode']], $mapel);
        }
    }
}