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
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StrukturKurikulumRelationManager extends RelationManager
{
    protected static string $relationship = 'strukturKurikulums';
    protected static ?string $title = 'Struktur Kurikulum (Mata Pelajaran)';

    public function form(Form $form): Form
    {
        return $form->schema([
            Select::make('mata_pelajaran_id')
                ->label('Mata Pelajaran')
                ->options(MataPelajaran::orderBy('nama')->pluck('nama', 'id'))
                ->searchable()
                ->required(),
            Select::make('kelompok')
                ->label('Kelompok Mata Pelajaran')
                ->options([
                    'Wajib A'      => 'Wajib A',
                    'Wajib B'      => 'Wajib B',
                    'Pilihan'      => 'Pilihan',
                    'Muatan Lokal' => 'Muatan Lokal',
                    'Proyek P5'    => 'Proyek P5',
                    'Vokasional'   => 'Vokasional',
                ])
                ->required(),
            TextInput::make('jam_per_minggu')
                ->label('Jam / Minggu')
                ->numeric()
                ->default(2)
                ->required(),
            Select::make('semester')
                ->label('Semester')
                ->options([
                    'Ganjil'    => 'Ganjil',
                    'Genap'     => 'Genap',
                    'Keduanya'  => 'Keduanya',
                ])
                ->default('Keduanya'),
            TextInput::make('kelas')
                ->label('Kelas')
                ->placeholder('7,8,9 atau kosong = semua'),
            TextInput::make('urutan')
                ->label('Urutan')
                ->numeric()
                ->default(0),
            Textarea::make('keterangan')
                ->label('Keterangan')
                ->rows(2)
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('urutan')->label('#')->sortable(),
                TextColumn::make('mataPelajaran.nama')->label('Mata Pelajaran')->searchable(),
                TextColumn::make('kelompok')->label('Kelompok')->badge()->color('info'),
                TextColumn::make('jam_per_minggu')->label('JP/Minggu'),
                TextColumn::make('semester')->label('Semester')->badge()->color('warning'),
                TextColumn::make('kelas')->label('Kelas'),
            ])
            ->defaultSort('urutan')
            ->headerActions([CreateAction::make()])
            ->actions([EditAction::make(), DeleteAction::make()])
            ->reorderable('urutan');
    }
}