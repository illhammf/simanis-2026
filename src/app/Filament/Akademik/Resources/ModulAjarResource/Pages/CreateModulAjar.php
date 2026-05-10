<?php

namespace App\Filament\Akademik\Resources\ModulAjarResource\Pages;

use App\Filament\Akademik\Resources\ModulAjarResource;
use App\Models\Kurikulum;
use App\Models\MataPelajaran;
use App\Models\Teacher;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;

class CreateModulAjar extends CreateRecord
{
    use HasWizard;

    protected static string $resource = ModulAjarResource::class;

    protected function getSteps(): array
    {
        return [
            Step::make('Identitas Modul')
                ->description('Judul, kurikulum, mata pelajaran, dan alokasi waktu')
                ->icon('heroicon-o-identification')
                ->columns(2)
                ->schema([
                    TextInput::make('judul')
                        ->label('Judul Modul Ajar')
                        ->placeholder('Contoh: Modul Ajar Matematika – Persamaan Linear Kelas 8')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Select::make('kurikulum_id')
                        ->label('Kurikulum')
                        ->options(Kurikulum::all()->mapWithKeys(fn ($k) => [$k->id => $k->nama_lengkap]))
                        ->searchable()
                        ->required(),

                    Select::make('mata_pelajaran_id')
                        ->label('Mata Pelajaran')
                        ->options(MataPelajaran::orderBy('nama')->pluck('nama', 'id'))
                        ->searchable()
                        ->required(),

                    Select::make('kelas')
                        ->label('Kelas')
                        ->options([
                            '7' => 'Kelas 7', '8' => 'Kelas 8', '9' => 'Kelas 9',
                            '10' => 'Kelas 10', '11' => 'Kelas 11', '12' => 'Kelas 12',
                        ])
                        ->required()
                        ->native(false),

                    Select::make('semester')
                        ->label('Semester')
                        ->options(['1' => 'Ganjil (1)', '2' => 'Genap (2)'])
                        ->required()
                        ->native(false),

                    TextInput::make('alokasi_waktu')
                        ->label('Alokasi Waktu (JP)')
                        ->numeric()
                        ->minValue(1)
                        ->placeholder('2')
                        ->suffix('JP'),

                    Select::make('teacher_id')
                        ->label('Guru Pengajar')
                        ->options(Teacher::orderBy('name')->pluck('name', 'id'))
                        ->searchable()
                        ->nullable()
                        ->placeholder('Belum ditentukan'),

                    Select::make('tujuan_pembelajaran_id')
                        ->label('Tujuan Pembelajaran (TP) — Opsional')
                        ->relationship('tujuanPembelajaran', 'kode_tp')
                        ->getOptionLabelFromRecordUsing(fn ($record) =>
                            "[{$record->kode_tp}] {$record->deskripsi}"
                        )
                        ->searchable()
                        ->preload()
                        ->nullable()
                        ->columnSpanFull()
                        ->helperText('Pilih TP yang menjadi acuan modul ini jika sudah ada.'),
                ]),

            Step::make('Tujuan & Konteks')
                ->description('Tujuan pembelajaran, pemahaman bermakna, dan pertanyaan pemantik')
                ->icon('heroicon-o-light-bulb')
                ->schema([
                    Textarea::make('tujuan')
                        ->label('Tujuan Pembelajaran')
                        ->placeholder('Siswa mampu memahami dan menerapkan…')
                        ->rows(4)
                        ->helperText('Uraikan capaian yang diharapkan dari siswa setelah mempelajari modul ini.'),

                    Textarea::make('pemahaman_bermakna')
                        ->label('Pemahaman Bermakna')
                        ->placeholder('Melalui modul ini, siswa akan menyadari bahwa…')
                        ->rows(3)
                        ->helperText('Ide besar atau konsep inti yang perlu dipahami secara mendalam.'),

                    Textarea::make('pertanyaan_pemantik')
                        ->label('Pertanyaan Pemantik')
                        ->placeholder('Pernahkah kamu…? Mengapa…? Bagaimana jika…?')
                        ->rows(3)
                        ->helperText('Pertanyaan yang membangkitkan rasa ingin tahu dan memandu eksplorasi siswa.'),
                ]),

            Step::make('Kegiatan & Asesmen')
                ->description('Rincian kegiatan pembelajaran dan bentuk asesmen')
                ->icon('heroicon-o-clipboard-document-list')
                ->schema([
                    RichEditor::make('kegiatan_pembelajaran')
                        ->label('Kegiatan Pembelajaran')
                        ->placeholder('Pendahuluan → Inti → Penutup')
                        ->toolbarButtons([
                            'bold', 'italic', 'underline', 'strike',
                            'bulletList', 'orderedList',
                            'h2', 'h3',
                            'blockquote', 'link',
                        ])
                        ->helperText('Uraikan alur kegiatan: Pendahuluan, Inti (eksplorasi, elaborasi, konfirmasi), dan Penutup.'),

                    RichEditor::make('asesmen')
                        ->label('Asesmen')
                        ->placeholder('Asesmen diagnostik, formatif, dan sumatif…')
                        ->toolbarButtons([
                            'bold', 'italic', 'underline',
                            'bulletList', 'orderedList',
                            'h3', 'link',
                        ])
                        ->helperText('Jelaskan jenis, bentuk, dan instrumen asesmen yang digunakan.'),
                ]),

            Step::make('Sumber & Berkas')
                ->description('Sumber belajar dan unggah file modul ajar')
                ->icon('heroicon-o-paper-clip')
                ->schema([
                    Textarea::make('sumber_belajar')
                        ->label('Sumber Belajar')
                        ->placeholder("Buku Siswa Kurikulum Merdeka\nBuku Guru\nVideo YouTube: https://…\nLKPD halaman 45-50")
                        ->rows(4)
                        ->helperText('Daftar buku, tautan, video, atau media lain yang digunakan.'),

                    FileUpload::make('file_modul')
                        ->label('File Modul Ajar (PDF / DOCX)')
                        ->disk('public')
                        ->directory('modul-ajar')
                        ->acceptedFileTypes([
                            'application/pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        ])
                        ->maxSize(10240)
                        ->downloadable()
                        ->helperText('Maks. 10 MB. Format PDF atau Word.'),
                ]),
        ];
    }
}
