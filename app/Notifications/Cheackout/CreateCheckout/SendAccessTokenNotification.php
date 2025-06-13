<?php

namespace App\Notifications\Cheackout\CreateCheckout;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendAccessTokenNotification extends Notification
{
    use Queueable;

    public $token;
    public $loginUrl;

    public function __construct(string $token, string $loginUrl)
    {
        $this->token    = $token;
        $this->loginUrl = $loginUrl;
    }


    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Seu código de acesso à plataforma')
            ->line("Seu token de acesso é: **{$this->token}**")
            ->line("E-mail de acesso: **{$notifiable->email}**")
            ->action('Clique aqui para acessar', $this->loginUrl)
            ->line('Use o código acima como sua senha de acesso. Troque sua senha após o login para maior segurança.');
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
