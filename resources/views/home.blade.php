@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Listado de Ejemplares</div>
                <div class="panel-body">
                    <div class="col-md-4 col-md-offset-8">
                        <a class="btn btn-primary btn-block" href='/ejemplares/create'>Agregar Nueva Ejemplar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection