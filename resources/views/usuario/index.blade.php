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

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <div class="row">
                        <div class="col-md-9">
                            <h4 class="title">Lista de Usuarios</h4>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('usuarios.create') }}" class="btn btn-outline-round pull-right">Nuevo Usuario</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($usuarios as $usuario)
                        <div class="col-lg-3 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-body card-custom">
                                    {{--<a href="{{ route('usuarios.edit',$usuarios->id) }}">--}}
                                        <div class="header">
                                            {{--<img src="{{asset('avatars/'.$usuarios->avatar)}}" />--}}
                                        </div>
                                        <strong>{{$usuarios->name}} {{$usuarios->lastname}}</strong>
                                    </a>
                                    <div class="footer c-footer">
                                        <a rel="tooltip" title="ver prestamos" class="btn btn-simple btn-link btn-wd">Prestamos</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($usuarios->lastPage() > 1)
                        <ul class="pagination pagination-no-border">
                            <li class="page-item {{ ($usuarios->currentPage() == 1) ? ' disabled' : '' }}">
                                <a href="{{ $usuarios->url(1) }}" class="page-link">«</a>
                            </li>
                            @for ($i = 1; $i <= $usuarios->lastPage(); $i++)
                                <li class="page-item {{ ($usuarios->currentPage() == $i) ? ' active' : '' }}">
                                    <a href="{{ $usuarios->url($i) }}" class="page-link">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item {{ ($usuarios->currentPage() === $usuarios->lastPage()) ? ' disabled' : '' }}">
                                <a href="{{ $usuarios->url($usuarios->lastPage()) }}" class="page-link">»</a>
                            </li>
                        </ul>
                    @endif
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Buscar Usuarios",
            }

        });
    });
</script>
@endsection
