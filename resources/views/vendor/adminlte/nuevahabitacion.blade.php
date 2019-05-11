@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
<!-- box con input para crear habitaciones -->
<div class="row">
  <div class="col-md-5">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Crear Habitaciones</h3>
      </div>
      <form method="post"  action="{{route('habitacion.create')}}"  >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <div class="form-group">
            <label for="numerohabitacion">Número de Habitacion</label>
            <input type="text" class="form-control" name="numero_habitacion" id="numero_habitacion" placeholder="Número de Habitacion">
          </div>
          <div class="form-group">
            <label for="tipohabitacion">Tipo de Habitación</label>
            <input type="text" class="form-control" name="tipo_habitacion" id="tipo_habitacion" placeholder="Tipo de Habitación">
          </div>
          <div class="form-group">
            <label for="preciohabitacion">Precio de Habitación</label>
            <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio de Habitación">
          </div>
          <div class="form-group">
            <label for="tiempolimpieza">Tiempo de Limpieza </label>
            <input type="time" name="tiempo_limpieza" id="tiempo_limpieza" value="00:00:00"  step="1">
            <!--<input type="text" class="form-control" name="tiempo_limpieza" id="tiempo_limpieza" placeholder="Tiempo de Limpieza">-->
          </div>
          <div class="form-group">
            <label for="iparduino">Dirección IP de placa Arduino</label>
            <input type="text" class="form-control" name="ip_arduino" id="ip_arduino" placeholder="Dirección Ip de placa Arduino">
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-success">Crear</button>
        </div>
      </form>
    </div>
  </div>
  <!-- box para el mapeo de habitaciones -->
  <div class="col-md-7">
    <div class="box box-primary">
     <div class="box-header with-border">
      <i class="fa fa-picture-o"></i>
      <h3 class="box-title" align="text-center">Mapa de Habitaciones</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <!-- recuadro de habitacion -->
    <div class="container-fluid spark-screen">
      @foreach($NuevaHabitacion as $NuevaHabitacion)
      <div class="col-md-5 col-md-offset-1">
        <div class="small-box bg-green">
          <div class="inner">
            <div class="row">
              <div class="col-md-3">
                <h3>{{$NuevaHabitacion->numero_habitacion}}</h3>
              </div>
              <div class="col-md-3">
                <p>{{$NuevaHabitacion->tipo_habitacion}}</p>
              </div>
              <div class="col-md-3">
                <p>${{$NuevaHabitacion->precio}}</p>
              </div>
              <div class="col-md-3 col-md-offset-1">
                <p>{{$NuevaHabitacion->tiempo_limpieza}}</p>
              </div>
            </div>
            

            <div class="row">
              <div class="col-md-3 col-md-offset-2">
               <form action="{{route ('habitacion.editar', $NuevaHabitacion->id)}}" method="post">
                {{csrf_field()}}
                
                <button type="submit" class="btn btn-warning btn-xs">Modificar</button></form>

              </div>
              <div class="col-md-3">
               <form action="{{route('habitacion.delete', $NuevaHabitacion->id)}}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger btn-xs">Borrar</button>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
    @endforeach
  </div>  
</div>
</div>
</div>
@endsection
