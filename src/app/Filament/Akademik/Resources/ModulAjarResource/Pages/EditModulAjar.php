<?php

namespace App\Filament\Akademik\Resources\ModulAjarResource\Pages;

use App\Filament\Akademik\Resources\ModulAjarResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditModulAjar extends EditRecord
{
    protected static string $resource = ModulAjarResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}