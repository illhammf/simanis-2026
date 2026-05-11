<?php

namespace App\Filament\OrangTua\Resources;

use App\Filament\OrangTua\Resources\JadwalAnakResource\Pages;
use App\Models\JadwalPelajaran;
use App\Models\Ortu;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class JadwalAnakResource extends Resource
{
    protected static ?string $model = JadwalPelajaran::class;

    protected static ?string $navigationLabel = 'Jadwal Anak';
    protected static ?string $pluralModelLabel = 'Jadwal Anak';
    protected static ?string $modelLabel = 'Jadwal';
    protected static ?string $navigationIcon = 'heroicon-s-calendar-days';
    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        $ortu   = Ortu::where('user_id', auth()->id())->first();
        $siswa  = $ortu?->siswa;

        return parent::getEloquentQuery()
            ->with(['mataPelajaran', 'teacher', 'ruangan', 'kelas', 'tahunAjaran'])
            ->where('kelas_id', $siswa?->kelas_id ?? 0)
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
            'index' => Pages\ListJadwalAnak::route('/'),
        ];
    }
}