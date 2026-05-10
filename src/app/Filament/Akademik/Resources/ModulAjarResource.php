<?php

namespace App\Filament\Akademik\Resources;

use App\Filament\Akademik\Resources\ModulAjarResource\Pages;
use App\Filament\Akademik\Resources\ModulAjarResource\RelationManagers\TugasRelationManager;
use App\Models\Kurikulum;
use App\Models\MataPelajaran;
use App\Models\ModulAjar;
use App\Models\Teacher;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ModulAjarResource extends Resource
{
    protected static ?string $model = ModulAjar::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Kurikulum & Pembelajaran';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = 'Modul Ajar';
    protected static ?string $modelLabel = 'Modul Ajar';
    protected static ?string $pluralModelLabel = 'Modul Ajar';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('judul')
                ->label('Judul Modul Ajar')
                ->required()
                ->columnSpanFull(),
            Select::make('kurikulum_id')
                ->label('Kurikulum')
                ->options(Kurikulum::all()->mapWithKeys(fn ($k) => [$k->id => $k->nama_lengkap]))
                ->searchable()->required(),
            Select::make('mata_pelajaran_id')
                ->label('Mata Pelajaran')
                ->options(MataPelajaran::orderBy('nama')->pluck('nama', 'id'))
                ->searchable()->required(),
            Select::make('tujuan_pembelajaran_id')
                ->label('Tujuan Pembelajaran (TP)')
                ->relationship('tujuanPembelajaran', 'kode_tp')
                ->getOptionLabelFromRecordUsing(fn ($record) =>
                    "[{$record->kode_tp}] {$record->deskripsi}"
                )
                ->searchable()->preload(),
            Select::make('teacher_id')
                ->label('Guru Pengajar')
                ->options(Teacher::orderBy('name')->pluck('name', 'id'))
                ->searchable()
                ->nullable()
                ->placeholder('Belum ditentukan'),
            Select::make('kelas')
                ->label('Kelas')
                ->options(['7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12'])
                ->required(),
            Select::make('semester')
                ->label('Semester')
                ->options(['1'=>'Ganjil (1)','2'=>'Genap (2)'])
                ->required(),
            TextInput::make('alokasi_waktu')
                ->label('Alokasi Waktu (JP)')
                ->numeric()
                ->minValue(1)
                ->placeholder('2'),
            Textarea::make('tujuan')->label('Tujuan Pembelajaran')->rows(3)->columnSpanFull(),
            Textarea::make('pemahaman_bermakna')->label('Pemahaman Bermakna')->rows(2)->columnSpanFull(),
            Textarea::make('pertanyaan_pemantik')->label('Pertanyaan Pemantik')->rows(2)->columnSpanFull(),
            Textarea::make('kegiatan_pembelajaran')->label('Kegiatan Pembelajaran')->rows(5)->columnSpanFull(),
            Textarea::make('asesmen')->label('Asesmen')->rows(3)->columnSpanFull(),
            Textarea::make('sumber_belajar')->label('Sumber Belajar')->rows(2)->columnSpanFull(),
            FileUpload::make('file_modul')
                ->label('File Modul Ajar (PDF/DOCX)')
                ->disk('public')
                ->directory('modul-ajar')
                ->acceptedFileTypes(['application/pdf','application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                ->downloadable()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')->label('Judul Modul Ajar')->searchable()->limit(55)->wrap(),
                TextColumn::make('kurikulum.nama')->label('Kurikulum'),
                TextColumn::make('mataPelajaran.nama')->label('Mata Pelajaran')->searchable(),
                TextColumn::make('teacher.name')->label('Guru')->searchable()->default('-'),
                TextColumn::make('kelas')->label('Kelas')->formatStateUsing(fn ($s) => "Kelas {$s}")->badge()->color('info'),
                TextColumn::make('semester')->label('Smt')
                    ->formatStateUsing(fn ($s) => $s === '1' ? 'Ganjil' : 'Genap')
                    ->badge()->color('warning'),
                TextColumn::make('alokasi_waktu')
                    ->label('Alokasi (JP)')
                    ->formatStateUsing(fn ($state) => $state ? "{$state} JP" : '-'),
                TextColumn::make('tugas_count')
                    ->label('Tugas')
                    ->counts('tugas')
                    ->badge()
                    ->color('warning'),
                IconColumn::make('file_modul')
                    ->label('File')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-text')
                    ->falseIcon('heroicon-o-x-mark'),
            ])
            ->filters([
                SelectFilter::make('kurikulum_id')
                    ->label('Kurikulum')
                    ->options(Kurikulum::all()->mapWithKeys(fn ($k) => [$k->id => $k->nama_lengkap])),
                SelectFilter::make('mata_pelajaran_id')
                    ->label('Mata Pelajaran')
                    ->options(MataPelajaran::orderBy('nama')->pluck('nama', 'id')),
                SelectFilter::make('kelas')
                    ->options(['7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12']),
                SelectFilter::make('semester')
                    ->options(['1'=>'Ganjil','2'=>'Genap']),
            ])
            ->actions([ViewAction::make(), EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelationManagers(): array
    {
        return [
            TugasRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListModulAjars::route('/'),
            'create' => Pages\CreateModulAjar::route('/create'),
            'view'   => Pages\ViewModulAjar::route('/{record}'),
            'edit'   => Pages\EditModulAjar::route('/{record}/edit'),
        ];
    }
}