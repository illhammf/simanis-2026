<?php

namespace App\Filament\OrangTua\Resources\KonsultasiAnakResource\Pages;

use App\Filament\OrangTua\Resources\KonsultasiAnakResource;
use Filament\Resources\Pages\ListRecords;

class ListKonsultasiAnak extends ListRecords
{
    protected static string $resource = KonsultasiAnakResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}