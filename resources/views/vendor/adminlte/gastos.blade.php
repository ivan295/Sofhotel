@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<label ><h3>Listado de Gastos</h3></label>
<div class="row">
  <br>
  <div class="col-md-5">
  <form method="GET"  action="{{route('gastos.index')}}" >
    <div class="input-group input-group-flat">
      <input type="text" class="form-control" name="gasto" id="gasto" placeholder="Busqueda por descripción">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Buscar</button>

      </span>
    </div>
  </form>
</div>
  <div class="contenedor-modal">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ventana_crear"><span class="glyphicon glyphicon-plus"></span> Agregar Gasto</button>
  </div>
</div>
<br>
<!--ventana modal -->
<div class="modal fade" id="ventana_crear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Nuevo gasto</h4>
      </div>
      <div class="modal-body">
      <form method="post"  action="{{route('gastos.create')}}" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <label for="descripcion">Descripción</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción" required>
          </div>
          <br>
          <label for="total_pagar">Total a Pagar</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
            <input type="text" class="form-control" name="gasto_total" id="gasto_total" placeholder="Total a Pagar" required>
          </div>
      </div>
      <div class="input-group">
            <input type="hidden" class="form-control" name="id_usuario" id="id_usuario" value="{{Auth::user()->id}}">
          </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span> Guardar</button>  
      </div>
    </form>
</div>
</div>
</div>
</div>

<!-- box para mostrar tabla con datos -->
<div class="col-md-14">
  <div class="box box-primary">
   <div class="box-header with-border">
    <i class="fa fa-bar-chart"></i>
    <h3 class="box-title" align="text-center">Gastos</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <!--tabla-->
  <table class="table table-hover table-bordered" id="tablagastos">
    <thead>
      <tr bgcolor="#98A8D5">
        <th class='text-center'>#</th>
        <th class='text-center'>Descripcion</th>
        <th class='text-center'>Total de Pago</th>
        <th class="text-center">Fecha y hora del Pago</th>
        <th class="text-center">Usuario</th>
        <th class="text-center">Opciones</th>
      </tr>
    </thead>
    <tbody>
      <tr></tr>
      @foreach($NuevoGasto as $Nuevogasto)
      <tr class='text-center'>
        <td>{{$Nuevogasto->id}}</td>
        <td>{{$Nuevogasto->descripcion}}</td>
        <td>$ {{$Nuevogasto->gasto_total}}</td>
        <td>{{$Nuevogasto->created_at}}</td>
        <td>{{$Nuevogasto->user}}</td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-2">
             <form action="{{route ('gastos.editar', $Nuevogasto->id)}}" method="post">
              {{csrf_field()}}

              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
            </div>
            <div class="col-md-6 text-left">
              <form action="{{route('gastos.delete', $Nuevogasto->id)}}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
{{ $NuevoGasto->links() }}

@endsection
