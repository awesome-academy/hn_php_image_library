<?php

namespace Tests\Unit\Notifications;

use App\Notifications\NewUploadImage;
use App\Traits\Test\TestController;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class UploadImageTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testFollowedUserUploadImage()
    {
        Notification::fake();
        Notification::assertNothingSent();
        $user = TestController::makeUser(1);
        $follower = TestController::makeUser(2);
        $image = TestController::makeImage(1, 1);
        $notification = new NewUploadImage(
            $user,
            $follower->id,
            $image
        );
        $follower->notify($notification);
        Notification::assertSentTo($follower, NewUploadImage::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
