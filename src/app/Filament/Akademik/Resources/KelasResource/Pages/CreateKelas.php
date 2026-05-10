<?php

namespace App\Filament\Akademik\Resources\KelasResource\Pages;

use App\Filament\Akademik\Resources\KelasResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKelas extends CreateRecord
{
    protected static string $resource = KelasResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}