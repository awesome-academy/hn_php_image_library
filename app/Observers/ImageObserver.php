<?php

namespace App\Observers;

use App\Models\Image;
use App\Models\User;
use App\Notifications\NewUploadImage;
use App\Repositories\Interfaces\FollowRepositoryInterface;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;

class ImageObserver extends Event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $followRepository;

    public function __construct(FollowRepositoryInterface $followRepository)
    {
        $this->followRepository = $followRepository;
    }

    public function created(Image $image)
    {
        $user = User::findOrFail($image['user_id']);
        $following = $this->followRepository->getFollowUser($image['user_id']);
        foreach ($following as $value) {
            $value->notify(new NewUploadImage($user, $image));
        }
    }
}
