@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<!-- box con input para registrar gasto -->
<!-- <div class="row">
  <div class="col-md-5 col-md-offset-3" >
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Alquiler</h3>
      </div> -->
      <!-- <form method="post"  action="" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <label for="numerohabitacion">fecha</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
            <input type="text" class="form-control" name="fecha" id="fecha" placeholder="fecha">
          </div>
          <br>
          <label for="tipohabitacion">hora de ingreso</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
            <input type="text" class="form-control" name="hora_ingreso" id="hora ingreso" placeholder="Total a Pagar">
          </div>
          <label for="tipohabitacion">hora de salida</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
            <input type="text" class="form-control" name="hora_salida" id="hora salida" placeholder="hora salida ">
          </div>
          <label for="tipohabitacion">tiempo</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
            <input type="text" class="form-control" name="tiempo_alquiler" id="tiempo_alquiler" placeholder="tiempo_alquiler">
          </div>
          <label for="tipohabitacion">numero de personas</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
            <input type="text" class="form-control" name="numero_personas" id="numero_personas" placeholder="numero de personas">
          </div>
          <div class="input-group">
            <input type="hidden" class="form-control" name="id_usuario" id="id_usuario" value="{{Auth::user()->id}}">
          </div>
          <label for="tipohabitacion">habitacion</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
            <input type="text" class="form-control" name="id_habitacion" id="id_habitacion" placeholder="habitacion">
          </div>
      </div>
      <div class="box-footer">
        <button type="submit"class="btn btn-success">Registrar alquiler</button>
      </div>
    </form>
  </div>
</div>
</div> -->
<!-- box para mostrar tabla con datos -->
<div class="col-md-14">
  <div class="box box-primary">
   <div class="box-header with-border">
    <i class="fa fa-bar-chart"></i>
    <h3 class="box-title" align="text-center">Alquiler</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <!--tabla-->
  <table class="table table-hover table-bordered" id="tablagastos">
    <thead>
      <tr bgcolor="#98A8D5">
        <th class='text-center'>#</th>
        <th class='text-center'>Fecha</th>
        <th class='text-center'>Hora de ingreso</th>
        <th class="text-center">Hora de salida</th>
        <th class="text-center">Tiempo alquiler</th>
        <th class="text-center">Número personas</th>
        <th class="text-center">Usuario</th>
        <th class="text-center">Número de habitación</th>
      </tr>
    </thead>
    <tbody>
      <tr></tr>
      @foreach($nuevoAlquiler as $nuevoalquiler)
      <tr class='text-center'>
        <td>{{$nuevoalquiler->id}}</td>
        <td>{{$nuevoalquiler->fecha}}</td>
        <td>{{$nuevoalquiler->hora_ingreso_habitacion}}</td>
        <td>{{$nuevoalquiler->hora_salida_habitacion}}</td>
        <td>{{$nuevoalquiler->tiempo_alquiler}}</td>
        <td>{{$nuevoalquiler->numero_personas}}</td>
        <td>{{$nuevoalquiler->name}}</td>
        <td>{{$nuevoalquiler->habitacion}}</td>
        <!-- <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-2">
             <form action="" method="post">
              {{csrf_field()}}

              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
            </div>
            <div class="col-md-6 text-left">
              <form action="" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger btn-xs">Borrar</button>
              </form>
          </div>
        </div>
      </td> -->
    </tr>
    @endforeach
  </tbody>
</table>
{{ $nuevoAlquiler->links() }}
</div>
</div>

@endsection
