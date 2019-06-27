@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
<label ><h3>Tipos de Usuario</h3></label>
<div class="row">
  <br>
  <div class="col-md-5">
    <form method="GET"  action="{{route('tipouser.index')}}" >
      <div class="input-group input-group-flat">
        <input type="text" class="form-control" name="tipo" id="tipo" placeholder="Busqueda por tipo de usuario">
        <span class="input-group-btn">

          <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Buscar</button>

        </span>
      </div>
    </form>
  </div>

  <div class="contenedor-modal">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ventana_crear"><span class="glyphicon glyphicon-plus"></span> Agregar Tipo de Usuario</button>
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
        <form method="post"  action="{{route('tipouser.create')}}" target="request">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="box-body">
            <label for="tipousuario">Tipo de Usuario</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-users"></i></span>
              <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Tipo de Usuario">
            </div>
            <br>
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
    <h3 class="box-title" align="text-center">Tipos de Usuario</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <table class="table table-hover table-bordered" id="tablatipousuario">
    <thead>
      <tr bgcolor="#98A8D5">
        <th class='text-center'>#</th>
        <th class="text-center">Descripcion</th>
        <th class="text-center">Opciones</th>
      </tr>
    </thead>
    <tbody>
      <tr></tr>
      @foreach($Nuevotipouser as $NuevotipoUser)
      <tr class='text-center'>
        <td>{{$NuevotipoUser->id}}</td>
        <td>{{$NuevotipoUser->descripcion}}</td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-3">
             <form action="{{route ('tipouser.editar', $NuevotipoUser->id)}}" method="post">
              {{csrf_field()}}
              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
            </div>
            <div class="col-md-6 text-left">
              <form action="{{route('tipouser.delete', $NuevotipoUser->id)}}" method="post">
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
{{ $Nuevotipouser->links() }}

@endsection
