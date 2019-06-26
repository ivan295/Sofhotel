@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<label ><h3>Listado de Proveedores</h3></label>
<div class="row">
  <br>
  <div class="col-md-5">
  <form method="GET"  action="{{route('proveedor.index')}}" >
    <div class="input-group input-group-flat">
      <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Busqueda por nombre">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Buscar</button>
      </span>
    </div>
  </form>
</div>
  <div class="contenedor-modal">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ventana_crear"><span class="glyphicon glyphicon-plus"></span> Nuevo Proveedor</button>
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
        <h4 class="modal-title" id="myModalLabel">Nuevo proveedor</h4>
      </div>
      <div class="modal-body">
        <form method="post"  action="{{route('proveedor.create')}}" >
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="box-body">
            <div class="col-md-6">
              <label for="nombre_proveedor">Nombre</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
              </div>
            </div>
            <div class="col-md-6">
              <label for="apellidos_proveedor">Apellido</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido">
              </div>
            </div>
            <div class="col-md-6">
              <label for="cedula_proveedor">Cédula</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-slack"></i></span>
                <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cédula">
              </div>
            </div>
            <div class="col-md-6">
              <label for="telefono_proveedor">Teléfono</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa fa-phone"></i></span>
                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono">
              </div>
            </div>
            <div class="col-md-6">
              <label for="correo_proveedor">Correo</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa  fa-at"></i></span>
                <input type="text" class="form-control" name="correo" id="correo" placeholder="Correo">
              </div>
            </div>
            <div class="col-md-6">
              <label for="empresa">Empresa</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-industry"></i></span>
                <input type="text" class="form-control" name="empresa" id="empresa" placeholder="Empresa">
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit"class="btn btn-success">Crear</button>
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
    <h3 class="box-title" align="text-center">Proveedores</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <!--tabla-->
  <table class="table table-hover table-bordered" id="tablagastos">
    <thead>
      <tr bgcolor="#98A8D5">
        <th class='text-center'>#</th>
        <th class='text-center'>Nombre</th>
        <th class='text-center'>Apellido</th>
        <th class="text-center">Cédula</th>
        <th class="text-center">Teléfono</th>
        <th class="text-center">Correo</th>
        <th class="text-center">Empresa</th>
        <th class="text-center">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($Nuevoproveedor as $Nuevoproveed)
      <tr class='text-center'>
        <td>{{$Nuevoproveed->id}}</td>
        <td>{{$Nuevoproveed->nombres}}</td>
        <td>{{$Nuevoproveed->apellidos}}</td>
        <td>{{$Nuevoproveed->cedula}}</td>
        <td>{{$Nuevoproveed->telefono}}</td>
        <td>{{$Nuevoproveed->correo}}</td>
        <td>{{$Nuevoproveed->empresa}}</td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-2">
             <form action="{{route('proveedor.editar', $Nuevoproveed->id)}}" method="post">
              {{csrf_field()}}

              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
            </div>
            <div class="col-md-6 text-left">
              <form action="{{route('proveedor.delete', $Nuevoproveed->id)}}" method="post">
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
{{$Nuevoproveedor->links()}}
</div>
</div>
@endsection
