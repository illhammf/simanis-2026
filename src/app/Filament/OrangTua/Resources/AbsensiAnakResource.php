<?php

namespace App\Filament\OrangTua\Resources;

use App\Filament\OrangTua\Resources\AbsensiAnakResource\Pages;
use App\Models\Absensi;
use App\Models\Ortu;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AbsensiAnakResource extends Resource
{
    protected static ?string $model = Absensi::class;

    protected static ?string $navigationLabel = 'Absensi Anak';
    protected static ?string $pluralModelLabel = 'Absensi Anak';
    protected static ?string $modelLabel = 'Absensi';
    protected static ?string $navigationIcon = 'heroicon-s-clipboard-document-check';
    protected static ?int $navigationSort = 3;

    public static function getEloquentQuery(): Builder
    {
        $ortu  = Ortu::where('user_id', auth()->id())->first();
        $siswa = $ortu?->siswa;

        return parent::getEloquentQuery()
            ->with(['jadwalPelajaran.mataPelajaran'])
            ->where('student_id', $siswa?->id ?? 0);
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
            'index' => Pages\ListAbsensiAnak::route('/'),
        ];
    }
}