<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;

class notifrechazo extends Notification
{
    use Queueable;

    protected $motivorechazo;
    protected $nombreevento;
    protected $fechaevento;
    protected $nombreautenticado;
   

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($motivorechazo, $nombreevento, $fechaevento, $nombreautenticado)
    {
        $this -> motivorechazo = $motivorechazo;
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
                    ->subject('Evento rechazado')
                    ->line('El usuario '. $this -> nombreautenticado .' ha rechazado el evento ' . $this -> nombreevento .' con fecha '. $this -> fechaevento.'.')
                    ->line('El motivo de rechazo es: '. $this -> motivorechazo.'.');
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