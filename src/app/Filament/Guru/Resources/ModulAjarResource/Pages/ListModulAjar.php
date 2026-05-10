<?php

namespace App\Filament\Guru\Resources\ModulAjarResource\Pages;

use App\Filament\Guru\Resources\ModulAjarResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListModulAjar extends ListRecords
{
    protected static string $resource = ModulAjarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Buat Modul Ajar'),
        ];
    }
}