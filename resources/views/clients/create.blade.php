@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content_header')
    <h1 class="m-0 text-dark">Create Reservation</h1>
@stop



@section('content')

    <div class="container">
        <form action="{{route('reservations.store')}}" method="post" >
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

            {{-- Accompany number --}}
            <label>Accompany number</label>
            <div class="input-group mb-3">

                <input type="number" name="accompany_number" class="form-control "
                       placeholder="Accompany number" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>
            </div>

            {{-- start end date--}}
            <div class="form-group">
                <label>Start Date</label>
                <input type="date" class="form-control" name="start_date" id="StartDate">
                <label>End Date</label>
                <input type="date" class="form-control" name="end_date" id="EndDate" >
            </div>

            {{-- selectedRoom --}}
            <div class="form-group">
                <label  for="post_creator">Room Number</label>
                <select name="room_id" class="form-control" id="post_creator">
                    <option value="{{$selectedRoom->id}}">{{$selectedRoom->number}}</option>
                </select>
            </div>




            {{-- Create button --}}
            <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                <span class="fas fa-user-plus"></span>
                Create
            </button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $("#EndDate").change(function () {
            var startDate = document.getElementById("StartDate").value;
            var endDate = document.getElementById("EndDate").value;
            if ((Date.parse(endDate) <= Date.parse(startDate))) {
                alert("End date should be greater than Start date");
            }
        });
    </script>
@stop
