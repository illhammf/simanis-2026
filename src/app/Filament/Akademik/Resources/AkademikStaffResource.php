<?php

namespace App\Filament\Akademik\Resources;

use App\Filament\Akademik\Resources\AkademikStaffResource\Pages;
use App\Models\AkademikStaff;
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

class AkademikStaffResource extends Resource
{
    protected static ?string $model = AkademikStaff::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Data Pengguna';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Staff Akademik';
    protected static ?string $modelLabel = 'Staff Akademik';
    protected static ?string $pluralModelLabel = 'Staff Akademik';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nia')
                ->label('NIA (Nomor Induk Akademik)')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(20),

            TextInput::make('name')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(100),

            TextInput::make('jabatan')
                ->label('Jabatan')
                ->placeholder('mis: Kepala Akademik, Staff Akademik')
                ->maxLength(100),

            TextInput::make('phone')
                ->label('No. Telepon')
                ->tel()
                ->maxLength(20),

            Select::make('user_id')
                ->label('Plot ke Akun User')
                ->relationship('user', 'name')
                ->searchable()
                ->preload()
                ->nullable()
                ->helperText('Hubungkan staff ini ke akun login. NIA akan otomatis dijadikan username.')
                ->getOptionLabelFromRecordUsing(fn (User $record) => "{$record->name} ({$record->email})")
                ->placeholder('Belum diplot'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nia')
                    ->label('NIA')
                    ->badge()
                    ->color('gray')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->toggleable(),
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
            'index'  => Pages\ListAkademikStaffs::route('/'),
            'create' => Pages\CreateAkademikStaff::route('/create'),
            'view'   => Pages\ViewAkademikStaff::route('/{record}'),
            'edit'   => Pages\EditAkademikStaff::route('/{record}/edit'),
        ];
    }
}