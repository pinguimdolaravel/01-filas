<?php

namespace App\Console\Commands;

use App\Jobs\SendNotificationsJob;
use App\Models\User;
use App\Notifications\LearnAboutQueues;
use Illuminate\Console\Command;

class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notifications';

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
        SendNotificationsJob::dispatch();

        // $this->withProgressBar(User::all(), function ($user) {
        //     $user->notify(new LearnAboutQueues);
        // });
    }
}
