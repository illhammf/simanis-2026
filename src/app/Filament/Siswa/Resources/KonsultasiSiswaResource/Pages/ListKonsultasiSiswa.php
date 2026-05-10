<?php

namespace App\Filament\Siswa\Resources\KonsultasiSiswaResource\Pages;

use App\Filament\Siswa\Resources\KonsultasiSiswaResource;
use App\Models\Student;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKonsultasiSiswa extends ListRecords
{
    protected static string $resource = KonsultasiSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Kirim Konsultasi'),
        ];
    }
}