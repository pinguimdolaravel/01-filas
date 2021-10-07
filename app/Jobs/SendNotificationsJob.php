<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;

class SendNotificationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $count = 1;
        User::query()->chunk(100, function ($users) use ($count) {
            $listOfAllJobs = [];
            foreach ($users as $user) {
                $job = new SendNotificationJob($user);

                $listOfAllJobs[] = $job;
            }
            Bus::batch($listOfAllJobs)->name('batch send notifications ' . $count)->dispatch();
            $count++;
        });
    }
}
