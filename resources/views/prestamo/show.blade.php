@extends('layouts.app')
@section('content')
{{--    @include('pago.modal_pago')--}}

{{--    @if ($message = Session::get('success'))--}}
{{--        <script>--}}
{{--            $.notify({--}}
{{--                icon: 'fa fa-user',--}}
{{--                message: '{{$message}}'--}}

{{--            }, {--}}
{{--                type: 'success',--}}
{{--                timer: '3000'--}}
{{--            });--}}
{{--        </script>--}}
{{--    @endif--}}
@if ($data = Session::get('response'))
    <script>
        $.notify({
            icon: 'fa fa-user',
            message: '{{$data["message"]}}'

        },{
            type: '{{$data["type"]}}',
            timer: '3000'
        });
    </script>
@endif

    <ul class="breadcrumb">
        <div class="container-fluid">
            <li class="breadcrumb-item">
                <a href="/dashboard">Inicio</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/prestamos">Prestamos</a>
            </li>
            <li class="breadcrumb-item active"> Detalles</li>
        </div>
    </ul>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-user c-user">
                        <div class="avatar-view">
                            @if($prestamo->cliente->sexo == 'm' )
                                <div class="avatar-preview">
                                    <div id="imagePreview"
                                         style="background-image: url('{{asset('avatars/'.'man.png')}}');"></div>
                                </div>
                                @else
                                <div class="avatar-preview">
                                    <div id="imagePreview"
                                         style="background-image: url('{{asset('avatars/'.'woman.png')}}');"></div>
                                </div>
                                @endif

                            <h3>{{$prestamo->cliente->nombre}} {{$prestamo->cliente->apellido}}</h3>
                                <a title="Llamar" href="tel:{{$prestamo->cliente->telefono}}"><i class="fa fa-phone" aria-hidden="true"></i> {{$prestamo->cliente->telefono}}</a>

                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-full-width">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>Monto prestado</td>
                                        {{--                                        <td class="textNegritas">@money($prestamo->monto.'00', 'USD')</td>--}}
                                        <td class="textNegritas">${{$prestamo->monto}}</td>
                                    </tr>
                                    <tr>
                                        <td>Fecha de creación</td>
                                        <td>{{$prestamo->fecha}}</td>
                                    </tr>
                                    <tr>
                                        <td>Amortización</td>
                                        <td>{{$prestamo->amortizacion}}</td>
                                    </tr>
                                    <tr>
                                        <td>Cuotas</td>
                                        <td>{{$prestamo->cuotas}}</td>
                                    </tr>
                                    <?php
                                    $idfechacobro = App\FechasCobro::where('prestamo_id',$prestamo->id)->pluck('id');
                                    $montoatraso =  App\Pago::whereIn('fecha_cobro_id',$idfechacobro)->sum('atraso');

                                    ?>
                                    <tr>
                                        <td>Atraso</td>
                                        @if($montoatraso > 0)
                                            <td class="textNegritasRed">${{$montoatraso}}</td>
                                            @else
                                            <td>${{$montoatraso}}</td>
                                            @endif

                                    </tr>
                                    <tr>
                                        <td>Generado por</td>
                                        <td>{{$prestamo->user->lastname}}, {{$prestamo->user->name}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-full-width">
                                <table class="table">
                                    <tbody>
                                    <?php
                                    $cantcuota = $prestamo->cuotas;
                                    $valcuota = $prestamo->fechascobro->valor_cuota;
                                    $montodevolver = $valcuota * $cantcuota;
                                    ?>
                                    <tr>
                                        <td>Monto a devolver</td>
                                        <td>@money($montodevolver.'00', 'USD')</td>
                                    </tr>
                                    <tr>
                                        <td>Interés</td>
                                        <td>{{$prestamo->interes}}%</td>
                                    </tr>
                                    <tr>
                                        <td>Modalidad Pago</td>
                                        <td>{{$prestamo->metodo_pago}}</td>
                                    </tr>
                                    <?php
                                    //                                $cantcuota= $prestamo->cuotas;
                                    $valcuota = $prestamo->fechascobro->valor_cuota;
                                    $montodevolver = $valcuota;
                                    ?>
                                    <tr>
                                        <td>Monto de cuota</td>
                                        <td>@money($valcuota.'00', 'USD')</td>
                                    </tr>
                                    <tr>
                                        <td>Pagado</td>
                                        <td>${{$pago}}</td>
                                    </tr>
                                    {{--                                <tr>--}}
                                    {{--                                    <td>Ganancia</td>--}}
                                    {{--                                    <td>@money($valcuota.'00', 'USD')</td>--}}
                                    {{--                                </tr>--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <div class="card-body">
                                {{--                            <a href="{{ route('pagos.create', $prestamo->id) }}" class="btn btn-success btn-wd">Agregar pago</a>--}}
                                <a href="{{ route('prestamos.edit', $prestamo->id) }}" class="btn btn-success btn-wd">Editar</a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['prestamos.destroy', $prestamo->id], 'class' => 'btn btn-simple btn-link btn-wd' ]) !!}
                                {!! Form::submit('Cancelar Prestamo', ['class' => 'btn btn-simple btn-link btn-wd red']) !!}
                                {!! Form::close() !!}
                                {{--                            <a href="#amortizacion" class="btn btn-simple btn-link btn-wd">Amortización</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-plain table-plain-bg">
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <th>Num cuota</th>
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th>Pago</th>
                                <th>Deuda</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                                </thead>
                                <tbody>
                                @foreach($fechacobro as $fechaco)
                                    <tr onclick="click('{{ $prestamo->id }}')">
                                        <td>{{ $fechaco->num_cuota }}</td>
                                        <td>{{ \Carbon\Carbon::parse($fechaco->fecha)->format('d/m/Y')}}</td>
                                        <td>${{$fechaco->valor_cuota ?? '0'}}</td>
                                        @if($fechaco->Pagos)
                                            <td>${{$fechaco->Pagos->capital}}</td>
                                        @else
                                            <td>$0</td>
                                        @endif
                                        @if($fechaco->Pagos)
                                            <td>${{$fechaco->Pagos->atraso}}</td>
                                        @else
                                            <td>$0</td>
                                        @endif

                                        {{--<td>0</td>--}}
                                        {{--<td>0</td>--}}
                                        @if($fechaco->estadocuota_id != 1)
                                            <td>{{$fechaco->Estados->descripcion}}</td>
                                        @else
                                            <td style="color: #ff0000;">{{$fechaco->Estados->descripcion}}</td>
                                        @endif
                                        {{--<td>--}}
                                        {{--{!! Form::open(['method' => 'DELETE','route' => ['pagos.destroy', $fechaco->id],'style'=>'display:inline']) !!}--}}
                                        {{--{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}--}}
                                        {{--{!! Form::close() !!}--}}
                                        {{--</td>--}}
                                        <td>
                                            @if($fechaco->estadocuota_id == 1)



                                                <a onclick="abrirModalPago({{$fechaco->id}},{{$fechaco->valor_cuota}},{{$fechaco->num_cuota}})"

                                                        class="text-white btn btn-success btn-sm">Pagar
                                                </a>

@else
                                                <button href="#" class="btn btn-info  btn-sm"><i class="fa fa-eye"></i>
                                                </button>
                                            @endif


                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="pagosModal" tabindex="-1" role="dialog" aria-labelledby="pagosModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="pagosModalLabel">Pagar cuota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('pagos.store')}}" method="POST" >
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>N° de cuota</label>
                                <input  readonly="true" id="numcuota" name="numcuota" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Monto</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        $
                                    </div>
                                <input  readonly="true" id="montocuota" name="montocuota" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Monto a abonar</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        $
                                    </div>
                                    <input type="number" autofocus min="1" step="any" id="capital" name="capital" class="form-control" value="" onkeyup="CalculateSaldo()">
                                </div>
{{--                                <input type="number" min="1" step="any" id="capital" name="capital" class="form-control" value="" onkeyup="CalculateSaldo()">--}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Saldo</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        $
                                    </div>
                                <input readonly="true" id="saldo" name="saldo" class="form-control" value="">
                                </div>
                            </div>
                        </div>

                        <input hidden id="idfechacobro" name="idfechacobro" value="">

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Observación</label>
                                <input  id="observacion" name="observacion" class="form-control" value="">
                            </div>
                        </div>


                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnsaldo" class="btn btn-info">Confirmar</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

    });

    function abrirModalPago(id,valorcuota,numcuota) {
        // plan = $('#').value();
        // alert('Id es: '+id+' valor de la cuotas es:'+valorcuota);
        var idfecha = id;
        $('#idfechacobro').val(id);
        $('#montocuota').val(valorcuota);
        $('#numcuota').val(numcuota);
        $( "#capital" ).val('');
        $('#btnsaldo').hide();


        // $('#datosplanwsp').attr('value', plan);
        $('#pagosModal').modal('show');
    }
    function CalculateSaldo() {
        var monto = $('#capital').val();
        var valcuota = $('#montocuota').val();
        if(monto !== ''){
            var result = parseInt(valcuota - monto);
            // alert(result);
            $('#saldo').val(result);
            $('#btnsaldo').show();
        }
        else{
            $('#btnsaldo').hide();
            $('#saldo').val('');
        }

    }
    // $('#btnsaldo')
    //     .on('click', function (e) {
    //         console.log('clickAddPago');
    //         var id = $('#idfechacobro').val();
    //
    //         e.preventDefault();
    //         $.ajax({
    //             url: '/pago/addpago/',
    //             type: 'POST',
    //             data: $('#pagoForm').serialize(),
    //             success: function (data) {
    //                 // $('#pagosModal').modal('hide')
    //
    //                 $.notify({
    //                     // options
    //                     message: data
    //                 },{
    //                     // settings
    //                     type: 'success'
    //                 });
    //                 actualizarPagina();
    //
    //                 // alert(data);
    //                 // window.history.go(-2)
    //
    //
    //                 // toastr.info('SE REGISTRO EXITOSAMENTE EL PAGO');
    //
    //
    //             },
    //             error: function (error) {
    //                 // toastr.error('Error');
    //             }
    //         });
    //
    //     });
function actualizarPagina() {
    location.reload();
}
</script>

<style>
        .textNegritas {
            font-weight: bold;
            font-size: 15px;
        }
        .textNegritasRed {
            color: red;
            font-weight: bold;
            font-size: 15px;
        }
    </style>
@endsection
