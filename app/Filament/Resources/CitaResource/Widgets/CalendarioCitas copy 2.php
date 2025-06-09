<?php

namespace App\Filament\Resources\CitaResource\Widgets;

use Filament\Support\View\Components\Modal;
use Filament\Widgets\Widget;

use App\Models\Cita;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Saade\FilamentFullCalendar\Actions\CreateAction;
use Saade\FilamentFullCalendar\Actions\ViewAction;
use Saade\FilamentFullCalendar\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Placeholder;
use Filament\Actions\ModalAction;


use Filament\Forms\Components\Select;
use Illuminate\Support\Str;


use Filament\Forms\Components\Grid;
use Filament\Forms;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;

use Saade\FilamentFullCalendar\Actions\EventDropAction;
use Saade\FilamentFullCalendar\Actions\EventResizeAction;

use App\Filament\Resources\CitaResource;

use Illuminate\Database\Eloquent\Model;

use Filament\Actions\Action;


use Carbon\Carbon;


use Saade\FilamentFullCalendar\Data\EventData;

use App\Models\Event;

use Illuminate\Support\Facades\View;

class CalendarioCitas extends FullCalendarWidget
{
    public string|Model|null $model = Cita::class;


    protected bool $hasRecord = true;

    protected function getListeners(): array
    {
        return [
            'refreshCalendar' => '$refresh',
        ];
    }
    /* Fetch */
    public function fetchEvents(array $fetchInfo): array
    {
        return Cita::query()
            ->with('cliente')
            ->where('fecha_inicio', '>=', $fetchInfo['start'])
            ->where('fecha_fin', '<=', $fetchInfo['end'])
            ->get()
            ->map(fn($cita) => [
                'id' => $cita->getKey(),
                // 'title' => Str::limit($cita->cliente->nombre, 10),
                'title' => $cita->cliente->nombre,
                'extendedProps' => [
                    'nombreCompleto' => $cita->cliente->nombre,
                ],
                'start' => $cita->fecha_inicio,
                'end' => $cita->fecha_fin,
                'shouldOpenModal' => true,
                'eventId' => $cita->getKey(),
            ])
            ->all();
    }
    protected function modalActions(): array
    {

        return [
            createAction::make()
                ->mountUsing(
                    function (Forms\Form $form, array $arguments) {

                        $form->fill([
                            'fecha_inicio' => $arguments['event']['start'] ?? now(),
                            'fecha_fin' => $arguments['event']['end'] ?? now(),
                        ]);
                    }
                ),



            editAction::make()
                ->mountUsing(
                    function (Forms\Form $form, array $arguments) {

                        $form->fill([
                            'fecha_inicio' => $arguments['event']['start'] ?? now(),
                            'fecha_fin' => $arguments['event']['end'] ?? now(),
                        ]);
                    }
                )

        ];

    }


    /* Override de Create - Select  */
    protected function createAction(): CreateAction
    {
        return CreateAction::make()
            ->modalFooterActions(fn(ViewAction $action) => [
                EditAction::make(),
                DeleteAction::make(),
                $action->getModalCancelAction(),

            ]);

    }


    protected function viewAction(): ViewAction
    {
        return ViewAction::make()
            ->modalHeading('Detalles de la cita')
            // ->modalWidth('md')
            ->form($this->getFormSchema()) // ← usa el mismo formulario que edición/creación
            ->modalFooterActions(fn(ViewAction $action) => [
                EditAction::make(),
                DeleteAction::make(),
                $action->getModalCancelAction(),

            ])
            ->mountUsing(function ($record, Forms\Form $form): void {
                $form->fill([
                    'cliente' => $record->cliente->id ?? '', // si es un select relacional
                    'asunto' => $record->asunto,
                    'fecha_inicio' => $record->fecha_inicio ? Carbon::parse($record->fecha_inicio) : null,
                    'fecha_fin' => $record->fecha_fin ? Carbon::parse($record->fecha_fin) : null,
                ]);
            });
    }

    protected function editAction(): EditAction
    {
        return EditAction::make()
            ->modalHeading('Editar cita')
            //->modalWidth('sm')
            ->form($this->getFormSchema())
            ->mountUsing(function ($record, Forms\Form $form, array $arguments) {
                $form->fill([
                    'cliente_id' => $record->cliente_id ?? null,
                    'asunto' => $record->asunto,
                    'fecha_inicio' => $arguments['event']['start'] ?? $record->fecha_inicio,
                    'fecha_fin' => $arguments['event']['end'] ?? $record->fecha_fin,


                ]);
            })
        ;



    }

    /* Creación de cita desde calendario */
    public function getFormSchema(): array
    {
        return [
            Select::make('cliente_id')
                ->placeholder('Seleccione un cliente')
                ->label('Cliente')
                ->relationship('cliente', 'nombre')
                ->preload()
                ->required(),

            TextInput::make('asunto')
                ->label('Asunto')
                ->required(),

            Grid::make()
                ->schema([
                    DateTimePicker::make('fecha_inicio')
                        ->label('Inicio')
                        ->required(),

                    DateTimePicker::make('fecha_fin')
                        ->label('Fin')
                        ->required(),
                ]),
        ];
    }




}
