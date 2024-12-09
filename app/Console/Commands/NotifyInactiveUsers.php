<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\UserInactivityReminder;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NotifyInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:notify-inactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify users who have been inactive for more than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        // Fecha límite para considerar inactividad
        $inactivityThreshold = Carbon::now()->subDays(10);

        // Obtén los usuarios inactivos
        $inactiveUsers = User::where('last_activity_at', '<', $inactivityThreshold)
            ->whereNull('notified_at') // Que no hayan sido notificados antes
            ->get();

        if ($inactiveUsers->isEmpty()) {
            $this->info('No inactive users found.');
            return;
        }

        // Notifica a cada usuario
        foreach ($inactiveUsers as $user) {
            $user->notify(new UserInactivityReminder());

            // Marca al usuario como notificado
            $user->update(['notified_at' => Carbon::now()]);
        }

        $this->info("Notified {$inactiveUsers->count()} inactive users.");
    }
}
