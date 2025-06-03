<?php

namespace App\Filament\Resources\CitaResource\Widgets;

use Filament\Widgets\Widget;

class CalendarioCitas extends Widget
{
    protected static string $view = 'CitaResource.widgets.calendario-citas-directo';

    protected int|string|array $columnSpan = 'full';
}
