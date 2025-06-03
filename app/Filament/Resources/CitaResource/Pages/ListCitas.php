<?php

namespace App\Filament\Resources\CitaResource\Pages;

use App\Filament\Resources\CitaResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;

use App\Models\Cita;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CitaResource\Widgets\CalendarioCitas;
use Illuminate\Contracts\View\View;


class ListCitas extends ListRecords
{
    protected static string $resource = CitaResource::class;

    public function getHeader(): View
    {
        return view('CitaResource.widgets.calendario-citas-directo'); //  archivo blade
    }



    public function getActions(): array
    {
        return [
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
                ->hidden(fn() => true), // oculto hasta que se llame por código JS
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }



}
