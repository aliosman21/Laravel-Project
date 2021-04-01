<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit(){
        if(Auth::guard('user')->user()){
            $profile = Auth::guard('user')->user();
        }else{
            $profile = Auth::guard('client')->user();
        }
        return view('profile.edit',compact('profile'));
    }

    public function update(Request $request,$profile){
        if(Auth::guard('user')->user()){
            $fullProfile = User::where('id',$profile)->first();
        }else{
            $fullProfile = Client::where('id',$profile)->first();
        }

        $request->validate([
            'name' => 'required',
            'email' => ['email',
                        'unique:clients,email,'.$fullProfile->id,
                        'unique:users,email,'.$fullProfile->id,]
        ]);

        if(Auth::guard('user')->user()){
            $fullProfile->update($request->all());
        }else{
            $fullProfile->update($request->all());
        }
        return redirect(route('clients.index'));
    }
}
