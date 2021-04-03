@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content_header')
    <h1 class="m-0 text-dark">Create Floor</h1>
@stop

@section('content')

    <div class="container">
        <form action="{{route('floors.store')}}" method="post">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Name field --}}
<<<<<<< Updated upstream
            <label  >Name</label>
=======

>>>>>>> Stashed changes
            <div class="input-group mb-3">
               
                <input type="text" name="name" class="form-control "
                       placeholder="Floor name" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Floor Number</label>
                <select name="number" class="form-control" id="post_creator">
                    @if( !empty($floor->number) )
                        <option value="{{$floor->number + 1000}}">{{$floor->number + 1000}}</option>
                    @else
                        <option value="1000">1000</option>
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label  for="post_creator">User Creator</label>
                <select name="user_id" class="form-control" id="post_creator">
                    <option value="{{Auth::guard('user')->user()->id}}">{{Auth::guard('user')->user()->name}}</option>
                </select>
            </div>

            {{-- Create button --}}
            <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                <span class="fas fa-user-plus"></span>
                Create
            </button>
        </form>
    </div>
@stop
