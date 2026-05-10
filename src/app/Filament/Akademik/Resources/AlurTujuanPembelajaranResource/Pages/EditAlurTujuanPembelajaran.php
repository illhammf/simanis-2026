<?php

namespace App\Filament\Akademik\Resources\AlurTujuanPembelajaranResource\Pages;

use App\Filament\Akademik\Resources\AlurTujuanPembelajaranResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAlurTujuanPembelajaran extends EditRecord
{
    protected static string $resource = AlurTujuanPembelajaranResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}