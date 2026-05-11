<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\StudentResource\Pages;
use App\Models\Kelas;
use App\Models\Student;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    protected static ?string $navigationIcon = 'heroicon-s-user';
    protected static ?string $navigationGroup = 'Data Pengguna';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Siswa';
    protected static ?string $modelLabel = 'Siswa';
    protected static ?string $pluralModelLabel = 'Siswa';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nis')
                ->label('NIS (Nomor Induk Siswa)')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(20),

            TextInput::make('name')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(100),

            DatePicker::make('tanggal_lahir')
                ->label('Tanggal Lahir')
                ->displayFormat('d/m/Y'),

            Select::make('jenis_kelamin')
                ->label('Jenis Kelamin')
                ->options(['L' => 'Laki-laki', 'P' => 'Perempuan']),

            TextInput::make('alamat')
                ->label('Alamat')
                ->maxLength(255),

            Select::make('kelas_id')
                ->label('Kelas')
                ->options(
                    Kelas::with('tahunAjaran')
                        ->get()
                        ->mapWithKeys(fn ($k) => [$k->id => "{$k->nama} — {$k->tahunAjaran?->nama}"])
                )
                ->searchable()
                ->nullable(),

            Select::make('stream_id')
                ->label('Stream / Peminatan')
                ->relationship('stream', 'nama')
                ->nullable()
                ->helperText('Diisi untuk siswa SMA saja.'),

            Select::make('user_id')
                ->label('Plot ke Akun User')
                ->relationship('user', 'name')
                ->searchable()
                ->preload()
                ->nullable()
                ->helperText('Hubungkan siswa ini ke akun login. NIS akan otomatis dijadikan username.')
                ->getOptionLabelFromRecordUsing(fn (User $record) => "{$record->name} ({$record->email})")
                ->placeholder('Belum diplot'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nis')->label('NIS')->badge()->color('gray')->searchable(),
                TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                TextColumn::make('kelas.nama')->label('Kelas')->badge()->color('info')->default('-'),
                TextColumn::make('stream.nama')->label('Stream')->badge()->color('warning')->default('-'),
                TextColumn::make('user.name')
                    ->label('Akun User')
                    ->badge()
                    ->color(fn ($state) => $state ? 'success' : 'gray')
                    ->default('Belum diplot'),
            ])
            ->filters([
                SelectFilter::make('kelas_id')->label('Kelas')->relationship('kelas', 'nama'),
                SelectFilter::make('stream_id')->label('Stream')->relationship('stream', 'nama'),
            ])
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit'   => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}