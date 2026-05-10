<?php

namespace App\Filament\Akademik\Resources\KurikulumResource\RelationManagers;

use App\Models\MataPelajaran;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CapaianPembelajaranRelationManager extends RelationManager
{
    protected static string $relationship = 'capaianPembelajarans';
    protected static ?string $title = 'Capaian Pembelajaran (CP)';

    public function form(Form $form): Form
    {
        return $form->schema([
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
                ->placeholder('Bilangan, Aljabar, Geometri...'),
            TextInput::make('urutan')
                ->label('Urutan')
                ->numeric()
                ->default(0),
            Textarea::make('deskripsi_cp')
                ->label('Deskripsi Capaian Pembelajaran')
                ->rows(5)
                ->required()
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('urutan')->label('#')->sortable(),
                TextColumn::make('kode_cp')->label('Kode')->badge()->color('primary'),
                TextColumn::make('mataPelajaran.nama')->label('Mata Pelajaran')->searchable(),
                TextColumn::make('elemen')->label('Elemen')->badge()->color('warning'),
                TextColumn::make('deskripsi_cp')->label('Deskripsi CP')->limit(80)->wrap(),
                TextColumn::make('alurTujuanPembelajarans_count')
                    ->label('ATP')
                    ->counts('alurTujuanPembelajarans')
                    ->badge()
                    ->color('gray'),
            ])
            ->defaultSort('urutan')
            ->headerActions([CreateAction::make()])
            ->actions([ViewAction::make(), EditAction::make(), DeleteAction::make()]);
    }
}