<?php

namespace App\Filament\Guru\Widgets;

use Filament\Widgets\Widget;

class ProfileWidget extends Widget
{
    protected static string $view = 'filament.guru.widgets.profile-widget';
    protected int|string|array $columnSpan = 'full';
}