<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    public function index (){
        $users = User::all();
        return UserResource::collection($users);

    }
}

