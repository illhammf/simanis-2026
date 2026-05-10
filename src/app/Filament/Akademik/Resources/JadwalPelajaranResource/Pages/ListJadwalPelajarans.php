<?php

namespace App\Filament\Akademik\Resources\JadwalPelajaranResource\Pages;

use App\Filament\Akademik\Resources\JadwalPelajaranResource;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Ruangan;
use App\Models\TahunAjaran;
use App\Models\Teacher;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListJadwalPelajarans extends ListRecords
{
    protected static string $resource = JadwalPelajaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('buat_jadwal_bulk')
                ->label('Buat Jadwal Kelas (Bulk)')
                ->icon('heroicon-o-table-cells')
                ->color('success')
                ->modalWidth('7xl')
                ->modalHeading('Buat Jadwal Pelajaran Sekaligus')
                ->modalDescription('Pilih kelas, lalu tambahkan baris jadwal sebanyak yang dibutuhkan. Semua baris disimpan dalam satu klik.')
                ->form([
                    Section::make('Target Kelas')->schema([
                        Select::make('tahun_ajaran_id')
                            ->label('Tahun Ajaran')
                            ->options(
                                TahunAjaran::orderByDesc('id')
                                    ->get()
                                    ->mapWithKeys(fn ($ta) => [$ta->id => "{$ta->nama} – {$ta->semester}"])
                            )
                            ->required()
                            ->default(fn () => TahunAjaran::where('is_aktif', true)->first()?->id)
                            ->searchable(),

                        Select::make('kelas_id')
                            ->label('Kelas')
                            ->options(
                                Kelas::orderBy('tingkat')->orderBy('nama')
                                    ->get()
                                    ->mapWithKeys(fn ($k) => [$k->id => $k->nama])
                            )
                            ->required()
                            ->searchable(),
                    ])->columns(2),

                    Repeater::make('jadwal')
                        ->label('Daftar Jadwal')
                        ->helperText('Satu baris = satu sesi pelajaran. Tambah baris sesuai kebutuhan.')
                        ->schema([
                            Select::make('mata_pelajaran_id')
                                ->label('Mata Pelajaran')
                                ->options(MataPelajaran::orderBy('nama')->pluck('nama', 'id'))
                                ->required()
                                ->searchable(),

                            Select::make('teacher_id')
                                ->label('Guru')
                                ->options(Teacher::orderBy('name')->pluck('name', 'id'))
                                ->required()
                                ->searchable(),

                            Select::make('hari')
                                ->label('Hari')
                                ->options(JadwalPelajaran::$hariOptions)
                                ->required()
                                ->native(false),

                            Select::make('jam_ke')
                                ->label('Jam Ke')
                                ->options(array_combine(range(1, 10), range(1, 10)))
                                ->required()
                                ->native(false),

                            TimePicker::make('jam_mulai')
                                ->label('Jam Mulai')
                                ->required()
                                ->seconds(false)
                                ->minutesStep(5),

                            TimePicker::make('jam_selesai')
                                ->label('Jam Selesai')
                                ->required()
                                ->seconds(false)
                                ->minutesStep(5),

                            Select::make('ruangan_id')
                                ->label('Ruangan')
                                ->options(
                                    Ruangan::where('is_aktif', true)
                                        ->orderBy('kode')
                                        ->get()
                                        ->mapWithKeys(fn ($r) => [$r->id => "[{$r->kode}] {$r->nama}"])
                                )
                                ->nullable()
                                ->searchable()
                                ->placeholder('—'),
                        ])
                        ->columns(4)
                        ->defaultItems(2)
                        ->minItems(1)
                        ->addActionLabel('+ Tambah Baris Jadwal')
                        ->reorderable(false),
                ])
                ->action(function (array $data): void {
                    $count = 0;
                    foreach ($data['jadwal'] as $row) {
                        JadwalPelajaran::create([
                            'tahun_ajaran_id'   => $data['tahun_ajaran_id'],
                            'kelas_id'          => $data['kelas_id'],
                            'mata_pelajaran_id' => $row['mata_pelajaran_id'],
                            'teacher_id'        => $row['teacher_id'],
                            'ruangan_id'        => $row['ruangan_id'] ?? null,
                            'hari'              => $row['hari'],
                            'jam_ke'            => $row['jam_ke'],
                            'jam_mulai'         => $row['jam_mulai'],
                            'jam_selesai'       => $row['jam_selesai'],
                            'is_aktif'          => true,
                        ]);
                        $count++;
                    }

                    Notification::make()
                        ->title("{$count} jadwal berhasil ditambahkan.")
                        ->success()
                        ->send();
                }),

            CreateAction::make()->label('Tambah Satu Jadwal'),
        ];
    }
}
