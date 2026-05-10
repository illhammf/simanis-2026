<?php

namespace App\Filament\Akademik\Resources\StreamResource\RelationManagers;

use App\Models\StreamMilestone;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MilestonesRelationManager extends RelationManager
{
    protected static string $relationship = 'milestones';

    protected static ?string $title = 'Milestone per Semester';

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Identitas Milestone')
                ->schema([
                    Select::make('semester')
                        ->label('Semester')
                        ->options(StreamMilestone::$tahunLabels)
                        ->required()
                        ->unique(
                            table: 'stream_milestones',
                            column: 'semester',
                            ignorable: fn ($record) => $record,
                            modifyRuleUsing: fn ($rule) => $rule->where('stream_id', $this->getOwnerRecord()->id)
                        ),

                    TextInput::make('judul')
                        ->label('Judul Milestone')
                        ->required()
                        ->maxLength(200)
                        ->placeholder('Contoh: Fondasi Akademik & Adaptasi Lingkungan'),

                    Toggle::make('is_aktif')
                        ->label('Aktif')
                        ->default(true)
                        ->inline(false),
                ])
                ->columns(3),

            Textarea::make('deskripsi')
                ->label('Deskripsi / Fokus Semester')
                ->rows(3)
                ->placeholder('Gambaran umum apa yang menjadi fokus pada semester ini...')
                ->columnSpanFull(),

            Section::make('Target Kompetensi Akademik')
                ->description('Tulis satu kompetensi per baris. Ini menjadi acuan capaian mata pelajaran pada semester ini.')
                ->schema([
                    Textarea::make('kompetensi_akademik')
                        ->label('Kompetensi Akademik')
                        ->rows(6)
                        ->placeholder("Matematika Dasar: Operasi bilangan & aljabar\nBahasa Indonesia: Membaca kritis & teks narasi\nIPA: Metode ilmiah & pengukuran\nBahasa Inggris: Tenses dasar & percakapan")
                        ->helperText('Satu item per baris')
                        ->columnSpanFull(),
                ]),

            Section::make('Target Karakter & Soft Skill')
                ->description('Nilai dan perilaku yang perlu dibentuk pada semester ini.')
                ->schema([
                    Textarea::make('target_karakter')
                        ->label('Target Karakter')
                        ->rows(5)
                        ->placeholder("Disiplin waktu & tertib mengikuti aturan sekolah\nPercaya diri berbicara di depan kelas\nBerkolaborasi dalam tim\nJujur & bertanggung jawab atas tugas")
                        ->helperText('Satu item per baris')
                        ->columnSpanFull(),
                ]),

            Section::make('Tips & Saran')
                ->schema([
                    Textarea::make('tips')
                        ->label('Tips untuk Siswa')
                        ->rows(4)
                        ->placeholder('Saran praktis agar siswa bisa berhasil melewati semester ini...')
                        ->helperText('Tips singkat yang ditampilkan di panel siswa')
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('judul')
            ->defaultSort('semester')
            ->columns([
                TextColumn::make('semester')
                    ->label('Semester')
                    ->formatStateUsing(fn ($state) => StreamMilestone::$tahunLabels[$state] ?? "Semester $state")
                    ->badge()
                    ->color(fn ($state) => match ((int) $state) {
                        1, 2 => 'info',
                        3, 4 => 'warning',
                        5, 6 => 'success',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('judul')
                    ->label('Judul Milestone')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('deskripsi')
                    ->label('Fokus')
                    ->limit(60)
                    ->toggleable(),

                TextColumn::make('kompetensi_akademik')
                    ->label('Kompetensi')
                    ->formatStateUsing(fn ($state) => collect(explode("\n", $state ?? ''))->filter()->count() . ' item')
                    ->badge()->color('info'),

                TextColumn::make('target_karakter')
                    ->label('Karakter')
                    ->formatStateUsing(fn ($state) => collect(explode("\n", $state ?? ''))->filter()->count() . ' item')
                    ->badge()->color('success'),

                IconColumn::make('is_aktif')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->headerActions([
                CreateAction::make()->label('Tambah Milestone'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->emptyStateHeading('Belum ada milestone')
            ->emptyStateDescription('Tambahkan milestone untuk setiap semester (1–6) pada stream ini.');
    }
}