@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="col-md-4 col-sm-6 ml-auto mr-auto">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="card card-login card-hidden">
                <div class="card-header ">
                    <h3 class="header text-center">Registrarse</h3>
                </div>
                <div class="card-body ">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class=" col-form-label text-md-right">Nombre</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email" class=" col-form-label text-md-right">E-Mail</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password" class=" col-form-label text-md-right">Contraseña</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class=" col-form-label text-md-right">Confirmar Contraseña</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary">Registrarse</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

