<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Reservation;
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
        
        $data = Reservation::latest()->get();
         return Datatables::of($data)
                ->editColumn('price',function($data){
                    $newPrice = $data->price / 100;
                    return  $newPrice;
                })
                ->rawColumns(['price'])
                ->make(true);
    }
}
