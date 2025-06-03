<?php

namespace App\Filament\Resources\CitaResource\Widgets;

use Filament\Widgets\ViewWidget;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;
use App\Models\Cita;

class CalendarioCitas extends ViewWidget implements HasActions
{
    use InteractsWithActions;

    protected static string $view = 'CitaResource.widgets.calendario-citas-directo';

    protected int|string|array $columnSpan = 'full';

    public function getActions(): array
    {
        return [
            Action::make('verCita')
                ->modalHeading(fn ($record) => $record->asunto)
                ->modalSubheading(fn ($record) => 'Cliente: ' . $record->cliente->nombre)
                ->modalButton('Cerrar')
                ->mountUsing(function (Cita $record, callable $set) {
                    $set('inicio', $record->fecha_inicio);
                    $set('fin', $record->fecha_fin);
                })
                ->form([
                    Placeholder::make('inicio')
                        ->label('Inicio')
                        ->content(fn ($get) => \Carbon\Carbon::parse($get('inicio'))->format('d/m/Y, g:i:s a')),
                    Placeholder::make('fin')
                        ->label('Fin')
                        ->content(fn ($get) => \Carbon\Carbon::parse($get('fin'))->format('d/m/Y, g:i:s a')),
                ])
                ->requiresConfirmation()
                ->hidden(fn () => true),
        ];
    }
}
