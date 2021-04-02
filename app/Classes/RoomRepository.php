<?php

namespace App\Classes;

use App\Models\Room;

class RoomRepository
{

    public static function getRoomById($room_id){
        return Room::where('id', $room_id)->first();
    }

    public static function getAllNonReservedRooms(){
       return Room::where('reserved', 0)->get();
    }

    public static function changeRoomStatusToReserved($room){
        $room->reserved = 1;
        $room->save();
    }

}
