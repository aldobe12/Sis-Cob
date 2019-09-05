@extends('layouts.app')
@section('content')
<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="section-image" data-image="../../assets/img/bg5.jpg">
            <div class="container">
                {{ Form::open(array('route' => 'clientes.store', 'files'=>true,'class'=>'form')) }}
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
                                        <div class="col-md-5 pr-1">
                                            <div class="form-group">
                                                {{ Form::label('nombre', 'Nombres') }}
                                                {{ Form::text('nombre', '', array('class' => 'form-control')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-3 px-1">
                                            <div class="form-group">
                                                {{ Form::label('apellido', 'Apellidos') }}
                                                {{ Form::text('apellido', '', array('class' => 'form-control')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-1">
                                            <div class="form-group">
                                                {{ Form::label('sexo', 'Sexo') }}
                                                {{Form::select(
                                                    'sexo', ['m' => 'M', 'f'=> 'F', 'otro' => 'Otro'], null, [
                                                        'class' => 'selectpicker', 
                                                        'data-title' => 'Seleccionar',
                                                        'data-style' => 'btn-default btn-outline', 
                                                        'data-menu-style' => 'dropdown-blue'
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 pr-1">
                                            <div class="form-group">
                                                {{ Form::label('cedula', 'Cedula') }}
                                                {{ Form::text('cedula', '', array('class' => 'form-control')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-3 pl-1">
                                            <div class="form-group">
                                                {{ Form::label('fechaN', 'Fecha de nacimiento') }}
                                                {{ Form::text('fechaN', '', ['id' =>'datetimepicker', 'class' => 'form-control datepicker']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-3 pl-1">
                                            <div class="form-group">
                                                {{ Form::label('celular', 'Celular') }}
                                                {{ Form::text('celular', '', array('class' => 'form-control')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-3 pl-1">
                                            <div class="form-group">
                                                {{ Form::label('tel', 'Telefono') }}
                                                {{ Form::text('tel', '', array('class' => 'form-control')) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            {{ Form::label('vivienda', 'Vivienda') }}
                                                {{Form::select(
                                                    'vivienda', ['propia' => 'Propia','alquiler' => 'Alquiler', 'otra' => 'Otra'], null, [
                                                        'class' => 'selectpicker', 
                                                        'data-title' => 'Seleccionar',
                                                        'data-style' => 'btn-default btn-outline', 
                                                        'data-menu-style' => 'dropdown-blue'
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('direccion', 'Direccion') }}
                                                {{ Form::text('direccion', '', array('class' => 'form-control')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                {{ Form::label('civil', 'ESTADO CIVIL') }}
                                                {{Form::select(
                                                    'civil', ['soltero' => 'Soltero', 'casado' => 'Casado', 'union libre' => 'Union Libre', 'divorciado' => 'Divorciado', 'viudo' => 'Viudo'], null, [
                                                        'class' => 'selectpicker', 
                                                        'data-title' => 'Seleccionar',
                                                        'data-style' => 'btn-default btn-outline', 
                                                        'data-menu-style' => 'dropdown-blue'
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 pr-1">
                                            <div class="form-group">
                                                {{ Form::label('empleo', 'Empleo') }}
                                                {{Form::select(
                                                    'empleo', ['empleado' => 'Empleado', 'desempleado' => 'Desempleado', 'estudiante' => 'Estudiante', 'otro' => 'Otro'], null, [
                                                        'class' => 'selectpicker', 
                                                        'data-title' => 'Seleccionar',
                                                        'data-style' => 'btn-default btn-outline', 
                                                        'data-menu-style' => 'dropdown-blue'
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-1">
                                            <div class="form-group">
                                               {{ Form::label('ingreso', 'Trabajo ingreso') }}
                                                {{ Form::number('ingreso', '', array('class' => 'form-control')) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('referenciaPersonal', 'Referencia personal') }}
                                                {{ Form::text('referenciaPersonal', '', array('class' => 'form-control')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('telR', 'Telefono') }}
                                                {{ Form::text('telR', '', array('class' => 'form-control')) }}
                                            </div>
                                        </div>
                                    </div>
                                    {{ Form::submit('Crear Cliente', array('class' => 'btn btn-info btn-fill pull-right')) }}
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-user">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        {{ Form::file('avatar', ['id' => 'imageUpload', 'accept' => '.png, .jpg, .jpeg']) }}
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url('../assets/img/default-avatar.png');">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});
$(document).ready(function(){
    let fecha = new Date();
    $('#datetimepicker').datetimepicker({
            format: 'DD/MM/YYYY',
            maxDate: fecha.setFullYear(fecha.getFullYear() - 18),
        });
})
</script>
@endsection