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
        // $users = User::all();
        // return view('users.manage',compact('users'));
//         Auth::guard('user')->user()->assignRole(Role::findById(1));
        // $users = User::all()
        // dd(Auth::guard('user')->user()->getAllPermissions());
        // dd(Auth::guard('user')->user()->hasRole('admin'));
        // dd(auth()->guard('user')->user()->hasRole('admin'));
        // Auth::guard('user')->user()->removeRole(Role::findById(2));
        // Auth::guard('user')->user()->assignRole(Role::findById(2));
        // dd(Auth::guard('user')->user()->hasRole('manager'));

        return view('users.manage');
    }
    public function active(){

        $users = User::withoutBanned()->get();
        return Datatables::of($users)
             /*    ->addColumn('action', 'helpers.approveClient')
                ->rawColumns(['action']) */
                ->make(true);
    }

    public function banned(){
        $users = User::onlyBanned()->get();
        return Datatables::of($users)
             /*    ->addColumn('action', 'helpers.approveClient')
                ->rawColumns(['action']) */
                ->make(true);

    }

    public function ban(Request $request){
        //dd($request->email);
        $user = User::where('email' , $request->email)->first();
        //dd($user->role);
        $err = "User cannot be banned";
        $success = "User banned successfully";
        if($user->role != "receptionist")
            return view('users.manage',compact('err'));
        $user->ban();
        return view('users.manage',compact('success'));
    }

    public function unban(Request $request){
        $user = User::where('email' , $request->email)->first();
        $user->unban();
        $success = "User unbanned successfully";
        return view('users.manage',compact('success'));
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

    public function getNonApprovedClientsView(){
        return view('users.nonApproved');
    }


    public function getGetApprovedClientsView(){
        return view('users.approved');
    }

    public function getNonApprovedClients(){
        $clients = Client::where('approved', 0)->get();

         return Datatables::of($clients)
                ->addColumn('action', 'helpers.approveClient')
                ->rawColumns(['action'])
                ->make(true);
    }

    public function getApprovedClients(){
        $clients = Client::where('approved', 1)->get();

         return Datatables::of($clients)
                ->make(true);
    }

    public function approveClient(Client $client){
        // dd($user);
        $client = Client::where('email' , $client->email)->first();
        $client->user_id=Auth::guard('user')->user()->id;
        if (!$client == null) {
            if ($client->approved == 0) {
                $client->approved = 1;
                $client->save();
                $this->sendMail($client);
            }
        }
        return  redirect()->route('users.nonApprovedClients');  // to the datatable page
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
        if($request->hasfile('avatar_img')){


            $fname =  $request->file('avatar_img')->getClientOriginalName();
            $request->file('avatar_img')->storeAS('',$fname,'public_uploads');
             //Storage::disk('public_uploads')->put($path, $request->avatar_img);

            //dd('yes file');

        }

        else{

            dd('no file');
        }
        $requestData = $request->all();
        //dd($request->user_id[6]);
        User::create([

            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),
            'national_id' => $requestData['national_id'],
            'avatar_img' =>   $fname,
            'role' => $requestData['role'],
            'created_by' => $requestData['user_id'][6] /// need to be checked with ali
            
        ]);
        return redirect()->route('home');
    }

    public function getUsers(Request $request) {
        //3awzien el zaraer gwa blade.php ya nakash
        if ($request->ajax()) {
            $data = User::withBanned()->get();
            //$data = User::latest()->get();
            return Datatables::of($data)
                ->addColumn('action', 'helpers.actionsButtons')
                ->editColumn('avatar_img','helpers.avatars')
                ->rawColumns(['action','avatar_img'])
                ->make(true);
        }
    }

    public function edit(User $user){
        return view('users.edit', compact('user'));
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
