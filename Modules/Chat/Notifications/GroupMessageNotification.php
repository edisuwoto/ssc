<?php

namespace Modules\Chat\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Chat\Entities\Group;

class GroupMessageNotification extends Notification
{
    use Queueable;

    public $group;

    public function __construct(Group $group)
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
            'group' => $this->group,
            'user' => auth()->user(),
            'url' => route('chat.group.show', $this->group->id)
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'group' => $this->group,
            'user' => auth()->user(),
            'url' => route('chat.group.show', $this->group->id),
            'user_name' => auth()->user()->first_name. ' '. auth()->user()->last_name,
        ]);
    }
}
