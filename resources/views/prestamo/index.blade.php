@extends('layouts.app')
@section('content')

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
        <li class="breadcrumb-item active"> Prestamos</li>
    </div>
</ul>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <div class="row">
                        <div class="col-md-9">
                            <h4 class="title">Prestamos</h4>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('prestamos.create') }}" class="btn btn-outline-round pull-right">Nuevo prestamo</a>
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
                                {{--<th data-field="id" class="text-center">ID</th>--}}
                                <th data-field="cliente" data-sortable="true">Cliente</th>
                                {{--<th data-field="amortizacion" data-sortable="true">Amortización</th>--}}
                                <th data-field="montoprestado" data-sortable="true">Monto Prestado</th>
                                <th data-field="montodevolver" data-sortable="true">Monto a devolver</th>
                                <th data-field="interes" data-sortable="true">Interés</th>
                                <th data-field="periodos" data-sortable="true">Cuotas</th>
                                <th data-field="pagos" data-sortable="true">Pagos</th>
                                <th data-field="ppago" data-sortable="true">Próximo Pago</th>
                                <th data-field="activo" data-sortable="true">Activo</th>
                                <th data-field="actions" class="td-actions">Opción</th>
                            </thead>
                            <tbody>
                                @foreach($prestamos as $prestamo)
                                   <tr onclick="click('{{ $prestamo->id }}')">
{{--                                        <td>{{ $prestamo->id }}</td>--}}
                                        <td>{{ $prestamo->cliente->nombre }} {{ $prestamo->cliente->apellido }}</td>
{{--                                        <td>{{ $prestamo->amortizacion }}</td>--}}
                                        <td>${{ $prestamo->monto }}</td>
                                       <?php
                                       $cantcuota= $prestamo->cuotas;
                                       $valcuota= $prestamo->fechascobro->valor_cuota;
                                       $montodevolver = $valcuota * $cantcuota;
                                       ?>
                                        <td>${{$montodevolver}}</td>
                                        <td>{{ $prestamo->interes }} %</td>
                                        <td>{{ $prestamo->cuotas }}</td>
                                        <td>{{ $prestamo->metodo_pago }}</td>
                                        <td>{{ $prestamo->fecha }}</td>
                                        <td>{{ $prestamo->estado }}</td>
                                        <td>
                                            <a title="Ver" class="btn btn-link btn-info table-action view" href="{{ route('prestamos.show', $prestamo->id) }}">
                                                <i class="fa fa-image"></i>
                                            </a>
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
<script type="text/javascript">
    var $table = $('#bootstrap-table');

    $().ready(function() {

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

            formatShowingRows: function(pageFrom, pageTo, totalRows) {
                //do nothing here, we don't want to show the text "showing x of y from..."
            },
            formatRecordsPerPage: function(pageNumber) {
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

        $(window).resize(function() {
            $table.bootstrapTable('resetView');
        });

function click(id) {
    console.log(id);
}
    });
</script>
@endsection
