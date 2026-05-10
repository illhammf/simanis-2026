<?php

namespace App\Filament\Akademik\Resources\JadwalPelajaranResource\Pages;

use App\Filament\Akademik\Resources\JadwalPelajaranResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJadwalPelajaran extends EditRecord
{
    protected static string $resource = JadwalPelajaranResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}