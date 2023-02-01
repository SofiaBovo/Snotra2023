<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;

class notifcancelevent extends Notification
{
    use Queueable;

    protected $titulo;
    protected $fecha;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($titulo,$fecha)
    {
        $this -> titulo = $titulo;
        $this -> fecha = $fecha;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Evento cancelado')
                    ->line('El evento '. $this -> titulo. ' programado para el día ' .$this -> fecha. ' ha sido cancelado.');
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
?>