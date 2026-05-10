<?php

namespace App\Filament\Siswa\Resources;

use App\Filament\Siswa\Resources\JadwalSiswaResource\Pages;
use App\Models\JadwalPelajaran;
use App\Models\Student;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class JadwalSiswaResource extends Resource
{
    protected static ?string $model = JadwalPelajaran::class;

    protected static ?string $navigationLabel = 'Jadwal Pelajaran';
    protected static ?string $pluralModelLabel = 'Jadwal Pelajaran';
    protected static ?string $modelLabel = 'Jadwal';
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        $student = Student::where('user_id', auth()->id())->first();

        return parent::getEloquentQuery()
            ->with(['mataPelajaran', 'teacher', 'ruangan', 'kelas', 'tahunAjaran'])
            ->where('kelas_id', $student?->kelas_id ?? 0)
            ->where('is_aktif', true);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tahunAjaran.nama')
                    ->label('Tahun Ajaran')
                    ->badge()->color('primary'),

                TextColumn::make('hari')
                    ->label('Hari')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Senin'  => 'info',
                        'Selasa' => 'success',
                        'Rabu'   => 'warning',
                        'Kamis'  => 'danger',
                        'Jumat'  => 'primary',
                        default  => 'gray',
                    }),

                TextColumn::make('jam_ke')
                    ->label('JP')
                    ->badge()->color('gray')
                    ->formatStateUsing(fn ($state) => "JP {$state}"),

                TextColumn::make('jam_mulai')
                    ->label('Mulai')
                    ->formatStateUsing(fn ($state) => substr($state, 0, 5)),

                TextColumn::make('jam_selesai')
                    ->label('Selesai')
                    ->formatStateUsing(fn ($state) => substr($state, 0, 5)),

                TextColumn::make('mataPelajaran.nama')
                    ->label('Mata Pelajaran'),

                TextColumn::make('teacher.name')
                    ->label('Guru'),

                TextColumn::make('ruangan.kode')
                    ->label('Ruangan')
                    ->default('-'),
            ])
            ->defaultSort(fn ($query) => $query
                ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
                ->orderBy('jam_ke')
            )
            ->filters([
                SelectFilter::make('tahun_ajaran_id')
                    ->relationship('tahunAjaran', 'nama')
                    ->label('Tahun Ajaran'),
            ])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJadwalSiswa::route('/'),
        ];
    }
}