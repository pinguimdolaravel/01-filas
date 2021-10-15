<?php

namespace App\Console\Commands;

use App\Jobs\LowJob;
use Illuminate\Console\Command;

class SendLowJob extends Command
{
    protected $signature = 'send-low-job';

    protected $description = 'Command description';

    public function handle()
    {
        for ($i = 0; $i < 500; $i++) {
            LowJob::dispatch()->onQueue('low');
        }
    }
}
