<?php

namespace Database\Seeders;

use App\Models\Kurikulum;
use App\Models\MataPelajaran;
use App\Models\ModulAjar;
use App\Models\Teacher;
use App\Models\Tugas;
use Illuminate\Database\Seeder;

class ModulAjarTugasSeeder extends Seeder
{
    public function run(): void
    {
        $kurikulum = Kurikulum::where('jenjang', 'SMP')->where('fase', 'D')->first();
        if (! $kurikulum) {
            $this->command->warn('Kurikulum SMP Fase D tidak ditemukan. ModulAjarTugasSeeder dilewati.');
            return;
        }

        $budi = Teacher::where('name', 'Budi Santoso')->first();
        $siti = Teacher::where('name', 'Siti Rahayu')->first();

        $mtk = MataPelajaran::where('kode', 'MTK')->first();
        $bin = MataPelajaran::where('kode', 'BIN')->first();
        $ipa = MataPelajaran::where('kode', 'IPA')->first();
        $ips = MataPelajaran::where('kode', 'IPS')->first();
        $big = MataPelajaran::where('kode', 'BIG')->first();

        // ── Modul Ajar + Tugas ────────────────────────────────────────
        $modulData = [
            // MATEMATIKA
            [
                'mapel' => $mtk, 'teacher' => $budi,
                'judul' => 'Bilangan Bulat & Operasinya', 'kelas' => '7', 'semester' => '1',
                'alokasi_waktu' => 4,
                'tujuan' => 'Peserta didik mampu melakukan operasi hitung bilangan bulat (penjumlahan, pengurangan, perkalian, pembagian) dengan benar.',
                'pemahaman_bermakna' => 'Bilangan bulat digunakan dalam kehidupan sehari-hari seperti suhu, hutang-piutang, dan ketinggian.',
                'pertanyaan_pemantik' => 'Mengapa termometer bisa menunjukkan angka negatif? Apa artinya?',
                'tugas' => [
                    ['judul' => 'Latihan Operasi Bilangan Bulat', 'tipe' => 'tugas_harian', 'deadline' => '+3 days', 'nilai_max' => 100],
                    ['judul' => 'Kuis Bilangan Bulat', 'tipe' => 'kuis', 'deadline' => '+7 days', 'nilai_max' => 100],
                ],
            ],
            [
                'mapel' => $mtk, 'teacher' => $budi,
                'judul' => 'Persamaan Linear Satu Variabel', 'kelas' => '7', 'semester' => '1',
                'alokasi_waktu' => 6,
                'tujuan' => 'Peserta didik mampu membuat dan menyelesaikan persamaan linear satu variabel dari masalah kontekstual.',
                'pemahaman_bermakna' => 'Persamaan linear digunakan untuk memodelkan berbagai masalah nyata, dari harga barang hingga perjalanan.',
                'pertanyaan_pemantik' => 'Jika sebuah buku harganya 2x dan dibeli 3, totalnya Rp60.000. Berapakah x?',
                'tugas' => [
                    ['judul' => 'Ulangan Harian Persamaan Linear', 'tipe' => 'ulangan_harian', 'deadline' => '+14 days', 'nilai_max' => 100],
                ],
            ],

            // BAHASA INDONESIA
            [
                'mapel' => $bin, 'teacher' => $siti,
                'judul' => 'Teks Deskripsi: Mengenal dan Menulis', 'kelas' => '7', 'semester' => '1',
                'alokasi_waktu' => 4,
                'tujuan' => 'Peserta didik mampu mengidentifikasi ciri-ciri teks deskripsi dan menyusun teks deskripsi dengan struktur yang benar.',
                'pemahaman_bermakna' => 'Teks deskripsi membantu pembaca "merasakan" objek yang digambarkan tanpa harus melihatnya langsung.',
                'pertanyaan_pemantik' => 'Coba gambarkan tempat favoritmu hanya dengan kata-kata — bisakah teman-temanmu menebaknya?',
                'tugas' => [
                    ['judul' => 'Tugas Menulis Teks Deskripsi', 'tipe' => 'tugas_harian', 'deadline' => '+5 days', 'nilai_max' => 100],
                    ['judul' => 'Penilaian Teks Deskripsi (PTS)', 'tipe' => 'pts', 'deadline' => '+21 days', 'nilai_max' => 100, 'bobot' => 30],
                ],
            ],
            [
                'mapel' => $bin, 'teacher' => $siti,
                'judul' => 'Teks Narasi: Menceritakan Pengalaman', 'kelas' => '7', 'semester' => '1',
                'alokasi_waktu' => 4,
                'tujuan' => 'Peserta didik dapat menulis teks narasi berdasarkan pengalaman pribadi dengan urutan peristiwa yang logis.',
                'pemahaman_bermakna' => 'Semua cerita yang pernah kamu dengar adalah teks narasi — dari dongeng hingga berita.',
                'pertanyaan_pemantik' => 'Cerita apa yang paling berkesan dalam hidupmu? Bagaimana kamu menceritakannya?',
                'tugas' => [
                    ['judul' => 'PR Teks Narasi Pengalaman Pribadi', 'tipe' => 'pr', 'deadline' => '+7 days', 'nilai_max' => 100],
                ],
            ],

            // IPA
            [
                'mapel' => $ipa, 'teacher' => $budi,
                'judul' => 'Metode Ilmiah & Keselamatan Laboratorium', 'kelas' => '7', 'semester' => '1',
                'alokasi_waktu' => 2,
                'tujuan' => 'Peserta didik memahami langkah-langkah metode ilmiah dan menerapkan prosedur keselamatan di laboratorium.',
                'pemahaman_bermakna' => 'Ilmuwan besar seperti Newton dan Einstein menggunakan metode ilmiah untuk menemukan teorinya.',
                'pertanyaan_pemantik' => 'Bagaimana caramu membuktikan bahwa tanaman butuh cahaya matahari?',
                'tugas' => [
                    ['judul' => 'Tugas Merancang Eksperimen Sederhana', 'tipe' => 'proyek', 'deadline' => '+10 days', 'nilai_max' => 100, 'bobot' => 20],
                ],
            ],
            [
                'mapel' => $ipa, 'teacher' => $budi,
                'judul' => 'Materi dan Perubahannya', 'kelas' => '7', 'semester' => '1',
                'alokasi_waktu' => 4,
                'tujuan' => 'Peserta didik mampu mengklasifikasikan materi berdasarkan wujud dan sifatnya, serta menjelaskan perubahan fisika dan kimia.',
                'pemahaman_bermakna' => 'Semua benda di sekitar kita adalah materi — es batu yang mencair, kertas yang terbakar.',
                'pertanyaan_pemantik' => 'Saat kamu membakar kertas, apakah kertasnya masih ada? Ke mana perginya?',
                'tugas' => [
                    ['judul' => 'Ulangan Harian Materi & Perubahannya', 'tipe' => 'ulangan_harian', 'deadline' => '+14 days', 'nilai_max' => 100],
                ],
            ],

            // IPS
            [
                'mapel' => $ips, 'teacher' => $siti,
                'judul' => 'Kondisi Geografis Indonesia', 'kelas' => '7', 'semester' => '1',
                'alokasi_waktu' => 4,
                'tujuan' => 'Peserta didik dapat mendeskripsikan kondisi geografis Indonesia dan pengaruhnya terhadap kehidupan masyarakat.',
                'pemahaman_bermakna' => 'Letak geografis Indonesia sebagai negara kepulauan terbesar memengaruhi iklim, budaya, dan ekonomi.',
                'pertanyaan_pemantik' => 'Mengapa Indonesia memiliki dua musim sementara negara lain memiliki empat musim?',
                'tugas' => [
                    ['judul' => 'Tugas Peta Kondisi Geografis Indonesia', 'tipe' => 'tugas_harian', 'deadline' => '+6 days', 'nilai_max' => 100],
                    ['judul' => 'Kuis Geografi Indonesia', 'tipe' => 'kuis', 'deadline' => '+12 days', 'nilai_max' => 50],
                ],
            ],

            // BAHASA INGGRIS
            [
                'mapel' => $big, 'teacher' => $budi,
                'judul' => 'Introduction & Self-Description (Speaking)', 'kelas' => '7', 'semester' => '1',
                'alokasi_waktu' => 2,
                'tujuan' => 'Students can introduce themselves and describe themselves using simple present tense.',
                'pemahaman_bermakna' => 'English is a global language used by more than 1.5 billion people worldwide.',
                'pertanyaan_pemantik' => 'How would you introduce yourself to someone from another country?',
                'tugas' => [
                    ['judul' => 'Speaking Test: Self Introduction', 'tipe' => 'tugas_harian', 'deadline' => '+8 days', 'nilai_max' => 100],
                ],
            ],
        ];

        foreach ($modulData as $item) {
            if (! $item['mapel'] || ! $item['teacher']) continue;

            $modul = ModulAjar::firstOrCreate(
                [
                    'kurikulum_id'      => $kurikulum->id,
                    'mata_pelajaran_id' => $item['mapel']->id,
                    'judul'             => $item['judul'],
                    'kelas'             => $item['kelas'],
                    'semester'          => $item['semester'],
                ],
                [
                    'teacher_id'              => $item['teacher']->id,
                    'alokasi_waktu'           => $item['alokasi_waktu'],
                    'tujuan'                  => $item['tujuan'],
                    'pemahaman_bermakna'      => $item['pemahaman_bermakna'],
                    'pertanyaan_pemantik'     => $item['pertanyaan_pemantik'],
                    'kegiatan_pembelajaran'   => "Pendahuluan:\n- Salam dan doa\n- Apersepsi: mengaitkan dengan materi sebelumnya\n- Menyampaikan tujuan pembelajaran\n\nKegiatan Inti:\n- Eksplorasi konsep\n- Diskusi kelompok\n- Presentasi hasil\n\nPenutup:\n- Refleksi\n- Rangkuman bersama\n- Pemberian tugas",
                    'asesmen'                 => "Asesmen Diagnostik: pertanyaan lisan di awal\nAsesmen Formatif: observasi aktivitas, kuis singkat\nAsesmen Sumatif: ulangan harian",
                    'sumber_belajar'          => "Buku teks siswa, LKPD, media presentasi",
                    'tujuan_pembelajaran_id'  => null,
                ]
            );

            // Buat tugas-tugasnya
            foreach ($item['tugas'] as $t) {
                $deadline = date('Y-m-d', strtotime($t['deadline']));

                Tugas::firstOrCreate(
                    ['modul_ajar_id' => $modul->id, 'judul' => $t['judul']],
                    [
                        'tipe'           => $t['tipe'],
                        'deadline'       => $deadline,
                        'tanggal_mulai'  => date('Y-m-d'),
                        'nilai_maksimal' => $t['nilai_max'],
                        'bobot'          => $t['bobot'] ?? null,
                        'deskripsi'      => 'Kerjakan dengan jujur dan teliti sesuai petunjuk yang diberikan.',
                    ]
                );
            }
        }

        $jumlahModul = ModulAjar::count();
        $jumlahTugas = Tugas::count();
        $this->command->info("ModulAjar seeded: {$jumlahModul} modul, {$jumlahTugas} tugas.");
    }
}