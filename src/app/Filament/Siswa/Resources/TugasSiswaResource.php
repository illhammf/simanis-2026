<?php

namespace App\Filament\Siswa\Resources;

use App\Filament\Siswa\Resources\TugasSiswaResource\Pages;
use App\Models\JadwalPelajaran;
use App\Models\Student;
use App\Models\Tugas;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TugasSiswaResource extends Resource
{
    protected static ?string $model = Tugas::class;

    protected static ?string $navigationLabel = 'Tugas';
    protected static ?string $pluralModelLabel = 'Tugas';
    protected static ?string $modelLabel = 'Tugas';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?int $navigationSort = 4;

    public static function getEloquentQuery(): Builder
    {
        $student = Student::where('user_id', auth()->id())->first();

        // Ambil tugas dari modul ajar yang sesuai dengan jadwal kelas siswa
        $jadwals = JadwalPelajaran::where('kelas_id', $student?->kelas_id ?? 0)
            ->where('is_aktif', true)
            ->get();

        $pairs = $jadwals->map(fn ($j) => [
            'mata_pelajaran_id' => $j->mata_pelajaran_id,
            'teacher_id'        => $j->teacher_id,
        ]);

        return parent::getEloquentQuery()
            ->with(['modulAjar.mataPelajaran', 'modulAjar.teacher'])
            ->whereHas('modulAjar', function ($q) use ($pairs) {
                $q->where(function ($sub) use ($pairs) {
                    foreach ($pairs as $pair) {
                        $sub->orWhere(function ($inner) use ($pair) {
                            $inner->where('mata_pelajaran_id', $pair['mata_pelajaran_id'])
                                  ->where('teacher_id', $pair['teacher_id']);
                        });
                    }
                });
            });
    }

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('modulAjar.mataPelajaran.nama')
                    ->label('Mata Pelajaran'),

                TextColumn::make('judul')
                    ->label('Judul Tugas')
                    ->searchable()->limit(50),

                TextColumn::make('tipe')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'tugas_harian','pr'     => 'info',
                        'kuis','ulangan_harian' => 'warning',
                        'pts','pas'             => 'danger',
                        'proyek'                => 'success',
                        default                 => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => Tugas::$tipeLabels[$state] ?? $state),

                TextColumn::make('tanggal_mulai')
                    ->label('Mulai')
                    ->date('d/m/Y')
                    ->default('-'),

                TextColumn::make('deadline')
                    ->label('Deadline')
                    ->date('d/m/Y')
                    ->default('-')
                    ->color(fn ($state) => $state && now()->greaterThan($state) ? 'danger' : null),

                TextColumn::make('nilai_maksimal')
                    ->label('Nilai Maks')
                    ->badge()->color('gray'),

                IconColumn::make('file_tugas')
                    ->label('File')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-text')
                    ->falseIcon('heroicon-o-x-mark'),

                TextColumn::make('modulAjar.teacher.name')
                    ->label('Guru')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('deadline', 'asc')
            ->filters([
                SelectFilter::make('tipe')
                    ->options(Tugas::$tipeLabels)
                    ->label('Jenis Tugas'),
            ])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTugasSiswa::route('/'),
        ];
    }
}