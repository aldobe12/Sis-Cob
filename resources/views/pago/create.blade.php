@extends('layouts.app')
@section('content')
<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="section-image" data-image="../../assets/img/bg5.jpg">
            <div class="container">
                {{ Form::open(array('route' => 'pagos.store', 'files'=>true,'class'=>'form')) }}
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
                                                {{ Form::label('fecha_pago', 'Fecha Pago') }}
                                                {{ Form::text('fecha_pago', '', ['id' =>'datetimepicker', 'class' => 'form-control datepicker']) }}
                                                {{ Form::hidden('prestamo_id', $data['prestamo']) }}
                                                {{ Form::hidden('cuota', $data['num'] + 1) }}
                                            </div>
                                        </div>
                                        <div class="col-md-3 px-1">
                                            <div class="form-group">
                                                {{ Form::label('capital', 'Capital') }}
                                                {{ Form::number('capital', '', array('class' => 'form-control', 'min' => '500')) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 pr-1">
                                            <div class="form-group">
                                                {{ Form::label('interes', 'Interés') }}
                                                {{ Form::number('interes', '', array('class' => 'form-control')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-1">
                                            <div class="form-group">
                                                {{ Form::label('mora', 'Mora') }}
                                                {{ Form::number('mora', '', array('class' => 'form-control', 'min' => '0')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-1">
                                            <div class="form-group">
                                                {{ Form::label('forma_pago', 'Modalidad Pago') }}
                                                {{Form::select(
                                                    'forma_pago', ['efectivo' => 'Efectivo', 'cheque' => 'Cheque', 'dt' => 'Depósito / Transferencia'], null, [
                                                        'class' => 'selectpicker', 
                                                        'data-title' => 'Seleccionar',
                                                        'data-style' => 'btn-default btn-outline', 
                                                        'data-menu-style' => 'dropdown-blue'
                                                    ])
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row c-ffooter">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                {{ Form::label('nota', 'Nota') }}
                                                {{ Form::textarea('nota', null, ['class' => 'form-control']) }}
                                            </div>
                                        </div>
                                    </div>
                                    {{ Form::submit('Pagar', array('class' => 'btn btn-info btn-fill pull-right')) }}
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
$(document).ready(function(){
    $('#datetimepicker').datetimepicker({
            format: 'DD/MM/YYYY',
            minDate: 'now',
        });
})
</script>
@endsection