<?php

namespace App\Filament\Admin\Resources\OrtuResource\Pages;

use App\Filament\Admin\Resources\OrtuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrtu extends EditRecord
{
    protected static string $resource = OrtuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
