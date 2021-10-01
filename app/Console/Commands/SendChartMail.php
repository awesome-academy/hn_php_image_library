<?php

namespace App\Console\Commands;

use App\Jobs\SendMailChart;
use App\Repositories\Eloquent\ImageRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Console\Command;

class SendChartMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:chart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send chart mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {
        $userRepository = new UserRepository();
        $imageRepository = new ImageRepository();
        $admin = $userRepository->getAdmin();
        $count = $imageRepository->getUploadImageDailyCount();
        dispatch(new SendMailChart($admin['email'], $count));
    }
}
