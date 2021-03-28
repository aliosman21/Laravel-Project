<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Models\Client;
use App\Models\Floor;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class RoomController extends Controller {

    public function index(){
        $rooms = Room::all();
        $users = User::all();
        return view('rooms.manage',compact('rooms','users'));
    }

    public function create(){
        $floors = Floor::all();
        $client = Client::where('email', 'default@default.com')->first();
        return view('rooms.create',compact('floors','client'));
    }

    public function store(StoreRoomRequest $request){
        $requestData = $request->all();
        $requestData['number'] = $requestData['number'] + $requestData['floor_number'];
        $requestData['price'] = $requestData['price'] * 100;
        Room::create($requestData);
        return redirect()->route('rooms.index');
    }

    public function edit(Room $room){
        $rooms = Floor::all();
        return view('rooms.edit', compact('room', 'rooms'));
    }

    public function update(Room $room, StoreRoomRequest $request){
        $room->update($request->all());
        return redirect()->route('rooms.index');
    }

    public function destroy(Room $room) {
        $room->delete();
        return redirect()->route('rooms.index');
    }

}
