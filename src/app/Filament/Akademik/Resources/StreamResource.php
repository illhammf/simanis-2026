<?php

namespace App\Filament\Akademik\Resources;

use App\Filament\Akademik\Resources\StreamResource\Pages;
use App\Filament\Akademik\Resources\StreamResource\RelationManagers\MilestonesRelationManager;
use App\Models\Stream;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StreamResource extends Resource
{
    protected static ?string $model = Stream::class;

    protected static ?string $navigationIcon = 'heroicon-s-squares-2x2';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Stream / Peminatan';
    protected static ?string $modelLabel = 'Stream';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Stream')
                    ->schema([
                        Forms\Components\Select::make('nama')
                            ->label('Nama Stream')
                            ->options([
                                'Akademik'   => 'Akademik',
                                'Vokasi'     => 'Vokasi',
                                'Wirausaha'  => 'Wirausaha',
                            ])
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Stream')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'Akademik'  => 'info',
                        'Vokasi'    => 'warning',
                        'Wirausaha' => 'success',
                        default     => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(60)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('milestones_count')
                    ->label('Milestone')
                    ->counts('milestones')
                    ->badge()
                    ->color('warning'),
                Tables\Columns\TextColumn::make('kelas_count')
                    ->label('Jumlah Kelas')
                    ->counts('kelas')
                    ->badge()
                    ->color('success'),
            ])
            ->filters([])
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
        return [
            MilestonesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListStreams::route('/'),
            'create' => Pages\CreateStream::route('/create'),
            'edit'   => Pages\EditStream::route('/{record}/edit'),
        ];
    }
}