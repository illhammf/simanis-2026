<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Stream;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $kelas  = Kelas::where('nama', '7A')->first();
        $stream = Stream::where('nama', 'Akademik')->first();

        $student = Student::updateOrCreate(
            ['nis' => 'NIS-000001'],
            [
                'name'          => 'Ilham Firmansyah',
                'tanggal_lahir' => '2010-05-15',
                'jenis_kelamin' => 'L',
                'alamat'        => 'Jl. Merdeka No. 10, Jakarta Selatan',
                'kelas_id'      => $kelas?->id,
                'stream_id'     => $stream?->id,
            ]
        );

        $user = User::where('username', 'NIS-000001')->first();
        if ($user && ! $student->user_id) {
            $student->update(['user_id' => $user->id]);
        }
    }
}