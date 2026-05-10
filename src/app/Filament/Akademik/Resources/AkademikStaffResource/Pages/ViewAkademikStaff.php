<?php

namespace App\Filament\Akademik\Resources\AkademikStaffResource\Pages;

use App\Filament\Akademik\Resources\AkademikStaffResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAkademikStaff extends ViewRecord
{
    protected static string $resource = AkademikStaffResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}