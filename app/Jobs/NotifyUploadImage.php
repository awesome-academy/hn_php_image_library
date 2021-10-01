<?php

namespace App\Jobs;

use App\Notifications\NewUploadImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyUploadImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $user;

    protected $image;

    protected $follower;

    public function __construct($user, $follower, $image)
    {
        $this->user = $user;
        $this->follower = $follower;
        $this->image = $image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->follower as $value) {
            try {
                $value->notify(new NewUploadImage($this->user, $value->id, $this->image));
            } catch (\Exception $e) {
                continue;
            }
        }
    }
}
