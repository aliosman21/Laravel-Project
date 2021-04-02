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
use App\Classes\ClientRepository;
use App\Classes\RoomRepository;
use App\Classes\ReservationRepository;
use DateTime;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller {

    public function register(StoreClientRequest $request){
        if ($request->hasfile('avatar_img')) {
            $fname =  $request->file('avatar_img')->getClientOriginalName();
            $request->file('avatar_img')->storeAS('', $fname, 'public_uploads');
        }
         else{
             dd('no file');
         }
        $clientExists = ClientRepository::getClientUsingEmail($request['email']);
        if(!$clientExists == null){
            return redirect()->route('register')->withErrors(['Email already in use']);
         }
        ClientRepository::registerNewClient($request, $fname);
        Auth::guard('client')->logout();
        return redirect()->route('welcome');
    }

    public function index(){
        return view('clients.index');
    }

    public function getRooms(){
        // $room = Room::where('reserved', 0)->get();
        $room = RoomRepository::getAllNonReservedRooms();
         return Datatables::of($room)
                 ->editColumn('price',function($room){
                     $realPrice = (int)($room->price / 100);
                     $view =  $realPrice;
                     return  $view ;
                 })
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
        // $reservation = Reservation::where('client_id', Auth::guard('client')->user()->id)->where('status','paid')->get();
        $reservation = ReservationRepository::getPaidReservationsOfLoggedInClient();
        return Datatables::of($reservation)
                ->editColumn('price',function ($data){
                    return $data->price / 100 ;
                })
                ->editColumn('room_id',function ($data){
                   $roomNumber = RoomRepository::getRoomById($data->room_id);
                    // $roomNumber = Room::where('id',$data->room_id)->first();
                    return $roomNumber->number;
                })
                ->rawColumns(['price','room_id'])
                ->make(true);
    }

    public function store(Request $request){
        $room = RoomRepository::getRoomById($request->room_id);
        $request->validate([
            'accompany_number' => 'max:'.$room->capacity,
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        ReservationRepository::reserveRoomAsClient($request , $room);
        RoomRepository::changeRoomStatusToReserved($room);
        return redirect()->route('clients.checkout');
    }

    public function authenticate(Request $request){
        $dataAttempt = array(
            'email' => $request->email,
            'password' => $request->password
        );
        $client = ClientRepository::getClientUsingEmail($request->email);
        if($client == null)  return redirect()->route('login')->withErrors(['Email Doesn\'t exist']);
        if(!$client->approved) return redirect()->route('login')->withErrors(['Email Not approved yet']);
        if(Auth::guard('client')->attempt($dataAttempt)){
            ClientRepository::setNowAsClientLastLogin($client);
            return redirect()->route('clients.index');
        }else{
            return redirect()->route('login')->withErrors(['Email or password incorrect']);
        }
    }

}
