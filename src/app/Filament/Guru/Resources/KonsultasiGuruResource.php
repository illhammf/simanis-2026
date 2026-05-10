<?php

namespace App\Filament\Guru\Resources;

use App\Filament\Guru\Resources\KonsultasiGuruResource\Pages;
use App\Models\Konsultasi;
use App\Models\Teacher;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class KonsultasiGuruResource extends Resource
{
    protected static ?string $model = Konsultasi::class;

    protected static ?string $navigationLabel = 'Konsultasi Siswa';
    protected static ?string $pluralModelLabel = 'Konsultasi Siswa';
    protected static ?string $modelLabel = 'Konsultasi';
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?int $navigationSort = 5;

    public static function getEloquentQuery(): Builder
    {
        $teacher = Teacher::where('user_id', auth()->id())->first();

        return parent::getEloquentQuery()
            ->with(['student.kelas', 'teacher'])
            ->where('teacher_id', $teacher?->id ?? 0);
    }

    public static function getNavigationBadge(): ?string
    {
        $teacher = Teacher::where('user_id', auth()->id())->first();

        $count = Konsultasi::where('teacher_id', $teacher?->id ?? 0)
            ->where('status', 'pending')
            ->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
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

                TextColumn::make('student.name')
                    ->label('Siswa')
                    ->searchable(),

                TextColumn::make('student.kelas.nama')
                    ->label('Kelas')
                    ->badge()->color('info'),

                TextColumn::make('judul')
                    ->label('Topik')
                    ->searchable()
                    ->limit(50),

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
                Action::make('balas')
                    ->label('Balas')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('primary')
                    ->modalHeading(fn ($record) => "Balas Konsultasi: {$record->judul}")
                    ->modalDescription(fn ($record) => 'Dari: ' . $record->student->name . ' (' . ($record->student->kelas->nama ?? '-') . ')')
                    ->form([
                        Textarea::make('pesan_siswa')
                            ->label('Pesan Siswa')
                            ->default(fn ($record) => $record->pesan)
                            ->disabled()
                            ->rows(4)
                            ->dehydrated(false),

                        Textarea::make('balasan')
                            ->label('Balasan Kamu')
                            ->required()
                            ->rows(4)
                            ->default(fn ($record) => $record->balasan),
                    ])
                    ->action(function ($record, array $data): void {
                        $record->update([
                            'balasan'    => $data['balasan'],
                            'status'     => 'dibalas',
                            'dibalas_at' => now(),
                        ]);

                        Notification::make()
                            ->title('Balasan terkirim')
                            ->success()
                            ->send();
                    }),

                Action::make('tandai_dibaca')
                    ->label('Tandai Dibaca')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record): void {
                        $record->update(['status' => 'dibaca']);
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKonsultasiGuru::route('/'),
        ];
    }
}