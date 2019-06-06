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
      <form method="post"  action="{{route('habitacion.create')}}" target="request">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <label for="numerohabitacion">Número de Habitación</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa  fa-slack"></i></span>
            <input type="text" class="form-control" name="numero_habitacion" id="numero_habitacion" placeholder="Número de Habitacion" required pattern="[0-9]" title="ESTE CAMPO SOLO ADMITE VALORES NUMÉRICOS">
          </div>
          <br>
          <label for="tipohabitacion">Tipo de Habitación</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-puzzle-piece"></i></span>
            <input type="text" class="form-control" name="tipo_habitacion" id="tipo_habitacion" placeholder="Tipo de Habitación" required pattern="[A-Za-z]{1-50}">
          </div>
          <br>
          <label for="preciohabitacion">Precio de Habitación</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
            <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio de Habitación" required pattern="[.-,]">
          </div>
          <br>
          <label for="tiempolimpieza">Tiempo de Limpieza </label>
          <div class="bootstrap-timepicker">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                </div>
                <input type="text" class="form-control timepicker" name="tiempo_limpieza" id="tiempo_limpieza" value="00:00:00" required>
              </div>
            </div>
          </div>
          <label for="iparduino">Dirección IP de placa Arduino</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa fa-laptop "></i></span>
            <input type="text" class="form-control" name="ip_arduino" id="ip_arduino" placeholder="IP de placa Arduino" required>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit"class="btn btn-success">Crear</button>
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
                
                <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>

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
