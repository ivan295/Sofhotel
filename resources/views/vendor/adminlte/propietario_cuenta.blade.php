@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
@if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
<label ><h3>Propietario de Cuenta</h3></label>
<div class="row">
  <br>
  <div class="col-md-5">
  <form method="GET"  action="{{route('propietario_cuenta.index')}}" >
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="input-group input-group-flat">
      <input type="text" class="form-control" name="propietario" id="propietario" placeholder="Busqueda por nombre de propietario o entidad">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Buscar</button>
      </span>
    </div>
  </form>
</div>
  <div class="contenedor-modal">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ventana_crear"><span class="glyphicon glyphicon-plus"></span> Agregar Propietario</button>
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
        <h4 class="modal-title" id="myModalLabel">Nuevo Propietario</h4>
      </div>
      <div class="modal-body">
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <form method="post"  action="{{route('propietario_cuenta.create')}} ">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="box-body">
            <label for="Nombre">Nombre o Entidad</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
              <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre o Entidad">
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
<!-- mostrar datos -->

<div class="col-md-14">
  <div class="box box-primary">
   <div class="box-header with-border">
    <i class="fa fa-bar-chart"></i>
    <h3 class="box-title" align="text-center">Propietarios</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <table class="table table-hover table-bordered" id="tablatipousuario">
    <thead>
      <tr bgcolor="#98A8D5">
        <th class='text-center'>#</th>
        <th class="text-center">Nombres o Entidad</th>
        <th class="text-center">Opciones</th>
      </tr>
    </thead>
    <tbody>
      <tr></tr>
      @foreach($propietario_cuenta as $pc)
      <tr class='text-center'>
        <td><?php echo $pc->id?></td>
        <td><?php echo $pc->nombre?></td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-3">
             <form action="{{route ('propietario_cuenta.cambio', $pc->id)}}" method="post">
              {{csrf_field()}}
              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
            </div>
            <div class="col-md-6 text-left">
              <form action="{{route('propietario_cuenta.delete', $pc->id)}}" method="post">
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
{{ $propietario_cuenta->links() }}
@endsection