@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-danger">
                                    <i class="nc-icon nc-single-02 text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category">Clientes activos</p>
                                    <h4 class="card-title">{{$dashboard->clientes}}</h4>
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
                            <div class="col-5">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-single-copy-04 text-warning"></i>
                                </div>
                            </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">Prestamos activos</p>
                                <h4 class="card-title">{{$dashboard->prestamos}}</h4>
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
                        <div class="col-5">
                            <div class="icon-big text-center icon-success">
                                <i class="nc-icon nc-money-coins text-success"></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">Total prestado</p>
                                <h4 class="card-title">@money($dashboard->totalPrestado.'00', 'USD')</h4>
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
                        <div class="col-5">
                            <div class="icon-big text-center icon-info">
                                <i class="nc-icon nc-chart-bar-32 text-info"></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">Total interes</p>
                                <h4 class="card-title">@money($dashboard->totalInteres.'00', 'USD')</h4>
                            </div>
                        </div>
                    </div>
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
        <div class="card-header ">
            <h4 class="card-title">Cuentas por cobrar</h4>
        </div>
    <div class="card-body ">
        <div class="table-full-width">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Prestamo 001 - cuota No.2 $8,567.56</td>
                        <td class="td-actions text-right">
                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Prestamo 001 - cuota No.2 $8,567.56</td>
                        <td class="td-actions text-right">
                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Prestamo 001 - cuota No.2 $8,567.56</td>
                        <td class="td-actions text-right">
                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection