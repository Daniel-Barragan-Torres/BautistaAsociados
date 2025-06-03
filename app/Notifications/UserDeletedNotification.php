<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserDeletedNotification extends Notification
{
    use Queueable;
    protected $usuario;
    protected $eliminadoPor;
    /**
     * Create a new notification instance.
     */
    public function __construct($usuario, $eliminadoPor)
    {
        $this->usuario = $usuario;
        $this->eliminadoPor = $eliminadoPor;
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
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('🗑️ Usuario eliminado del sistema')
            ->greeting('Hola equipo de soporte 👋')
            ->line('Se ha eliminado un usuario del sistema de correos de Bautista Asociados.')
            ->line('👤 Nombre: ' . $this->usuario->name)
            ->line('📧 Correo: ' . $this->usuario->email)
            ->line('🧑‍💼 Eliminado por: ' . $this->eliminadoPor->name . ' (' . $this->eliminadoPor->email . ')')
            ->salutation('— Sistema de Gestión | Bautista Asociados');
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
