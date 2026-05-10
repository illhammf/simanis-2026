<?php

namespace App\Filament\Siswa\Resources;

use App\Filament\Siswa\Resources\NilaiSiswaResource\Pages;
use App\Models\Nilai;
use App\Models\Student;
use App\Models\Tugas;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class NilaiSiswaResource extends Resource
{
    protected static ?string $model = Nilai::class;

    protected static ?string $navigationLabel = 'Nilai Saya';
    protected static ?string $pluralModelLabel = 'Nilai';
    protected static ?string $modelLabel = 'Nilai';
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        $student = Student::where('user_id', auth()->id())->first();

        return parent::getEloquentQuery()
            ->with(['tugas', 'jadwalPelajaran.mataPelajaran', 'teacher'])
            ->where('student_id', $student?->id ?? 0);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jadwalPelajaran.mataPelajaran.nama')
                    ->label('Mata Pelajaran')
                    ->searchable(),

                TextColumn::make('tugas.judul')
                    ->label('Tugas / Penilaian')
                    ->limit(45),

                TextColumn::make('tugas.tipe')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'tugas_harian','pr'         => 'info',
                        'kuis','ulangan_harian'     => 'warning',
                        'pts','pas'                 => 'danger',
                        'proyek'                    => 'success',
                        default                     => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => Tugas::$tipeLabels[$state] ?? $state),

                TextColumn::make('nilai')
                    ->label('Nilai')
                    ->badge()
                    ->color(fn ($state) => match (true) {
                        $state >= 85 => 'success',
                        $state >= 70 => 'warning',
                        default      => 'danger',
                    }),

                TextColumn::make('tugas.nilai_maksimal')
                    ->label('Nilai Maks')
                    ->badge()->color('gray'),

                TextColumn::make('teacher.name')
                    ->label('Guru')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->default('-')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('jadwal_pelajaran_id')
                    ->relationship('jadwalPelajaran', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->mataPelajaran->nama ?? $record->id)
                    ->label('Mata Pelajaran'),
            ])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNilaiSiswa::route('/'),
        ];
    }
}