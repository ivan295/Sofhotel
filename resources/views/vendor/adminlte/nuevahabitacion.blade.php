@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
<script type="text/javascript">
  function consultar(){
    var dato = document.getElementById('consulta_ip').value;
    document.getElementById('id_estado').value = dato;
  }

  function consultar_iva(){
    var dato = document.getElementById('consulta_iva').value;
    document.getElementById('iva').value = dato;
  }
</script>
<!-- box con input para crear habitaciones -->
@include('adminlte::alerts.error')
  @include('adminlte::alerts.exito')
<div class="row">
  <div class="col-md-5">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Crear habitaciones</h3>
      </div>
    <form method="post"  action="{{route('habitacion.create')}}" target="request">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <label for="numerohabitacion">Número de habitación</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa  fa-slack"></i></span>
            <input type="text" class="form-control" name="numero_habitacion" id="numero_habitacion" placeholder="Número de Habitacion" required>
          </div>
          <br>
          <label for="tipohabitacion">Tipo de habitación</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-puzzle-piece"></i></span>
            <input type="text" class="form-control" name="tipo_habitacion" id="tipo_habitacion" placeholder="Tipo de Habitación" required>
          </div>
          <br>
          <label for="preciohabitacion">Precio de habitación a cobrar</label>
          <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
            <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio de Habitación" required>
          </div>
          <br>
          <label for="tiempolimpieza">Tiempo de limpieza </label>
          <div class="form-group">
            <input type="time" name="tiempo_limpieza" value="00:00:00"  step="1" required>
          </div>

          <label for="tiempolimpieza">IVA</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
            <select class="form-control" name="consulta_iva" id="consulta_iva" onchange="consultar_iva()">                    
              <option value="0">Seleccionar IVA</option>
              <?php $iva = DB::table('ivas')->get(); ?>
              @foreach($iva as $i)
              <option value="<?php  echo $i->id ; ?>"> <?php echo "%".round($i->valor); ?>  </option>
              @endforeach
            </select>
          </div>

          <label>Ip de la placa Arduino</label>
           <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-tv"></i></span>
            <select class="form-control" name="ip_arduino" id="consulta_ip" onchange="consultar()">                    
              <option value="0">Seleccionar Ip de Arduino</option>
              <?php $ip = DB::table('estado_habitacion')->get(); ?>
              @foreach($ip as $ip)
              <option value="<?php  echo $ip->id ; ?>"> <?php echo $ip->ip_arduino; ?>  </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span> Guardar</button>  
          <input type="hidden" id="id_estado" name="id_estado">
          <input type="hidden" id="iva" name="iva">
        </div>
      </form>

    </div>
  </div>
  <!-- box para el mapeo de habitaciones -->
  <div class="col-md-7">
    <div class="box box-primary">
     <div class="box-header with-border">
      <i class="fa fa-picture-o"></i>
      <h3 class="box-title" align="text-center">Mapa de habitaciones</h3>
      <div class="box-tools pull-right">
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
                <button type="submit" class="btn btn-danger btn-xs" onclick="return borrar()">Borrar</button>
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
<script src="{{ asset('/js/alerta_confirmacion.js') }}" defer></script>

@endsection
