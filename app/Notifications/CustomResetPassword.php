<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends BaseResetPassword
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Recuperación de contraseña - PRETENFORT')
            ->greeting('Hola!')
            ->line('Recibimos una solicitud para restablecer tu contraseña.')
            ->action('Restablecer contraseña', url(route('password.reset', [
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false)))
            ->line('Este enlace expirará en 60 minutos.')
            ->line('Si no solicitaste este cambio, puedes ignorar este mensaje.')
            ->salutation('Sistema PRETENFORT');
    }
}
