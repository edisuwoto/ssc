<?php

namespace Modules\Chat\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvitationNotification extends Notification
{
    use Queueable;

    public $invitation;
    public $message;

    public function __construct($invitation, $message)
    {
        $this->invitation = $invitation;
        $this->message = $message;
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


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'invitation' => $this->invitation,
            'user' => auth()->user(),
            'message' => $this->message,
            'url' => route('chat.invitation')
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'invitation' => $this->invitation,
            'user' => auth()->user(),
            'message' => $this->message,
            'url' => route('chat.invitation')
        ]);
    }

}
