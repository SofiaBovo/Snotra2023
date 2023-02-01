<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;

class notifaceptacion extends Notification
{
    use Queueable;

    protected $nombreevento;
    protected $fechaevento;
    protected $nombreautenticado;
   

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($nombreevento, $fechaevento, $nombreautenticado)
    {
        $this -> nombreevento = $nombreevento;
        $this -> fechaevento = $fechaevento;
        $this -> nombreautenticado = $nombreautenticado;
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
                    ->subject('Evento aceptado')
                    ->line('El usuario '. $this -> nombreautenticado .' ha aceptado el evento ' . $this -> nombreevento .' con fecha '. $this -> fechaevento.'.');         
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