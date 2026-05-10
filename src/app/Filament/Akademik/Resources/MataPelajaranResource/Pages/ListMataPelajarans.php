<?php

namespace App\Filament\Akademik\Resources\MataPelajaranResource\Pages;

use App\Filament\Akademik\Resources\MataPelajaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMataPelajarans extends ListRecords
{
    protected static string $resource = MataPelajaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}