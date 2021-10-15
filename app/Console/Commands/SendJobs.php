<?php

namespace App\Console\Commands;

use App\Jobs\HighJob;
use App\Jobs\LowJob;
use Illuminate\Console\Command;

class SendJobs extends Command
{
    protected $signature = 'send-jobs';

    protected $description = 'Command description';

    public function handle()
    {
        HighJob::dispatch();

        LowJob::dispatch()->onQueue('low');
    }
}
