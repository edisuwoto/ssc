<?php

namespace Modules\Chat\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MessageNotification extends Notification
{
    use Queueable;

    public $thread;

    public function __construct($thread)
    {
        $this->thread = $thread;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', 'https://laravel.com')
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'thread' => $this->thread,
            'user' => auth()->user(),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'thread' => $this->thread,
            'user_name' => auth()->user()->first_name. ' '. auth()->user()->last_name,
            'message' => $this->thread->message,
            'user' => auth()->user(),
        ]);
    }
}
