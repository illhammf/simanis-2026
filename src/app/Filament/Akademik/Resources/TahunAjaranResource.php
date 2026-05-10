<?php

namespace App\Filament\Akademik\Resources;

use App\Filament\Akademik\Resources\TahunAjaranResource\Pages;
use App\Models\TahunAjaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TahunAjaranResource extends Resource
{
    protected static ?string $model = TahunAjaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Tahun Ajaran';
    protected static ?string $modelLabel = 'Tahun Ajaran';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Tahun Ajaran')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Tahun Ajaran')
                            ->placeholder('2025/2026')
                            ->required()
                            ->maxLength(20),
                        Forms\Components\Select::make('semester')
                            ->label('Semester')
                            ->options([
                                'Ganjil' => 'Ganjil',
                                'Genap'  => 'Genap',
                            ])
                            ->required(),
                        Forms\Components\DatePicker::make('tanggal_mulai')
                            ->label('Tanggal Mulai')
                            ->required(),
                        Forms\Components\DatePicker::make('tanggal_selesai')
                            ->label('Tanggal Selesai')
                            ->required()
                            ->after('tanggal_mulai'),
                        Forms\Components\Toggle::make('is_aktif')
                            ->label('Jadikan Aktif')
                            ->helperText('Hanya satu tahun ajaran yang bisa aktif sekaligus.')
                            ->default(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Tahun Ajaran')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('semester')
                    ->badge()
                    ->color(fn (string $state) => $state === 'Ganjil' ? 'info' : 'warning'),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->label('Mulai')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->label('Selesai')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_aktif')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('semester')
                    ->options([
                        'Ganjil' => 'Ganjil',
                        'Genap'  => 'Genap',
                    ]),
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
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTahunAjarans::route('/'),
            'create' => Pages\CreateTahunAjaran::route('/create'),
            'view'   => Pages\ViewTahunAjaran::route('/{record}'),
            'edit'   => Pages\EditTahunAjaran::route('/{record}/edit'),
        ];
    }
}