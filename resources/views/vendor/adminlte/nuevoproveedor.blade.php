@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')

<div class="row">
  <div class="col-md-5 col-md-offset-3" >
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Proveedor</h3>
      </div>
      <form method="post"  action="{{route('proveedor.create')}}" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <br>
          <label for="numerohabitacion">Nombre</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
          </div>
          <label for="numerohabitacion">Apellido</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido">
          </div>
          <label for="numerohabitacion">Cédula</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
            <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cédula">
          </div>
          <label for="numerohabitacion">Teléfono</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
            <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono">
          </div>
          <label for="numerohabitacion">Correo</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
            <input type="text" class="form-control" name="correo" id="correo" placeholder="Correo">
          </div>
          <label for="numerohabitacion">Empresa</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
            <input type="text" class="form-control" name="empresa" id="empresa" placeholder="Empresa">
          </div>
        </div>
      <div class="box-footer">
        <button type="submit"class="btn btn-success">Crear</button>
      </div>
    </form>
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
      <tr>
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
      @foreach($Nuevoproveedor as $Nuevoproveedor)
      <tr class='text-center'>
        <td>{{$Nuevoproveedor->id}}</td>
        <td>{{$Nuevoproveedor->nombres}}</td>
        <td>{{$Nuevoproveedor->apellidos}}</td>
        <td>{{$Nuevoproveedor->cedula}}</td>
        <td>{{$Nuevoproveedor->telefono}}</td>
        <td>{{$Nuevoproveedor->correo}}</td>
        <td>{{$Nuevoproveedor->empresa}}</td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-2">
             <form action="" method="post">
              {{csrf_field()}}

              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
            </div>
            <div class="col-md-6 text-left">
              <form action="{{route('proveedor.delete', $Nuevoproveedor->id)}}" method="post">
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
</div>
</div>

@endsection
