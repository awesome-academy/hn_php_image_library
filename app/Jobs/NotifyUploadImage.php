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

    protected $following;

    public function __construct($user, $following, $image)
    {
        $this->user = $user;
        $this->following = $following;
        $this->image = $image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->following as $value) {
            $value->notify(new NewUploadImage($this->user, $value->id, $this->image));
        }
    }
}
