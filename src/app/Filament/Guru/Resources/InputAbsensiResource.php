<?php

namespace App\Filament\Guru\Resources;

use App\Filament\Guru\Resources\InputAbsensiResource\Pages;
use App\Models\Absensi;
use App\Models\JadwalPelajaran;
use App\Models\Student;
use App\Models\Teacher;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InputAbsensiResource extends Resource
{
    protected static ?string $model = Absensi::class;

    protected static ?string $navigationLabel = 'Absensi Siswa';
    protected static ?string $pluralModelLabel = 'Absensi Siswa';
    protected static ?string $modelLabel = 'Absensi';
    protected static ?string $navigationIcon = 'heroicon-s-clipboard-document-check';
    protected static ?int $navigationSort = 4;

    public static function getEloquentQuery(): Builder
    {
        $teacher = Teacher::where('user_id', auth()->id())->first();

        return parent::getEloquentQuery()
            ->with(['student', 'jadwalPelajaran.mataPelajaran', 'jadwalPelajaran.kelas'])
            ->whereHas('jadwalPelajaran', function ($q) use ($teacher) {
                $q->where('teacher_id', $teacher?->id ?? 0);
            });
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

                DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->required()
                    ->displayFormat('d/m/Y')
                    ->default(now()),

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

                Select::make('status')
                    ->label('Status Kehadiran')
                    ->options(Absensi::$statusOptions)
                    ->required()
                    ->default('hadir')
                    ->native(false),

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
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('jadwalPelajaran.kelas.nama')
                    ->label('Kelas')
                    ->badge()->color('info'),

                TextColumn::make('jadwalPelajaran.mataPelajaran.nama')
                    ->label('Mata Pelajaran'),

                TextColumn::make('student.name')
                    ->label('Nama Siswa')
                    ->searchable(),

                TextColumn::make('student.nis')
                    ->label('NIS')
                    ->badge()->color('gray'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'hadir' => 'success',
                        'izin'  => 'info',
                        'sakit' => 'warning',
                        'alpha' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => Absensi::$statusOptions[$state] ?? $state),
            ])
            ->defaultSort('tanggal', 'desc')
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
                SelectFilter::make('status')
                    ->options(Absensi::$statusOptions)
                    ->label('Status'),
            ])
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListInputAbsensi::route('/'),
            'create' => Pages\CreateInputAbsensi::route('/create'),
            'edit'   => Pages\EditInputAbsensi::route('/{record}/edit'),
        ];
    }
}