<?php

namespace App\Jobs;

use App\Repositories\Eloquent\ImageRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SendGrid\Mail\Mail;

class SendMailChart implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {
        $userRepository = new UserRepository();
        $imageRepository = new ImageRepository();
        $email = new Mail();
        $admin = $userRepository->getAdmin();
        $email->setFrom("ducquang006900@gmail.com", "ImageLibrary");
        $email->setSubject(ucfirst(__("upload_image_mail_subject")));
        $email->addTo($admin['email']);
        $count = $imageRepository->getUploadImageDailyCount();
        $email->addContent(
            "text/html",
            view('template.mail.uploadimagechart', ['count' => $count])->render()
        );
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        $sendgrid->send($email);
    }
}
