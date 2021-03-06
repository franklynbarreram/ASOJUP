@extends('layouts.app', ['class' => 'bg-default'])

@section('content')

    @include('layouts.headers.guest', [
        'title'  =>  'Registra un Nuevo Delegado'
    ])
    
    <div class="container mt--8 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
            @if (\Session::has('notification'))
                @include('layouts.templates.notification', [
                'success' => \Session::get('success'),
                'message' => \Session::get('notification'),
                'alert_class' => \Session::get('success') == true ?
                'alert alert-success alert-dismissible fade show' :
                'alert alert-danger alert-dismissible fade show'
                ])
            @endif

            <div class="col-lg-6 col-md-8">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                    </div>
                                    <input 
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('Nombre') }}" 
                                        type="text" 
                                        name="name" 
                                        value="{{ old('name') }}" 
                                        required autofocus
                                    >
                                </div>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input 
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('Email') }}" 
                                        type="email" 
                                        name="email" 
                                        value="{{ old('email') }}" 
                                        required
                                    >
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-map-big"></i></span>
                                    </div>

                                    <select 
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                        name="zone_id" 
                                        value="{{ old('zone') }}" 
                                        required
                                    >
                                        <option value="none" disabled selected>Elige una zona</option>
                                        @foreach ($zones as $z)
                                            <option value="{{$z->id}}">{{$z->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input 
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Contraseña') }}"
                                        type="password"
                                        name="password"
                                        required
                                    >
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="{{ __('Repite la contraseña') }}" type="password" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">{{ __('Crear cuenta') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
