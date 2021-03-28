<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory(25)->create();
        \App\Models\Client::factory(25)->create();
        \App\Models\Floor::factory(5)->create();
        \App\Models\Room::factory(15)->create();
    }
}
