<?php

namespace App\Filament\Akademik\Resources\KelasResource\Pages;

use App\Filament\Akademik\Resources\KelasResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewKelas extends ViewRecord
{
    protected static string $resource = KelasResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}