<?php

namespace App\Filament\Guru\Resources\InputNilaiResource\Pages;

use App\Filament\Guru\Resources\InputNilaiResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInputNilai extends EditRecord
{
    protected static string $resource = InputNilaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}