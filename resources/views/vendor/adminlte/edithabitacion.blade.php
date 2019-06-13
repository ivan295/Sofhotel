@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
 <div class="col-md-12 col-md-offset-3">
  <div class="col-md-5">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Modificar Habitaciones</h3>
      </div>
      <form method="post"  action="{{route('habitacion.update', $habit->id)}}"  >
       {{csrf_field()}}
      {{ method_field('PUT') }}
        <div class="box-body">
          <div class="form-group">
            <label for="numerohabitacion">Número de Habitacion</label>
            <input type="text" class="form-control" name="numero_habitacion" value="<?php echo $habit->numero_habitacion; ?>">
          </div>
          <div class="form-group">
            <label for="tipohabitacion">Tipo de Habitación</label>
            <input type="text" class="form-control" name="tipo_habitacion" value="<?php echo $habit->tipo_habitacion; ?>">
          </div>
          <div class="form-group">
            <label for="preciohabitacion">Precio de Habitación</label>
            <input type="text" class="form-control" name="precio" value="<?php echo $habit->precio; ?>">
          </div>
          <div class="form-group">
            <label for="tiempolimpieza">Tiempo de Limpieza </label>
            <input type="time" name="tiempo_limpieza" value="<?php echo $habit->tiempo_limpieza; ?>"  step="1">
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-success">Modificar</button>
          <button type="submit" class="btn btn-danger" onclick="vendor/adminlte/nuevahabitacion.php">Salir</button>
        </div>
      </form>
    </div>
  </div>
  
  </div>  
@endsection
