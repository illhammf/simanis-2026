<?php

namespace App\Filament\Guru\Resources\ModulAjarResource\Pages;

use App\Filament\Guru\Resources\ModulAjarResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditModulAjar extends EditRecord
{
    protected static string $resource = ModulAjarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}