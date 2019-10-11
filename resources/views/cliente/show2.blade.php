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
            <a href="/clientes">Cliente</a>
        </li>
        <li class="breadcrumb-item active"> Detalles</li>
    </div>
</ul>
<div class="content">
    <div class="container-fluid">
        <div class="row">
{{--            <div class="col-md-3">--}}
{{--                <div class="card card-user c-user">--}}
{{--                    <div class="avatar-view">--}}
{{--                        <div class="avatar-preview">--}}
{{--                            <div id="imagePreview" style="background-image: url('{{asset('avatars/'.$cliente->cliente->avatar)}}');"></div>--}}
{{--                        </div>--}}
{{--                        <h3>{{$cliente->cliente->nombre}} {{$cliente->cliente->apellido}}</h3>--}}
{{--                        <span>{{$cliente->cliente->tel}}</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="textNegritas">Apellido</td>
                                        <td>{{$cliente->apellido}}</td>
                                    </tr>

                                    <tr>
                                        <td class="textNegritas">DNI</td>
                                        <td>{{$cliente->dni}}</td>
                                    </tr>
                                    <tr>
                                        <td class="textNegritas">Estado Civil</td>
                                        <td>{{$cliente->estadocivil}}</td>
                                    </tr>
                                    <tr>
                                        <td class="textNegritas">Dirección</td>
                                        <td>{{$cliente->direccion}}</td>
                                    </tr>
                                    <tr>
                                        <td class="textNegritas">Telefono</td>
                                        <td>{{$cliente->telefono}}</td>
                                    </tr>
                                    <tr>
                                        <td class="textNegritas">Fecha de Alta</td>
                                        <td>{{$cliente->created_at}}</td>
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
                                        <td class="textNegritas">Nombre</td>
                                        <td>{{$cliente->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td class="textNegritas">Fecha de Nacimiento</td>
                                        <td>{{$cliente->fechaN}}</td>
                                    </tr>
                                    <tr>
                                        <td class="textNegritas">Sexo</td>
                                        <td>{{$cliente->sexo == 'm' ? 'Masculino' : 'Femenino'}}</td>
                                    </tr>
                                <tr>
                                    <td class="textNegritas">Localidad</td>
                                    <td>{{$cliente->localidades->descripcion}}</td>
                                </tr>
                                <tr>
                                    <td class="textNegritas">Email</td>
                                    <td>{{$cliente->email}}</td>
                                </tr>
                                <tr>
                                    <td class="textNegritas">Generado por</td>
                                    <td>{{$cliente->user->lastname}}, {{$cliente->user->name}}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
    <style>
        .textNegritas {
            font-weight: bold;
            font-size: 15px;
        }
    </style>
@endsection
