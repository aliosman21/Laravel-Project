<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = Hash::make('123456');
        $user->role = 'admin';
        $user->national_id = '123456789';
        $user->save();


        $user2 = new User();
        $user2->name = 'admin2';
        $user2->email = 'admin2@admin.com';
        $user2->password = Hash::make('123456');
        $user2->role = 'admin';
        $user2->national_id = '1234536789';
        $user2->save();

    }
}
