@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="col-md-4 col-sm-6 ml-auto mr-auto">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="card card-login card-hidden">
                <div class="card-header ">
                    <h2 class="header text-center" style="font-family: 'Roboto', sans-serif;">SysCob</h2>
                </div>
                <div class="card-body ">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email" class="col-form-label text-md-right">Usuario</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-form-label text-md-right">CONTRASEÑA</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="form-check-sign"></span>
                                    RECORDARME
                                </label>
                                <label class="form-check-label">
                                    <a class="form-check-input" href="{{ route('password.request') }}">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-warning btn-wd">Iniciar sesión</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
