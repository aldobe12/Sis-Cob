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

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Usuario</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('usuarios.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="header">
                <img src="{{asset('avatars/'.$usuario->avatar)}}" />
            </div>
            {{$usuario->nombre}} {{$usuario->apellido}}
            <a class="btn btn-primary" href="{{ route('$usuarios.edit',$usuario->id) }}">Edit</a>
        </div>
    </div>
@endsection
