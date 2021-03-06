<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Models\Client;
use App\Models\Floor;
use App\Models\Room;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Auth;

class RoomController extends Controller {

    public function index(){
        return view('rooms.manage');
    }

    public function create(){
        $floors = Floor::all();
        
        return view('rooms.create',compact('floors'));
    }

    public function store(StoreRoomRequest $request){
        $requestData = $request->all();
        $floor = Floor::where('id', $request->floor_id)->first();
        $requestData['user_id']=Auth::guard('user')->user()->id;
        $requestData['number'] = $requestData['number'] + $floor->number;
        $requestData['price'] = $requestData['price'] * 100;
        $room = Room::create($requestData);

        return redirect()->route('rooms.index');
    }
    public function getRoom(Request $request) {

        if ($request->ajax()) {

            $data = Room::latest()->get();
            return Datatables::of($data)
                ->addColumn('action', 'helpers.roomsActionsButtons')
                ->addColumn('RealPrice',function($data){

                  $realPrice = (int)($data->price / 100);
                  $view =  $realPrice;
                    return  $view ;
                })
                ->addColumn('floorNumber',function($data){
                    $floor = (int)( $data->number / 1000)  ;
                    $floorNumber = $floor * 1000 ;
                    $view =   $floorNumber;
                      return  $view ;
                  })
                  ->editColumn('user_id',function($data){
                    if ($data->user_id != null){
                    $creator = User::where('id',$data->user_id)->first();
                    return $creator->name;
                    }else {
                        return $data->name;
                    }

                })
                ->rawColumns(['action','RealPrice','floorNumber','user_id'])
                ->make(true);
        }
    }

    public function edit(Room $room){

        $rooms = Floor::all();

        return view('rooms.edit', compact('room', 'rooms'));
    }

    public function update(Room $room, Request $request){
        $request->validate([
            'capacity' => 'required',
            'price' => 'required'
        ]);
        $request['price'] = $request['price'] * 100;
        $room->update($request->all());
        return redirect()->route('rooms.index');
    }

    public function destroy(Room $room) {
        if($room->reserved == 1){
            $msg = 'this room is reserved ,cant be removed';
            return view('rooms.manage',compact('msg'));
        }
        $room->delete();
        return redirect()->route('rooms.index');
    }

}
