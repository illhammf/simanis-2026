<?php

namespace App\Filament\Akademik\Resources\KelasResource\RelationManagers;

use App\Models\Kelas;
use App\Models\Stream;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class SiswaRelationManager extends RelationManager
{
    protected static string $relationship = 'students';
    protected static ?string $title = 'Daftar Siswa';
    protected static ?string $icon = 'heroicon-o-user-group';

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Data Siswa')->schema([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(100),

                TextInput::make('nis')
                    ->label('NIS')
                    ->required()
                    ->unique(table: 'students', column: 'nis', ignoreRecord: true)
                    ->maxLength(20),

                Select::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options(['L' => 'Laki-laki', 'P' => 'Perempuan'])
                    ->required(),

                DatePicker::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->nullable(),

                Select::make('stream_id')
                    ->label('Stream / Peminatan')
                    ->options(Stream::orderBy('nama')->pluck('nama', 'id'))
                    ->nullable()
                    ->searchable(),

                TextInput::make('alamat')
                    ->label('Alamat')
                    ->nullable()
                    ->maxLength(255)
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('nis')
                    ->label('NIS')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jenis_kelamin')
                    ->label('JK')
                    ->badge()
                    ->color(fn ($state) => $state === 'L' ? 'info' : 'danger')
                    ->formatStateUsing(fn ($state) => $state === 'L' ? 'Laki-laki' : 'Perempuan'),

                TextColumn::make('stream.nama')
                    ->label('Stream')
                    ->badge()
                    ->color('success')
                    ->default('-'),

                TextColumn::make('tanggal_lahir')
                    ->label('Tgl Lahir')
                    ->date('d/m/Y')
                    ->toggleable(),
            ])
            ->headerActions([
                // Bulk: register new students and assign to this class in one shot
                Action::make('tambah_banyak_siswa')
                    ->label('Input Siswa Baru (Bulk)')
                    ->icon('heroicon-o-user-group')
                    ->color('primary')
                    ->modalWidth('5xl')
                    ->modalHeading('Input Siswa Baru ke Kelas Ini')
                    ->modalDescription('Isi data siswa baru. Semua baris disimpan sekaligus dan langsung masuk kelas ini.')
                    ->form([
                        Repeater::make('siswa')
                            ->label('Daftar Siswa Baru')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->maxLength(100),

                                TextInput::make('nis')
                                    ->label('NIS')
                                    ->required()
                                    ->maxLength(20),

                                Select::make('jenis_kelamin')
                                    ->label('JK')
                                    ->options(['L' => 'L', 'P' => 'P'])
                                    ->required()
                                    ->native(false),

                                DatePicker::make('tanggal_lahir')
                                    ->label('Tanggal Lahir')
                                    ->nullable(),

                                Select::make('stream_id')
                                    ->label('Stream')
                                    ->options(Stream::orderBy('nama')->pluck('nama', 'id'))
                                    ->nullable()
                                    ->searchable(),
                            ])
                            ->columns(5)
                            ->defaultItems(3)
                            ->minItems(1)
                            ->addActionLabel('+ Tambah Siswa')
                            ->reorderable(false),
                    ])
                    ->action(function (array $data): void {
                        $kelasId = $this->getOwnerRecord()->id;
                        $count = 0;

                        foreach ($data['siswa'] as $row) {
                            \App\Models\Student::create([
                                'name'          => $row['name'],
                                'nis'           => $row['nis'],
                                'jenis_kelamin' => $row['jenis_kelamin'],
                                'tanggal_lahir' => $row['tanggal_lahir'] ?? null,
                                'stream_id'     => $row['stream_id'] ?? null,
                                'kelas_id'      => $kelasId,
                            ]);
                            $count++;
                        }

                        Notification::make()
                            ->title("{$count} siswa baru berhasil didaftarkan ke kelas ini.")
                            ->success()
                            ->send();
                    }),

                // Assign existing students (without a class) to this class
                Action::make('assign_siswa')
                    ->label('Pindahkan Siswa Masuk')
                    ->icon('heroicon-o-user-plus')
                    ->color('success')
                    ->form([
                        Select::make('student_ids')
                            ->label('Pilih Siswa (belum punya kelas)')
                            ->options(
                                \App\Models\Student::whereNull('kelas_id')
                                    ->orderBy('name')
                                    ->get()
                                    ->mapWithKeys(fn ($s) => [$s->id => "{$s->name} ({$s->nis})"])
                            )
                            ->multiple()
                            ->searchable()
                            ->required()
                            ->helperText('Hanya siswa yang belum masuk kelas manapun yang tampil di sini.'),
                    ])
                    ->action(function (array $data): void {
                        $count = \App\Models\Student::whereIn('id', $data['student_ids'])
                            ->update(['kelas_id' => $this->getOwnerRecord()->id]);

                        Notification::make()
                            ->title("{$count} siswa berhasil ditambahkan ke kelas ini.")
                            ->success()
                            ->send();
                    }),
            ])
            ->actions([
                EditAction::make(),
                ActionGroup::make([
                    Action::make('keluarkan')
                        ->label('Keluarkan dari Kelas')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function ($record): void {
                            $record->update(['kelas_id' => null]);
                            Notification::make()
                                ->title("{$record->name} dikeluarkan dari kelas ini.")
                                ->warning()
                                ->send();
                        }),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('pindahkan_kelas')
                        ->label('Pindahkan Kelas')
                        ->icon('heroicon-o-arrows-right-left')
                        ->color('warning')
                        ->form([
                            Select::make('kelas_id')
                                ->label('Pindahkan ke Kelas')
                                ->options(
                                    Kelas::orderBy('tingkat')->orderBy('nama')
                                        ->get()
                                        ->mapWithKeys(fn ($k) => [$k->id => $k->nama])
                                )
                                ->required()
                                ->searchable(),
                        ])
                        ->action(function (Collection $records, array $data): void {
                            $count = $records->count();
                            $records->each->update(['kelas_id' => $data['kelas_id']]);
                            Notification::make()
                                ->title("{$count} siswa berhasil dipindahkan.")
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),

                    BulkAction::make('keluarkan_bulk')
                        ->label('Keluarkan dari Kelas')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function (Collection $records): void {
                            $count = $records->count();
                            $records->each->update(['kelas_id' => null]);
                            Notification::make()
                                ->title("{$count} siswa dikeluarkan dari kelas ini.")
                                ->warning()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->defaultSort('name');
    }
}