<?php

namespace App\Filament\Akademik\Resources\AlurTujuanPembelajaranResource\RelationManagers;

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

class TujuanPembelajaranRelationManager extends RelationManager
{
    protected static string $relationship = 'tujuanPembelajarans';
    protected static ?string $title = 'Tujuan Pembelajaran (TP)';

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('kode_tp')
                ->label('Kode TP')
                ->placeholder('TP.MAT.D.1.1.1'),
            TextInput::make('urutan')->label('Urutan')->numeric()->default(0),
            Textarea::make('deskripsi')
                ->label('Deskripsi TP')
                ->rows(3)
                ->required()
                ->columnSpanFull(),
            Textarea::make('indikator')
                ->label('Indikator Pencapaian')
                ->rows(3)
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('urutan')->label('#')->sortable(),
                TextColumn::make('kode_tp')->label('Kode TP')->badge()->color('primary'),
                TextColumn::make('deskripsi')->label('Deskripsi TP')->limit(80)->wrap(),
                TextColumn::make('modulAjars_count')->label('Modul')->counts('modulAjars')->badge()->color('gray'),
            ])
            ->defaultSort('urutan')
            ->headerActions([CreateAction::make()])
            ->actions([ViewAction::make(), EditAction::make(), DeleteAction::make()])
            ->reorderable('urutan');
    }
}