@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content_header')
<h1 class="m-0 text-dark">Create Staff</h1>
@stop

@section('content')

<div class="container">
<form action="{{route('users.store')}}" method="post">
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
<div class="input-group mb-3">
 <input type="text" name="name" class="form-control "
 placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
<div class="input-group-append">
 <div class="input-group-text">
 <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
 </div>
        </div>
 
    </div>

    {{-- Email field --}}
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control "
            placeholder="{{ __('adminlte::adminlte.email') }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>

    </div>

    {{-- Password field --}}
    <div class="input-group mb-3">
        <input type="password" name="password"
            class="form-control "
            placeholder="{{ __('adminlte::adminlte.password') }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>

    </div>


    {{-- National-id field --}}
    <div class="input-group mb-3">
        <input type="text" name="national_id" class="form-control "
             placeholder="NationalID" >
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>

    </div>

{{-- role field --}}
<div class="input-group mb-3">
    <select id="role" name="role" class="form-control "
       placeholder="role" autofocus>
        <option value="manager">Manager</option>
        <option value="receptionist">Receptionist</option>
    </select>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
        </div>
    </div>
</div>



    {{-- Avatar field --}}
    <div class="input-group mb-3">
        <input type="file" id="avatar" name="avatar" accept="image/*"
            class="form-control {{ $errors->has('avatar') ? 'is-invalid' : '' }}" value="{{ old('avatar') }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>
        @if ($errors->has('avatar'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('avatar') }}</strong>
            </div>
        @endif
    </div>

    {{-- Create button --}}
    <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
        <span class="fas fa-user-plus"></span>
        Create
    </button>

</form>

</div>

        @stop
