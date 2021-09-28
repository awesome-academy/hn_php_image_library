<?php

namespace Tests\Unit\Jobs;

use SendGrid;
use SendGrid\Mail\Mail;
use Tests\TestCase;

class SendMailTest extends TestCase
{
    protected $email;

    protected function setUp(): void
    {
        parent::setUp();
        $this->email = new Mail();
    }

    public function testSendingMail()
    {
        $mailFrom = "ducquang006900@gmail.com";
        $mailTo = "ducquang171099@gmail.com";
        $this->email->setFrom($mailFrom, "ImageLibrary");
        $this->email->setSubject(ucfirst(__("upload_image_mail_subject")));
        $this->email->addTo($mailTo);
        $this->email->addContent(
            "text/html",
            view('mail.upload-image-chart', ['count' => 100])->render()
        );
        $sendgrid = new SendGrid('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');
        $result = $sendgrid->send($this->email);
        $this->assertEquals(202, $result->statusCode());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
