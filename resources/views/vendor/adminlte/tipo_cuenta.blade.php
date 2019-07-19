@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
@include('adminlte::alerts.error')
  @include('adminlte::alerts.exito')
<label ><h3>Tipos de cuentas</h3></label>
<div class="row">
  <br>
  <div class="col-md-5">
  <form method="GET"  action="{{route('tipo_cuenta.index')}}" >
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="input-group input-group-flat">
      <input type="text" class="form-control" name="tipo" id="tipo" placeholder="Busqueda por tipo de cuenta">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Buscar</button>
      </span>
    </div>
  </form>
</div>
 <div class="contenedor-modal">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ventana_crear"><span class="glyphicon glyphicon-plus"></span> Agregar Tipo de Cuenta</button>
  </div>
</div>
<br>
<!--ventana modal-->
<div class="modal fade" id="ventana_crear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Nuevo tipo de cuenta</h4>
      </div>
      <div class="modal-body">
       @include('adminlte::alerts.error')

        <form method="post"  action="{{route('tipo_cuenta.create')}} ">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="box-body">
            <label for="descripcion">Descripción</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
              <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción" required>
            </div>
            <br>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span> Guardar</button>  
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- datos -->
<div class="col-md-14">
  <div class="box box-primary">
   <div class="box-header with-border">
    <i class="fa fa-bar-chart"></i>
    <h3 class="box-title" align="text-center">Tipos de cuentas</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <table class="table table-hover table-bordered" id="tablatipousuario">
    <thead>
      <tr bgcolor="#98A8D5">
        <th class='text-center'>#</th>
        <th class="text-center">Descripcion</th>
        <th class="text-center">Acción</th>
      </tr>
    </thead>
    <tbody>
      <tr></tr>
      @foreach($tipo_cuenta as $tp)
      <tr class='text-center'>
        <td><?php echo $tp->id?></td>
        <td><?php echo $tp->descripcion?></td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-3">
             <form action="{{route ('tipo_cuenta.cambio', $tp->id)}}" method="post">
              {{csrf_field()}}
              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
            </div>
            <div class="col-md-6 text-left">
              <form action="{{route('tipo_cuenta.delete', $tp->id)}}" method="post">
                {{csrf_field()}}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger btn-xs"onclick="return borrar()">Borrar</button>
              </form>
            </form>
          </div>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<script src="{{ asset('/js/alerta_confirmacion.js') }}" defer></script>

@endsection