<?php

namespace App\Classes;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ClientRepository
{

    public static function getClientUsingEmail($email){
        return Client::where('email', $email)->first();
    }
    public static function setNowAsClientLastLogin($client){
        $client->last_login = Carbon::now();
        $client->save();

    }

    public static function registerNewClient($clientInfo , $imgName){
        Client::create([
             'name' => $clientInfo['name'],
             'email' => $clientInfo['email'],
             'password' => Hash::make($clientInfo['password']),
             'mobile'=>$clientInfo['mobile'],
             'country'=>$clientInfo['country'],
             'gender' => $clientInfo['gender'],
             'avatar_img' => $imgName,
             'user_id'=>$clientInfo['user_id']//need to be checked with ali
         ]);

    }

}
