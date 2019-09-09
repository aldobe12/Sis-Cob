@extends('layouts.app')
@section('content')
    <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
            <div class="section-image" data-image="../../assets/img/bg5.jpg">
                <div class="container">
                    {{ Form::open(array('route' => 'usuarios.store', 'files'=>true,'class'=>'form')) }}
                    <div class="row">
                        <div class="col-md-8 col-sm-6">
                            <div class="card ">
                                <div class="card-header ">
                                    <div class="card-header">
                                        <h4 class="card-title">Registrar Usuario</h4>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nombre</label>
                                                <input name="name" id="name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Apellido</label>
                                                <input name="lastname" id="lastname" class="form-control" required>
                                            </div>
                                        </div>

                                    </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" id="email" type="text" class="form-control"
                                            >
                                        </div>

                                    <div class="form-group" class="col-md-6">
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


                                    <div class="row">
                                        {{--<div class="col-md-4">--}}
                                            {{--<div class="form-group">--}}
                                                {{--{{ Form::label('cedula', 'Cedula') }}--}}
                                                {{--{{ Form::text('cedula', '', array('class' => 'form-control')) }}--}}
                                                {{--<label>Telefono</label>--}}
                                                {{--<input name="num" id="email" type="email" class="form-control"--}}
                                                       {{--required>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-4 pl-1">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label>Fecha de nacimiento</label>--}}
                                                {{--<input name="fechaN" id="datetimepicker" class="form-control datepicker"--}}
                                                       {{--required>--}}
                                                {{--{{ Form::label('fechaN', 'Fecha de nacimiento') }}--}}
                                                {{--{{ Form::text('fechaN', '', ['id' =>'datetimepicker', 'class' => 'form-control datepicker']) }}--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-3 pl-1">--}}
                                        {{--<div class="form-group">--}}
                                        {{--{{ Form::label('celular', 'Celular') }}--}}
                                        {{--{{ Form::text('celular', '', array('class' => 'form-control')) }}--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="col-md-4">
                                            {{--<div class="form-group">--}}
                                                {{--<label>Sexo</label>--}}
                                                {{--<select name="sexo" class="selectpicker" data-menu-style='dropdown-blue'--}}
                                                        {{--data-style='btn-default btn-outline' required>--}}
                                                    {{--<option value="" selected disabled>Seleccione un sexo</option>--}}
                                                    {{--<option value="1">Masculino</option>--}}
                                                    {{--<option value="2">Femenino</option>--}}
                                                    {{--<option disabled>Seleccione un sexo</option>--}}
                                                {{--</select>--}}
                                                {{--{{ Form::label('sexo', 'Sexo') }}--}}
                                                {{--{{Form::select(--}}
                                                {{--'sexo', ['m' => 'M', 'f'=> 'F', 'otro' => 'Otro'], null, [--}}
                                                {{--'class' => 'selectpicker', --}}
                                                {{--'data-title' => 'Seleccionar',--}}
                                                {{--'data-style' => 'btn-default btn-outline', --}}
                                                {{--'data-menu-style' => 'dropdown-blue'--}}
                                                {{--])--}}
                                                {{--}}--}}
                                            {{--</div>--}}
                                        </div>

                                    </div>

                                    <div class="row">
                                        {{--<div class="col-md-4">--}}
                                            {{--<div class="form-group">--}}
                                                {{--{{ Form::label('civil', 'ESTADO CIVIL') }}--}}
                                                {{--{{Form::select(--}}
                                                    {{--'civil', ['soltero' => 'Soltero', 'casado' => 'Casado', 'union libre' => 'Union Libre', 'divorciado' => 'Divorciado', 'viudo' => 'Viudo'], null, [--}}
                                                        {{--'class' => 'selectpicker',--}}
                                                        {{--'data-title' => 'Seleccionar',--}}
                                                        {{--'data-style' => 'btn-default btn-outline',--}}
                                                        {{--'data-menu-style' => 'dropdown-blue'--}}
                                                    {{--])--}}
                                                {{--}}--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-8">--}}
                                            {{--<div class="form-group">--}}
                                                {{--{{ Form::label('direccion', 'Direccion') }}--}}
                                                {{--{{ Form::text('direccion', '', array('class' => 'form-control')) }}--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                    </div>
                                    <div class="row">
                                        {{--<div class="col-md-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label>Provincia</label>--}}
                                                {{--<select name="localidad" class="selectpicker" data-menu-style='dropdown-blue'--}}
                                                        {{--data-style='btn-default btn-outline' required>--}}
                                                    {{--<option value="" selected disabled>Seleccione una Provincia</option>--}}
                                                    {{--<option value="1">Tucuman</option>--}}
                                                    {{--<option value="2">Jujuy</option>--}}
                                                {{--</select>--}}


                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label>Localidad</label>--}}
                                                {{--<select name="localidad" class="selectpicker" data-menu-style='dropdown-blue'--}}
                                                        {{--data-style='btn-default btn-outline' required>--}}
                                                    {{--<option value="" selected disabled>Seleccione una localidad</option>--}}
                                                    {{--<option value="1">San Miguel de Tucuman</option>--}}
                                                    {{--<option value="2">Monteros</option>--}}
                                                    {{--<option value="2">Concepcion</option>--}}
                                                    {{--<option value="2">Aguilares</option>--}}
                                                {{--</select>--}}


                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                                    <div class="row">

                                        {{--<div class="col-md-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--{{ Form::label('telR', 'Telefono') }}--}}
                                                {{--{{ Form::text('telR', '', array('class' => 'form-control')) }}--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                    </div>
                                    {{ Form::submit('Crear Usuario', array('class' => 'btn btn-info btn-fill pull-right')) }}
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        {{--<div class="col-md-4">--}}
                            {{--<div class="card card-user">--}}
                                {{--<div class="avatar-upload">--}}
                                    {{--<div class="avatar-edit">--}}
                                        {{--{{ Form::file('avatar', ['id' => 'imageUpload', 'accept' => '.png, .jpg, .jpeg']) }}--}}
                                        {{--<label for="imageUpload"></label>--}}
                                    {{--</div>--}}
                                    {{--<div class="avatar-preview">--}}
                                        {{--<div id="imagePreview"--}}
                                             {{--style="background-image: url('../assets/img/default-avatar.png');">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imageUpload").change(function () {
            readURL(this);
        });
        $(document).ready(function () {
            let fecha = new Date();
            $('#datetimepicker').datetimepicker({
                format: 'DD/MM/YYYY',
                maxDate: fecha.setFullYear(fecha.getFullYear() - 18),
            });
        })
    </script>
@endsection