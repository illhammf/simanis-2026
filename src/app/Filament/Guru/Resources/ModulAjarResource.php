<?php

namespace App\Filament\Guru\Resources;

use App\Filament\Guru\Resources\ModulAjarResource\Pages;
use App\Filament\Guru\Resources\ModulAjarResource\RelationManagers\TugasRelationManager;
use App\Models\Kurikulum;
use App\Models\MataPelajaran;
use App\Models\ModulAjar;
use App\Models\Teacher;
use App\Models\TujuanPembelajaran;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
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
use Illuminate\Database\Eloquent\Builder;

class ModulAjarResource extends Resource
{
    protected static ?string $model = ModulAjar::class;

    protected static ?string $navigationLabel = 'Modul Ajar';
    protected static ?string $pluralModelLabel = 'Modul Ajar';
    protected static ?string $modelLabel = 'Modul Ajar';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        $teacher = Teacher::where('user_id', auth()->id())->first();

        return parent::getEloquentQuery()
            ->with(['kurikulum', 'mataPelajaran', 'tujuanPembelajaran', 'tugas'])
            ->where('teacher_id', $teacher?->id ?? 0);
    }

    public static function form(Form $form): Form
    {
        $teacher = Teacher::where('user_id', auth()->id())->first();

        return $form->schema([
            Wizard::make([
                Step::make('Identitas')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
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
                            ->searchable()->required()
                            ->reactive(),
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
                            ->numeric()->minValue(1)->placeholder('2'),
                        Select::make('teacher_id')
                            ->label('Guru Pengajar')
                            ->default($teacher?->id)
                            ->options(Teacher::orderBy('name')->pluck('name', 'id'))
                            ->searchable()->nullable()->disabled(),
                        Select::make('tujuan_pembelajaran_id')
                            ->label('Tujuan Pembelajaran (TP)')
                            ->relationship('tujuanPembelajaran', 'kode_tp')
                            ->getOptionLabelFromRecordUsing(fn ($record) =>
                                "[{$record->kode_tp}] {$record->deskripsi}"
                            )
                            ->searchable()->preload()->nullable(),
                    ])->columns(2),

                Step::make('Tujuan & Konteks')
                    ->icon('heroicon-o-light-bulb')
                    ->schema([
                        Textarea::make('tujuan')
                            ->label('Tujuan Pembelajaran')
                            ->rows(4)->columnSpanFull()->required(),
                        Textarea::make('pemahaman_bermakna')
                            ->label('Pemahaman Bermakna')
                            ->rows(3)->columnSpanFull(),
                        Textarea::make('pertanyaan_pemantik')
                            ->label('Pertanyaan Pemantik')
                            ->rows(3)->columnSpanFull(),
                    ]),

                Step::make('Kegiatan & Asesmen')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        RichEditor::make('kegiatan_pembelajaran')
                            ->label('Kegiatan Pembelajaran')
                            ->toolbarButtons(['bold','italic','underline','orderedList','bulletList','h2','h3','blockquote'])
                            ->columnSpanFull(),
                        RichEditor::make('asesmen')
                            ->label('Asesmen')
                            ->toolbarButtons(['bold','italic','underline','orderedList','bulletList'])
                            ->columnSpanFull(),
                    ]),

                Step::make('Sumber & Berkas')
                    ->icon('heroicon-o-paper-clip')
                    ->schema([
                        Textarea::make('sumber_belajar')
                            ->label('Sumber Belajar')
                            ->rows(3)->columnSpanFull(),
                        FileUpload::make('file_modul')
                            ->label('File Modul Ajar (PDF/DOCX)')
                            ->disk('public')
                            ->directory('modul-ajar')
                            ->acceptedFileTypes([
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            ])
                            ->downloadable()
                            ->columnSpanFull(),
                    ]),
            ])->columnSpanFull()->skippable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
                    ->label('Judul Modul Ajar')
                    ->searchable()->limit(55)->wrap(),
                TextColumn::make('kurikulum.nama')
                    ->label('Kurikulum'),
                TextColumn::make('mataPelajaran.nama')
                    ->label('Mata Pelajaran')->searchable(),
                TextColumn::make('kelas')
                    ->label('Kelas')
                    ->formatStateUsing(fn ($s) => "Kelas {$s}")
                    ->badge()->color('info'),
                TextColumn::make('semester')
                    ->label('Smt')
                    ->formatStateUsing(fn ($s) => $s === '1' ? 'Ganjil' : 'Genap')
                    ->badge()->color('warning'),
                TextColumn::make('tugas_count')
                    ->label('Tugas')
                    ->counts('tugas')
                    ->badge()->color('warning'),
                IconColumn::make('file_modul')
                    ->label('File')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-text')
                    ->falseIcon('heroicon-o-x-mark'),
            ])
            ->filters([
                SelectFilter::make('mata_pelajaran_id')
                    ->relationship('mataPelajaran', 'nama')
                    ->label('Mata Pelajaran'),
                SelectFilter::make('kelas')
                    ->options(['7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12'])
                    ->label('Kelas'),
            ])
            ->actions([ViewAction::make(), EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getRelations(): array
    {
        return [
            TugasRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListModulAjar::route('/'),
            'create' => Pages\CreateModulAjar::route('/create'),
            'view'   => Pages\ViewModulAjar::route('/{record}'),
            'edit'   => Pages\EditModulAjar::route('/{record}/edit'),
        ];
    }
}