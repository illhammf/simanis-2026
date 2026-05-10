<?php

namespace App\Filament\Akademik\Resources\AlurTujuanPembelajaranResource\Pages;

use App\Filament\Akademik\Resources\AlurTujuanPembelajaranResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAlurTujuanPembelajarans extends ListRecords
{
    protected static string $resource = AlurTujuanPembelajaranResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}