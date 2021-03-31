<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {name} {email} {password} {national_id=029408220201578}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user with admin roles';

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
        $user = User::create([
            'name' => $this->argument('name'),
            'email' => $this->argument('email'),
            'password' => Hash::make($this->argument('password')),
            'role' => 'admin',
            'national_id' => $this->argument('national_id')

        ]);
        if($user){
            $this->info('Admin user successfully created the name '.$this->argument('name').' and email is '.$this->argument('email'));
        }
    }
}
