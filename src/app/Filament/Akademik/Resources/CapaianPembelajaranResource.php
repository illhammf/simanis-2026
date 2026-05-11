<?php

namespace App\Filament\Akademik\Resources;

use App\Filament\Akademik\Resources\CapaianPembelajaranResource\Pages;
use App\Filament\Akademik\Resources\CapaianPembelajaranResource\RelationManagers;
use App\Models\CapaianPembelajaran;
use App\Models\Kurikulum;
use App\Models\MataPelajaran;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CapaianPembelajaranResource extends Resource
{
    protected static ?string $model = CapaianPembelajaran::class;
    protected static ?string $navigationIcon = 'heroicon-s-clipboard-document-list';
    protected static ?string $navigationGroup = 'Kurikulum & Pembelajaran';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Capaian Pembelajaran';
    protected static ?string $modelLabel = 'Capaian Pembelajaran';
    protected static ?string $pluralModelLabel = 'Capaian Pembelajaran';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('kurikulum_id')
                ->label('Kurikulum')
                ->options(Kurikulum::all()->mapWithKeys(fn ($k) => [$k->id => $k->nama_lengkap]))
                ->searchable()
                ->required(),
            Select::make('mata_pelajaran_id')
                ->label('Mata Pelajaran')
                ->options(MataPelajaran::orderBy('nama')->pluck('nama', 'id'))
                ->searchable()
                ->required(),
            TextInput::make('kode_cp')
                ->label('Kode CP')
                ->placeholder('CP.MAT.D.1'),
            TextInput::make('elemen')
                ->label('Elemen')
                ->placeholder('Bilangan, Aljabar...'),
            TextInput::make('urutan')
                ->label('Urutan')
                ->numeric()
                ->default(0),
            Textarea::make('deskripsi_cp')
                ->label('Deskripsi Capaian Pembelajaran')
                ->rows(6)
                ->required()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_cp')->label('Kode')->badge()->color('primary')->searchable(),
                TextColumn::make('kurikulum.nama')->label('Kurikulum')->searchable(),
                TextColumn::make('mataPelajaran.nama')->label('Mata Pelajaran')->searchable(),
                TextColumn::make('elemen')->label('Elemen')->badge()->color('warning'),
                TextColumn::make('deskripsi_cp')->label('Deskripsi')->limit(70)->wrap(),
                TextColumn::make('alurTujuanPembelajarans_count')
                    ->label('ATP')
                    ->counts('alurTujuanPembelajarans')
                    ->badge()->color('gray'),
            ])
            ->filters([
                SelectFilter::make('kurikulum_id')
                    ->label('Kurikulum')
                    ->options(Kurikulum::all()->mapWithKeys(fn ($k) => [$k->id => $k->nama_lengkap])),
                SelectFilter::make('mata_pelajaran_id')
                    ->label('Mata Pelajaran')
                    ->options(MataPelajaran::orderBy('nama')->pluck('nama', 'id')),
            ])
            ->actions([ViewAction::make(), EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])])
            ->defaultSort('kurikulum_id');
    }

    public static function getRelationManagers(): array
    {
        return [
            RelationManagers\AlurTujuanPembelajaranRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCapaianPembelajarans::route('/'),
            'create' => Pages\CreateCapaianPembelajaran::route('/create'),
            'view'   => Pages\ViewCapaianPembelajaran::route('/{record}'),
            'edit'   => Pages\EditCapaianPembelajaran::route('/{record}/edit'),
        ];
    }
}