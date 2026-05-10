<?php

namespace App\Filament\Siswa\Resources\AbsensiSiswaResource\Pages;

use App\Filament\Siswa\Resources\AbsensiSiswaResource;
use Filament\Resources\Pages\ListRecords;

class ListAbsensiSiswa extends ListRecords
{
    protected static string $resource = AbsensiSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}