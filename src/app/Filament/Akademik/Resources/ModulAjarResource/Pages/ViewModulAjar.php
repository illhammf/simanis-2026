<?php

namespace App\Filament\Akademik\Resources\ModulAjarResource\Pages;

use App\Filament\Akademik\Resources\ModulAjarResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewModulAjar extends ViewRecord
{
    protected static string $resource = ModulAjarResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}