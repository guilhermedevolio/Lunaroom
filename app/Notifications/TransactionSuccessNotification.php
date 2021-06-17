<?php

namespace App\Notifications;

use App\Models\Transactions\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransactionSuccessNotification extends Notification
{
    use Queueable;

    public $payload;
    public $username;
    public $value;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($payload, $username)
    {
        $this->payload = $payload;
        $this->username = $username;
        $this->value = $payload["amount"];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Olá!')
            ->subject('Lunaroom - Você recebeu uma transação de Lunapoints')
            ->line("Boas Notícias, o usuário $this->username te enviou $this->value Lunapoints!")
            ->line("Achou suspeito? A transação está detalhada na página minha carteira, tenha um dia feliz =)")
            ->line('Obrigado por ser um Lunaroom');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
