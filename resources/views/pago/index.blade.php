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
        $fecha1= DateTime::createFromFormat('Ymd', $fechaDesde)->format('d/m/Y');
        $fecha2 = DateTime::createFromFormat('Ymd', $fechaHasta)->format('d/m/Y');
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
                                <h4 class="title">Listar Cobros - Desde: {{$fecha1}} - Hasta: {{$fecha2}}</h4>

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
                <div class="col-md-12 card bootstrap-table">
                    <div class="card-body table-full-width">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <table id="bootstrap-table" class="table">
                            <thead>
                            {{--                            <th data-field="id" class="text-center">ID</th>--}}
                            <th data-field="cliente" data-sortable="true">Cliente</th>
                            <th data-field="fecha" data-sortable="true">Feha Pago</th>
                            <th data-field="interes" data-sortable="true">Num Cuota</th>
                            <th data-field="periodos" data-sortable="true">Monto</th>
                            <th data-field="pagos" data-sortable="true">Saldo</th>
                            <th data-field="estado" data-sortable="true">Usuario</th>
                            <th data-field="actions" class="td-actions">Opción</th>
                            </thead>
                            <tbody>
                            @foreach($pagos as $pago)
                                <tr onclick="click('{{ $pago->id }}')">
                                    {{--                                    <td>{{ $pago->id }}</td>--}}
                                    <td>{{ $pago->FechaCobro->Prestamo2->cliente2->apellido }}
                                        ,{{ $pago->FechaCobro->Prestamo2->cliente2->nombre }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                                    <td>{{ $pago->FechaCobro->num_cuota }}</td>
                                    <td>${{$pago->capital}}</td>
                                    <td>${{ $pago->atraso }}</td>
                                    <td>{{$pago->user->lastname}}, {{$pago->user->name}}</td>
                                    <td>
                                        <a title="Ver" class="btn btn-link btn-info table-action view"
                                           href="{{ route('prestamos.show', $pago->FechaCobro->Prestamo2->id) }}">
                                            <i class="fa fa-image"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(count($pagos) >0)
                            <div class="col-md-12">
                                <div class="container text-center">
                                    <h5>Total cobrado:</h5><h2>${{$pagoTotal}}</h2>
                                </div>

                            </div>
{{--                            <div class="col-md-12">--}}
{{--                                <a id="btnImprimir"  title="Imprimir pagos" class="btn btn-secondary btn-block" href="#">Imprimir</a>--}}
{{--                            </div>--}}

                        @endif

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
                formatNoMatches: function () {
                    return '';
                },
                exportOptions: {
                    fileName: function () {
                        return 'exportName'
                    }
                },
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
                language: {
                    zeroRecords: "No se registran datos"
                },
                icons: {
                    refresh: 'fa fa-refresh',
                    toggle: 'fa fa-th-list',
                    columns: 'fa fa-columns',
                    detailOpen: 'fa fa-plus-circle',
                    detailClose: 'fa fa-minus-circle',
                    export: 'glyphicon-export icon-share'
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
        //     // $('#btnConsultar').attr('href', '/pagos/index/' + $fechaDesde + '/' + $fechaHasta);
        //     $("#btnConsultar").click(function(e){
        //         e.preventDefault();
        //         page(this.href);
        //     });
        // })
        // $('#inputFechaHasta').on('change', function (e) {
        //     console.log(e.target.value.replace(/-/g, ''));
        //     var fecha = e.target.value.replace(/-/g, '');
        //     $fechaHasta = fecha;
        //     $('#btnConsultar').attr('href', '/pagos/index/' + $fechaDesde + '/' + $fechaHasta);
        // })
        function Buscar() {

            fechad= $('#inputFechaDesde').val();
            fechah= $('#inputFechaHasta').val();
            if(fechad !== '' && fechah !== ''){
                location.href = "/pagos/index/" + fechad + '/' + fechah;
            }
            else if(fechad === '' && fechah !== ''){
                // toastr.info('SE AGREGO EXITOSAMENTE LA GESTION A LA SOLICITUD');
                alert('Ingrese Fecha desde');
            }
            else if(fechah === '' && fechad !== ''){
                alert('Ingrese Fecha hasta');
            }
            else{
                alert('Ingresar fecha desde y hasta');
            }



        }

    </script>
    <style>
        .custom {
            width: 78px !important;
        }

        .centro {
            text-align: center;
        }
        .red{
            style: color #EE2D20;
        }


    </style>
@endsection
