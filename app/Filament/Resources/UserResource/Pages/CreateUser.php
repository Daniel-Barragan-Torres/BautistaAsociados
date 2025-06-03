<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Notifications\UserCreateNotification;
use Illuminate\Support\Facades\Notification as MailNotification;
use Filament\Notifications\Notification as ToastNotification;


class CreateUser extends CreateRecord
{
    public ?string $rawPassword = null;

    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        MailNotification::route('mail', 'adminpass@bautistaasociados.mx')


            ->notify(new UserCreateNotification(
                $this->record,          // el usuario que se acaba de crear
                auth()->user(),         // quien lo creó
                $this->rawPassword      // contraseña cruda capturada
            ));

        ToastNotification::make()
            ->title('Usuario creado con éxito')
            ->body('El usuario ' . $this->record->name . ' fue registrado correctamente.')
            ->success()
            ->send();
    }
}
