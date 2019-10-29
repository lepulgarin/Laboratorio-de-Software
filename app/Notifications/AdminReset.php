<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminReset extends Notification
{

    public function __construct($token)
    {
        $this->token = $token;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Este es su email para recuperar contraseña.')
            ->action('Restaurar contraseña', route('password.reset.token',['token' => $this->token]))
            ->line('If you did not request a password reset, no further action is required.');
    }
}