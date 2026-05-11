<?php

namespace App\Filament\Guru\Resources;

use App\Filament\Guru\Resources\InputNilaiResource\Pages;
use App\Models\JadwalPelajaran;
use App\Models\Nilai;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Tugas;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InputNilaiResource extends Resource
{
    protected static ?string $model = Nilai::class;

    protected static ?string $navigationLabel = 'Input Nilai';
    protected static ?string $pluralModelLabel = 'Nilai Siswa';
    protected static ?string $modelLabel = 'Nilai';
    protected static ?string $navigationIcon = 'heroicon-s-pencil-square';
    protected static ?int $navigationSort = 3;

    public static function getEloquentQuery(): Builder
    {
        $teacher = Teacher::where('user_id', auth()->id())->first();

        return parent::getEloquentQuery()
            ->with(['student', 'tugas', 'jadwalPelajaran.mataPelajaran', 'jadwalPelajaran.kelas'])
            ->where('teacher_id', $teacher?->id ?? 0);
    }

    public static function form(Form $form): Form
    {
        $teacher = Teacher::where('user_id', auth()->id())->first();

        $jadwalOptions = JadwalPelajaran::with(['mataPelajaran', 'kelas'])
            ->where('teacher_id', $teacher?->id)
            ->where('is_aktif', true)
            ->get()
            ->mapWithKeys(fn ($j) => [
                $j->id => "[{$j->kelas->nama}] {$j->mataPelajaran->nama} – {$j->hari} JP{$j->jam_ke}"
            ]);

        return $form->schema([
            Grid::make(2)->schema([
                Select::make('jadwal_pelajaran_id')
                    ->label('Jadwal Kelas')
                    ->options($jadwalOptions)
                    ->required()
                    ->searchable()
                    ->native(false)
                    ->reactive(),

                Select::make('tugas_id')
                    ->label('Tugas')
                    ->options(fn ($get) => $get('jadwal_pelajaran_id')
                        ? (function () use ($get) {
                            $jp = JadwalPelajaran::find($get('jadwal_pelajaran_id'));
                            if (! $jp) return [];
                            return Tugas::whereHas('modulAjar', fn ($q) =>
                                $q->where('mata_pelajaran_id', $jp->mata_pelajaran_id)
                            )->pluck('judul', 'id')->toArray();
                        })()
                        : []
                    )
                    ->required()
                    ->searchable()
                    ->native(false),

                Select::make('student_id')
                    ->label('Siswa')
                    ->options(fn ($get) => $get('jadwal_pelajaran_id')
                        ? Student::whereHas('kelas', function ($q) use ($get) {
                            $jp = JadwalPelajaran::find($get('jadwal_pelajaran_id'));
                            $q->where('id', $jp?->kelas_id);
                        })->orderBy('name')->pluck('name', 'id')
                        : []
                    )
                    ->required()
                    ->searchable()
                    ->native(false),

                TextInput::make('nilai')
                    ->label('Nilai (0–100)')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->step(0.25)
                    ->required(),

                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->rows(2)
                    ->nullable()
                    ->columnSpan(2),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jadwalPelajaran.kelas.nama')
                    ->label('Kelas')
                    ->badge()->color('info'),

                TextColumn::make('jadwalPelajaran.mataPelajaran.nama')
                    ->label('Mata Pelajaran'),

                TextColumn::make('tugas.judul')
                    ->label('Tugas')
                    ->limit(40),

                TextColumn::make('tugas.tipe')
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

                TextColumn::make('student.name')
                    ->label('Nama Siswa')
                    ->searchable(),

                TextColumn::make('student.nis')
                    ->label('NIS')
                    ->badge()->color('gray'),

                TextColumn::make('nilai')
                    ->label('Nilai')
                    ->badge()
                    ->color(fn ($state) => match (true) {
                        $state >= 85 => 'success',
                        $state >= 70 => 'warning',
                        default      => 'danger',
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('jadwal_pelajaran_id')
                    ->label('Jadwal Kelas')
                    ->options(function () {
                        $teacher = Teacher::where('user_id', auth()->id())->first();
                        return JadwalPelajaran::with(['mataPelajaran', 'kelas'])
                            ->where('teacher_id', $teacher?->id)
                            ->where('is_aktif', true)
                            ->get()
                            ->mapWithKeys(fn ($j) => [
                                $j->id => "[{$j->kelas->nama}] {$j->mataPelajaran->nama}"
                            ]);
                    }),
            ])
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListInputNilai::route('/'),
            'create' => Pages\CreateInputNilai::route('/create'),
            'edit'   => Pages\EditInputNilai::route('/{record}/edit'),
        ];
    }
}