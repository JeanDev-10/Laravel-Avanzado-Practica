<?php

namespace App\Listeners;

use App\Events\UserLoginEvent;
use App\Events\UserRegisteredEvent;
use App\Models\User;
use App\Notifications\RegisterNotificationAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendRegisterNotificationAdmin implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegisteredEvent $event): void
    {
        $user=User::find(1); //se supone que es admin creado por seeder
        Notification::send($user, new RegisterNotificationAdmin($event->user));
    }
}
