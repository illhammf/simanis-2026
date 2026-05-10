<?php

namespace App\Filament\OrangTua\Resources\JadwalAnakResource\Pages;

use App\Filament\OrangTua\Resources\JadwalAnakResource;
use Filament\Resources\Pages\ListRecords;

class ListJadwalAnak extends ListRecords
{
    protected static string $resource = JadwalAnakResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}