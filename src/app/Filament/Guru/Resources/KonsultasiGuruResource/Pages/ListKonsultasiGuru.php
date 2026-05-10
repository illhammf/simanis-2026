<?php

namespace App\Filament\Guru\Resources\KonsultasiGuruResource\Pages;

use App\Filament\Guru\Resources\KonsultasiGuruResource;
use Filament\Resources\Pages\ListRecords;

class ListKonsultasiGuru extends ListRecords
{
    protected static string $resource = KonsultasiGuruResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}