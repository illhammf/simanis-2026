<?php

namespace App\Filament\Siswa\Resources\NilaiSiswaResource\Pages;

use App\Filament\Siswa\Resources\NilaiSiswaResource;
use Filament\Resources\Pages\ListRecords;

class ListNilaiSiswa extends ListRecords
{
    protected static string $resource = NilaiSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}