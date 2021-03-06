@extends('layouts.app')
@section('content')
    <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
            <div class="section-image" data-image="../../assets/img/bg5.jpg">
                <div class="container">
                    {{--{{ Form::open(array('route' => 'clientes.store', 'files'=>true,'class'=>'form')) }}--}}
                    <form method="post" class="form" action="{{ route('clientes.store') }}">
                        {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-8 col-sm-6">
                            <div class="card ">
                                <div class="card-header ">
                                    <div class="card-header">
                                        <h4 class="card-title">Registrar cliente</h4>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nombres</label>
                                                <input name="nombre" placeholder="Juan" id="nombre" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Apellido</label>
                                                <input name="apellido" placeholder="Perez" id="apellido" class="form-control" required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{--{{ Form::label('cedula', 'Cedula') }}--}}
                                                {{--{{ Form::text('cedula', '', array('class' => 'form-control')) }}--}}
                                                <label>DNI</label>
                                                <input name="dni" id="dni" placeholder="12345678" type="number" class="form-control"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-1">
                                            <div class="form-group">
                                                <label>Fecha de nacimiento</label>
                                                <input name="fechaN" id="datetimepicker" class="form-control datepicker"
                                                       required>
                                                {{--{{ Form::label('fechaN', 'Fecha de nacimiento') }}--}}
                                                {{--{{ Form::text('fechaN', '', ['id' =>'datetimepicker', 'class' => 'form-control datepicker']) }}--}}
                                            </div>
                                        </div>
                                        {{--<div class="col-md-3 pl-1">--}}
                                        {{--<div class="form-group">--}}
                                        {{--{{ Form::label('celular', 'Celular') }}--}}
                                        {{--{{ Form::text('celular', '', array('class' => 'form-control')) }}--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Sexo</label>
                                                <select name="sexo" class="selectpicker" data-menu-style='dropdown-blue'
                                                        data-style='btn-default btn-outline' required>
                                                    <option value="" selected disabled>Seleccione un sexo</option>
                                                    <option value="m">Masculino</option>
                                                    <option value="f">Femenino</option>
                                                    {{--<option disabled>Seleccione un sexo</option>--}}
                                                </select>
                                                {{--{{ Form::label('sexo', 'Sexo') }}--}}
                                                {{--{{Form::select(--}}
                                                {{--'sexo', ['m' => 'M', 'f'=> 'F', 'otro' => 'Otro'], null, [--}}
                                                {{--'class' => 'selectpicker', --}}
                                                {{--'data-title' => 'Seleccionar',--}}
                                                {{--'data-style' => 'btn-default btn-outline', --}}
                                                {{--'data-menu-style' => 'dropdown-blue'--}}
                                                {{--])--}}
                                                {{--}}--}}
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{--{{ Form::label('civil', 'ESTADO CIVIL') }}--}}
                                                {{--{{Form::select(--}}
                                                    {{--'civil', ['soltero' => 'Soltero', 'casado' => 'Casado', 'union libre' => 'Union Libre', 'divorciado' => 'Divorciado', 'viudo' => 'Viudo'], null, [--}}
                                                        {{--'class' => 'selectpicker',--}}
                                                        {{--'data-title' => 'Seleccionar',--}}
                                                        {{--'data-style' => 'btn-default btn-outline',--}}
                                                        {{--'data-menu-style' => 'dropdown-blue'--}}
                                                    {{--])--}}
                                                {{--}}--}}
                                                <label>ESTADO CIVIL</label>
                                                <select name="estadocivil" class="selectpicker" data-menu-style='dropdown-blue'
                                                        data-style='btn-default btn-outline' required>
                                                    <option value="" selected disabled>Seleccione un estado</option>
                                                    <option value="soltero">Soltero/a</option>
                                                    <option value="casado">Casado/a</option>
                                                    <option value="divorciado">Divorciado/a</option>
                                                    <option value="viudo">Viudo/a</option>
                                                    {{--<option disabled>Seleccione un sexo</option>--}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                {{--{{ Form::label('direccion', 'Direccion') }}--}}
                                                {{--{{ Form::text('direccion', '', array('class' => 'form-control')) }}--}}
                                                <label>Dirección</label>
                                                <input name="direccion" placeholder="Calle 1234" id="direccion" type="text" class="form-control"
                                                       required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Provincia</label>
                                                <select  class="selectpicker" data-menu-style='dropdown-blue'
                                                        data-style='btn-default btn-outline' required>
                                                    <option value="" selected disabled>Seleccione una Provincia</option>
                                                    <option value="1">Tucuman</option>
                                                    <option value="2">Jujuy</option>
                                                </select>


                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Localidad</label>
                                                <select name="localidad" class="selectpicker" data-menu-style='dropdown-blue'
                                                        data-style='btn-default btn-outline' required>
                                                    <option value="" selected disabled>Seleccione una localidad</option>
                                                    <option value="1">San Miguel de Tucuman</option>
                                                    <option value="2">Monteros</option>
                                                    <option value="3">Concepcion</option>
                                                    <option value="4">Aguilares</option>
                                                </select>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{--{{ Form::label('telR', 'Telefono') }}--}}
                                                {{--{{ Form::text('telR', '', array('class' => 'form-control')) }}--}}
                                                <label>Telefono</label>
                                                <input name="telefono" placeholder="3815789127"id="telefono" type="number" class="form-control"maxlength="10"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input name="email" placeholder="correo@correo.com" id="email" type="text" class="form-control"
                                                       >
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right"> Crear

                                    </button>
                                    {{--{{ Form::submit('Crear Cliente', array('class' => 'btn btn-info btn-fill pull-right')) }}--}}
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