<?php

namespace App\Filament\Siswa\Resources\TugasSiswaResource\Pages;

use App\Filament\Siswa\Resources\TugasSiswaResource;
use Filament\Resources\Pages\ListRecords;

class ListTugasSiswa extends ListRecords
{
    protected static string $resource = TugasSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}