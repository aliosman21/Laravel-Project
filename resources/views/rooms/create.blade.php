@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content_header')
    <h1 class="m-0 text-dark">Create Room</h1>
@stop

@section('content')

    <div class="container">
        <form action="{{route('rooms.store')}}" method="post">
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

            {{-- number field --}}
            <div class="input-group mb-3">
                <input type="number" name="number" class="form-control "
                       placeholder="Room number" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>
            </div>

            {{-- capacity field --}}
            <div class="input-group mb-3">
                <input type="number" name="capacity" class="form-control "
                       placeholder="capacity" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>
            </div>

            {{-- price field --}}
            <div class="input-group mb-3">
                <input type="number" name="price" class="form-control "
                       placeholder="price" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>
            </div>

            {{-- floor field --}}
            <div class="form-group">
                <label  for="post_creator">Floor number</label>
                <select name="floor_number" class="form-control" id="post_creator">
                    @foreach ($floors as $floor)
                        <option value="{{$floor->number}}">{{$floor->number}}</option>
                    @endforeach
                </select>
            </div>

            {{-- user creator --}}
            <div class="form-group">
                <label  for="post_creator">User Creator</label>
                <select name="user_id" class="form-control" id="post_creator" disabled>
                    <option value="{{Auth::guard('user')->user()->id}}">{{Auth::guard('user')->user()->name}} </option>
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
