@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php($login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
    @php($register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))

        @if (config('adminlte.use_route_url', false))
            @php($login_url = $login_url ? route($login_url) : '')
                @php($register_url = $register_url ? route($register_url) : '')
                @else
                    @php($login_url = $login_url ? url($login_url) : '')
                        @php($register_url = $register_url ? url($register_url) : '')
                        @endif

                        @section('auth_header', __('adminlte::adminlte.register_message'))







                        @section('auth_body')
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first() }}
                                </div>
                            @endif
                            <form action="{{ route('clients.register') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                {{-- Name field --}}
                                <div class="input-group mb-3">
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                    @endif
                                </div>

                                {{-- Email field --}}
                                <div class="input-group mb-3">
                                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                        value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                                </div>

                                {{-- Password field --}}
                                <div class="input-group mb-3">
                                    <input type="password" name="password"
                                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                        placeholder="{{ __('adminlte::adminlte.password') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                    @endif
                                </div>

                                {{-- Confirm password field --}}
                                <div class="input-group mb-3">
                                    <input type="password" name="password_confirmation"
                                        class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                        placeholder="{{ __('adminlte::adminlte.retype_password') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                {{-- Mobile field --}}
                                <div class="input-group mb-3">
                                    <input type="text" name="mobile" class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}"
                                        value="{{ old('mobile') }}" placeholder="Mobile" autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('mobile'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </div>
                                    @endif
                                </div>

                                {{-- Country field --}}
                                <div class="input-group mb-3">
                                    <select id="country" name="country" class="form-control {{ $errors->has('Country') ? 'is-invalid' : '' }}"
                                        value="{{ old('Country') }}" placeholder="Country" autofocus>
                                        @php($countries = countries())
                                            @foreach ($countries as $country)
                                                <option value="{{ $country['official_name'] }}">{{ $country['official_name'] }}</option>
                                            @endforeach
                                            {{-- @include('adminlte::partials.countries.country') --}}
                                        </select>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('Country'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('Country') }}</strong>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- gender field --}}
                                    <div class="input-group mb-3">
                                        <select id="gender" name="gender" class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}"
                                            value="{{ old('gender') }}" placeholder="gender" autofocus>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('gender'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Avatar field --}}
                                    <div class="input-group mb-3">
                                        <input type="file" id="avatar_img" name="avatar_img" accept="image/*"
                                            class="form-control {{ $errors->has('avatar_img') ? 'is-invalid' : '' }}"
                                            value="{{ old('avatar_img') }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('avatar_img'))
                                            <div class="invalid-feedback">
                                                <strong>'{{ $errors->first('avatar_img') }}'</strong>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Register button --}}
                                    <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                                        <span class="fas fa-user-plus"></span>
                                        {{ __('adminlte::adminlte.register') }}
                                    </button>

                                </form>




                            @stop

                        @section('auth_footer')
                            <p class="my-0">
                                <a href="{{ $login_url }}">
                                    {{ __('adminlte::adminlte.i_already_have_a_membership') }}
                                </a>
                            </p>
                        @stop
