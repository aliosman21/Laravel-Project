<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;


class UserController extends Controller
{
    
    public function index()
    {
        //$users = User::with('users')->get();
        $users = User::all();
        return view('admin.manage',compact('users'));
    }

    public function create()
    {
        $users = User::all();
        
        return view('users.create',compact('users'));
    }

    public function store(StoreUserRequest $request)
    {
        
        $requestData = $request->all();
        User::create($requestData);
        return redirect()->route('home');
    }

    public function getUsers(Request $request) {
        //3awzien el zaraer gwa blade.php ya nakash
        if ($request->ajax()) {
            
            $data = User::latest()->get();
            return Datatables::of($data)
               
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="" class="edit btn btn-success btn-sm">Edit</a> <a href="" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->editColumn('name', 'into')
                ->rawColumns(['action','name'])
                ->make(true);
        }
    }

    public function edit(User $user){
        $users = User::all();
        return view('users.edit', compact('user', 'users'));
    }

    public function update(User $user, StoreUserRequest $request){
        $user->update($request->all());
        return redirect()->route('users.index');
    }
    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('users.index');
    }




}