@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<!-- box con input para registrar gasto -->
<div class="row">
  <div class="col-md-5 col-md-offset-3" >
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Registrar Gastos</h3>
      </div>
      <form method="post"  action="{{route('gastos.create')}}" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <label for="numerohabitacion">Descripción</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción">
          </div>
          <br>
          <label for="tipohabitacion">Total a Pagar</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
            <input type="text" class="form-control" name="gasto_total" id="gasto_total" placeholder="Total a Pagar">
          </div>
          <br>
          <label for="preciohabitacion">Hora de Pago</label>
          <div class="input-group">
           <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
          <input type="text" class="form-control timepicker" name="hora_gasto" id="hora_gasto" placeholder="Hora de Pago">                 
        </div>
        <br>
        <label for="fechagasto">Fecha de Pago</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" class="form-control datepicker" name="fecha_gasto" id="fecha_gasto" placeholder="Fecha de Pago">
        </div>
      </div>
      <div class="input-group">
            <input type="hidden" class="form-control" name="usuario" id="usuario" value="{{Auth::user()->name}}">
          </div>
      <div class="box-footer">
        <button type="submit"class="btn btn-success">Registrar Pago</button>
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
    <h3 class="box-title" align="text-center">Gastos</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <!--tabla-->
  <table class="table table-hover table-bordered" id="tablagastos">
    <thead>
      <tr>
        <th class='text-center'>#</th>
        <th class='text-center'>Descripcion</th>
        <th class='text-center'>Total de Pago</th>
        <th class="text-center">Hora del pago</th>
        <th class="text-center">Fecha del Pago</th>
        <th class="text-center">Usuario</th>
        <th class="text-center">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr></tr>
      @foreach($NuevoGasto as $NuevoGasto)
      <tr class='text-center'>
        <td>{{$NuevoGasto->id}}</td>
        <td>{{$NuevoGasto->descripcion}}</td>
        <td>$ {{$NuevoGasto->gasto_total}}</td>
        <td>{{$NuevoGasto->hora_gasto}}</td>
        <td>{{$NuevoGasto->fecha_gasto}}</td>
        <td>{{$NuevoGasto->id_usuario}}</td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-2">
             <form action="{{route ('gastos.editar', $NuevoGasto->id)}}" method="post">
              {{csrf_field()}}

              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
            </div>
            <div class="col-md-6 text-left">
              <form action="{{route('gastos.delete', $NuevoGasto->id)}}" method="post">
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
