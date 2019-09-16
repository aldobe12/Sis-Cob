@extends('layouts.app')
@section('content')
<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="section-image" data-image="../../assets/img/bg5.jpg">
            <div class="container">
                {{ Form::model($prestamo, array('route' => array('prestamos.update', $prestamo->id), 'method' => 'PUT', 'files'=>true,'class'=>'form')) }}
                    <div class="row">
                        <div class="col-md-12 col-sm-6">
                            <div class="card ">
                                <div class="card-header ">
                                    <div class="card-header">
                                        <h4 class="card-title">Nuevo Prestamo</h4>
                                    </div>
                                    
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-md-5 pr-1">
                                            <div class="form-group">
                                                {{ Form::label('cliente_id', 'Cliente') }}
                                                {{ Form::text('cliente_id', $prestamo->cliente->nombre.' '.$prestamo->cliente->apellido, array('class' => 'form-control', 'disabled')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-3 px-1">
                                            <div class="form-group">
                                                {{ Form::label('amortizacion', 'Amortización') }}
                                                {{Form::select(
                                                    'amortizacion', ['cuotas fijas' => 'Cuotas Fijas', 'disminuir cuotas' => 'Disminuir Cuotas', 'interes fijo' => 'Interes Fijo'], null, [
                                                        'class' => 'selectpicker', 
                                                        'data-title' => 'Seleccionar',
                                                        'data-style' => 'btn-default btn-outline', 
                                                        'data-menu-style' => 'dropdown-blue'
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-1">
                                            <div class="form-group">
                                                {{ Form::label('monto', 'Monto a prestar') }}
                                                {{ Form::number('monto', Null, array('class' => 'form-control', 'min' => '500')) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 pr-1">
                                            <div class="form-group">
                                                {{ Form::label('interes', 'Interés') }}
                                                {{ Form::text('interes', Null, array('class' => 'form-control')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-3 pl-1">
                                            <div class="form-group">
                                                {{ Form::label('cuotas', 'Cuotas') }}
                                                {{ Form::number('cuotas', Null, array('class' => 'form-control')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-3 pl-1">
                                            <div class="form-group">
                                                {{ Form::label('metodo_pago', 'Modalidad Pago') }}
                                                {{Form::select(
                                                    'metodo_pago', ['diario' => 'Diario', 'semanal' => 'Semanal', 'quincenal' => 'Quincenal', 'mensual' => 'Mensual'], null, [
                                                        'class' => 'selectpicker', 
                                                        'data-title' => 'Seleccionar',
                                                        'data-style' => 'btn-default btn-outline', 
                                                        'data-menu-style' => 'dropdown-blue'
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                        <div class="col-md-3 pl-1">
                                            <div class="form-group">
                                                {{ Form::label('fecha', 'Fecha') }}
                                                {{ Form::text('fecha', Null, ['id' =>'datetimepicker', 'class' => 'form-control datepicker']) }}
                                            </div>
                                        </div>
                                    </div>
                                    {{--<div class="row">--}}
                                        {{--<div class="col-md-12">--}}
                                            {{--<h4 class="card-title">Información de Codeudor</h4>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="row c-ffooter">--}}
                                        {{--<div class="col-md-4">--}}
                                            {{--<div class="form-group">--}}
                                                {{--{{ Form::label('codeudor', 'Codeudor') }}--}}
                                                {{--{{ Form::text('codeudor', Null, array('class' => 'form-control')) }}--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-4">--}}
                                            {{--<div class="form-group">--}}
                                                {{--{{ Form::label('cTelefono', 'Teléfono') }}--}}
                                                {{--{{ Form::text('cTelefono', Null, array('class' => 'form-control')) }}--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-4">--}}
                                            {{--<div class="form-group">--}}
                                                {{--{{ Form::label('cDireccion', 'Dirección Codeudor') }}--}}
                                                {{--{{ Form::text('cDireccion', Null, array('class' => 'form-control')) }}--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{ Form::submit('Crear Prestamo', array('class' => 'btn btn-info btn-fill pull-right')) }}
                                    <div class="clearfix"></div>
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
    $('#datetimepicker').datetimepicker({
            format: 'DD/MM/YYYY',
        });
})
</script>
@endsection