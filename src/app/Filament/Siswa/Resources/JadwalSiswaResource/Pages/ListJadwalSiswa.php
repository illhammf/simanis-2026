<?php

namespace App\Filament\Siswa\Resources\JadwalSiswaResource\Pages;

use App\Filament\Siswa\Resources\JadwalSiswaResource;
use Filament\Resources\Pages\ListRecords;

class ListJadwalSiswa extends ListRecords
{
    protected static string $resource = JadwalSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}