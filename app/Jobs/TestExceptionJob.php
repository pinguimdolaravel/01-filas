<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestExceptionJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected User $user,
        protected bool $needsToFail = false
    ) {
        //
    }

    public function handle()
    {
        ray('Running Job for user: ' . $this->user->name)->blue();

        if ($this->needsToFail) {
            throw new \Exception("falhou com o usuario " . $this->user->name, 1);
        }
    }
}
