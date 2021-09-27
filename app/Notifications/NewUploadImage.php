<?php

namespace App\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewUploadImage extends Notification
{
    use Queueable;

    protected $followed_user;

    protected $user_id;

    protected $image;

    public function __construct($followed_user, $user_id, $image)
    {
        $this->followed_user = $followed_user;
        $this->user_id = $user_id;
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
            'title' => $this->followed_user->name,
            'content' => __('new_upload_image'),
            'image' => $this->followed_user->avatar,
            'slug' => $this->image->slug,
        ];
    }

    public function broadcastOn()
    {
        return new PrivateChannel('users.' . $this->user_id);
    }
}
