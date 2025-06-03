<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreateNotification extends Notification
{
    use Queueable;
    protected $usuario;
    protected $creadoPor;
    protected $password;

    /**
     * Create a new notification instance.
     */
    public function __construct( $usuario,  $creadoPor,  $password) {

        $this->usuario = $usuario;
        $this->creadoPor = $creadoPor;
        $this->password = $password;
    
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
{
    return (new MailMessage)
        ->subject('👤 Nuevo usuario creado')
        ->greeting('Hola equipo de soporte 👋')
        ->line('Se ha creado un nuevo usuario.')
        ->line('📧 Correo: ' . $this->usuario->email)
        ->line('👤 Nombre: ' . $this->usuario->name)
        ->line('🔑 Contraseña asignada: **' . $this->password . '**')
        ->line('🛠️ Creado por: ' . $this->creadoPor->name . ' (' . $this->creadoPor->email . ')')
        ->salutation('— Sistema de Correos | Bautista Asociados');
}

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
