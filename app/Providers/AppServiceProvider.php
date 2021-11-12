<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        RateLimiter::for('notifications', fn () => Limit::perMinute(10));

        Queue::failing(function (JobFailed $event) {
            Notification::route('mail', 'pinguim@dolaravel.com')
                ->route('slack', config('services.slack.error'))
                ->notify(new \App\Notifications\JobFailed($event));
        });
    }
}
