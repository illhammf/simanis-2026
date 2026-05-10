<?php

namespace App\Filament\OrangTua\Resources\NilaiAnakResource\Pages;

use App\Filament\OrangTua\Resources\NilaiAnakResource;
use Filament\Resources\Pages\ListRecords;

class ListNilaiAnak extends ListRecords
{
    protected static string $resource = NilaiAnakResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}