<?php

namespace App\Filament\Admin\Resources\AkademikStaffResource\Pages;

use App\Filament\Admin\Resources\AkademikStaffResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAkademikStaffs extends ListRecords
{
    protected static string $resource = AkademikStaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}