<?php

namespace App\Filament\Akademik\Resources\OrtuResource\Pages;

use App\Filament\Akademik\Resources\OrtuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrtus extends ListRecords
{
    protected static string $resource = OrtuResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}