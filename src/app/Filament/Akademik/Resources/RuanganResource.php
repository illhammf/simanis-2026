<?php

namespace App\Filament\Akademik\Resources;

use App\Filament\Akademik\Resources\RuanganResource\Pages;
use App\Models\Ruangan;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class RuanganResource extends Resource
{
    protected static ?string $model = Ruangan::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = 'Ruangan';
    protected static ?string $modelLabel = 'Ruangan';
    protected static ?string $pluralModelLabel = 'Ruangan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Identitas Ruangan')->schema([
                TextInput::make('kode')
                    ->label('Kode')
                    ->placeholder('RK-01 / LAB-IPA')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(20),

                TextInput::make('nama')
                    ->label('Nama Ruangan')
                    ->placeholder('Ruang Kelas 7A / Laboratorium IPA')
                    ->required()
                    ->maxLength(100),

                Select::make('jenis')
                    ->label('Jenis')
                    ->options(Ruangan::$jenisLabels)
                    ->default('kelas')
                    ->required()
                    ->native(false),

                TextInput::make('kapasitas')
                    ->label('Kapasitas (orang)')
                    ->numeric()
                    ->default(32)
                    ->minValue(1)
                    ->required(),

                TextInput::make('gedung')
                    ->label('Gedung / Blok')
                    ->placeholder('Gedung A')
                    ->nullable()
                    ->maxLength(50),

                TextInput::make('lantai')
                    ->label('Lantai')
                    ->placeholder('Lantai 1')
                    ->nullable()
                    ->maxLength(20),

                Toggle::make('is_aktif')
                    ->label('Aktif')
                    ->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode')
                    ->label('Kode')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama')
                    ->label('Nama Ruangan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->formatStateUsing(fn ($state) => Ruangan::$jenisLabels[$state] ?? $state)
                    ->color(fn ($state) => match ($state) {
                        'kelas'        => 'info',
                        'lab_ipa'      => 'success',
                        'lab_komputer' => 'warning',
                        'lab_bahasa'   => 'warning',
                        'aula'         => 'danger',
                        default        => 'gray',
                    }),

                TextColumn::make('kapasitas')
                    ->label('Kapasitas')
                    ->sortable()
                    ->suffix(' orang'),

                TextColumn::make('gedung')
                    ->label('Gedung')
                    ->default('-')
                    ->toggleable(),

                TextColumn::make('lantai')
                    ->label('Lantai')
                    ->default('-')
                    ->toggleable(),

                IconColumn::make('is_aktif')
                    ->label('Aktif')
                    ->boolean(),

                TextColumn::make('jadwalPelajarans_count')
                    ->label('Jadwal')
                    ->counts('jadwalPelajarans')
                    ->badge()
                    ->color('info'),
            ])
            ->filters([
                SelectFilter::make('jenis')
                    ->label('Jenis')
                    ->options(Ruangan::$jenisLabels),
                SelectFilter::make('is_aktif')
                    ->label('Status')
                    ->options([1 => 'Aktif', 0 => 'Tidak Aktif'])
                    ->attribute('is_aktif'),
            ])
            ->actions([ViewAction::make(), EditAction::make(), DeleteAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])])
            ->defaultSort('kode');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListRuangans::route('/'),
            'create' => Pages\CreateRuangan::route('/create'),
            'view'   => Pages\ViewRuangan::route('/{record}'),
            'edit'   => Pages\EditRuangan::route('/{record}/edit'),
        ];
    }
}