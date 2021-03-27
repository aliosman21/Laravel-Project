<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index() {
        // $users = User::all()
        return view('users.manage');
    }

    public function login(){
        return view('users.staffLogin');
    }
    public function authenticate(Request $request){
       $dataAttempt = array(
            'email' => $request->email,
            'password' => $request->password
        );


        if(Auth::guard('user')->attempt($dataAttempt)){
            //dd(Auth::guard('user')->user()->role);
            if(Auth::guard('user')->user()->role == "admin")
                return redirect()->route('users.index');
            else
                return redirect()->route('home');
/*             $user = User::where('email', $request->email)->get();
            dd(Auth::user());
            dd(Auth::login($user[0])); */

        }
        else{
             return redirect()->route('users.login');
        }
        //dd($user[0]);

    }


    public function create(){
        //dd(Auth::user());
        $users = User::all();
        return view('users.create',compact('users'));
    }

    public function store(StoreUserRequest $request) {
        $requestData = $request->all();
        User::create($requestData);
        return redirect()->route('home');
    }

    public function getUsers(Request $request) {
        //3awzien el zaraer gwa blade.php ya nakash
        if ($request->ajax()) {

            $data = User::latest()->get();
            return Datatables::of($data)
                ->addColumn('action', 'helpers.actionsButtons')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit(User $user){
        $users = User::all();
        return view('users.edit', compact('user', 'users'));
    }

    public function update(User $user, StoreUserRequest $request){
        $user->update($request->all());
        return redirect()->route('users.index');
    }
    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('users.index');
    }




}
