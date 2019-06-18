@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')

<div class="row">
  <div class="col-md-12 col-md-offset-0" >
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Proveedor</h3>
      </div>
      <form method="post"  action="{{route('proveedor.update', $Nuevoproveedor->id)}}" >
        {{csrf_field()}}
       {{ method_field('PUT') }}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <br>
          <div class="col-md-6">
          <label for="nombre_proveedor">Nombre</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $Nuevoproveedor->nombres; ?>">
          </div>
        </div>
        <div class="col-md-6">
          <label for="apellidos_proveedor">Apellido</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo $Nuevoproveedor->apellidos; ?>">
          </div>
        </div>
        <div class="col-md-6">
          <label for="cedula_proveedor">Cédula</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-slack"></i></span>
            <input type="text" class="form-control" name="cedula" id="cedula" value="<?php echo $Nuevoproveedor->cedula; ?>">
          </div>
        </div>
        <div class="col-md-6">
          <label for="telefono_proveedor">Teléfono</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa fa-phone"></i></span>
            <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $Nuevoproveedor->telefono; ?>">
          </div>
        </div>
        <div class="col-md-6">
          <label for="correo_proveedor">Correo</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa  fa-at"></i></span>
            <input type="text" class="form-control" name="correo" id="correo" value="<?php echo $Nuevoproveedor->correo; ?>">
          </div>
        </div>
        <div class="col-md-6">
          <label for="empresa">Empresa</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-industry"></i></span>
            <input type="text" class="form-control" name="empresa" id="empresa" value="<?php echo $Nuevoproveedor->empresa; ?>">
          </div>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit"class="btn btn-success">Modificar</button>
        <button type="submit" class="btn btn-danger" onclick="vendor/adminlte/nuevoproveedor.php">Salir</button>
      </div>
    </form>
</div>
</div>
</div>
@endsection
