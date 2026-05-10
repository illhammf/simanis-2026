<?php

namespace App\Filament\OrangTua\Resources\AbsensiAnakResource\Pages;

use App\Filament\OrangTua\Resources\AbsensiAnakResource;
use Filament\Resources\Pages\ListRecords;

class ListAbsensiAnak extends ListRecords
{
    protected static string $resource = AbsensiAnakResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}