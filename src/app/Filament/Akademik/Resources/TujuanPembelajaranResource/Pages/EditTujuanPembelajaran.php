<?php

namespace App\Filament\Akademik\Resources\TujuanPembelajaranResource\Pages;

use App\Filament\Akademik\Resources\TujuanPembelajaranResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTujuanPembelajaran extends EditRecord
{
    protected static string $resource = TujuanPembelajaranResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}