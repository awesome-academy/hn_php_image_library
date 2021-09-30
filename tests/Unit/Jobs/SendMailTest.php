<?php

namespace Tests\Unit\Jobs;

use App\Jobs\SendMailChart;
use App\Mail\MailUploadImageChart;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendMailTest extends TestCase
{
    protected $sendMailChart;

    protected $email = 'test@gmail.com';

    protected function setUp(): void
    {
        parent::setUp();
        $this->sendMailChart = new SendMailChart(
            $this->email,
            100
        );
    }

    public function testHandle()
    {
        Mail::fake();
        $this->sendMailChart->handle();
        $email_check = $this->email;
        Mail::assertSent(MailUploadImageChart::class, function ($email) use ($email_check) {
            return $email->hasTo($email_check);
        });
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
