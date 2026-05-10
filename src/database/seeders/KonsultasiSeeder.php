<?php

namespace Database\Seeders;

use App\Models\Konsultasi;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class KonsultasiSeeder extends Seeder
{
    public function run(): void
    {
        $student = Student::where('nis', 'NIS-000001')->first();
        $waliKelas = Teacher::where('name', 'Siti Rahayu')->first();

        if (! $student || ! $waliKelas) {
            $this->command->warn('Student atau Wali Kelas tidak ditemukan. KonsultasiSeeder dilewati.');
            return;
        }

        $data = [
            [
                'judul'      => 'Kesulitan Memahami Materi Persamaan Linear',
                'pesan'      => 'Bu, saya mengalami kesulitan memahami materi persamaan linear satu variabel, terutama bagian substitusi. Apakah ada cara yang lebih mudah untuk memahaminya? Saya sudah mencoba membaca ulang buku tapi masih bingung.',
                'balasan'    => 'Halo Ahmad! Terima kasih sudah terbuka ya. Untuk persamaan linear, coba bayangkan seperti timbangan — kedua sisi harus seimbang. Kalau kamu kurangi/tambahkan sesuatu di satu sisi, lakukan hal yang sama di sisi lain. Coba juga latihan soal dari halaman 45–50 buku teksmu. Kalau masih bingung, datang ke ruang guru ya, Ibu siap bantu!',
                'status'     => 'dibalas',
                'dibalas_at' => now()->subDays(5),
                'created_at' => now()->subDays(7),
            ],
            [
                'judul'      => 'Izin Tidak Masuk Hari Kamis',
                'pesan'      => 'Bu, saya Ahmad ingin memberitahu bahwa Kamis depan saya tidak bisa masuk sekolah karena ada acara keluarga yang tidak bisa ditunda. Mohon izin dan saya siap mengejar materi yang tertinggal.',
                'balasan'    => 'Baik Ahmad, izin diterima. Tolong bawa surat keterangan dari orang tua ya ketika kamu masuk kembali. Materi yang kamu lewatkan adalah IPS dan Bahasa Indonesia bab teks narasi. Minta catatan dari teman sekelasmu dan kerjakan latihan di buku halaman 78.',
                'status'     => 'dibalas',
                'dibalas_at' => now()->subDays(2),
                'created_at' => now()->subDays(3),
            ],
            [
                'judul'      => 'Tanya Jadwal Ulangan Harian IPA',
                'pesan'      => 'Bu, saya mau tanya kapan jadwal ulangan harian IPA materi Materi dan Perubahannya? Saya ingin mempersiapkan diri dengan baik. Terima kasih.',
                'balasan'    => null,
                'status'     => 'dibaca',
                'dibalas_at' => null,
                'created_at' => now()->subDay(),
            ],
            [
                'judul'      => 'Minta Rekomendasi Buku Tambahan Matematika',
                'pesan'      => 'Bu, apakah ada rekomendasi buku atau sumber belajar tambahan untuk Matematika kelas 7? Saya ingin belajar lebih banyak di rumah karena nilai kuis saya kurang memuaskan.',
                'balasan'    => null,
                'status'     => 'pending',
                'dibalas_at' => null,
                'created_at' => now()->subHours(3),
            ],
        ];

        foreach ($data as $row) {
            Konsultasi::firstOrCreate(
                [
                    'student_id' => $student->id,
                    'teacher_id' => $waliKelas->id,
                    'judul'      => $row['judul'],
                ],
                array_merge($row, [
                    'student_id' => $student->id,
                    'teacher_id' => $waliKelas->id,
                    'updated_at' => $row['dibalas_at'] ?? $row['created_at'],
                ])
            );
        }

        $this->command->info('Konsultasi seeded: ' . count($data) . ' record.');
    }
}