<?php

namespace App\Filament\Resources\CitaResource\Widgets;

use Filament\Widgets\Widget;
use Filament\Actions\Contracts\HasActions;
use Filament\Support\Contracts\TranslatableContentDriver;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;
use App\Models\Cita;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarioCitas extends Widget implements HasActions
{
    public function makeFilamentTranslatableContentDriver(): ?TranslatableContentDriver
    {
        return null;
    }
    use InteractsWithActions;

    //  protected static string $view = 'CitaResource.widgets.calendario-citas-directo';
    protected static string $view = 'filament.resources.cita-resource.widgets.calendario-citas-directo';


    protected int|string|array $columnSpan = 'full';
    public ?Cita $record = null;

    public function getActions(): array
    {

        return [
            Action::make('verCita')
                ->modalHeading('Detalles de la Cita')
                ->modalButton('Cerrar')
                ->mountUsing(function ($record, $set) {
                    $set('inicio', $record->fecha_inicio);
                    $set('fin', $record->fecha_fin);
                    $set('asunto', $record->asunto);
                    $set('cliente', $record->cliente->nombre ?? '');
                })
                ->form([
                    Placeholder::make('cliente')->label('Cliente'),
                    Placeholder::make('asunto')->label('Asunto'),
                    Placeholder::make('inicio')->label('Inicio'),
                    Placeholder::make('fin')->label('Fin'),
                ]),
        ];
        /* return [
             Action::make('verCita')
                 ->modalHeading(fn($record) => $record->asunto)
                 ->modalSubheading(fn($record) => 'Cliente: ' . $record->cliente->nombre)
                 ->modalButton('Cerrar')
                 ->mountUsing(function (Cita $record, callable $set) {
                     $set('inicio', $record->fecha_inicio);
                     $set('fin', $record->fecha_fin);
                 })
                 ->form([
                     Placeholder::make('inicio')
                         ->label('Inicio')
                         ->content(fn($get) => \Carbon\Carbon::parse($get('inicio'))->format('d/m/Y, g:i:s a')),
                     Placeholder::make('fin')
                         ->label('Fin')
                         ->content(fn($get) => \Carbon\Carbon::parse($get('fin'))->format('d/m/Y, g:i:s a')),
                 ])
                 ->requiresConfirmation()
                 ->hidden(fn() => true),
         ];*/
    }
}
