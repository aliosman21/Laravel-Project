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
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller {


    public function register(StoreClientRequest $request){

        // dd($request);


         Client::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'mobile'=>$request['mobile'],
            'country'=>$request['country'],
            'gender' => $request['gender'],
            'avatar' => $request['avatar']
        ]);


        return redirect()->route('clients.index');
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
        $reservation = Reservation::where('id', Auth::guard('client')->user()->id)->get();
         return Datatables::of($reservation)
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
        //dd($room->price * 100 * $days);
        $reservation = Reservation::create([
            'accompany_number'=> $room->capacity,
            'price' => $room->price * 100 * $days,
            'status' => 'pending',
            'start_date' => $start_date,
            'end_date' => $end_date,
            'client_id' => $request->client_id,
            'room_id'=>$request->room_id
            ]);
            $room->reserved = 1;
            $room->save();
        return redirect()->route('clients.checkout',compact('reservation'));
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
