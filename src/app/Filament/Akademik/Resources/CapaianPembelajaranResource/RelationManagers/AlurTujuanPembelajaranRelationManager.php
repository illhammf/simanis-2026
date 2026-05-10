<?php

namespace App\Filament\Akademik\Resources\CapaianPembelajaranResource\RelationManagers;

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

class AlurTujuanPembelajaranRelationManager extends RelationManager
{
    protected static string $relationship = 'alurTujuanPembelajarans';
    protected static ?string $title = 'Alur Tujuan Pembelajaran (ATP)';

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('kode_atp')
                ->label('Kode ATP')
                ->placeholder('ATP.MAT.D.1.1'),
            Select::make('kelas')
                ->label('Kelas')
                ->options([
                    '7' => 'Kelas 7', '8' => 'Kelas 8', '9' => 'Kelas 9',
                    '10' => 'Kelas 10', '11' => 'Kelas 11', '12' => 'Kelas 12',
                ])
                ->required(),
            Select::make('semester')
                ->label('Semester')
                ->options(['1' => 'Ganjil (1)', '2' => 'Genap (2)'])
                ->required(),
            TextInput::make('urutan')
                ->label('Urutan')
                ->numeric()
                ->default(0),
            Textarea::make('deskripsi')
                ->label('Deskripsi ATP')
                ->rows(4)
                ->required()
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('urutan')->label('#')->sortable(),
                TextColumn::make('kode_atp')->label('Kode')->badge()->color('primary'),
                TextColumn::make('kelas')->label('Kelas')->formatStateUsing(fn ($s) => "Kelas {$s}")->badge()->color('info'),
                TextColumn::make('semester')->label('Smt')->formatStateUsing(fn ($s) => $s === '1' ? 'Ganjil' : 'Genap')->badge()->color('warning'),
                TextColumn::make('deskripsi')->label('Deskripsi ATP')->limit(80)->wrap(),
                TextColumn::make('tujuanPembelajarans_count')
                    ->label('TP')
                    ->counts('tujuanPembelajarans')
                    ->badge()->color('gray'),
            ])
            ->defaultSort('urutan')
            ->headerActions([CreateAction::make()])
            ->actions([ViewAction::make(), EditAction::make(), DeleteAction::make()])
            ->reorderable('urutan');
    }
}