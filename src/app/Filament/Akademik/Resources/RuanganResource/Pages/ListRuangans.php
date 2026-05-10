<?php

namespace App\Filament\Akademik\Resources\RuanganResource\Pages;

use App\Filament\Akademik\Resources\RuanganResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRuangans extends ListRecords
{
    protected static string $resource = RuanganResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}