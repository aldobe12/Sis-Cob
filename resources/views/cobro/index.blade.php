@extends('layouts.app')
@section('content')

    @if ($data = Session::get('response'))
        <script>
            $.notify({
                icon: 'fa fa-user',
                message: '{{$data["message"]}}'

            }, {
                type: '{{$data["type"]}}',
                timer: '3000'
            });
        </script>
    @endif
    @php
        $fecha1= DateTime::createFromFormat('Y-m-d', $fechaDesde)->format('d/m/Y');
        $fecha2 = DateTime::createFromFormat('Y-m-d', $fechaHasta)->format('d/m/Y');
    @endphp

    <ul class="breadcrumb">
        <div class="container-fluid">
            <li class="breadcrumb-item">
                <a href="/dashboard">Inicio</a>
            </li>
            <li class="breadcrumb-item active"> Cobros</li>
        </div>
    </ul>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="title">Cobros - Desde: {{$fecha1}} - Hasta: {{$fecha2}}</h4>

                            </div>

                        </div>


                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Desde</label>
                                    <input id="inputFechaDesde" name="inputFechaDesde" type="date" class="form-control" required>
                                </div>


                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Hasta</label>
                                    <input id="inputFechaHasta" name="inputFechaHasta"  type="date" class="form-control" required>
                                </div>

                            </div>
                            <div class="col-md-4 m-auto align-items-center">
                                <button id="btnConsultar" name="btnConsultar" class=" btn btn-info btn-sm" onclick="Buscar()">Buscar</button>
                            </div>


                        </div>

                    </div>
                </div>
                <div class="card bootstrap-table">
                    <div class="card-body table-full-width">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <table id="bootstrap-table" class="table">
                            <thead>
                            <th data-field="id" class="text-center">ID</th>
                            <th data-field="cliente" data-sortable="true">Cliente</th>
                            <th data-field="fecha" data-sortable="true">Feha Cobro</th>
                            <th data-field="amortizacion" data-sortable="true">Dirección</th>
                            <th data-field="capital" data-sortable="true">Localidad</th>
                            <th data-field="interes" data-sortable="true">Num Cuota</th>
                            <th data-field="periodos" data-sortable="true">Monto Cuota</th>
                            <th data-field="pagos" data-sortable="true">Saldo</th>
                            <th data-field="ppago" data-sortable="true">Atraso</th>
                            <th data-field="actions" class="td-actions">Opción</th>
                            </thead>
                            <tbody>
                            @foreach($cobros as $cobro)
                                <tr onclick="click('{{ $cobro->id }}')">
                                    <td>{{ $cobro->id }}</td>
                                    <td>{{ $cobro->Prestamo2->cliente2->apellido }}
                                        ,{{ $cobro->Prestamo2->cliente2->nombre }}</td>
                                    <td>{{ \Carbon\Carbon::parse($cobro->fecha)->format('d/m/Y') }}</td>
                                    <td>{{ $cobro->Prestamo2->cliente2->direccion }}</td>
                                    <td>{{$cobro->Prestamo2->cliente2->localidades->descripcion}}</td>
                                    <td class="centro">{{ $cobro->num_cuota }}</td>
                                    <td>${{ $cobro->valor_cuota }}</td>
                                    <?php
                                    if ($cobro->Pagos != null) {
                                        $pagos = $cobro->Pagos->sum('capital');
                                    } else {
                                        $pagos = 0;
                                    }

                                    $cantcuota = $cobro->Prestamo2['cuotas'];
                                    $valcuota = $cobro->valor_cuota;
                                    $montodevolver = $valcuota * $cantcuota;
                                    $saldo = $montodevolver - $pagos;

                                    ?>
                                    <td>${{ $saldo}}</td>
                                    <td>${{ $cobro->Pagos != null ? $cobro->Pagos->sum('atraso') : 0 }}</td>
                                    {{--<td>{{ $cobro->estado }}</td>--}}
                                    <td>
                                        <a title="Ver" class="btn btn-link btn-info table-action view"
                                           href="{{ route('prestamos.show', $cobro->id) }}">
                                            <i class="fa fa-image"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col-md-12">
                            <a id="btnImprimir" title="Imprimir cobros" class="btn btn-success btn-block" href="#">Imprimir</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>




    </div>
    <script type="text/javascript">
        var $table = $('#bootstrap-table');

        $().ready(function () {

            $table.bootstrapTable({
                toolbar: ".toolbar",
                clickToSelect: true,
                search: true,
                showToggle: true,
                showColumns: true,
                pagination: true,
                searchAlign: 'left',
                pageSize: 8,
                clickToSelect: false,
                pageList: [8, 10, 25, 50, 100],

                formatShowingRows: function (pageFrom, pageTo, totalRows) {
                    //do nothing here, we don't want to show the text "showing x of y from..."
                },
                formatRecordsPerPage: function (pageNumber) {
                    return pageNumber + " rows visible";
                },
                icons: {
                    refresh: 'fa fa-refresh',
                    toggle: 'fa fa-th-list',
                    columns: 'fa fa-columns',
                    detailOpen: 'fa fa-plus-circle',
                    detailClose: 'fa fa-minus-circle'
                }
            });

            //activate the tooltips after the data table is initialized
            $('[rel="tooltip"]').tooltip();

            $(window).resize(function () {
                $table.bootstrapTable('resetView');
            });

            function click(id) {
                console.log(id);
            }
        });
        // $fechaDesde = null;
        // $fechaHasta = null;
        // $('#inputFechaDesde').on('change', function (e) {
        //     console.log(e.target.value.replace(/-/g, ''));
        //     var fecha = e.target.value.replace(/-/g, '');
        //     $fechaDesde = fecha;
        //     // $('#btnConsultar').attr('href', '/cobros/index/' + $fechaDesde + '/' + $fechaHasta);
        //     $("#btnConsultar").click(function(e){
        //         e.preventDefault();
        //         page(this.href);
        //     });
        // })
        // $('#inputFechaHasta').on('change', function (e) {
        //     console.log(e.target.value.replace(/-/g, ''));
        //     var fecha = e.target.value.replace(/-/g, '');
        //     $fechaHasta = fecha;
        //     $('#btnConsultar').attr('href', '/cobros/index/' + $fechaDesde + '/' + $fechaHasta);
        // })
        function Buscar() {

            fechad= $('#inputFechaDesde').val();
            fechah= $('#inputFechaHasta').val();
            location.href = "/cobros/index/" + fechad + '/' + fechah;
        }

    </script>
    <style>
        .custom {
            width: 78px !important;
        }

        .centro {
            text-align: center;
        }
    </style>
@endsection
