<?php

namespace App\Filament\Akademik\Resources\MataPelajaranResource\Pages;

use App\Filament\Akademik\Resources\MataPelajaranResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMataPelajaran extends CreateRecord
{
    protected static string $resource = MataPelajaranResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}