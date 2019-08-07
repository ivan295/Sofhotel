@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
@include('adminlte::alerts.error')
@include('adminlte::alerts.exito')
<label>
    <h3>Parámetros</h3>
</label>
<div class="row">
    <div class="col-md-5">
        <div class="contenedor-modal">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ventana_crear"><span class="glyphicon glyphicon-plus"></span> Agregar Parámetros</button>
        </div>
    </div>
</div>
<br>
<!-- ventana modal -->
<div class="modal fade" id="ventana_crear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Nuevo tipo de usuario</h4>
            </div>
            <div class="modal-body">
                @include('adminlte::alerts.error')
                <form method="post" action="{{route('parametros.create')}}" target="request">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-body">
                        <label for="tipousuario">IVA</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                            <input type="number" class="form-control" name="iva" id="iva" placeholder="IVA %" required>
                        </div>
                        <label for="tipousuario">Precio</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                            <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio habitacion" required>
                        </div>
                        <label for="tipousuario">Tiempo</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                            <input type="text" class="form-control" name="tiempo" id="tiempo" placeholder="Tiempo" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span> Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-md-14">
    <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fa fa-bar-chart"></i>
            <h3 class="box-title" align="text-center">Parámetros</h3>
            <div class="box-tools pull-right">
            </div>
        </div>
        <table class="table table-hover table-bordered" id="tablatipousuario">
            <thead>
                <tr bgcolor="#98A8D5">
                    <th class='text-center'>#</th>
                    <th class="text-center">Iva</th>
                    <th class="text-center">Precio</th>
                    <th class="text-center">Tiempo</th>
                    <th class="text-center">Opción</th>

                </tr>
            </thead>
            <tbody>
                @foreach($parametro as $paramet)
                <tr></tr>
                <tr class='text-center'>
                    <td>{{$paramet->id}}</td>
                    <td>{{$paramet->iva*100}}%</td>
                    <td>$ {{$paramet->precio}}</td>
                    <td>{{$paramet->tiempo}}</td>
                    <td class="text-center">

                        <div class="col-md-3 col-md-offset-3">
                            <form action="{{route ('parametros.editar', $paramet->id)}}" method="post">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
                        </div>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @endsection