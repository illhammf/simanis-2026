<?php

namespace App\Filament\Guru\Resources\InputAbsensiResource\Pages;

use App\Filament\Guru\Resources\InputAbsensiResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInputAbsensi extends EditRecord
{
    protected static string $resource = InputAbsensiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}