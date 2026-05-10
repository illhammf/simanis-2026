<?php

namespace App\Filament\Akademik\Resources\TahunAjaranResource\Pages;

use App\Filament\Akademik\Resources\TahunAjaranResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTahunAjaran extends ViewRecord
{
    protected static string $resource = TahunAjaranResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}