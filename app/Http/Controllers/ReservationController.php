<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
class ReservationController extends Controller
{
    public function index() {
        // $users = User::all();
        // return view('users.manage',compact('users'));
        // Auth::guard('user')->user()->assignRole(Role::findById(1));
        // $users = User::all()
        // dd(Auth::guard('user')->user()->getAllPermissions());
        // dd(Auth::guard('user')->user()->hasRole('admin'));
        // dd(auth()->guard('user')->user()->hasRole('admin'));
        // Auth::guard('user')->user()->removeRole(Role::findById(2));
        // Auth::guard('user')->user()->assignRole(Role::findById(2));
        // dd(Auth::guard('user')->user()->hasRole('manager'));

        return view('Reservations.manage');
    }
    public function getReservation(){
        
        $data = Reservation::where('status','paid')->get();


        if (auth()->guard('user')->user()->hasRole('receptionist')){
                $getReservation = Reservation::
                whereIn('client_id',Client::where('user_id',auth()->guard('user')->user()->id)->get('id'))
                ->where('status','paid')
                ->get();


            return Datatables::of($getReservation)
                ->editColumn('price',function($data){
                    $newPrice = $data->price / 100;
                    return  $newPrice;
                })
                ->editColumn('client_id',function($data){
                    $client = Client::where('id',$data->client_id)->first();
                    return $client->name;
                  
                })
                ->editColumn('room_id',function ($data){
                    $roomNumber = Room::where('id',$data->room_id)->first();
                    return $roomNumber->number;
                })
                ->rawColumns(['price','client_id','room_id'])
                ->make(true);
            }
         return Datatables::of($data)
                ->editColumn('price',function($data){
                    $newPrice = $data->price / 100;
                    return  $newPrice;
                })
                ->editColumn('client_id',function($data){
                    $client = Client::where('id',$data->client_id)->first();
                    return $client->name;
                  
                })
                ->editColumn('room_id',function ($data){
                    $roomNumber = Room::where('id',$data->room_id)->first();
                    return $roomNumber->number;
                })
                ->rawColumns(['price','client_id','room_id'])
                ->rawColumns(['price'])
                ->make(true);
    }
}
