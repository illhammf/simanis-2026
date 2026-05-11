<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TeacherResource\Pages;
use App\Models\Teacher;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;
    protected static ?string $navigationIcon = 'heroicon-s-user-group';
    protected static ?string $navigationGroup = 'Data Pengguna';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Guru';
    protected static ?string $modelLabel = 'Guru';
    protected static ?string $pluralModelLabel = 'Guru';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nig')
                ->label('NIG (Nomor Induk Guru)')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(20),

            TextInput::make('name')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(100),

            TextInput::make('phone')
                ->label('No. Telepon')
                ->tel()
                ->maxLength(20),

            TextInput::make('alamat')
                ->label('Alamat')
                ->maxLength(255),

            Select::make('jenis_kelamin')
                ->label('Jenis Kelamin')
                ->options(['L' => 'Laki-laki', 'P' => 'Perempuan']),

            Select::make('user_id')
                ->label('Plot ke Akun User')
                ->relationship('user', 'name')
                ->searchable()
                ->preload()
                ->nullable()
                ->helperText('Hubungkan guru ini ke akun login. NIG akan otomatis dijadikan username.')
                ->getOptionLabelFromRecordUsing(fn (User $record) => "{$record->name} ({$record->email})")
                ->placeholder('Belum diplot'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nig')->label('NIG')->badge()->color('gray')->searchable(),
                TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                TextColumn::make('phone')->label('Telepon')->toggleable(),
                TextColumn::make('user.name')
                    ->label('Akun User')
                    ->badge()
                    ->color(fn ($state) => $state ? 'success' : 'gray')
                    ->default('Belum diplot'),
                TextColumn::make('kelas_count')->label('Wali Kelas')->counts('kelas')->badge()->color('info'),
            ])
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit'   => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}