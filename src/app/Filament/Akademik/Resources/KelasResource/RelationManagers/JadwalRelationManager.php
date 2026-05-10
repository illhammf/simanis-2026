<?php

namespace App\Filament\Akademik\Resources\KelasResource\RelationManagers;

use App\Models\JadwalPelajaran;
use App\Models\MataPelajaran;
use App\Models\Ruangan;
use App\Models\Teacher;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class JadwalRelationManager extends RelationManager
{
    protected static string $relationship = 'jadwalPelajarans';
    protected static ?string $title = 'Jadwal Pelajaran';
    protected static ?string $icon = 'heroicon-o-calendar-days';

    public function form(Form $form): Form
    {
        return $form->schema([
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
                    Ruangan::where('is_aktif', true)->orderBy('kode')
                        ->get()
                        ->mapWithKeys(fn ($r) => [$r->id => "[{$r->kode}] {$r->nama}"])
                )
                ->nullable()
                ->searchable()
                ->placeholder('—'),

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

            Toggle::make('is_aktif')
                ->label('Aktif')
                ->default(true),
        ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $kelas = $this->getOwnerRecord();
        $data['tahun_ajaran_id'] = $kelas->tahun_ajaran_id;
        return $data;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('hari')
            ->columns([
                TextColumn::make('hari')
                    ->label('Hari')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Senin'  => 'info',
                        'Selasa' => 'success',
                        'Rabu'   => 'warning',
                        'Kamis'  => 'danger',
                        default  => 'gray',
                    }),

                TextColumn::make('jam_ke')
                    ->label('Jam')
                    ->badge()
                    ->color('gray')
                    ->formatStateUsing(fn ($state) => "JP {$state}"),

                TextColumn::make('jam_mulai')
                    ->label('Mulai')
                    ->formatStateUsing(fn ($state) => substr($state, 0, 5)),

                TextColumn::make('jam_selesai')
                    ->label('Selesai')
                    ->formatStateUsing(fn ($state) => substr($state, 0, 5)),

                TextColumn::make('mataPelajaran.nama')
                    ->label('Mata Pelajaran')
                    ->searchable(),

                TextColumn::make('teacher.name')
                    ->label('Guru')
                    ->searchable(),

                TextColumn::make('ruangan.kode')
                    ->label('Ruangan')
                    ->badge()
                    ->color('success')
                    ->default('-'),

                IconColumn::make('is_aktif')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->defaultSort(fn ($query) => $query
                ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
                ->orderBy('jam_ke')
            )
            ->headerActions([CreateAction::make()->label('Tambah Jadwal')])
            ->actions([EditAction::make(), DeleteAction::make()])
            ->bulkActions([]);
    }
}