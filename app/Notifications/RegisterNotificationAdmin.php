<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisterNotificationAdmin extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public User $userRegistered)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nuevo usuario registrado')
            ->greeting('Hola administrador,')
            ->line('Un nuevo usuario se ha registrado en la plataforma.')
            ->line('Nombre: ' . $this->userRegistered->name)
            ->line('Email: ' . $this->userRegistered->email)
            ->line('¡Gracias por usar nuestra plataforma!');
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

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Un nuevo usuario se ha registrado.',
            'user_name' => $this->userRegistered->name,
            'user_email' => $this->userRegistered->email,
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'message' => 'Un nuevo usuario se ha registrado.',
            'user_name' => $this->userRegistered->name,
            'user_email' => $this->userRegistered->email,
        ]);
    }
    public function broadcastType(): string
    {
        return 'register.notification.admin';
    }
}
