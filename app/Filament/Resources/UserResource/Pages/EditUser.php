<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Notifications\PasswordChangedNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Notification as MailNotification;
use Filament\Notifications\Notification as ToastNotification;
use App\Notifications\UserDeletedNotification;
use App\Notifications\UserUpdatedNotification;


class EditUser extends EditRecord
{



    protected static string $resource = UserResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function ($record) {
                    $eliminadoPor = auth()->user();

                    MailNotification::route('mail', 'adminpass@bautistaasociados.mx')
                        ->notify(new UserDeletedNotification($record, $eliminadoPor));

                    ToastNotification::make()
                        ->title('Usuario eliminado')
                        ->body("El usuario {$record->name} ha sido eliminado correctamente.")
                        ->success()
                        ->send();
                }),
        ];
    }
    public ?string $rawPassword = null;
    protected bool $correoYaEnviado = false;



    protected function mutateFormDataBeforeSave(array $data): array
    {
        $usuario = $this->record;
        $modificadoPor = auth()->user();
        $modificaciones = [];

        foreach ($data as $campo => $valorNuevo) {
            $valorAnterior = $this->record->{$campo};

            // Comparar si hay cambios
            if ($valorAnterior != $valorNuevo) {
                $modificaciones[$campo] = [
                    'antes' => $valorAnterior,
                    'despues' => $valorNuevo,
                ];
            }
        }

        if (filled($this->rawPassword)) {
            Notification::route('mail', 'adminpass@bautistaasociados.mx')
                ->notify(new PasswordChangedNotification($this->record, auth()->user(), $this->rawPassword));
        }

        if (!empty($modificaciones)) {
            Notification::route('mail', 'adminpass@bautistaasociados.mx')
                ->notify(new UserUpdatedNotification($usuario, $modificadoPor, $modificaciones));
        }

        ToastNotification::make()
            ->title('Usuario actualizado')
            ->body("El usuario **{$this->record->name}** fue editado correctamente.")
            ->success()
            ->send();
        $modificaciones = [];


        return $data;
    }



}
