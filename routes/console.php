<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('Inject', function () {
    //File::copy(public_path('Initialization/Clientssss.php'), public_path('vendor/laravel/framework/src/Illuminate/Foundation/Auth'));
    File::copy('Initialization/Clientssss.php', 'vendor/laravel/framework/src/Illuminate/Foundation/Auth/Client.php');
    $this->comment("Initialization done");
})->purpose('Initialize the project by manipulating files in dependencies');
