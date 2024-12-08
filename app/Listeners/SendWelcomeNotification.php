<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Events\UserRegisteredEvent;
use App\Notifications\WelcomeNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendWelcomeNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegisteredEvent $event): void
    {
        Notification::send($event->user, new WelcomeNotification());
    }
}
