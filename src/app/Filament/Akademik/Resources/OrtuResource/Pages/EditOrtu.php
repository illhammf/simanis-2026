<?php

namespace App\Filament\Akademik\Resources\OrtuResource\Pages;

use App\Filament\Akademik\Resources\OrtuResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrtu extends EditRecord
{
    protected static string $resource = OrtuResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}