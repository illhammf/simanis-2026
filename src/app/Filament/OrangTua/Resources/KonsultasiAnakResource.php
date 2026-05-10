<?php

namespace App\Filament\OrangTua\Resources;

use App\Filament\OrangTua\Resources\KonsultasiAnakResource\Pages;
use App\Models\Konsultasi;
use App\Models\Ortu;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class KonsultasiAnakResource extends Resource
{
    protected static ?string $model = Konsultasi::class;

    protected static ?string $navigationLabel = 'Konsultasi Anak';
    protected static ?string $pluralModelLabel = 'Konsultasi Anak';
    protected static ?string $modelLabel = 'Konsultasi';
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?int $navigationSort = 4;

    public static function getEloquentQuery(): Builder
    {
        $ortu  = Ortu::where('user_id', auth()->id())->first();
        $siswa = $ortu?->siswa;

        return parent::getEloquentQuery()
            ->with(['student', 'teacher'])
            ->where('student_id', $siswa?->id ?? 0);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('judul')
                    ->label('Topik')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('teacher.name')
                    ->label('Wali Kelas'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'pending' => 'warning',
                        'dibaca'  => 'info',
                        'dibalas' => 'success',
                        default   => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => Konsultasi::$statusOptions[$state] ?? $state),

                TextColumn::make('dibalas_at')
                    ->label('Dibalas')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('Belum dibalas'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options(Konsultasi::$statusOptions)
                    ->label('Status'),
            ])
            ->actions([
                Action::make('lihat_detail')
                    ->label('Detail')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->modalHeading(fn ($record) => "Konsultasi: {$record->judul}")
                    ->form([
                        \Filament\Forms\Components\Textarea::make('pesan')
                            ->label('Pesan Anak')
                            ->disabled()
                            ->default(fn ($record) => $record->pesan)
                            ->rows(4)
                            ->dehydrated(false),

                        \Filament\Forms\Components\Textarea::make('balasan')
                            ->label('Balasan Wali Kelas')
                            ->disabled()
                            ->default(fn ($record) => $record->balasan ?? '(belum dibalas)')
                            ->rows(4)
                            ->dehydrated(false),
                    ])
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup'),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKonsultasiAnak::route('/'),
        ];
    }
}