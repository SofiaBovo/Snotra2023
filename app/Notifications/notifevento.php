<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;

class notifevento extends Notification
{
    use Queueable;

    protected $creador;
    protected $titulo;
    protected $tipo;
    protected $descripcion;
    protected $lugar;
    protected $fecha;
    protected $hora;
    protected $role;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($creador,$tipo,$titulo,$descripcion,$lugar,$fecha,$hora,$role)
    {
        $this -> creador = $creador;
        $this -> tipo = $tipo;
        $this -> titulo = $titulo;
        $this -> descripcion = $descripcion;
        $this -> lugar = $lugar;
        $this -> fecha = $fecha;
        $this -> hora = $hora;
        $this -> role = $role;

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
        if($this -> tipo=='Reunión' and $this -> role=='familia'){
        return (new MailMessage)
                    ->subject('Nuevo evento')
                    ->line('Te han invitado a un evento:')
                    ->line('Creador del evento: '. $this -> creador)
                    ->line('Tipo de evento: ' . $this -> tipo)
                    ->line('Nombre del evento: ' . $this -> titulo)
                    ->line('Descripcion: ' . $this -> descripcion)
                    ->line('Lugar: ' . $this -> lugar)
                    ->line('Fecha: ' . $this -> fecha)
                    ->line('Hora: ' . $this -> hora)
                    ->line('Para aceptar o rechazar la reunión debe ingresar al siguiente link:')
                    ->action('Ir a eventos', url('Eventos/listado'));
    }
    else
    {
        return (new MailMessage)
                    ->subject('Nuevo evento')
                    ->line('Te han invitado a un evento:')
                    ->line('Creador del evento: '. $this -> creador)
                    ->line('Tipo de evento: ' . $this -> tipo)
                    ->line('Nombre del evento: ' . $this -> titulo)
                    ->line('Descripcion: ' . $this -> descripcion)
                    ->line('Lugar: ' . $this -> lugar)
                    ->line('Fecha: ' . $this -> fecha)
                    ->line('Hora: ' . $this -> hora);
    }
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