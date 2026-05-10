<?php

namespace App\Filament\Guru\Resources\ModulAjarResource\Pages;

use App\Filament\Guru\Resources\ModulAjarResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewModulAjar extends ViewRecord
{
    protected static string $resource = ModulAjarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}