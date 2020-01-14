<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class WorkAdded extends Notification
{
    use Queueable;
  
    public $nomeCLiente;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($cliente)
    {
        $this->nomeCliente = $cliente;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toTelegram($notifiable)
    {
//         $url = url('/invoice/' . $this->invoice->id);

        return TelegramMessage::create()
            // Optional recipient user id.
            ->to('234321055')
            // Markdown supported.
            ->content("E' stato aggiunto un lavoro su *CRM - WEB AGENCY PRO* per il cliente"." ".$this->nomeCliente);
            // (Optional) Inline Buttons
//             ->button('View Invoice', $url)
//             ->button('Download Invoice', $url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
