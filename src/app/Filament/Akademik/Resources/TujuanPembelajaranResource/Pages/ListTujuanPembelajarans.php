<?php

namespace App\Filament\Akademik\Resources\TujuanPembelajaranResource\Pages;

use App\Filament\Akademik\Resources\TujuanPembelajaranResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTujuanPembelajarans extends ListRecords
{
    protected static string $resource = TujuanPembelajaranResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}