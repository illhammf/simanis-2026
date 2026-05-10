<?php

namespace App\Filament\Akademik\Resources\OrtuResource\Pages;

use App\Filament\Akademik\Resources\OrtuResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOrtu extends ViewRecord
{
    protected static string $resource = OrtuResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}