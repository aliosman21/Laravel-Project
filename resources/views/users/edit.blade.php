@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content_header')
    <h1 class="m-0 text-dark">Edit Staff</h1>
@stop

@section('content')

    <div class="container">
        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="post">
            @csrf
            @method('PUT')
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

            <div class="input-group mb-3">

                <input type="text" name="name" class="form-control " value="{{ $user->name }}" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>

            </div>

            {{-- Email field --}}
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control " value="{{ $user->email }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>

            </div>

            {{-- update button --}}
            <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                <span class="fas fa-user-plus"></span>
                Update
            </button>

        </form>

    </div>

@stop
