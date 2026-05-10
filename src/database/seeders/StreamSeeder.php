<?php

namespace Database\Seeders;

use App\Models\Stream;
use Illuminate\Database\Seeder;

class StreamSeeder extends Seeder
{
    public function run(): void
    {
        $streams = [
            [
                'nama'      => 'Akademik',
                'deskripsi' => 'Program studi reguler dengan fokus ilmu pengetahuan umum.',
            ],
            [
                'nama'      => 'Vokasi',
                'deskripsi' => 'Program studi dengan fokus keterampilan vokasional dan teknologi.',
            ],
            [
                'nama'      => 'Wirausaha',
                'deskripsi' => 'Program studi dengan fokus kewirausahaan dan bisnis.',
            ],
        ];

        foreach ($streams as $stream) {
            Stream::firstOrCreate(['nama' => $stream['nama']], $stream);
        }
    }
}