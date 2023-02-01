<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;

class notifactualizarevento extends Notification
{
    use Queueable;

    protected $creador;
    protected $titulo;
    protected $tipo;
    protected $descripcion;
    protected $lugar;
    protected $fecha;
    protected $hora;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($creador,$tipo,$titulo,$descripcion,$lugar,$fecha,$hora)
    {
        $this -> creador = $creador;
        $this -> tipo = $tipo;
        $this -> titulo = $titulo;
        $this -> descripcion = $descripcion;
        $this -> lugar = $lugar;
        $this -> fecha = $fecha;
        $this -> hora = $hora;

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
                    ->subject('Evento modificado')
                    ->line('Se ha modificado el evento:')
                    ->line('Creador del evento: '. $this -> creador)
                    ->line('Tipo de evento: ' . $this -> tipo)
                    ->line('Nombre del evento: ' . $this -> titulo)
                    ->line('Descripcion: ' . $this -> descripcion)
                    ->line('Lugar: ' . $this -> lugar)
                    ->line('Fecha: ' . $this -> fecha)
                    ->line('Hora: ' . $this -> hora);  
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