<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFloorRequest;
use App\Models\Floor;
use App\Models\Room;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    public function index(){
        return view('floors.manage');
    }

    public function create(){
        $floor = Floor::latest()->first();
        return view('floors.create',compact('floor'));
    }

    public function store(StoreFloorRequest $request){
        $requestData = $request->all();
        // $requestData['user_id']=Auth::guard('user')->user()->id;
        Floor::create($request->all());
        return redirect()->route('floors.index');
    }

    public function edit(Floor $floor){
       
        $floors = Floor::all();
        return view('floors.edit', compact('floor', 'floors'));
    }

    public function update(Floor $floor, StoreFloorRequest $request){
        $floor->update($request->all());
        return redirect()->route('floors.index');
    }

    public function destroy(Floor $floor) {
        
        $rooms = Room::where('floor_id',$floor->id)->first();
        //dd($rooms);
        if($rooms){
            $msg = "this floor cant be deleted";
            return view('floors.manage',compact('msg'));
        }
        
        $floor->delete();
        return redirect()->route('floors.index');
    }
    public function getfloor(Request $request) {

        if ($request->ajax()) {

            $data = Floor::latest()->get();
            return Datatables::of($data)
                ->addColumn('action', 'helpers.floorsActionsButtons')
                ->editColumn('user_id',function($data){
                    if ($data->user_id != null){
                    $creator = User::where('id',$data->user_id)->first();
                    return $creator->name;
                    }else {
                        return $data->name;
                    }
                    
                })
                ->rawColumns(['action','user_id'])
                ->make(true);
        }
    }
}
