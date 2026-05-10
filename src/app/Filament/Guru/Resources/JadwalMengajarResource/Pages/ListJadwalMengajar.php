<?php

namespace App\Filament\Guru\Resources\JadwalMengajarResource\Pages;

use App\Filament\Guru\Resources\JadwalMengajarResource;
use Filament\Resources\Pages\ListRecords;

class ListJadwalMengajar extends ListRecords
{
    protected static string $resource = JadwalMengajarResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}