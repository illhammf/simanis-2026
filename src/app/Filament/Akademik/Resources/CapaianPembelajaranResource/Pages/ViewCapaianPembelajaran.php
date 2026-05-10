<?php

namespace App\Filament\Akademik\Resources\CapaianPembelajaranResource\Pages;

use App\Filament\Akademik\Resources\CapaianPembelajaranResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCapaianPembelajaran extends ViewRecord
{
    protected static string $resource = CapaianPembelajaranResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}