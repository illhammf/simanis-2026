<?php

namespace App\Filament\Akademik\Resources;

use App\Filament\Akademik\Resources\AlurTujuanPembelajaranResource\Pages;
use App\Filament\Akademik\Resources\AlurTujuanPembelajaranResource\RelationManagers;
use App\Models\AlurTujuanPembelajaran;
use App\Models\Kurikulum;
use App\Models\MataPelajaran;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AlurTujuanPembelajaranResource extends Resource
{
    protected static ?string $model = AlurTujuanPembelajaran::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';
    protected static ?string $navigationGroup = 'Kurikulum & Pembelajaran';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'ATP';
    protected static ?string $modelLabel = 'Alur Tujuan Pembelajaran';
    protected static ?string $pluralModelLabel = 'Alur Tujuan Pembelajaran (ATP)';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('capaian_pembelajaran_id')
                ->label('Capaian Pembelajaran')
                ->relationship('capaianPembelajaran', 'kode_cp')
                ->getOptionLabelFromRecordUsing(fn ($record) =>
                    "[{$record->kode_cp}] {$record->mataPelajaran?->nama} – {$record->elemen}"
                )
                ->searchable()
                ->preload()
                ->required()
                ->columnSpanFull(),
            TextInput::make('kode_atp')
                ->label('Kode ATP')
                ->placeholder('ATP.MAT.D.1.1'),
            Select::make('kelas')
                ->label('Kelas')
                ->options([
                    '7' => 'Kelas 7', '8' => 'Kelas 8', '9' => 'Kelas 9',
                    '10' => 'Kelas 10', '11' => 'Kelas 11', '12' => 'Kelas 12',
                ])
                ->required(),
            Select::make('semester')
                ->label('Semester')
                ->options(['1' => 'Ganjil (1)', '2' => 'Genap (2)'])
                ->required(),
            TextInput::make('urutan')->label('Urutan')->numeric()->default(0),
            Textarea::make('deskripsi')
                ->label('Deskripsi ATP')
                ->rows(4)
                ->required()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_atp')->label('Kode ATP')->badge()->color('primary')->searchable(),
                TextColumn::make('capaianPembelajaran.mataPelajaran.nama')->label('Mata Pelajaran')->searchable(),
                TextColumn::make('capaianPembelajaran.elemen')->label('Elemen')->badge()->color('warning'),
                TextColumn::make('kelas')->label('Kelas')->formatStateUsing(fn ($s) => "Kelas {$s}")->badge()->color('info'),
                TextColumn::make('semester')->label('Smt')->formatStateUsing(fn ($s) => $s === '1' ? 'Ganjil' : 'Genap')->badge()->color('gray'),
                TextColumn::make('deskripsi')->label('Deskripsi')->limit(70)->wrap(),
                TextColumn::make('tujuanPembelajarans_count')->label('TP')->counts('tujuanPembelajarans')->badge()->color('gray'),
            ])
            ->filters([
                SelectFilter::make('kelas')
                    ->options(['7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12']),
                SelectFilter::make('semester')
                    ->options(['1'=>'Ganjil','2'=>'Genap']),
            ])
            ->actions([ViewAction::make(), EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getRelationManagers(): array
    {
        return [
            RelationManagers\TujuanPembelajaranRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAlurTujuanPembelajarans::route('/'),
            'create' => Pages\CreateAlurTujuanPembelajaran::route('/create'),
            'view'   => Pages\ViewAlurTujuanPembelajaran::route('/{record}'),
            'edit'   => Pages\EditAlurTujuanPembelajaran::route('/{record}/edit'),
        ];
    }
}