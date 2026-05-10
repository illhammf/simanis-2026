<?php

namespace App\Filament\Akademik\Resources\GuruResource\Pages;

use App\Filament\Akademik\Resources\GuruResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGuru extends EditRecord
{
    protected static string $resource = GuruResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}