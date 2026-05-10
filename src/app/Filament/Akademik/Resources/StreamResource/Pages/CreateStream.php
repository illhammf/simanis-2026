<?php

namespace App\Filament\Akademik\Resources\StreamResource\Pages;

use App\Filament\Akademik\Resources\StreamResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStream extends CreateRecord
{
    protected static string $resource = StreamResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}