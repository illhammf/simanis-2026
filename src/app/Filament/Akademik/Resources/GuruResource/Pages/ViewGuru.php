<?php

namespace App\Filament\Akademik\Resources\GuruResource\Pages;

use App\Filament\Akademik\Resources\GuruResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewGuru extends ViewRecord
{
    protected static string $resource = GuruResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}