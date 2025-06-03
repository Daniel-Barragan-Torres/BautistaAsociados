<?php

namespace App\Filament\Resources\CitaResource\Pages;

use App\Filament\Resources\CitaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CitaResource\Widgets\CalendarioCitas;
use Illuminate\Contracts\View\View;


class ListCitas extends ListRecords
{
    protected static string $resource = CitaResource::class;

     public function getHeader(): View
    {
        return view('CitaResource.widgets.calendario-citas-directo'); // Tu archivo blade
    } 





    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getFooterActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }



    /*   public function getHeader(): View
      {
          return view('cita-resource.widgets.calendario-citas-directo',
          [
              'acciones' => $this->getHeaderActions()
          ]
      );
      } */

    /*  public function getHeaderWidgets(): array
     {
         return [];
     } */





    /*
        protected function getHeaderWidgets(): array
        {
            return [
                CalendarioCitas::class,
            ];
        }
            */
}
