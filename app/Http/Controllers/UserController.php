<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\Client;
use App\Notifications\NotifyApproval;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index() {
        $users = User::all();
        return view('users.manage',compact('users'));
        // Auth::guard('user')->user()->assignRole(Role::findById(1));
        // $users = User::all()
        // dd(Auth::guard('user')->user()->getAllPermissions());
        // dd(Auth::guard('user')->user()->hasRole('admin'));
        // dd(auth()->guard('user')->user()->hasRole('admin'));
        // Auth::guard('user')->user()->removeRole('admin');
        // Auth::guard('user')->user()->assignRole('manager');
        // dd(Auth::guard('user')->user()->hasRole('manager'));

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

    public function getNonApprovedClients(){
        $clients = Client::where('approved', 0)->get();

         return Datatables::of($clients)
                /* ->addColumn('action', 'helpers.actionsButtons')
                ->rawColumns(['action']) */
                ->make(true);
    }

    public function getApprovedClients(){
        $clients = Client::where('approved', 1)->get();

         return Datatables::of($clients)
                /* ->addColumn('action', 'helpers.actionsButtons')
                ->rawColumns(['action']) */
                ->make(true);
    }

    public function approveClient(Request $request){

        $client = Client::where('email' , $request->email)->first();

        if (!$client == null) {
            if ($client->approved == 0) {
                $client->approved = 1;
                $client->save();
                $this->sendMail($client);
            }
        }
        return  redirect()->route('home');  // to the datatable page
    }

    private function sendMail($client){


        //Notification way of laravel
        $client->notify(new NotifyApproval());

        //Normal way to use laravel Mail
        /*  $details = [
                'title' => 'Mail From HotelManagement System',
                'body' =>  'Hello, '.$client->name.' Hope you are having a wonderful day, If you are reading
                this you have been accepted to our system and we are all waiting for you to login',
                'rand'=>'random text'
            ];
                \Mail::to($client->email)->send(new \App\Mail\ApprovedMail($details));
                dd("Email is Sent."); */

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
