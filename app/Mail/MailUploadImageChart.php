<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailUploadImageChart extends Mailable
{
    use Queueable, SerializesModels;

    public $count;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($count)
    {
        $this->count = $count;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this
            ->from("ImageLibrary@gmail.com", "ImageLibrary")
            ->subject(ucfirst(__("upload_image_mail_subject")))
            ->html(view('mail.upload-image-chart', ['count' => $this->count])->render());
    }
}
