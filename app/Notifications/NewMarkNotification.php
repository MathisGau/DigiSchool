<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMarkNotification extends Notification
{
    use Queueable;

    /**
     * Les notes nouvellement attribuées.
     *
     * @var array
     */
    public $notes;

    /**
     * Create a new notification instance.
     *
     * @param  array  $notes
     * @return void
     */
    public function __construct($notes)
    {
        $this->notes = $notes;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelles notes attribuées')
            ->line('Bonjour ' . $notifiable->name . ',')
            ->line('Vous avez de nouvelles notes attribuées :')
            ->line('---------------------')
            ->line('Évaluation : ' . $this->notes['evaluations_title'])
            ->line('Note : ' . $this->notes['mark'])
            ->line('Description : ' . $this->notes['description'])
            ->line('---------------------')
            ->action('Voir les détails', url('/'))
            ->line('Merci de votre attention!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
