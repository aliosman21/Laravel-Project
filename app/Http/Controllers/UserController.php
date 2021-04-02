<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\Client;
use App\Notifications\NotifyApproval;
use Illuminate\Http\Request;
use DataTables;
use App\Classes\ClientRepository;
use Illuminate\Cache\Repository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index() {
        // $users = User::all();
        // return view('users.manage',compact('users'));
        // Auth::guard('user')->user()->assignRole(Role::findById(1));
        // $users = User::all()
        // dd(Auth::guard('user')->user()->getAllPermissions());
        // dd(Auth::guard('user')->user()->hasRole('admin'));
        // dd(auth()->guard('user')->user()->hasRole('admin'));
        //Auth::guard('user')->user()->removeRole(Role::findById(3));
        // Auth::guard('user')->user()->assignRole(Role::findById(3));
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
        $user = User::where('email', $request->email)->first();
        if($user == null)  return redirect()->route('users.login')->withErrors(['Email Doesn\'t exist']);
        if(!$user->banned_at == null) return redirect()->route('users.login')->withErrors(['Email Is banned']);

        if(Auth::guard('user')->attempt($dataAttempt)){
            return redirect()->route('users.index');
        }else{
            Auth::guard('user')->logout();
            return redirect()->route('users.login')->withErrors(['Email or password incorrect']);
        }

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
        if (auth()->guard('user')->user()->hasRole('receptionist')){
        $getClients = Client::where('user_id',auth()->guard('user')->user()->id )->get();
        return Datatables::of($getClients)
        ->make(true);
        }
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

        $requestData = $request->all();
        //dd($requestData);

        if($request->hasfile('avatar_img')){

            $fname =  $request->file('avatar_img')->getClientOriginalName();
            $request->file('avatar_img')->storeAS('',$fname,'public_uploads');
             //Storage::disk('public_uploads')->put($path, $request->avatar_img);

            //dd('yes file');



        }

        User::create([

            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),
            'national_id' => $requestData['national_id'],
            'avatar_img' =>   $request->hasfile('avatar_img') ? $fname : null,
            'role' => $requestData['role'],
            'created_by' => $requestData['user_id'][6] /// need to be checked with ali

        ]);

        //dd($request->user_id[6]);

        if($requestData['role']=='manager'){
           $user= User::where('email',$requestData['email'])->first();
           $user->assignRole(Role::findById(2));
        }

        else{
            $user= User::where('email',$requestData['email'])->first();
           $user->assignRole(Role::findById(3));
        }
        return redirect()->route('users.index');
    }

    public function getUsers(Request $request) {
        //3awzien el zaraer gwa blade.php ya nakash
        if ($request->ajax()) {
            $data = User::withBanned()->get();
            //$data = User::latest()->get();
            return Datatables::of($data)
                ->addColumn('action', 'helpers.actionsButtons')
                ->editColumn('avatar_img','helpers.avatars')
                ->editColumn('created_by',function($data){
                    if ($data->created_by != null){
                    $creator = User::where('id',$data->created_by)->first();
                    return $creator->name;
                    }else {
                        return $data->name;
                    }

                })
                ->rawColumns(['action','avatar_img','created_by'])
                ->make(true);
        }
    }

    public function edit(User $user){
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required | unique:users,email,'.$user->id,
        ]);
        $user->update($request->all());
        return redirect()->route('users.index');
    }
    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('users.index');
    }

    public function unapproveClient(Client $client){
        $client->delete();
        return redirect()->route('users.nonApprovedClients');
    }
}
