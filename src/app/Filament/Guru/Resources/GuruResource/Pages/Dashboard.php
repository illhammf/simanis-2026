<?php

namespace App\Filament\Guru\Resources\GuruResource\Pages;

use App\Filament\Guru\Resources\GuruResource;
use Filament\Resources\Pages\Page;

class Dashboard extends Page
{
    protected static string $resource = GuruResource::class;

    protected static string $view = 'filament.guru.resources.guru-resource.pages.dashboard';


}