<?php

namespace App\Filament\Akademik\Resources\ModulAjarResource\Pages;

use App\Filament\Akademik\Resources\ModulAjarResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListModulAjars extends ListRecords
{
    protected static string $resource = ModulAjarResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}