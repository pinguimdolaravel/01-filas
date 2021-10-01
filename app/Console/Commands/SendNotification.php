<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\PinguimDoLaravelEhTop;
use Illuminate\Console\Command;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->withProgressBar(
            User::all(),
            fn (User $user) => $user->notify(new PinguimDoLaravelEhTop)
        );
    }
}
