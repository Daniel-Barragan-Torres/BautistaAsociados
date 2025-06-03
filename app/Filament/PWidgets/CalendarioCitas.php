<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class CalendarioCitas extends Widget
{
    protected static string $view = 'filament.widgets.calendario-citas-directo';
    protected int|string|array $columnSpan = 'full';
}
