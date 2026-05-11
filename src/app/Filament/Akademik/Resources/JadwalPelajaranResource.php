<?php

namespace App\Filament\Akademik\Resources;

use App\Filament\Akademik\Resources\JadwalPelajaranResource\Pages;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Ruangan;
use App\Models\TahunAjaran;
use App\Models\Teacher;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class JadwalPelajaranResource extends Resource
{
    protected static ?string $model = JadwalPelajaran::class;
    protected static ?string $navigationIcon = 'heroicon-s-calendar-days';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 6;
    protected static ?string $navigationLabel = 'Jadwal Pelajaran';
    protected static ?string $modelLabel = 'Jadwal Pelajaran';
    protected static ?string $pluralModelLabel = 'Jadwal Pelajaran';

    private static array $hariOrder = [
        'Senin' => 1, 'Selasa' => 2, 'Rabu' => 3,
        'Kamis' => 4, 'Jumat' => 5, 'Sabtu' => 6,
    ];

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Plotting Guru ke Kelas')->schema([
                Select::make('tahun_ajaran_id')
                    ->label('Tahun Ajaran')
                    ->options(
                        TahunAjaran::orderByDesc('id')
                            ->get()
                            ->mapWithKeys(fn ($ta) => [$ta->id => "{$ta->nama} – {$ta->semester}"])
                    )
                    ->required()
                    ->default(fn () => TahunAjaran::where('is_aktif', true)->first()?->id)
                    ->searchable()
                    ->preload(),

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
                    ->placeholder('Belum ditentukan'),

                Toggle::make('is_aktif')
                    ->label('Aktif')
                    ->default(true),
            ])->columns(2),

            Section::make('Waktu Pelaksanaan')->schema([
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
                    ->minutesStep(5)
                    ->after('jam_mulai'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kelas.nama')
                    ->label('Kelas')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('mataPelajaran.nama')
                    ->label('Mata Pelajaran')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('teacher.name')
                    ->label('Guru Pengajar')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('hari')
                    ->label('Hari')
                    ->badge()
                    ->sortable()
                    ->color(fn ($state) => match ($state) {
                        'Senin'  => 'info',
                        'Selasa' => 'success',
                        'Rabu'   => 'warning',
                        'Kamis'  => 'danger',
                        'Jumat'  => 'gray',
                        'Sabtu'  => 'gray',
                        default  => 'gray',
                    }),

                TextColumn::make('jam_ke')
                    ->label('Jam Ke')
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
                    ->badge()
                    ->color('success')
                    ->default('-'),

                IconColumn::make('is_aktif')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->filters([
                SelectFilter::make('tahun_ajaran_id')
                    ->label('Tahun Ajaran')
                    ->options(
                        TahunAjaran::orderByDesc('id')
                            ->get()
                            ->mapWithKeys(fn ($ta) => [$ta->id => "{$ta->nama} – {$ta->semester}"])
                    )
                    ->default(fn () => TahunAjaran::where('is_aktif', true)->first()?->id),

                SelectFilter::make('kelas_id')
                    ->label('Kelas')
                    ->options(Kelas::orderBy('tingkat')->orderBy('nama')->pluck('nama', 'id'))
                    ->searchable(),

                SelectFilter::make('teacher_id')
                    ->label('Guru')
                    ->options(Teacher::orderBy('name')->pluck('name', 'id'))
                    ->searchable(),

                SelectFilter::make('hari')
                    ->label('Hari')
                    ->options(JadwalPelajaran::$hariOptions),
            ])
            ->defaultSort(fn ($query) => $query
                ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
                ->orderBy('jam_ke')
            )
            ->actions([EditAction::make(), DeleteAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListJadwalPelajarans::route('/'),
            'create' => Pages\CreateJadwalPelajaran::route('/create'),
            'edit'   => Pages\EditJadwalPelajaran::route('/{record}/edit'),
        ];
    }
}