<?php

namespace App\Filament\Akademik\Resources\JadwalPelajaranResource\Pages;

use App\Filament\Akademik\Resources\JadwalPelajaranResource;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Ruangan;
use App\Models\TahunAjaran;
use App\Models\Teacher;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;

class CreateJadwalPelajaran extends CreateRecord
{
    use HasWizard;

    protected static string $resource = JadwalPelajaranResource::class;

    protected function getSteps(): array
    {
        return [
            Step::make('Kelas')
                ->description('Pilih tahun ajaran dan kelas yang akan dijadwalkan')
                ->icon('heroicon-o-academic-cap')
                ->columns(2)
                ->schema([
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
                            Kelas::with('tahunAjaran')
                                ->orderBy('tingkat')
                                ->orderBy('nama')
                                ->get()
                                ->mapWithKeys(fn ($k) => [$k->id => "{$k->nama} ({$k->tahunAjaran?->nama})"])
                        )
                        ->required()
                        ->searchable(),
                ]),

            Step::make('Guru & Mata Pelajaran')
                ->description('Tentukan guru pengajar, mata pelajaran, dan ruangan')
                ->icon('heroicon-o-user-circle')
                ->columns(2)
                ->schema([
                    Select::make('mata_pelajaran_id')
                        ->label('Mata Pelajaran')
                        ->options(MataPelajaran::orderBy('nama')->pluck('nama', 'id'))
                        ->required()
                        ->searchable(),

                    Select::make('teacher_id')
                        ->label('Guru Pengajar')
                        ->options(Teacher::orderBy('name')->pluck('name', 'id'))
                        ->required()
                        ->searchable(),

                    Select::make('ruangan_id')
                        ->label('Ruangan')
                        ->options(
                            Ruangan::where('is_aktif', true)
                                ->orderBy('kode')
                                ->get()
                                ->mapWithKeys(fn ($r) => [$r->id => "[{$r->kode}] {$r->nama}"])
                        )
                        ->searchable()
                        ->nullable()
                        ->placeholder('Belum ditentukan')
                        ->columnSpanFull(),
                ]),

            Step::make('Waktu Pelaksanaan')
                ->description('Atur hari, jam pelajaran, dan jam mulai/selesai')
                ->icon('heroicon-o-clock')
                ->columns(2)
                ->schema([
                    Select::make('hari')
                        ->label('Hari')
                        ->options(JadwalPelajaran::$hariOptions)
                        ->required()
                        ->native(false),

                    Select::make('jam_ke')
                        ->label('Jam Pelajaran Ke')
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

                    Toggle::make('is_aktif')
                        ->label('Aktif')
                        ->default(true)
                        ->columnSpanFull(),
                ]),
        ];
    }
}