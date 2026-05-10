<?php

namespace App\Filament\Akademik\Resources\RuanganResource\Pages;

use App\Filament\Akademik\Resources\RuanganResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRuangan extends EditRecord
{
    protected static string $resource = RuanganResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}