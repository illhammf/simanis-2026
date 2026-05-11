<?php

namespace App\Filament\Akademik\Resources;

use App\Filament\Akademik\Resources\HariLiburResource\Pages;
use App\Models\HariLibur;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class HariLiburResource extends Resource
{
    protected static ?string $model = HariLibur::class;

    protected static ?string $navigationLabel = 'Hari Libur';
    protected static ?string $pluralModelLabel = 'Hari Libur';
    protected static ?string $modelLabel = 'Hari Libur';
    protected static ?string $navigationIcon = 'heroicon-s-calendar';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form->schema([
            DatePicker::make('tanggal')
                ->label('Tanggal')
                ->required()
                ->displayFormat('d/m/Y'),

            TextInput::make('nama')
                ->label('Nama Hari Libur')
                ->required()
                ->maxLength(150),

            Select::make('jenis')
                ->label('Jenis')
                ->options(HariLibur::$jenisOptions)
                ->required()
                ->default('nasional')
                ->native(false),

            Textarea::make('keterangan')
                ->label('Keterangan')
                ->rows(2)
                ->nullable(),

            Toggle::make('is_aktif')
                ->label('Aktif')
                ->default(true),
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

                TextColumn::make('hari')
                    ->label('Hari')
                    ->getStateUsing(fn ($record) =>
                        \Carbon\Carbon::parse($record->tanggal)->locale('id')->translatedFormat('l')
                    )
                    ->badge()->color('gray'),

                TextColumn::make('nama')
                    ->label('Nama Hari Libur')
                    ->searchable(),

                TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'nasional' => 'danger',
                        'lokal'    => 'warning',
                        'sekolah'  => 'info',
                        default    => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => HariLibur::$jenisOptions[$state] ?? $state),

                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->default('-')
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_aktif')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->defaultSort('tanggal', 'asc')
            ->filters([
                SelectFilter::make('jenis')
                    ->options(HariLibur::$jenisOptions)
                    ->label('Jenis'),
                SelectFilter::make('tahun')
                    ->label('Tahun')
                    ->options(fn () => collect(range(now()->year - 1, now()->year + 2))
                        ->mapWithKeys(fn ($y) => [$y => $y])
                    )
                    ->query(fn ($query, $data) =>
                        $data['value'] ? $query->whereYear('tanggal', $data['value']) : $query
                    ),
            ])
            ->actions([EditAction::make(), DeleteAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListHariLiburs::route('/'),
            'create' => Pages\CreateHariLibur::route('/create'),
            'edit'   => Pages\EditHariLibur::route('/{record}/edit'),
        ];
    }
}