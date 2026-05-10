<?php

namespace App\Filament\Akademik\Resources\TujuanPembelajaranResource\Pages;

use App\Filament\Akademik\Resources\TujuanPembelajaranResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTujuanPembelajaran extends ViewRecord
{
    protected static string $resource = TujuanPembelajaranResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}