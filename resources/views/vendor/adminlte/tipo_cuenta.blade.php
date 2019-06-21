@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
<label ><h3>Tipos de cuentas</h3></label>
<div class="row">
  <br>
  <div class="col-md-5">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-search"></i></span>
      <input type="text" class="form-control" name="buscar_tipocuenta" id="buscar_tipocuenta" placeholder="Busqueda por tipo">
    </div>
  </div>
  <div class="col-md-5">
    <input type="hidden" name="hidden">
  </div>
  <div class="contenedor-modal">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ventana_crear"><span class="glyphicon glyphicon-plus"></span> Nuevo tipo de cuenta</button>
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

        <form method="post"  action="{{route('tipo_cuenta.create')}} ">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="box-body">
            <label for="descripcion">Descripción</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
              <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción">
            </div>
            <br>
          </div>
          <div class="box-footer">
            <button type="submit"class="btn btn-success">Crear</button>
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
                <button type="submit" class="btn btn-danger btn-xs">Borrar</button>
              </form>
            </form>
          </div>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection