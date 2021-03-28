<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFloorRequest;
use App\Models\Floor;
use App\Models\User;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    public function index(){
        $floors = Floor::all();
        $users = User::all();
        return view('floors.manage',compact('floors','users'));
    }

    public function create(){
        $floor = Floor::latest()->first();
        return view('floors.create',compact('floor'));
    }

    public function store(StoreFloorRequest $request){
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
        $floor->delete();
        return redirect()->route('floors.index');
    }
}
