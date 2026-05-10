<?php

namespace App\Filament\Guru\Resources\InputNilaiResource\Pages;

use App\Filament\Guru\Resources\InputNilaiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInputNilai extends ListRecords
{
    protected static string $resource = InputNilaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Input Nilai'),
        ];
    }
}