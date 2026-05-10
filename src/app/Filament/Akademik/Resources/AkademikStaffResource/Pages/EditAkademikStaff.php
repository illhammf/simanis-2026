<?php

namespace App\Filament\Akademik\Resources\AkademikStaffResource\Pages;

use App\Filament\Akademik\Resources\AkademikStaffResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAkademikStaff extends EditRecord
{
    protected static string $resource = AkademikStaffResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}