<?php

namespace App\Filament\Admin\Resources\PemeriksaanResource\Pages;

use App\Filament\Admin\Resources\PemeriksaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPemeriksaans extends ListRecords
{
    protected static string $resource = PemeriksaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
