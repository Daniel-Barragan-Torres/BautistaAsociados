<?php

namespace App\Filament\Resources\ClienteResource\Pages;

use App\Filament\Resources\ClienteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCliente extends EditRecord
{
    /* protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['telefono'] = $data['lada'] . $data['telefono'];
        unset($data['lada']);
        return $data;
    } */

    protected static string $resource = ClienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

}
