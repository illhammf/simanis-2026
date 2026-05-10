<?php

namespace App\Filament\Akademik\Resources\TujuanPembelajaranResource\RelationManagers;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ModulAjarRelationManager extends RelationManager
{
    protected static string $relationship = 'modulAjars';
    protected static ?string $title = 'Modul Ajar';

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('judul')
                ->label('Judul Modul Ajar')
                ->required()
                ->columnSpanFull(),
            Select::make('kurikulum_id')
                ->label('Kurikulum')
                ->relationship('kurikulum', 'nama')
                ->searchable()->preload()->required(),
            Select::make('mata_pelajaran_id')
                ->label('Mata Pelajaran')
                ->relationship('mataPelajaran', 'nama')
                ->searchable()->preload()->required(),
            Select::make('kelas')
                ->label('Kelas')
                ->options(['7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12'])
                ->required(),
            Select::make('semester')
                ->label('Semester')
                ->options(['1'=>'Ganjil','2'=>'Genap'])
                ->required(),
            TextInput::make('alokasi_waktu')->label('Alokasi Waktu')->placeholder('2 x 40 menit'),
            Textarea::make('tujuan')->label('Tujuan Pembelajaran')->rows(3)->columnSpanFull(),
            Textarea::make('pemahaman_bermakna')->label('Pemahaman Bermakna')->rows(2)->columnSpanFull(),
            Textarea::make('pertanyaan_pemantik')->label('Pertanyaan Pemantik')->rows(2)->columnSpanFull(),
            Textarea::make('kegiatan_pembelajaran')->label('Kegiatan Pembelajaran')->rows(4)->columnSpanFull(),
            Textarea::make('asesmen')->label('Asesmen')->rows(3)->columnSpanFull(),
            Textarea::make('sumber_belajar')->label('Sumber Belajar')->rows(2)->columnSpanFull(),
            FileUpload::make('file_modul')
                ->label('File Modul Ajar')
                ->disk('public')
                ->directory('modul-ajar')
                ->acceptedFileTypes(['application/pdf','application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')->label('Judul Modul Ajar')->searchable()->limit(60)->wrap(),
                TextColumn::make('kurikulum.nama')->label('Kurikulum'),
                TextColumn::make('mataPelajaran.nama')->label('Mata Pelajaran'),
                TextColumn::make('kelas')->label('Kelas')->formatStateUsing(fn ($s) => "Kelas {$s}")->badge()->color('info'),
                TextColumn::make('semester')->label('Smt')->formatStateUsing(fn ($s) => $s === '1' ? 'Ganjil' : 'Genap')->badge()->color('warning'),
                TextColumn::make('alokasi_waktu')->label('Alokasi'),
                IconColumn::make('file_modul')->label('File')->boolean()->trueIcon('heroicon-o-document-text')->falseIcon('heroicon-o-x-mark'),
            ])
            ->headerActions([CreateAction::make()])
            ->actions([ViewAction::make(), EditAction::make(), DeleteAction::make()]);
    }
}