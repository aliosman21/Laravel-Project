<?php

namespace App\Classes;

use App\Models\Reservation;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationRepository
{

    public static function reserveRoomAsClient($reservationInfo , $roomInfo){
        $end_date = new DateTime($reservationInfo->end_date);
        $start_date = new DateTime($reservationInfo->start_date);
        $interval = $end_date->diff($start_date);
        $days = $interval->format('%a');

        Reservation::create([
            'accompany_number'=> $reservationInfo->accompany_number,
            'price' => $roomInfo->price * 100 * $days,
            'status' => 'pending',
            'start_date' => $start_date,
            'end_date' => $end_date,
            'client_id' => Auth::guard('client')->user()->id,
            'room_id'=>$reservationInfo->room_id
            ]);
    }

    public static function getPaidReservationsOfLoggedInClient(){
       return Reservation::where('client_id', Auth::guard('client')->user()->id)->where('status','paid')->get();
    }

}
