<?php

namespace App\Filament\Akademik\Resources\GuruResource\Pages;

use App\Filament\Akademik\Resources\GuruResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGurus extends ListRecords
{
    protected static string $resource = GuruResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}