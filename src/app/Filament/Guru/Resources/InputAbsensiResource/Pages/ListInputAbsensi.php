<?php

namespace App\Filament\Guru\Resources\InputAbsensiResource\Pages;

use App\Filament\Guru\Resources\InputAbsensiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInputAbsensi extends ListRecords
{
    protected static string $resource = InputAbsensiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Catat Absensi'),
        ];
    }
}