<?php

namespace Database\Seeders;

use App\Models\Stream;
use App\Models\StreamMilestone;
use Illuminate\Database\Seeder;

class StreamMilestoneSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Akademik' => [
                1 => [
                    'judul'               => 'Fondasi Akademik & Adaptasi Lingkungan',
                    'deskripsi'           => 'Semester pertama berfokus pada penyesuaian diri dengan lingkungan baru, membangun kebiasaan belajar yang baik, dan menguasai konsep-konsep dasar setiap mata pelajaran.',
                    'kompetensi_akademik' => "Matematika: Operasi bilangan bulat & aljabar dasar\nBahasa Indonesia: Membaca kritis & menulis paragraf narasi\nBahasa Inggris: Tenses dasar (present, past) & percakapan sehari-hari\nIPA/IPS: Pengenalan konsep ilmu alam & ilmu sosial",
                    'target_karakter'     => "Disiplin waktu & tertib mengikuti aturan sekolah\nPercaya diri berbicara di depan kelas\nBerkolaborasi & menghargai teman sebaya\nJujur dalam mengerjakan tugas & ujian",
                    'tips'                => 'Buat jadwal belajar harian minimal 1,5 jam. Jangan ragu bertanya kepada guru jika ada materi yang belum dipahami. Kenali teman-teman barumu dan bangun jaringan belajar bersama.',
                ],
                2 => [
                    'judul'               => 'Penguatan Konsep & Eksplorasi Minat',
                    'deskripsi'           => 'Saatnya memperkuat pemahaman konsep yang dipelajari semester lalu dan mulai mengeksplorasi mata pelajaran mana yang paling diminati.',
                    'kompetensi_akademik' => "Matematika: Persamaan & pertidaksamaan linear\nBahasa Indonesia: Menulis teks eksposisi & argumentasi\nBahasa Inggris: Reading comprehension & writing paragraf\nIPA: Materi & perubahannya\nIPS: Sejarah dan geografi dasar",
                    'target_karakter'     => "Rasa ingin tahu yang tinggi terhadap ilmu pengetahuan\nMandiri dalam mengerjakan pekerjaan rumah\nMenghargai keberagaman perspektif\nMulai mengenal kekuatan & kelemahan diri sendiri",
                    'tips'                => 'Coba ikut satu kegiatan ekstrakurikuler yang sesuai minat. Buat catatan ringkasan setelah setiap pelajaran untuk memperkuat ingatan.',
                ],
                3 => [
                    'judul'               => 'Pengembangan Kemampuan Analitis',
                    'deskripsi'           => 'Memasuki tahun kedua, fokus bergeser ke kemampuan menganalisis, membuat inferensi, dan menghubungkan konsep antar mata pelajaran.',
                    'kompetensi_akademik' => "Matematika: Fungsi, persamaan kuadrat & geometri\nBahasa Indonesia: Analisis teks sastra & non-sastra\nBahasa Inggris: Grammar menengah & essay writing\nIPA: Fisika dasar & kimia dasar\nIPS: Ekonomi dasar & interaksi sosial",
                    'target_karakter'     => "Berpikir kritis & tidak mudah menerima informasi tanpa verifikasi\nBertanggung jawab atas hasil belajar sendiri\nTerbiasa membuat perencanaan sebelum mengerjakan tugas\nEmpati & kemampuan mendengarkan",
                    'tips'                => 'Mulai kebiasaan membaca buku non-pelajaran (novel, artikel ilmiah populer) minimal 30 menit per hari untuk memperluas wawasan dan memperkuat literasi.',
                ],
                4 => [
                    'judul'               => 'Konsolidasi & Persiapan Penjurusan',
                    'deskripsi'           => 'Semester ini penting sebagai dasar penjurusan. Perkuat mata pelajaran yang akan menjadi fokus di tahun ketiga dan kenali potensi akademik diri.',
                    'kompetensi_akademik' => "Matematika: Statistika dasar & trigonometri\nBahasa Indonesia: Produksi teks ilmiah & presentasi\nBahasa Inggris: Debat & public speaking dasar\nIPA: Mekanika & stoikiometri dasar\nIPS: Sejarah modern & geopolitik",
                    'target_karakter'     => "Visioner: mulai memikirkan cita-cita & jalur karir\nKetangguhan mental dalam menghadapi tantangan akademik\nMampu menerima kritik & masukan secara konstruktif\nKolaborasi lintas kelompok",
                    'tips'                => 'Diskusikan pilihan jurusan dengan guru BK dan orang tua. Cari informasi tentang jurusan kuliah yang diminati agar penjurusan SMA sejalan dengan tujuan jangka panjang.',
                ],
                5 => [
                    'judul'               => 'Spesialisasi & Pendalaman Materi',
                    'deskripsi'           => 'Tahun ketiga adalah tahun pendalaman. Kuasai materi ujian nasional/asesmen kompetensi dan mulai menyiapkan portofolio akademik.',
                    'kompetensi_akademik' => "Matematika: Kalkulus dasar & kombinatorika\nBahasa Indonesia: Karya ilmiah & laporan penelitian\nBahasa Inggris: TOEFL/IELTS preparation dasar\nMata pelajaran peminatan: pendalaman konsep lanjut",
                    'target_karakter'     => "Disiplin & fokus menghadapi tekanan ujian\nManajemen stres yang sehat\nMotivasi intrinsik: belajar karena ingin tahu, bukan hanya nilai\nSiap bersaing secara sehat di tingkat nasional",
                    'tips'                => 'Buat bank soal pribadi dari latihan ujian tahun-tahun sebelumnya. Bergabung dengan kelompok belajar intensif untuk materi yang masih lemah.',
                ],
                6 => [
                    'judul'               => 'Puncak Pencapaian & Transisi',
                    'deskripsi'           => 'Semester akhir: waktunya membuktikan seluruh kerja keras 3 tahun. Selesaikan studi dengan nilai terbaik dan siapkan diri untuk jenjang berikutnya.',
                    'kompetensi_akademik' => "Penguasaan penuh seluruh kompetensi kurikulum\nKemampuan presentasi & argumentasi ilmiah\nLiterasi digital & riset mandiri\nPersiapan UTBK/seleksi perguruan tinggi",
                    'target_karakter'     => "Kepemimpinan & inisiatif\nMenjadi mentor bagi adik kelas\nSyukur & apresiasi atas perjalanan belajar\nSiap mental untuk kehidupan akademik/kerja berikutnya",
                    'tips'                => 'Jaga kesehatan fisik dan mental di semester akhir ini. Luangkan waktu untuk refleksi atas pencapaian 3 tahun dan rayakan setiap kemajuan, sekecil apapun.',
                ],
            ],
            'Vokasi' => [
                1 => [
                    'judul'               => 'Orientasi Dunia Kerja & Kompetensi Dasar',
                    'deskripsi'           => 'Membangun fondasi pengetahuan vokasional dan mengenalkan dunia kerja di bidang yang dipilih. Praktik awal di bengkel/lab.',
                    'kompetensi_akademik' => "Pengantar teknik/bisnis sesuai bidang keahlian\nMatematika terapan: perhitungan dasar\nBahasa Indonesia: komunikasi teknis dasar\nKeselamatan & Kesehatan Kerja (K3)\nPengenalan alat & peralatan dasar",
                    'target_karakter'     => "Kedisiplinan & ketepatan (presisi) dalam bekerja\nSikap profesional di lingkungan praktik\nBertanggung jawab atas peralatan & keselamatan\nSemangat & etos kerja tinggi",
                    'tips'                => 'Amati setiap detail saat instruktur mendemonstrasikan teknik. Jangan malu bertanya — di bidang vokasi, kekeliruan teknis kecil bisa berdampak besar.',
                ],
                2 => [
                    'judul'               => 'Penguasaan Teknik Dasar',
                    'deskripsi'           => 'Mengembangkan keterampilan teknis dasar bidang keahlian dengan praktek berulang hingga mencapai standar kompetensi yang ditetapkan.',
                    'kompetensi_akademik' => "Teknik dasar bidang keahlian (praktik terbimbing)\nDokumentasi & laporan kerja\nMenggambar teknik / desain dasar\nPenggunaan software/aplikasi bidang keahlian\nKomunikasi bisnis dasar",
                    'target_karakter'     => "Ketelitian & perhatian terhadap detail\nKetahanan menghadapi pekerjaan berulang (tekun)\nKreativitas dalam pemecahan masalah teknis\nKerja sama tim dalam proyek kecil",
                    'tips'                => 'Latih keterampilan teknis di rumah dengan proyek mini yang relevan. Dokumentasikan setiap pekerjaan sebagai portofolio awal.',
                ],
                3 => [
                    'judul'               => 'Integrasi Kompetensi & Proyek Terapan',
                    'deskripsi'           => 'Menggabungkan berbagai kompetensi teknis dalam proyek terapan yang lebih kompleks. Mulai terbiasa dengan standar industri.',
                    'kompetensi_akademik' => "Proyek terapan multidisiplin\nManajemen waktu & perencanaan kerja\nStandar kualitas industri (ISO/SNI dasar)\nPresentasi hasil karya teknis\nDigitalisasi proses kerja",
                    'target_karakter'     => "Orientasi hasil (result-oriented)\nAdaptasi terhadap perubahan teknologi\nInisiatif & problem-solving mandiri\nKomunikasi efektif dengan klien/rekan",
                    'tips'                => 'Mulai membangun portofolio digital: foto/video karya, laporan proyek, sertifikat kompetensi. Ini akan sangat berguna saat melamar kerja atau beasiswa.',
                ],
                4 => [
                    'judul'               => 'Pendalaman & Standar Kompetensi Industri',
                    'deskripsi'           => 'Mendalami kompetensi inti hingga mencapai standar industri. Persiapan untuk praktik kerja lapangan (PKL).',
                    'kompetensi_akademik' => "Kompetensi teknis lanjut sesuai bidang\nManajemen proyek dasar\nKewirausahaan & analisis pasar\nPersiapan sertifikasi kompetensi\nK3 lanjut & regulasi industri",
                    'target_karakter'     => "Profesionalisme & etika kerja\nLeadership dalam tim kecil\nNegoisasi & persuasi\nSiap mental menghadapi lingkungan kerja nyata",
                    'tips'                => 'Cari tahu jadwal & persyaratan uji kompetensi/sertifikasi di bidangmu. Persiapkan dokumen untuk PKL dan mulai survey perusahaan yang ingin dituju.',
                ],
                5 => [
                    'judul'               => 'Praktik Kerja Lapangan & Kompetensi Lanjut',
                    'deskripsi'           => 'PKL di industri nyata adalah puncak pembelajaran vokasional. Terapkan semua kompetensi dalam lingkungan profesional.',
                    'kompetensi_akademik' => "Praktik kerja lapangan (PKL) minimal 3 bulan\nLaporan PKL & presentasi pengalaman\nAdaptasi budaya kerja perusahaan\nPenerapan kompetensi teknis di dunia nyata\nNetworking profesional",
                    'target_karakter'     => "Adaptasi cepat & fleksibilitas\nInisiatif & proaktif tanpa instruksi berulang\nMenjaga reputasi diri & sekolah\nMembangun relasi profesional",
                    'tips'                => 'Catat semua pengalaman berharga selama PKL — tantangan, solusi, dan pelajaran. Ini akan menjadi bahan cerita terbaik saat wawancara kerja di masa depan.',
                ],
                6 => [
                    'judul'               => 'Uji Kompetensi & Kesiapan Kerja',
                    'deskripsi'           => 'Semester terakhir difokuskan untuk uji kompetensi resmi, penyempurnaan portofolio, dan mempersiapkan diri memasuki dunia kerja atau wirausaha.',
                    'kompetensi_akademik' => "Uji Kompetensi Keahlian (UKK)\nProyek akhir / karya nyata bidang keahlian\nCV, portofolio & wawancara kerja\nRencana karir & kewirausahaan\nLiterasi keuangan dasar",
                    'target_karakter'     => "Kepercayaan diri atas kompetensi yang dimiliki\nKesiapan bersaing di pasar kerja\nSemangat wirausaha & inovasi\nMenghargai proses & merayakan pencapaian",
                    'tips'                => 'Daftar ke bursa kerja atau pameran pendidikan. Siapkan minimal 3 versi CV untuk berbagai posisi. Jangan ragu melamar meskipun merasa belum 100% siap — pengalaman melamar pun adalah pembelajaran.',
                ],
            ],
            'Wirausaha' => [
                1 => [
                    'judul'               => 'Mengenal Mindset Wirausaha',
                    'deskripsi'           => 'Membangun pola pikir wirausaha (entrepreneurial mindset) dan mengenalkan ekosistem bisnis. Belajar mengidentifikasi peluang dari masalah sehari-hari.',
                    'kompetensi_akademik' => "Pengantar kewirausahaan & sejarah entrepreneur Indonesia\nIdentifikasi peluang bisnis dari masalah nyata\nDasar-dasar ekonomi & pasar\nKomunikasi persuasif & storytelling\nFinansi dasar: pendapatan, biaya, keuntungan",
                    'target_karakter'     => "Rasa ingin tahu & kepekaan terhadap masalah sekitar\nKeberanian mencoba & tidak takut gagal\nKreativitas & pemikiran out-of-the-box\nSemangat & kegigihan (grit)",
                    'tips'                => 'Mulai kebiasaan "problem journal": setiap hari catat 1 masalah yang kamu lihat di sekitarmu. Kebiasaan ini melatih kepekaan yang sangat dibutuhkan seorang wirausaha.',
                ],
                2 => [
                    'judul'               => 'Validasi Ide & Bisnis Mini Pertama',
                    'deskripsi'           => 'Dari ide, bergerak ke aksi nyata. Buat bisnis kecil pertama dengan modal minim untuk belajar proses jual-beli dan mendapat feedback nyata dari pasar.',
                    'kompetensi_akademik' => "Business Model Canvas (BMC)\nValidasi ide: survei, wawancara pelanggan\nPricing strategy dasar\nMedia sosial sebagai alat pemasaran\nPembukuan sederhana & arus kas",
                    'target_karakter'     => "Action-oriented: lebih banyak aksi daripada rencana\nResilien: bangkit dari penolakan & kegagalan pertama\nEmpati terhadap kebutuhan pelanggan\nIntegritas dalam bertransaksi",
                    'tips'                => 'Buat bisnis mini dengan modal di bawah Rp100.000. Tujuannya bukan untung besar, tapi belajar prosesnya: cari produk/jasa, tawarkan ke orang, terima uang, evaluasi. Lakukan minimal 1 kali!',
                ],
                3 => [
                    'judul'               => 'Skalakan Bisnis & Bangun Tim',
                    'deskripsi'           => 'Mengembangkan bisnis mini menjadi lebih terstruktur. Belajar mengajak orang lain bergabung dan membagi peran dalam tim kecil.',
                    'kompetensi_akademik' => "Manajemen tim & pembagian peran\nStrategi pemasaran digital (SEO, sosmed, konten)\nAnalisis kompetitor\nNegoisasi & kerjasama bisnis\nRekap keuangan & laporan laba rugi sederhana",
                    'target_karakter'     => "Leadership & kemampuan mendelegasikan\nKomunikasi terbuka dengan anggota tim\nFokus pada solusi, bukan masalah\nKonsistensi & komitmen jangka menengah",
                    'tips'                => 'Ajak minimal 2 teman untuk bergabung dalam proyek bisnis bersama. Belajar berkolaborasi, bagi hasil, dan menangani konflik tim adalah kompetensi wirausaha yang paling berharga.',
                ],
                4 => [
                    'judul'               => 'Inovasi Produk & Strategi Pertumbuhan',
                    'deskripsi'           => 'Pelajari cara berinovasi pada produk/layanan berdasarkan data dan feedback pelanggan. Kenali strategi pertumbuhan bisnis yang berkelanjutan.',
                    'kompetensi_akademik' => "Design Thinking & proses inovasi\nAnalisis data penjualan & feedback pelanggan\nStrategi pertumbuhan: viral, referral, kolaborasi\nBranding & identitas bisnis\nLegalitas usaha: UMKM, izin usaha dasar",
                    'target_karakter'     => "Berbasis data dalam pengambilan keputusan\nFleksibilitas: pivot jika diperlukan\nPikiran terbuka terhadap kritik pelanggan\nVisi jangka panjang bisnis",
                    'tips'                => 'Wawancarai minimal 5 pelanggan setiap bulan untuk memahami kebutuhan mereka lebih dalam. Bisnis terbaik dibangun dari mendengarkan, bukan hanya dari asumsi.',
                ],
                5 => [
                    'judul'               => 'Pitching, Funding & Jaringan Bisnis',
                    'deskripsi'           => 'Tingkatkan kemampuan presentasi bisnis (pitch), kenali sumber pendanaan, dan bangun jaringan dengan ekosistem wirausaha yang lebih luas.',
                    'kompetensi_akademik' => "Pitch deck & presentasi investor\nSumber pendanaan: bootstrap, hibah, investor\nEkosistem startup & inkubator bisnis\nPublic speaking & personal branding\nPerencanaan bisnis (business plan) lengkap",
                    'target_karakter'     => "Kepercayaan diri berbicara di depan investor/public\nNetworking aktif & tidak segan meminta mentorship\nAmbisi sehat: mau tumbuh tapi tetap beretika\nSikap kontributif terhadap komunitas",
                    'tips'                => 'Cari kompetisi bisnis pelajar (seperti PKM, Young Entrepreneur) dan ikuti meskipun belum siap sempurna. Pengalaman pitching di depan juri jauh lebih berharga dari ribuan jam persiapan.',
                ],
                6 => [
                    'judul'               => 'Bisnis Berkelanjutan & Legacy',
                    'deskripsi'           => 'Semester akhir: konsolidasi bisnis, susun rencana keberlanjutan, dan siapkan diri untuk melanjutkan ke jenjang berikutnya (kuliah kewirausahaan, inkubator, atau full-time entrepreneur).',
                    'kompetensi_akademik' => "Bisnis model berkelanjutan (sustainability)\nCorporate Social Responsibility (CSR) dasar\nSuksesi & transfer kepemimpinan bisnis\nPortofolio wirausaha & impact measurement\nRencana 5 tahun ke depan",
                    'target_karakter'     => "Kepemimpinan berkarakter & beretika\nOrientasi dampak: bisnis sebagai solusi sosial\nGratitude & menghargai perjalanan\nSiap menjadi mentor generasi berikutnya",
                    'tips'                => 'Dokumentasikan seluruh perjalanan bisnismu dalam sebuah cerita (blog, video, atau presentasi). Ini adalah bukti terkuat bahwa kamu adalah seorang wirausaha muda yang telah berani bergerak.',
                ],
            ],
        ];

        foreach ($data as $streamNama => $milestones) {
            $stream = Stream::where('nama', $streamNama)->first();

            if (! $stream) {
                continue;
            }

            foreach ($milestones as $semester => $milestoneData) {
                StreamMilestone::updateOrCreate(
                    ['stream_id' => $stream->id, 'semester' => $semester],
                    array_merge($milestoneData, ['is_aktif' => true])
                );
            }
        }
    }
}