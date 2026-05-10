<?php

namespace App\Filament\Akademik\Resources\AlurTujuanPembelajaranResource\Pages;

use App\Filament\Akademik\Resources\AlurTujuanPembelajaranResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAlurTujuanPembelajaran extends ViewRecord
{
    protected static string $resource = AlurTujuanPembelajaranResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}