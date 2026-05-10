<?php

namespace App\Filament\Akademik\Resources\KurikulumResource\Pages;

use App\Filament\Akademik\Resources\KurikulumResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKurikulums extends ListRecords
{
    protected static string $resource = KurikulumResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}