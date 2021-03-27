<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{


    public function index(){
        return view('clients.index');
    }

    public function authenticate(Request $request){
        $dataAttempt = array(
            'email' => $request->email,
            'password' => $request->password
        );

        //dd(Auth::guard('client')->attempt($dataAttempt));
        if(Auth::guard('client')->attempt($dataAttempt)){
                return redirect()->route('clients.index');
        }else{
            return redirect()->route('login');
        }
        //dd($user[0])
    }
}
