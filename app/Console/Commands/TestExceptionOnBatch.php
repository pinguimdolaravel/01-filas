<?php

namespace App\Console\Commands;

use App\Jobs\TestExceptionJob;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class TestExceptionOnBatch extends Command
{
    protected $signature   = 'teb';
    protected $description = 'Test Exception on Batch';

    public function handle()
    {
        $user1 = User::query()->offset(0)->first();
        $user2 = User::query()->offset(1)->first();
        $user3 = User::query()->offset(2)->first();

        $user4 = User::query()->offset(3)->first();
        $user5 = User::query()->offset(4)->first();
        $user6 = User::query()->offset(5)->first();

        $users = User::query()->take(10)->offset(10)->get()->map(fn ($u) => new TestExceptionJob($u, false));

        $batch = [
            ...$users, // 10
            [ // Chain
                new TestExceptionJob($user1, true),
                new TestExceptionJob($user2, false),
                new TestExceptionJob($user3, false),
            ],
            [ // Chain
                new TestExceptionJob($user4, false),
                new TestExceptionJob($user5, true),
                new TestExceptionJob($user6, false),
            ]
        ];

        Bus::batch($batch)->dispatch();

        /* Example the chain
        Bus::chain([
            new TestExceptionJob($user1, false),
            new TestExceptionJob($user2, true),
            new TestExceptionJob($user3, false),
        ])->dispatch();
        */
    }
}
