<?php

namespace App\Filament\Akademik\Resources\AkademikStaffResource\Pages;

use App\Filament\Akademik\Resources\AkademikStaffResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAkademikStaffs extends ListRecords
{
    protected static string $resource = AkademikStaffResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}