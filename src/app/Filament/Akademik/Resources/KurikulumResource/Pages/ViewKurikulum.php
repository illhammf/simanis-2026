<?php

namespace App\Filament\Akademik\Resources\KurikulumResource\Pages;

use App\Filament\Akademik\Resources\KurikulumResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewKurikulum extends ViewRecord
{
    protected static string $resource = KurikulumResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}