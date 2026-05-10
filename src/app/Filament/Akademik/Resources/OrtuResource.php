<?php

namespace App\Filament\Akademik\Resources;

use App\Filament\Akademik\Resources\OrtuResource\Pages;
use App\Models\Ortu;
use App\Models\Student;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrtuResource extends Resource
{
    protected static ?string $model = Ortu::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Data Pengguna';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Orang Tua';
    protected static ?string $modelLabel = 'Orang Tua';
    protected static ?string $pluralModelLabel = 'Orang Tua';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nio')
                ->label('NIO (Nomor Induk Orang Tua)')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(20),

            TextInput::make('name')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(100),

            TextInput::make('email')
                ->label('Email Kontak')
                ->email()
                ->maxLength(100),

            TextInput::make('phone')
                ->label('No. Telepon')
                ->tel()
                ->maxLength(20),

            Select::make('student_id')
                ->label('Siswa (Anak)')
                ->options(Student::pluck('name', 'id'))
                ->searchable()
                ->nullable(),

            Select::make('user_id')
                ->label('Plot ke Akun User')
                ->relationship('user', 'name')
                ->searchable()
                ->preload()
                ->nullable()
                ->helperText('Hubungkan orang tua ini ke akun login. NIO akan otomatis dijadikan username.')
                ->getOptionLabelFromRecordUsing(fn (User $record) => "{$record->name} ({$record->email})")
                ->placeholder('Belum diplot'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nio')
                    ->label('NIO')
                    ->badge()
                    ->color('gray')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->label('Telepon')
                    ->toggleable(),
                TextColumn::make('siswa.name')
                    ->label('Siswa / Anak')
                    ->badge()
                    ->color('info')
                    ->default('-'),
                TextColumn::make('user.name')
                    ->label('Akun User')
                    ->badge()
                    ->color(fn ($state) => $state ? 'success' : 'gray')
                    ->default('Belum diplot'),
            ])
            ->actions([ViewAction::make(), EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListOrtus::route('/'),
            'create' => Pages\CreateOrtu::route('/create'),
            'view'   => Pages\ViewOrtu::route('/{record}'),
            'edit'   => Pages\EditOrtu::route('/{record}/edit'),
        ];
    }
}