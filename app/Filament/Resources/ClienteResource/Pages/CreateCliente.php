<?php

namespace App\Filament\Resources\ClienteResource\Pages;

use App\Filament\Resources\ClienteResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCliente extends CreateRecord
{
    protected static string $resource = ClienteResource::class;

    /* protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['telefono'] = $data['lada'] . $data['telefono'];
        unset($data['lada']);
        return $data;
    } */

}
