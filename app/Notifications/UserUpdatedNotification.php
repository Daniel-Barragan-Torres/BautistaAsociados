<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserUpdatedNotification extends Notification
{
    use Queueable;

    protected $usuario;
    protected $modificadoPor;
    protected $modificaciones;
    /**
     * Create a new notification instance.
     */
    public function __construct($usuario, $modificadoPor, $modificaciones)
    {
        $this->usuario = $usuario;
        $this->modificadoPor = $modificadoPor;
        $this->modificaciones = $modificaciones;
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
        $traducciones = [
            'name' => 'Nombre',
            'email' => 'Correo',
            'role_id' => 'Rol Asingado',
        ];

        $mail = (new MailMessage)
            ->subject('📝 Usuario actualizado')
            ->greeting('Hola equipo de soporte 👋')
            ->line('Un usuario ha sido modificado en el sistema.')
            ->line('📧 Correo: ' . $this->usuario->email)
            ->line('👤 Nombre: ' . $this->usuario->name)
            ->line('🛠️ Modificado por: ' . $this->modificadoPor->name . ' (' . $this->modificadoPor->email . ')');

        /*  foreach ($this->modificaciones as $cambio) {
             $mail->line("🔄 Campo **{$campo}**: `{$cambio['anterior']}` → `{$cambio['nuevo']}`");
         } */
        foreach ($this->modificaciones as $campo => $cambio) {
            if ($campo === 'password') {
                continue;
            }
            $mail->line("📝 Campo **{$campo}**: `{$cambio['antes']}` ➜ `{$cambio['despues']}`");
        }

        return $mail->salutation('— Sistema de Correos | Bautista Asociados');
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
