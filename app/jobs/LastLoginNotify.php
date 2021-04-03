<?php

namespace App\jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Notifications\ClientMissing;
use App\Notifications\ClientGreeting;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Client;
use App\Notifications\NotifyNoLoginFor30Days;
use Carbon\Carbon;

class LastLoginNotify implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct() {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function __invoke() {
        $date = Carbon::now()->subDays(30)->format('Y-m-d');
        $clients = Client::whereNotBetween('last_login' , [$date , Carbon::now()->format('Y-m-d')])->get();
        foreach ($clients as $client) {
            $client-> $client->notify(new NotifyNoLoginFor30Days());
        }
    }
}
