@extends('layouts.app')
@section('content')

@if ($message = Session::get('success'))
    <script>
        $.notify({
            icon: 'fa fa-user',
            message: '{{$message}}'

        },{
            type: 'success',
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
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url('{{asset('avatars/'.$prestamo->cliente->avatar)}}');"></div>
                        </div>
                        <h3>{{$prestamo->cliente->nombre}} {{$prestamo->cliente->apellido}}</h3>
                        <span>{{$prestamo->cliente->tel}}</span>
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
                                        <td>Capital Actual</td>
                                        <td>@money($prestamo->monto_actual.'00', 'USD')</td>
                                    </tr>
                                    <tr>
                                        <td>Fecha</td>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Capital Inicial</td>
                                        <td>@money($prestamo->monto.'00', 'USD')</td>
                                    </tr>
                                    <tr>
                                        <td>Interés</td>
                                        <td>{{$prestamo->interes}}</td>
                                    </tr>
                                    <tr>
                                        <td>Modalidad Pago</td>
                                        <td>{{$prestamo->metodo_pago}}</td>
                                    </tr>
                                    <tr>
                                        <td>Próximo Pago</td>
                                        <td>{{$prestamo->monto}}</td>
                                    </tr>
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
                            <a href="{{ route('pagos.create', $prestamo->id) }}" class="btn btn-success btn-wd">Agregar pago</a>
                            <a href="{{ route('prestamos.edit', $prestamo->id) }}" class="btn btn-simple btn-link btn-wd">Editar</a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['prestamos.destroy', $prestamo->id], 'class' => 'btn btn-simple btn-link btn-wd' ]) !!}
                            {!! Form::submit('Cancelar Prestamo', ['class' => 'btn btn-simple btn-link btn-wd red']) !!}
                            {!! Form::close() !!}
                            <a href="#amortizacion" class="btn btn-simple btn-link btn-wd">Amortización</a>
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
                                           <td>${{$fechaco->Pagos->monto}}</td>
                                           @else
                                           <td>$0</td>
                                           @endif
                                       @if($fechaco->Pagos)
                                           <td>${{$fechaco->Pagos->deuda}}</td>
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



                                           <button href="{{ route('pagos.create', $fechaco->id) }}" class="btn btn-success btn-sm">Pagar</button>


                                       @endif
                                       <button href="{{ route('pagos.create', $fechaco->id) }}" class="btn btn-info  btn-sm"><i class="fa fa-eye"></i></button>
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
@endsection
