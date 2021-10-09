<?php

namespace Modules\Chat\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class GroupCreationNotification extends Notification
{
    use Queueable;

    public $group;

    public function __construct($group)
    {
        $this->group = $group;
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

    public function toDatabase($notifiable)
    {
        return [
            'group' => $this->group,
            'user' => auth()->user(),
            'url' => route('chat.group.show', $this->group->id),
            'message' => 'You are invited in new group',
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'group' => $this->group,
            'user' => auth()->user(),
            'url' => route('chat.group.show', $this->group->id),
            'message' => 'You are invited in new group',
        ]);
    }

}
