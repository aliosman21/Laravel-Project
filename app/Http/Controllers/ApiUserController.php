<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    public function index (){
        $users = User::all();
        // $mapped_users = [];
        // foreach($users as $user){
        //     $mapped_users [] =[
        //         'name' => $user->name,
        //         'email' => $user->email,
        //         'national_id' => $user->national_id,
        //         'role' => $user->role
        //     ]; 
        // }
        // return $mapped_users;
        return UserResource::collection($users);

    }
}

