<?php

namespace App\Filament\Pages;

use App\Filament\Resources\CitaResource;
use Filament\Pages\Page;


class Overview extends Page
{
    protected static string $resource = CitaResource::class;

protected static ?string $navigationGroup = 'Agenda';
    protected static ?string $title = 'Calendario de Citas';
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

     protected static string $view = 'filament.pages.overview';


}
