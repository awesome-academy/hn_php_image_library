<?php

namespace App\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewUploadImage extends Notification
{
    use Queueable;

    protected $user;

    protected $follower_id;

    protected $image;

    public function __construct($user, $follower_id, $image)
    {
        $this->user = $user;
        $this->follower_id = $follower_id;
        $this->image = $image;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'id' => $this->id,
            'title' => $this->user->name,
            'content' => __('new_upload_image'),
            'image' => $this->user->avatar,
            'slug' => $this->image->slug,
        ];
    }

    public function broadcastOn()
    {
        return new PrivateChannel('users.' . $this->follower_id);
    }
}
