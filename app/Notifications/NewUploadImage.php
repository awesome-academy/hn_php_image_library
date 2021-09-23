<?php

namespace App\Notifications;

use App\Models\Image;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class NewUploadImage extends Notification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels, Queueable;

    protected $followed_user;

    protected $image;

    public function __construct(User $followed_user, Image $image)
    {
        $this->followed_user = $followed_user;
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
        return ['image-channel'];
    }
}
