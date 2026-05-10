<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class BackToModulWidget extends Widget
{
    protected static string $view = 'filament.widgets.back-to-modul-widget';

    protected static ?int $sort = -10;

    protected int | string | array $columnSpan = 'full';
}