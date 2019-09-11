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
                            <h4 class="title">Usuarios</h4>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('usuarios.create') }}" class="btn btn-outline-round pull-right">Nuevo Usuario</a>
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
                                <th data-field="lastname" data-sortable="true">Apellido</th>
                                <th data-field="name" data-sortable="true">Nombre</th>
                                <th data-field="role" data-sortable="true">Rol</th>
                                <th data-field="email" data-sortable="true">Email</th>
                                <th data-field="created_at" data-sortable="true">Fecha de Alta</th>
                                {{--<th data-field="dni" data-sortable="true">DNI</th>--}}
                                {{--<th data-field="direccion" data-sortable="true">Dirección</th>--}}
                                {{--<th data-field="localidad" data-sortable="true">Localidad</th>--}}
                                {{--<th data-field="provincia" data-sortable="true">Provincia</th>--}}
                                {{--<th data-field="telefono" data-sortable="true">Telefono</th>--}}
                                {{--<th data-field="email" data-sortable="true">Email</th>--}}
                                <th data-field="actions" class="td-actions">Opción</th>
                            </thead>
                            <tbody>
                                @foreach($usuarios as $usuario)
                                   <tr onclick="click('{{ $usuario->id }}')">
                                        <td>{{ $usuario->id }}</td>
                                        <td>{{ $usuario->lastname }}</td>
                                        <td>{{ $usuario->name}}</td>
                                        <td>{{ $usuario->roles->first()->description}}</td>
                                        {{--<td>@money($usuario->monto.'00', 'USD')</td>--}}
                                        <td>{{ $usuario->email }}</td>
                                        <td>{{ $usuario->created_at }}</td>
                                        {{--<td>{{ $usuario->localidad }}</td>--}}
                                        {{--<td>Tucuman</td>--}}
                                        {{--<td>{{ $usuario->telefono }}</td>--}}
                                        {{--<td>{{ $usuario->email }}</td>--}}
                                        {{--<td>{{ $usuario->estado }}</td>--}}
                                        <td>
                                            <a title="Ver" class="btn btn-link btn-info table-action view" href="{{ route('usuarios.show', $usuario->id) }}">
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
