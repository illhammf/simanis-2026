<?php

namespace App\Filament\Akademik\Resources\SiswaResource\Pages;

use App\Filament\Akademik\Resources\SiswaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSiswa extends EditRecord
{
    protected static string $resource = SiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}