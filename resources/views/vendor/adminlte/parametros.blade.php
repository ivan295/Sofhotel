@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
@include('adminlte::alerts.error')
@include('adminlte::alerts.exito')
<label>
    <h3>IVA</h3>
</label>
<div class="row">
    <div class="col-md-5">
        <div class="contenedor-modal">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ventana_crear"><span class="glyphicon glyphicon-plus"></span> Agregar IVA</button>
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
                <h4 class="modal-title" id="myModalLabel">Porcentajes de IVA</h4>
            </div>
            <div class="modal-body">
                @include('adminlte::alerts.error')
                <form method="post" action="{{route('iva.create')}}" target="request">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-body">
                        <label for="tipousuario">IVA</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                            <input type="number" class="form-control" name="iva" id="iva" placeholder="IVA %" required>
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
            <h3 class="box-title" align="text-center">IVA</h3>
            <div class="box-tools pull-right">
            </div>
        </div>
        <table class="table table-hover table-bordered" id="tablatipousuario">
            <thead>
                <tr bgcolor="#98A8D5">
                    <th class='text-center'>#</th>
                    <th class="text-center">IVA</th>
                    <th class="text-center">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($iva as $i)
                <tr></tr>
                <tr class='text-center'>
                    <td>{{$i->id}}</td>
                    <td>{{round($i->valor)}}%</td>
                    <td class="text-center">
                         <div class="row">
                            <div class="col-md-3 col-md-offset-3">
                             <form action="{{route ('iva.editar', $i->id)}}" method="post">
                              {{csrf_field()}}
                              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
                            </div>
                            <div class="col-md-6 text-left">
                              <form action="{{route('iva.delete', $i->id)}}" method="post">
                                {{csrf_field()}}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-xs" onclick="return borrar()">Borrar</button>
                              </form>
                           
                          </div>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @endsection