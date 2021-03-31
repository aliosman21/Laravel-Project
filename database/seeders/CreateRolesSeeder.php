<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permissions;
use Illuminate\Database\Seeder;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Role = new Role();
        $Role->name = 'admin';
        $Role->guard_name = 'web';
        $Role->created_at = '2021-03-31 15:38:38';
        $Role->updated_at = '2021-03-31 15:38:38';
        $Role->save();


        $Role = new Role();
        $Role->name = 'manager';
        $Role->guard_name = 'web';
        $Role->created_at = '2021-03-31 15:38:38';
        $Role->updated_at = '2021-03-31 15:38:38';
        $Role->save();

        $Role = new Role();
        $Role->name = 'receptionist';
        $Role->guard_name = 'web';
        $Role->created_at = '2021-03-31 15:38:38';
        $Role->updated_at = '2021-03-31 15:38:38';
        $Role->save();

        // $Permission = new Permission();
        // $Permission->name = 'receptionist';
        // $Permission->guard_name = 'web';
        // $Permission->created_at = '2021-03-31 15:38:38';
        // $Permission->updated_at = '2021-03-31 15:38:38';
        // $Role->save();

    }
}
