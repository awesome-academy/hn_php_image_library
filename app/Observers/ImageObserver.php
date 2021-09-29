<?php

namespace App\Observers;

use App\Jobs\NotifyUploadImage;
use App\Models\Image;
use App\Models\User;
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
        $follower = $this->followRepository->getFollowUserById($image['user_id']);
        dispatch(new NotifyUploadImage($user, $follower, $image));
    }
}
