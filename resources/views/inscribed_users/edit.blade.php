@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hola') . ' '. $inscrito->name,
        'description' => __('Esta es tu página de perfil, donde podrás visualizar todos tus datos y hacer edición de ellos'),
        'class' => 'col-lg-7'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">

                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        <span class="heading">{{$inscrito->name}} {{$inscrito->surname}}</span>
                                        <span class="description">{{$inscrito->email}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{$inscrito->phone}}
                            </div>
                            <hr class="my-4" />
                            <p>{{$inscrito->address}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Editar Perfil') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('inscribed_users.update') }}" autocomplete="off">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                            <h6 class="heading-small text-muted mb-4">{{ __('Información de Inscrito') }}</h6>
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (session('ErrorSave'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('ErrorSave') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            

                            <input type="hidden" name="id" value="{{$inscrito->id}}">
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Nombre') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}" value="{{ old('name', $inscrito->name) }}" disabled autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('surname') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-surname">{{ __('Apellido') }}</label>
                                    <input type="text" name="surname" id="input-surname" class="form-control form-control-alternative{{ $errors->has('surname') ? ' is-invalid' : '' }}" placeholder="{{ __('Apellido') }}" value="{{ old('surname', $inscrito->surname) }}" disabled autofocus>

                                    @if ($errors->has('surname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('surname') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', $inscrito->email) }}" disabled>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('identification') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-identification">{{ __('Cédula') }}</label>
                                    <input type="text" name="identification" id="input-identification" class="form-control form-control-alternative{{ $errors->has('identification') ? ' is-invalid' : '' }}" placeholder="{{ __('Cédula') }}" value="{{ old('identification', $inscrito->identification) }}" disabled autofocus>

                                    @if ($errors->has('identification'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('identification') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('cicpc_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-cicpc_id">{{ __('Identificación CICPC') }}</label>
                                    <input type="text" name="cicpc_id" id="input-cicpc_id" class="form-control form-control-alternative{{ $errors->has('cicpc_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Identificación CICPC') }}" value="{{ old('cicpc_id', $inscrito->cicpc_id) }}" disabled autofocus>

                                    @if ($errors->has('cicpc_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cicpc_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone">{{ __('Teléfono') }}</label>
                                    <input required type="text" name="phone" id="input-phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Teléfono') }}" value="{{ old('phone', $inscrito->phone) }}"  autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-address">{{ __('Dirección') }}</label>
                                    <input required type="text" name="address" id="input-address" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="{{ __('Dirección') }}" value="{{ old('address', $inscrito->address) }}"  autofocus>

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Guardar Cambios') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
{{--                        <form method="post" action="{{ route('inscribed_users.password') }}" autocomplete="off">--}}
{{--                            {{ csrf_field() }}--}}
{{--                            {{ method_field('PUT') }}--}}

{{--                            <h6 class="heading-small text-muted mb-4">{{ __('Contraseña') }}</h6>--}}

{{--                            @if (session('password_status'))--}}
{{--                                <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
{{--                                    {{ session('password_status') }}--}}
{{--                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                        <span aria-hidden="true">&times;</span>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                            @if (session('ErrorSavePassword'))--}}
{{--                                <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--                                    {{ session('ErrorSavePassword') }}--}}
{{--                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                        <span aria-hidden="true">&times;</span>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                            <input type="hidden" name="id" value="{{$inscrito->id}}">--}}
{{--                            <div class="pl-lg-4">--}}
{{--                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">--}}
{{--                                    <label class="form-control-label" for="input-current-password">{{ __('Contraseña Actual') }}</label>--}}
{{--                                    <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Contraseña Actual') }}" value="" required>--}}
{{--                                    --}}
{{--                                    @if ($errors->has('old_password'))--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $errors->first('old_password') }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">--}}
{{--                                    <label class="form-control-label" for="input-password">{{ __('Nueva Contraseña') }}</label>--}}
{{--                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Nueva Contraseña') }}" value="" required>--}}
{{--                                    --}}
{{--                                    @if ($errors->has('password'))--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $errors->first('password') }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirmar Contraseña') }}</label>--}}
{{--                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirmar Contraseña') }}" value="" required>--}}
{{--                                </div>--}}

{{--                                <div class="text-center">--}}
{{--                                    <button type="submit" class="btn btn-success mt-4">{{ __('Guardar Contraseña') }}</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection