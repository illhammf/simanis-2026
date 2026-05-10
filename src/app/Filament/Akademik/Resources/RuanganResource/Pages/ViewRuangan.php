<?php

namespace App\Filament\Akademik\Resources\RuanganResource\Pages;

use App\Filament\Akademik\Resources\RuanganResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRuangan extends ViewRecord
{
    protected static string $resource = RuanganResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}