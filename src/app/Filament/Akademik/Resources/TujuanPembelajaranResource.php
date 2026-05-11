<?php

namespace App\Filament\Akademik\Resources;

use App\Filament\Akademik\Resources\TujuanPembelajaranResource\Pages;
use App\Filament\Akademik\Resources\TujuanPembelajaranResource\RelationManagers;
use App\Models\TujuanPembelajaran;
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

class TujuanPembelajaranResource extends Resource
{
    protected static ?string $model = TujuanPembelajaran::class;
    protected static ?string $navigationIcon = 'heroicon-s-bookmark-square';
    protected static ?string $navigationGroup = 'Kurikulum & Pembelajaran';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Tujuan Pembelajaran';
    protected static ?string $modelLabel = 'Tujuan Pembelajaran';
    protected static ?string $pluralModelLabel = 'Tujuan Pembelajaran (TP)';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('alur_tujuan_pembelajaran_id')
                ->label('Alur Tujuan Pembelajaran (ATP)')
                ->relationship('alurTujuanPembelajaran', 'kode_atp')
                ->getOptionLabelFromRecordUsing(fn ($record) =>
                    "[{$record->kode_atp}] {$record->capaianPembelajaran?->mataPelajaran?->nama} – Kelas {$record->kelas}"
                )
                ->searchable()
                ->preload()
                ->required()
                ->columnSpanFull(),
            TextInput::make('kode_tp')
                ->label('Kode TP')
                ->placeholder('TP.MAT.D.1.1.1'),
            TextInput::make('urutan')->label('Urutan')->numeric()->default(0),
            Textarea::make('deskripsi')
                ->label('Deskripsi Tujuan Pembelajaran')
                ->rows(4)
                ->required()
                ->columnSpanFull(),
            Textarea::make('indikator')
                ->label('Indikator Pencapaian Kompetensi')
                ->rows(4)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_tp')->label('Kode TP')->badge()->color('primary')->searchable(),
                TextColumn::make('alurTujuanPembelajaran.kode_atp')->label('ATP')->badge()->color('info'),
                TextColumn::make('alurTujuanPembelajaran.capaianPembelajaran.mataPelajaran.nama')->label('Mata Pelajaran')->searchable(),
                TextColumn::make('deskripsi')->label('Deskripsi TP')->limit(80)->wrap(),
                TextColumn::make('modulAjars_count')->label('Modul Ajar')->counts('modulAjars')->badge()->color('gray'),
            ])
            ->actions([ViewAction::make(), EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getRelationManagers(): array
    {
        return [
            RelationManagers\ModulAjarRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTujuanPembelajarans::route('/'),
            'create' => Pages\CreateTujuanPembelajaran::route('/create'),
            'view'   => Pages\ViewTujuanPembelajaran::route('/{record}'),
            'edit'   => Pages\EditTujuanPembelajaran::route('/{record}/edit'),
        ];
    }
}