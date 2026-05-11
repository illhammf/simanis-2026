<?php

namespace App\Filament\Admin\Resources\PemeriksaanResource\Pages;

use App\Filament\Admin\Resources\PemeriksaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPemeriksaan extends EditRecord
{
    protected static string $resource = PemeriksaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
