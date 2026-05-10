<?php

namespace App\Filament\Akademik\Resources\SiswaResource\Pages;

use App\Filament\Akademik\Resources\SiswaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSiswas extends ListRecords
{
    protected static string $resource = SiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}