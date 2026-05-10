<?php

namespace App\Filament\Siswa\Resources;

use App\Filament\Siswa\Resources\KonsultasiSiswaResource\Pages;
use App\Models\Konsultasi;
use App\Models\Student;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class KonsultasiSiswaResource extends Resource
{
    protected static ?string $model = Konsultasi::class;

    protected static ?string $navigationLabel = 'Konsultasi Wali Kelas';
    protected static ?string $pluralModelLabel = 'Konsultasi';
    protected static ?string $modelLabel = 'Konsultasi';
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?int $navigationSort = 5;

    public static function getEloquentQuery(): Builder
    {
        $student = Student::where('user_id', auth()->id())->first();

        return parent::getEloquentQuery()
            ->with(['teacher'])
            ->where('student_id', $student?->id ?? 0);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('judul')
                ->label('Judul / Topik')
                ->required()
                ->maxLength(200),

            Textarea::make('pesan')
                ->label('Pesan')
                ->required()
                ->rows(5)
                ->columnSpanFull(),
        ]);
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
                Action::make('lihat_balasan')
                    ->label('Lihat Balasan')
                    ->icon('heroicon-o-chat-bubble-left')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'dibalas')
                    ->modalHeading(fn ($record) => "Balasan: {$record->judul}")
                    ->modalContent(fn ($record) => view(
                        'filament.siswa.konsultasi-balasan',
                        ['konsultasi' => $record]
                    ))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup'),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListKonsultasiSiswa::route('/'),
            'create' => Pages\CreateKonsultasiSiswa::route('/create'),
        ];
    }
}