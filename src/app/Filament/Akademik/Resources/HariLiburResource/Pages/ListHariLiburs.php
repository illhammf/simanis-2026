<?php

namespace App\Filament\Akademik\Resources\HariLiburResource\Pages;

use App\Filament\Akademik\Resources\HariLiburResource;
use App\Models\HariLibur;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Http;
use Filament\Actions\Action;

class ListHariLiburs extends ListRecords
{
    protected static string $resource = HariLiburResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('import_api')
                ->label('Import dari API')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('info')
                ->form([
                    Select::make('tahun')
                        ->label('Tahun')
                        ->options(collect(range(now()->year - 1, now()->year + 2))
                            ->mapWithKeys(fn ($y) => [$y => $y])
                        )
                        ->default(now()->year)
                        ->required()
                        ->native(false),
                ])
                ->action(function (array $data): void {
                    $tahun = $data['tahun'];

                    try {
                        $response = Http::timeout(15)
                            ->get("https://date.nager.at/api/v3/PublicHolidays/{$tahun}/ID");

                        if (! $response->successful()) {
                            Notification::make()
                                ->title('Gagal mengambil data dari API')
                                ->body("Status: {$response->status()}")
                                ->danger()
                                ->send();
                            return;
                        }

                        $holidays = $response->json();
                        $count    = 0;

                        foreach ($holidays as $holiday) {
                            $created = HariLibur::firstOrCreate(
                                ['tanggal' => $holiday['date']],
                                [
                                    'nama'     => $holiday['localName'] ?? $holiday['name'],
                                    'jenis'    => 'nasional',
                                    'is_aktif' => true,
                                ]
                            );

                            if ($created->wasRecentlyCreated) {
                                $count++;
                            }
                        }

                        Notification::make()
                            ->title('Import berhasil')
                            ->body("{$count} hari libur baru ditambahkan untuk tahun {$tahun}.")
                            ->success()
                            ->send();

                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Error saat import')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),

            CreateAction::make()->label('Tambah Manual'),
        ];
    }
}