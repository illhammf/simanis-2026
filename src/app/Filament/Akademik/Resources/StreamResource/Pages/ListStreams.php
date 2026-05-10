<?php

namespace App\Filament\Akademik\Resources\StreamResource\Pages;

use App\Filament\Akademik\Resources\StreamResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStreams extends ListRecords
{
    protected static string $resource = StreamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}