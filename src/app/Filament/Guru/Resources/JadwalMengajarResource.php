<?php

namespace App\Filament\Guru\Resources;

use App\Models\JadwalPelajaran;
use App\Models\Teacher;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class JadwalMengajarResource extends Resource
{
    protected static ?string $model = JadwalPelajaran::class;

    protected static ?string $navigationLabel = 'Jadwal Mengajar';
    protected static ?string $pluralModelLabel = 'Jadwal Mengajar';
    protected static ?string $modelLabel = 'Jadwal';
    protected static ?string $navigationIcon = 'heroicon-s-calendar-days';
    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        $teacher = Teacher::where('user_id', auth()->id())->first();

        return parent::getEloquentQuery()
            ->with(['tahunAjaran', 'kelas', 'mataPelajaran', 'ruangan'])
            ->where('teacher_id', $teacher?->id ?? 0)
            ->where('is_aktif', true);
    }

    public static function form(Form $form): Form
    {
        // Read-only — guru tidak bisa ubah jadwal
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tahunAjaran.nama')
                    ->label('Tahun Ajaran')
                    ->badge()
                    ->color('primary'),

                TextColumn::make('kelas.nama')
                    ->label('Kelas')
                    ->badge()
                    ->color('info'),

                TextColumn::make('mataPelajaran.nama')
                    ->label('Mata Pelajaran')
                    ->searchable(),

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
                    ->badge()
                    ->color('gray')
                    ->formatStateUsing(fn ($state) => "JP {$state}"),

                TextColumn::make('jam_mulai')
                    ->label('Mulai')
                    ->formatStateUsing(fn ($state) => substr($state, 0, 5)),

                TextColumn::make('jam_selesai')
                    ->label('Selesai')
                    ->formatStateUsing(fn ($state) => substr($state, 0, 5)),

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
            'index' => \App\Filament\Guru\Resources\JadwalMengajarResource\Pages\ListJadwalMengajar::route('/'),
        ];
    }
}