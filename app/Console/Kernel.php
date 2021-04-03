<?php

namespace App\Console;

use App\Models\Reservation;
use Illuminate\Console\Scheduling\Schedule;
use App\Models\Client;
use App\Notifications\NotifyNoLoginFor30Days;
use Carbon\Carbon;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('ban:delete-expired')->everyMinute();

        $schedule->call(function (){
            $pendingReservation = Reservation::where('status','pending')->first();
            $pendingReservation->delete();
        })->everyMinute();

        $schedule->call(function (){
            $date = Carbon::now()->subDays(30)->format('Y-m-d');
            $clients = Client::whereNotBetween('last_login' , [$date , Carbon::now()->format('Y-m-d')])->get();
            foreach ($clients as $client) {
                $client-> $client->notify(new NotifyNoLoginFor30Days());
            }
        })->monthly();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
