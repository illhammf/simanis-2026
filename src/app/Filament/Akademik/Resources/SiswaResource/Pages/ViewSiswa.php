<?php

namespace App\Filament\Akademik\Resources\SiswaResource\Pages;

use App\Filament\Akademik\Resources\SiswaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSiswa extends ViewRecord
{
    protected static string $resource = SiswaResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}