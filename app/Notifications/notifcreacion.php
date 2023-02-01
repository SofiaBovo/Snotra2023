<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class notifcreacion extends Notification
{
    use Queueable;

    protected $emaildocente;
    protected $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($emaildocente, $password)
    {
        $this -> emaildocente = $emaildocente;
        $this -> password = $password;
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
                    ->subject('Activación de cuenta')
                    ->line('Hemos creado una cuenta para ti. Puedes ingresar ahora con los siguientes datos:')
                    ->line('Usuario: ' . $this -> emaildocente)
                    ->line('Contraseña: ' . $this -> password)
                    ->line('La primera vez que ingrese, le recomendamos modificar la contraseña.');
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