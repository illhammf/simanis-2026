<?php

namespace App\Filament\Akademik\Resources;

use App\Filament\Akademik\Resources\KurikulumResource\Pages;
use App\Filament\Akademik\Resources\KurikulumResource\RelationManagers;
use App\Models\Kurikulum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class KurikulumResource extends Resource
{
    protected static ?string $model = Kurikulum::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Kurikulum & Pembelajaran';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Kurikulum';
    protected static ?string $modelLabel = 'Kurikulum';
    protected static ?string $pluralModelLabel = 'Kurikulum';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nama')
                ->label('Nama Kurikulum')
                ->required()
                ->placeholder('Kurikulum Merdeka')
                ->columnSpanFull(),
            Select::make('jenjang')
                ->label('Jenjang')
                ->options(['SMP' => 'SMP', 'SMA' => 'SMA'])
                ->required()
                ->live(),
            Select::make('fase')
                ->label('Fase')
                ->options(fn ($get) => match($get('jenjang')) {
                    'SMP' => ['D' => 'Fase D (Kelas 7–9)'],
                    'SMA' => ['E' => 'Fase E (Kelas 10)', 'F' => 'Fase F (Kelas 11–12)'],
                    default => ['D' => 'Fase D', 'E' => 'Fase E', 'F' => 'Fase F'],
                })
                ->required(),
            TextInput::make('tahun_mulai')
                ->label('Tahun Mulai')
                ->numeric()
                ->placeholder(date('Y')),
            Toggle::make('is_active')
                ->label('Aktif')
                ->default(true),
            Textarea::make('deskripsi')
                ->label('Deskripsi')
                ->rows(3)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Kurikulum')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('jenjang')
                    ->label('Jenjang')
                    ->badge()
                    ->color(fn ($state) => $state === 'SMP' ? 'info' : 'success'),
                TextColumn::make('fase')
                    ->label('Fase')
                    ->badge()
                    ->formatStateUsing(fn ($state) => "Fase {$state}")
                    ->color('warning'),
                TextColumn::make('tahun_mulai')
                    ->label('Tahun'),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                TextColumn::make('strukturKurikulums_count')
                    ->label('Mapel')
                    ->counts('strukturKurikulums')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('capaianPembelajarans_count')
                    ->label('CP')
                    ->counts('capaianPembelajarans')
                    ->badge()
                    ->color('gray'),
            ])
            ->filters([
                SelectFilter::make('jenjang')
                    ->options(['SMP' => 'SMP', 'SMA' => 'SMA']),
                SelectFilter::make('fase')
                    ->options(['D' => 'Fase D', 'E' => 'Fase E', 'F' => 'Fase F']),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ])
            ->defaultSort('jenjang');
    }

    public static function getRelationManagers(): array
    {
        return [
            RelationManagers\StrukturKurikulumRelationManager::class,
            RelationManagers\CapaianPembelajaranRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListKurikulums::route('/'),
            'create' => Pages\CreateKurikulum::route('/create'),
            'view'   => Pages\ViewKurikulum::route('/{record}'),
            'edit'   => Pages\EditKurikulum::route('/{record}/edit'),
        ];
    }
}