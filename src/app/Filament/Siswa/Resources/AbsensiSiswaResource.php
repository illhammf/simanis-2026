<?php

namespace App\Filament\Siswa\Resources;

use App\Filament\Siswa\Resources\AbsensiSiswaResource\Pages;
use App\Models\Absensi;
use App\Models\Student;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AbsensiSiswaResource extends Resource
{
    protected static ?string $model = Absensi::class;

    protected static ?string $navigationLabel = 'Absensi Saya';
    protected static ?string $pluralModelLabel = 'Absensi';
    protected static ?string $modelLabel = 'Absensi';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?int $navigationSort = 3;

    public static function getEloquentQuery(): Builder
    {
        $student = Student::where('user_id', auth()->id())->first();

        return parent::getEloquentQuery()
            ->with(['jadwalPelajaran.mataPelajaran'])
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
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('jadwalPelajaran.mataPelajaran.nama')
                    ->label('Mata Pelajaran'),

                TextColumn::make('jadwalPelajaran.hari')
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

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'hadir' => 'success',
                        'izin'  => 'info',
                        'sakit' => 'warning',
                        'alpha' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => Absensi::$statusOptions[$state] ?? $state),

                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->default('-'),
            ])
            ->defaultSort('tanggal', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options(Absensi::$statusOptions)
                    ->label('Status'),
            ])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbsensiSiswa::route('/'),
        ];
    }
}