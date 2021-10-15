<?php

namespace App\Console\Commands;

use App\Jobs\HighJob;
use Illuminate\Console\Command;

class SendHighJob extends Command
{
    protected $signature = 'send-high-job';

    protected $description = 'Command description';

    public function handle()
    {
        for ($i = 0; $i < 500; $i++) {
            HighJob::dispatch()->onQueue('high');
        }
    }
}
