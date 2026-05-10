<?php

namespace App\Filament\Akademik\Resources\CapaianPembelajaranResource\Pages;

use App\Filament\Akademik\Resources\CapaianPembelajaranResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCapaianPembelajarans extends ListRecords
{
    protected static string $resource = CapaianPembelajaranResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}