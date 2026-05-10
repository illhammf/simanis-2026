<?php

namespace App\Filament\Guru\Resources\ModulAjarResource\RelationManagers;

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
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TugasRelationManager extends RelationManager
{
    protected static string $relationship = 'tugas';
    protected static ?string $title = 'Tugas & Penilaian';
    protected static ?string $label = 'Tugas';

    public function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(2)->schema([
                TextInput::make('judul')
                    ->label('Judul Tugas')
                    ->required()->maxLength(255)->columnSpan(2),

                Select::make('tipe')
                    ->label('Jenis')
                    ->options(Tugas::$tipeLabels)
                    ->required()->default('tugas_harian')->native(false),

                Grid::make(2)->schema([
                    DatePicker::make('tanggal_mulai')
                        ->label('Tanggal Mulai')
                        ->displayFormat('d/m/Y')->nullable(),
                    DatePicker::make('deadline')
                        ->label('Deadline')
                        ->displayFormat('d/m/Y')
                        ->after('tanggal_mulai')->nullable(),
                ])->columnSpan(1),

                Grid::make(2)->schema([
                    TextInput::make('alokasi_waktu')
                        ->label('Alokasi Waktu (menit)')
                        ->numeric()->minValue(1)->placeholder('60')->nullable(),
                    TextInput::make('nilai_maksimal')
                        ->label('Nilai Maksimal')
                        ->numeric()->default(100)->minValue(1)->maxValue(1000)->required(),
                ])->columnSpan(1),

                TextInput::make('bobot')
                    ->label('Bobot (%)')
                    ->numeric()->minValue(0)->maxValue(100)->nullable(),

                Textarea::make('deskripsi')
                    ->label('Deskripsi Singkat')
                    ->rows(2)->nullable()->columnSpan(2),

                RichEditor::make('instruksi')
                    ->label('Instruksi / Petunjuk')
                    ->toolbarButtons(['bold','italic','underline','orderedList','bulletList','h2','h3','blockquote'])
                    ->nullable()->columnSpan(2),

                FileUpload::make('file_tugas')
                    ->label('File Tugas')
                    ->disk('public')->directory('tugas')
                    ->acceptedFileTypes(['application/pdf','application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                    ->downloadable()->nullable()->columnSpan(2),
            ]),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('judul')
            ->columns([
                TextColumn::make('judul')->label('Judul')->searchable()->limit(50),
                TextColumn::make('tipe')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'tugas_harian','pr' => 'info',
                        'kuis','ulangan_harian' => 'warning',
                        'pts','pas' => 'danger',
                        'proyek' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => Tugas::$tipeLabels[$state] ?? $state),
                TextColumn::make('deadline')->label('Deadline')->date('d/m/Y')->default('-'),
                TextColumn::make('nilai_maksimal')->label('Nilai Maks')->badge()->color('gray'),
                TextColumn::make('bobot')
                    ->label('Bobot')
                    ->formatStateUsing(fn ($state) => $state ? "{$state}%" : '-'),
                IconColumn::make('file_tugas')->label('File')->boolean()
                    ->trueIcon('heroicon-o-document-text')->falseIcon('heroicon-o-x-mark'),
            ])
            ->filters([
                SelectFilter::make('tipe')
                    ->options(Tugas::$tipeLabels)
                    ->label('Jenis Tugas'),
            ])
            ->headerActions([CreateAction::make()->label('Tambah Tugas')])
            ->actions([ViewAction::make(), EditAction::make(), DeleteAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}