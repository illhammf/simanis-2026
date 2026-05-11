<?php

namespace App\Filament\Akademik\Resources\ModulAjarResource\RelationManagers;

use App\Models\Tugas;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TugasRelationManager extends RelationManager
{
    protected static string $relationship = 'tugas';
    protected static ?string $title = 'Tugas & Penilaian';
    protected static ?string $label = 'Tugas';
    protected static ?string $pluralLabel = 'Tugas & Penilaian';

    public function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(2)->schema([
                TextInput::make('judul')
                    ->label('Judul Tugas')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),

                Select::make('tipe')
                    ->label('Jenis')
                    ->options(Tugas::$tipeLabels)
                    ->required()
                    ->default('tugas_harian')
                    ->native(false),

                Grid::make(2)->schema([
                    DatePicker::make('tanggal_mulai')
                        ->label('Tanggal Mulai')
                        ->displayFormat('d/m/Y')
                        ->nullable(),

                    DatePicker::make('deadline')
                        ->label('Deadline')
                        ->displayFormat('d/m/Y')
                        ->after('tanggal_mulai')
                        ->nullable(),
                ])->columnSpan(1),

                Grid::make(2)->schema([
                    TextInput::make('alokasi_waktu')
                        ->label('Alokasi Waktu (menit)')
                        ->numeric()
                        ->minValue(1)
                        ->placeholder('60')
                        ->nullable(),

                    TextInput::make('nilai_maksimal')
                        ->label('Nilai Maksimal')
                        ->numeric()
                        ->default(100)
                        ->minValue(1)
                        ->maxValue(1000)
                        ->required(),
                ])->columnSpan(1),

                TextInput::make('bobot')
                    ->label('Bobot Penilaian (%)')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->nullable()
                    ->helperText('Mis: 30 berarti tugas ini berbobot 30% dari total nilai.'),

                Textarea::make('deskripsi')
                    ->label('Deskripsi Singkat')
                    ->rows(2)
                    ->nullable()
                    ->columnSpan(2),

                RichEditor::make('instruksi')
                    ->label('Instruksi / Petunjuk Pengerjaan')
                    ->toolbarButtons([
                        'bold', 'italic', 'underline', 'strike',
                        'orderedList', 'bulletList',
                        'h2', 'h3',
                        'link', 'blockquote',
                    ])
                    ->nullable()
                    ->columnSpan(2),

                FileUpload::make('file_soal')
                    ->label('File Soal (PDF/DOCX)')
                    ->disk('public')
                    ->directory('tugas-soal')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    ])
                    ->downloadable()
                    ->nullable()
                    ->columnSpan(2),
            ]),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('judul')
            ->columns([
                TextColumn::make('judul')
                    ->label('Judul Tugas')
                    ->searchable()
                    ->limit(50)
                    ->weight('semibold'),

                TextColumn::make('tipe')
                    ->label('Jenis')
                    ->badge()
                    ->formatStateUsing(fn ($state) => Tugas::$tipeLabels[$state] ?? $state)
                    ->color(fn ($state) => match ($state) {
                        'tugas_harian'   => 'gray',
                        'pr'             => 'gray',
                        'kuis'           => 'info',
                        'ulangan_harian' => 'warning',
                        'pts'            => 'danger',
                        'pas'            => 'danger',
                        'proyek'         => 'success',
                        default          => 'gray',
                    }),

                TextColumn::make('deadline')
                    ->label('Deadline')
                    ->date('d M Y')
                    ->sortable()
                    ->default('-'),

                TextColumn::make('alokasi_waktu')
                    ->label('Waktu (menit)')
                    ->default('-')
                    ->toggleable(),

                TextColumn::make('nilai_maksimal')
                    ->label('Nilai Maks')
                    ->badge()
                    ->color('info'),

                TextColumn::make('bobot')
                    ->label('Bobot')
                    ->formatStateUsing(fn ($state) => $state ? "{$state}%" : '-')
                    ->toggleable(),

                IconColumn::make('file_soal')
                    ->label('File')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-text')
                    ->falseIcon('heroicon-o-minus'),
            ])
            ->filters([
                SelectFilter::make('tipe')
                    ->label('Jenis')
                    ->options(Tugas::$tipeLabels),
            ])
            ->headerActions([
                CreateAction::make()->label('Tambah Tugas'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ])
            ->defaultSort('deadline', 'asc');
    }
}