<?php

namespace App\Filament\Akademik\Resources\StreamResource\Pages;

use App\Filament\Akademik\Resources\StreamResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStream extends EditRecord
{
    protected static string $resource = StreamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}