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
        <li class="breadcrumb-item active"> pagos</li>
    </div>
</ul>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <div class="row">
                        <div class="col-md-9">
                            <h4 class="title">pagos</h4>
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
                                <th data-field="fecha" class="text-center">Fecha</th>
                                <th data-field="capital" data-sortable="true">Capital</th>
                                <th data-field="interes" data-sortable="true">Interés</th>
                                <th data-field="mora" data-sortable="true">Mora</th>
                                <th data-field="totalpago" data-sortable="true">Total Pago</th>
                                <th data-field="formapago" data-sortable="true">Forma Pago</th>
                                <th data-field="estado" data-sortable="true">Estado</th>
                                <th data-field="actions" class="td-actions"></th>
                            </thead>
                            <tbody>
                                @foreach($pagos as $pago)
                                   <tr onclick="click('{{ $pago->id }}')">
                                        <td>{{ $pago->fecha_pago }}</td>
                                        <td>@money($pago->capital.'00', 'USD')</td>
                                        <td>@money($pago->interes.'00', 'USD')</td>
                                        <td>@money($pago->mora.'00', 'USD')</td>
                                        <td>@money($pago->capital + $pago->interes + $pago->mora.'00', 'USD')</td>
                                        <td>{{ $pago->forma_pago }}</td>
                                        <td>{{ $pago->estado }}</td>
                                        <td>
                                            <a title="Ver" class="btn btn-link btn-info table-action view" href="{{ route('prestamos.show', $pago->prestamo_id) }}">
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
                return pageNumber + "Renglones visibles";
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
