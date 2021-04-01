<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReservationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Room;
use DateTime;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller {


    public function register(StoreClientRequest $request){

        // dd($request);


        if($request->hasfile('avatar_img')){

            // dd('yes file');

             $fname =  $request->file('avatar_img')->getClientOriginalName();
             $request->file('avatar_img')->storeAS('',$fname,'public_uploads');
              //Storage::disk('public_uploads')->put($path, $request->avatar_img);

             //dd('yes file');

         }

         else{

             dd('no file');
         }


          Client::create([
             'name' => $request['name'],
             'email' => $request['email'],
             'password' => Hash::make($request['password']),
             'mobile'=>$request['mobile'],
             'country'=>$request['country'],
             'gender' => $request['gender'],
             'avatar_img' => $fname,
             'user_id'=>$request['user_id']//need to be checked with ali
         ]);


         return redirect()->route('login');
    }

    public function index(){
        return view('clients.index');
    }
    public function getRooms(){
        $room = Room::where('reserved', 0)->get();;
         return Datatables::of($room)
                ->addColumn('action', 'helpers.getRooms')
                ->rawColumns(['action'])
                ->make(true);
    }

    public function create($room){
        $selectedRoom = Room::where('id', $room)->first();
        $client = Auth::guard('client')->user();
        return view('clients.create',compact('selectedRoom','client'));
    }

    public function reservation(){
        return view('clients.list');
    }
    public function getReservation(){
        $reservation = Reservation::where('client_id', Auth::guard('client')->user()->id)->where('status','paid')->get();
         return Datatables::of($reservation)
                ->editColumn('price',function ($data){
                    return $data->price / 100 ;
                })
                ->editColumn('room_id',function ($data){
                    $roomNumber = Room::where('id',$data->room_id)->first();
                    return $roomNumber->number;
                })
                ->rawColumns(['price','room_id'])
                ->make(true);
    }


    public function store(Request $request){

        $end_date = new DateTime($request->end_date);
        $start_date = new DateTime($request->start_date);
        $interval = $end_date->diff($start_date);
        $days = $interval->format('%a');
        $room = Room::where('id', $request->room_id)->first();
        $request->validate([
            'accompany_number' => 'max:'.$room->capacity,
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $reservation = $request;

        $reservation = Reservation::create([
            'accompany_number'=> $request->accompany_number,
            'price' => $room->price * 100 * $days,
            'status' => 'pending',
            'start_date' => $start_date,
            'end_date' => $end_date,
            'client_id' => Auth::guard('client')->user()->id,
            'room_id'=>$request->room_id
            ]);
            $room->reserved = 1;
            $room->save();


        return redirect()->route('clients.checkout');
    }

    public function authenticate(Request $request){
        $dataAttempt = array(
            'email' => $request->email,
            'password' => $request->password
        );

        //dd(Auth::guard('client')->attempt($dataAttempt));
        $client = Client::where('email', $request->email)->first();
        if(Auth::guard('client')->attempt($dataAttempt) && $client->approved){

            $client->last_login = Carbon::now();
            $client->save();
            return redirect()->route('clients.index');
        }else{
            return redirect()->route('login');
        }
        //dd($user[0])
    }
}
