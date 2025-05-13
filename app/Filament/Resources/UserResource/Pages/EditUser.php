<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Notifications\PasswordChangedNotification;
use Illuminate\Support\Facades\Notification;

class EditUser extends EditRecord
{

    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }


    public ?string $rawPassword = null;
    protected bool $correoYaEnviado = false;



    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (filled($this->rawPassword)) {
            Notification::route('mail', 'adminpass@bautistaasociados.mx')
                ->notify(new PasswordChangedNotification($this->record, auth()->user(), $this->rawPassword));
        }
    
        return $data;
    }
    
    

    /*
    protected function afterSave(): void
    {
        if ($this->correoYaEnviado) {
            return; // 🛑 Ya se envió, no repetimos
        }
    
        if (filled($this->rawPassword)) {
            Notification::route('mail', 'adminpass@bautistaasociados.mx')
                ->notify(new PasswordChangedNotification($this->record, auth()->user(), $this->rawPassword));
    
            $this->correoYaEnviado = true; // ✅ Setea la bandera
        }
    }

*/

}
