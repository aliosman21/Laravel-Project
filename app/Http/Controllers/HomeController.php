<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $role = Role::create(['name' => 'admin']);
        // $role = Role::create(['name' => 'manager']);
        // $role = Role::create(['name' => 'receptionist']);
        ######################################################################
        // $permission = Permission::create(['name' => 'approve client']);
        // $permission = Permission::create(['name' => 'create room']);
        // $permission = Permission::create(['name' => 'edit room']);
        // $permission = Permission::create(['name' => 'delete room']);
        // $permission = Permission::create(['name' => 'view room']);
        // $permission = Permission::create(['name' => 'create floor']);
        // $permission = Permission::create(['name' => 'edit floor']);
        // $permission = Permission::create(['name' => 'delete floor']);
        // $permission = Permission::create(['name' => 'view floor']);
        // $permission = Permission::create(['name' => 'add manager']);
        // $permission = Permission::create(['name' => 'edit manager']);
        // $permission = Permission::create(['name' => 'delete manager']);
        // $permission = Permission::create(['name' => 'view manager']);
        // $permission = Permission::create(['name' => 'add receptionist']);
        // $permission = Permission::create(['name' => 'edit receptionist']);
        // $permission = Permission::create(['name' => 'delete receptionist']);
        // $permission = Permission::create(['name' => 'view receptionist']);
        // $permission = Permission::create(['name' => 'add reservation']);
        // $permission = Permission::create(['name' => 'edit reservation']);
        // $permission = Permission::create(['name' => 'delete reservation']);
        // $permission = Permission::create(['name' => 'view reservation']);
        ########################################################################
        //  $permission1 = Permission::findById(1);
        //  $permission2 = Permission::findById(2);
        //  $permission3 = Permission::findById(3);
        //  $permission4 = Permission::findById(4);
        //  $permission5 = Permission::findById(5);
        //  $permission6 = Permission::findById(6);
        //  $permission7 = Permission::findById(7);
        //  $permission8 = Permission::findById(8);
        //  $permission9 = Permission::findById(9);
        //  $permission10 = Permission::findById(10);
        //  $permission11 = Permission::findById(11);
        //  $permission12 = Permission::findById(12);
        //  $permission13 = Permission::findById(13);
        //  $permission14 = Permission::findById(14);
        //  $permission15 = Permission::findById(15);
        //  $permission16 = Permission::findById(16);
        //  $permission17 = Permission::findById(17);
        //  $permission18 = Permission::findById(18);
        //  $permission19 = Permission::findById(19);
        //  $permission20 = Permission::findById(20);
        //  $permission21 = Permission::findById(21);

        //  $role1 = Role::findById(1);
        //  $role2 = Role::findById(2);
        //  $role3 = Role::findById(3);

        
        // $role1->givePermissionTo([
        //     $permission1,
        //     $permission2,
        //     $permission3,
        //     $permission4,
        //     $permission5,
        //     $permission6,
        //     $permission7,
        //     $permission8,
        //     $permission9,
        //     $permission10,
        //     $permission11,
        //     $permission12,
        //     $permission13,
        //     $permission14,
        //     $permission15,
        //     $permission16,
        //     $permission17,
        //     $permission18,
        //     $permission19,
        //     $permission20,
        //     $permission21,
        //     ]);
            
        //  $role2->givePermissionTo([
        //     $permission1,
        //     $permission2,
        //     $permission3,
        //     $permission4,
        //     $permission5,
        //     $permission6,
        //     $permission7,
        //     $permission8,
        //     $permission9,
        //     $permission13,
        //     $permission14,
        //     $permission15,
        //     $permission16,
        //     $permission17,
        //     $permission18,
        //     $permission19,
        //     $permission20,
        //     $permission21,
        //     ]);
        //     $role3->givePermissionTo([
        //         $permission1,
        //         $permission18,
        //         $permission19,
        //         $permission20,
        //         $permission21,
        //         ]);

        // dd(auth()->user());
        return view('home');
    }
}
