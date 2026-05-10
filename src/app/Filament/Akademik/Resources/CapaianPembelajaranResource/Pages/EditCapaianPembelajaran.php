<?php

namespace App\Filament\Akademik\Resources\CapaianPembelajaranResource\Pages;

use App\Filament\Akademik\Resources\CapaianPembelajaranResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCapaianPembelajaran extends EditRecord
{
    protected static string $resource = CapaianPembelajaranResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}