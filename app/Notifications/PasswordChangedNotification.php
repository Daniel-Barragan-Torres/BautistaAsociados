<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordChangedNotification extends Notification
{
    use Queueable;
    protected $usuario;
    protected $modificadoPor;
    protected $nuevoPassword;

    /**
     * Create a new notification instance.
     */
    public function __construct($usuario, $modificadoPor = null, $nuevoPassword = null)
    {
        $this->usuario = $usuario;
        $this->modificadoPor = $modificadoPor;
        $this->nuevoPassword = $nuevoPassword;
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
    public function toMail(object $notifiable): MailMessage
    {

        return (new MailMessage)
        ->subject('🛡️ Solicitud de cambio de contraseña de correo')
        ->greeting('Hola equipo de soporte 👋')
        ->line('Se ha solicitado un **cambio de contraseña** en el sistema interno de Bautista Asociados.')
        ->line('📧 **Correo corporativo afectado:** ' . ($this->usuario->email ?? '[no definido]'))
        ->line('👤 **Nombre del usuario:** ' . ($this->usuario->name ?? '[no definido]'))
        ->when($this->modificadoPor, fn ($msg) =>
            $msg->line('🔧 **Modificado por:** ' . $this->modificadoPor->name . ' (' . $this->modificadoPor->email . ')')
        )
        ->line('🔑 **Nueva contraseña sugerida:** `' . $this->nuevoPassword . '`')
        ->line('👉 Por favor procedan a actualizar la contraseña también en Hostinger si aplica.')
        ->salutation('— Sistema de Gestión de Correos | Bautista Asociados');

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
