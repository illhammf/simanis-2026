<?php

namespace App\Filament\Akademik\Resources;

use App\Filament\Akademik\Resources\KelasResource\Pages;
use App\Filament\Akademik\Resources\KelasResource\RelationManagers\JadwalRelationManager;
use App\Filament\Akademik\Resources\KelasResource\RelationManagers\SiswaRelationManager;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KelasResource extends Resource
{
    protected static ?string $model = Kelas::class;

    protected static ?string $navigationIcon = 'heroicon-s-academic-cap';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Kelas';
    protected static ?string $modelLabel = 'Kelas';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kelas')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Kelas')
                            ->placeholder('7A / 10 Vokasi 1')
                            ->required()
                            ->maxLength(50),
                        Forms\Components\Select::make('jenjang')
                            ->label('Jenjang')
                            ->options([
                                'SMP' => 'SMP (Fase D)',
                                'SMA' => 'SMA (Fase E & F)',
                            ])
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (callable $set) => $set('tingkat', null)),
                        Forms\Components\Select::make('tingkat')
                            ->label('Tingkat / Kelas')
                            ->options(fn (Get $get) => match ($get('jenjang')) {
                                'SMP' => ['7' => 'Kelas 7', '8' => 'Kelas 8', '9' => 'Kelas 9'],
                                'SMA' => ['10' => 'Kelas 10', '11' => 'Kelas 11', '12' => 'Kelas 12'],
                                default => [],
                            })
                            ->required(),
                        Forms\Components\Select::make('stream_id')
                            ->label('Stream / Peminatan')
                            ->relationship('stream', 'nama')
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->visible(fn (Get $get) => $get('jenjang') === 'SMA')
                            ->helperText('Hanya untuk kelas SMA. Kelas 10 boleh kosong (belum pilih stream).'),
                        Forms\Components\Select::make('tahun_ajaran_id')
                            ->label('Tahun Ajaran')
                            ->options(
                                TahunAjaran::orderByDesc('created_at')
                                    ->get()
                                    ->mapWithKeys(fn ($ta) => [$ta->id => "{$ta->nama} - {$ta->semester}"])
                            )
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('wali_kelas_id')
                            ->label('Wali Kelas')
                            ->relationship('waliKelas', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Kelas')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenjang')
                    ->label('Jenjang')
                    ->badge()
                    ->color(fn (string $state) => $state === 'SMP' ? 'info' : 'warning'),
                Tables\Columns\TextColumn::make('tingkat')
                    ->label('Kelas')
                    ->formatStateUsing(fn (string $state) => "Kelas {$state}")
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stream.nama')
                    ->label('Stream')
                    ->badge()
                    ->color(fn (?string $state) => match ($state) {
                        'Akademik'  => 'info',
                        'Vokasi'    => 'warning',
                        'Wirausaha' => 'success',
                        default     => 'gray',
                    })
                    ->default('-'),
                Tables\Columns\TextColumn::make('tahunAjaran.nama')
                    ->label('Tahun Ajaran')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tahunAjaran.semester')
                    ->label('Semester')
                    ->badge()
                    ->color(fn (string $state) => $state === 'Ganjil' ? 'info' : 'warning'),
                Tables\Columns\TextColumn::make('waliKelas.name')
                    ->label('Wali Kelas')
                    ->searchable()
                    ->default('-'),
                Tables\Columns\TextColumn::make('students_count')
                    ->label('Siswa')
                    ->counts('students')
                    ->badge()
                    ->color('success'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenjang')
                    ->label('Jenjang')
                    ->options(['SMP' => 'SMP', 'SMA' => 'SMA']),
                Tables\Filters\SelectFilter::make('tingkat')
                    ->label('Tingkat')
                    ->options([
                        '7' => 'Kelas 7', '8' => 'Kelas 8', '9' => 'Kelas 9',
                        '10' => 'Kelas 10', '11' => 'Kelas 11', '12' => 'Kelas 12',
                    ]),
                Tables\Filters\SelectFilter::make('stream_id')
                    ->label('Stream')
                    ->relationship('stream', 'nama'),
                Tables\Filters\SelectFilter::make('tahun_ajaran_id')
                    ->label('Tahun Ajaran')
                    ->relationship('tahunAjaran', 'nama'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SiswaRelationManager::class,
            JadwalRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListKelas::route('/'),
            'create' => Pages\CreateKelas::route('/create'),
            'view'   => Pages\ViewKelas::route('/{record}'),
            'edit'   => Pages\EditKelas::route('/{record}/edit'),
        ];
    }
}