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
                            <h4 class="title">Lista de clientes</h4>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('clientes.create') }}" class="btn btn-outline-round pull-right">Nuevo Cliente</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($clientes as $cliente)
                        <div class="col-lg-3 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-body card-custom">
                                    <a href="{{ route('clientes.edit',$cliente->id) }}">
                                        {{--<div class="header">--}}
                                            {{--<img src="{{asset('avatars/'.$cliente->avatar)}}" />--}}
                                        {{--</div>--}}
                                        <strong>{{$cliente->nombre}} {{$cliente->apellido}}</strong>
                                    </a>
                                    <div class="footer c-footer">
                                        <a rel="tooltip" title="ver prestamos" class="btn btn-simple btn-link btn-wd">Prestamos</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($clientes->lastPage() > 1)
                        <ul class="pagination pagination-no-border">
                            <li class="page-item {{ ($clientes->currentPage() == 1) ? ' disabled' : '' }}">
                                <a href="{{ $clientes->url(1) }}" class="page-link">«</a>
                            </li>
                            @for ($i = 1; $i <= $clientes->lastPage(); $i++)
                                <li class="page-item {{ ($clientes->currentPage() == $i) ? ' active' : '' }}">
                                    <a href="{{ $clientes->url($i) }}" class="page-link">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item {{ ($clientes->currentPage() === $clientes->lastPage()) ? ' disabled' : '' }}">
                                <a href="{{ $clientes->url($clientes->lastPage()) }}" class="page-link">»</a>
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
                searchPlaceholder: "Buscar clientes",
            }

        });
    });
</script>
@endsection
