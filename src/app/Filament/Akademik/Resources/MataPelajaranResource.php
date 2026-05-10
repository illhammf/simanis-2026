<?php

namespace App\Filament\Akademik\Resources;

use App\Filament\Akademik\Resources\MataPelajaranResource\Pages;
use App\Models\MataPelajaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MataPelajaranResource extends Resource
{
    protected static ?string $model = MataPelajaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Mata Pelajaran';
    protected static ?string $modelLabel = 'Mata Pelajaran';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Mata Pelajaran')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Mata Pelajaran')
                            ->placeholder('Matematika')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('kode')
                            ->label('Kode')
                            ->placeholder('MTK')
                            ->required()
                            ->maxLength(20)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('jenjang')
                            ->label('Berlaku untuk Jenjang')
                            ->options([
                                'Semua' => 'Semua (SMP & SMA)',
                                'SMP'   => 'SMP saja (Fase D)',
                                'SMA'   => 'SMA saja (Fase E & F)',
                            ])
                            ->default('Semua')
                            ->required(),
                        Forms\Components\Select::make('stream_id')
                            ->label('Stream / Peminatan')
                            ->relationship('stream', 'nama')
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->helperText('Kosongkan jika berlaku untuk semua stream.'),
                        Forms\Components\TextInput::make('kkm')
                            ->label('KKM')
                            ->numeric()
                            ->default(75)
                            ->minValue(0)
                            ->maxValue(100)
                            ->required(),
                        Forms\Components\TextInput::make('jam_per_minggu')
                            ->label('Jam / Minggu')
                            ->numeric()
                            ->default(2)
                            ->minValue(1)
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->label('Kode')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Mata Pelajaran')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenjang')
                    ->label('Jenjang')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'SMP'   => 'info',
                        'SMA'   => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('stream.nama')
                    ->label('Stream')
                    ->badge()
                    ->color(fn (?string $state) => match ($state) {
                        'Akademik'  => 'info',
                        'Vokasi'    => 'warning',
                        'Wirausaha' => 'success',
                        default     => 'gray',
                    })
                    ->default('Semua'),
                Tables\Columns\TextColumn::make('kkm')
                    ->label('KKM')
                    ->badge()
                    ->color('warning'),
                Tables\Columns\TextColumn::make('jam_per_minggu')
                    ->label('Jam/Minggu')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenjang')
                    ->label('Jenjang')
                    ->options(['SMP' => 'SMP', 'SMA' => 'SMA', 'Semua' => 'Semua']),
                Tables\Filters\SelectFilter::make('stream_id')
                    ->label('Stream')
                    ->relationship('stream', 'nama')
                    ->placeholder('Semua Stream'),
            ])
            ->actions([
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListMataPelajarans::route('/'),
            'create' => Pages\CreateMataPelajaran::route('/create'),
            'edit'   => Pages\EditMataPelajaran::route('/{record}/edit'),
        ];
    }
}