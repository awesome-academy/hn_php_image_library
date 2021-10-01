<?php

namespace App\Jobs;

use App\Mail\MailUploadImageChart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailChart implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;

    protected $count;

    public function __construct($email, $count)
    {
        $this->email = $email;
        $this->count = $count;
    }

    public function handle()
    {
        Mail::to($this->email)->send(new MailUploadImageChart($this->count));
    }
}
