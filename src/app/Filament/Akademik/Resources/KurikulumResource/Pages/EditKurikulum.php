<?php

namespace App\Filament\Akademik\Resources\KurikulumResource\Pages;

use App\Filament\Akademik\Resources\KurikulumResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKurikulum extends EditRecord
{
    protected static string $resource = KurikulumResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}