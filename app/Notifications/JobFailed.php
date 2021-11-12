<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\Events\JobFailed as EventsJobFailed;

class JobFailed extends Notification
{
    use Queueable;

    public function __construct(
        public EventsJobFailed $event
    ) {
        //
    }

    public function via($notifiable)
    {
        return ['mail', 'slack'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->error()
            ->subject(config('app.name') . ' : JobFailed : ' . $this->event->job->resolveName())
            ->line('The job failed to process.')
            ->line('Name: ' . $this->event->job->resolveName())
            ->line('Error: ' . $this->event->exception->getMessage())
            ->line('Body: ' . $this->event->job->getRawBody())
            ->line('Trace: ' . $this->event->exception->getTraceAsString());
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->from('Laravel Horizon')
            ->image(config('services.slack.logo'))
            ->error()
            ->content('Woops! Queue Error!')
            ->attachment(function ($attachment) {
                $attachment
                    ->title("The job {$this->event->job->resolveName()} has failed.")
                    ->fields([
                        'Error' => $this->event->exception->getMessage(),
                        'Body'  => $this->event->job->getRawBody(),
                        'Trace' => $this->event->exception->getTraceAsString(),
                    ]);
            });
    }
}
