@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-4">
                                    <div class="icon-big text-center icon-danger">
                                        <i class="nc-icon nc-single-02 text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="numbers">
                                        <a href="/clientes">
                                            <p class="card-category">Clientes activos</p>
                                            <h4 class="card-title">{{$dashboard->clientes}}</h4>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-single-copy-04 text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="numbers">
                                        <a href="/prestamos">
                                            <p class="card-category">Prestamos activos</p>
                                            <h4 class="card-title">{{$dashboard->prestamos}}</h4>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-4">
                                    <div class="icon-big text-center icon-success">
                                        <i class="nc-icon nc-money-coins text-success"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="numbers">
                                        <a href="/cobros/index">
                                            <p class="card-category">Total Prestado</p>
                                            <h4 class="card-title">
                                                ${{number_format($dashboard->totalPrestado, 2, ',', '.')}}</h4>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <a href="/pagos/index">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="icon-big text-center icon-info">
                                            <i class="nc-icon nc-bank text-info"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="numbers">

                                            <p class="card-category">Total Pagos</p>
                                            <h4 class="card-title">
                                                ${{number_format($dashboard->totalInteres, 2, ',', '.')}}</h4>


                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">Ingresos</h4>
                        </div>
                        <div class="card-body ">
                            <div id="chartActivity" class="ct-chart"></div>
                        </div>
                        <div class="card-footer ">
                            <div class="legend">
                                <i class="fa fa-circle text-info"></i> Prestamos
                                <i class="fa fa-circle text-danger"></i> Intereses
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card  card-tasks">
                        <a href="/cobros/index">
                            <div class="card-header ">
                                <h4 class="card-title">Cuentas por cobrar: {{$dashboard->fecha}}</h4>
                            </div>
                            <div class="card-body ">

                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody>
                                        @foreach($dashboard->cuentasCobrar as $cuentas)
                                            <tr>
                                                <td>Prestamo {{$cuentas->prestamo_id}} - cuota
                                                    No.{{$cuentas->num_cuota}} $ {{$cuentas->valor_cuota}}</td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Edit Task"
                                                            class="btn btn-info btn-simple btn-link">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
                <div class="cold-block d-sm-block d-md-none col-md-12">

                                            <a href="/logout" class="btn btn-danger btn-lg btn-block text-white" role="button">
                                                <i class="nc-icon nc-button-power"></i> Cerrar sesión
                                            </a>
                </div>


@endsection