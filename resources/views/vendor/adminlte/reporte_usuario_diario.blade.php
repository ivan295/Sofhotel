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
        <h3 class="box-title">Reporte diario</h3>
      </div>
     		<form method="post"  action="/consulta_caja_usuario_dia">
          {{csrf_field()}}
          <div class="box-body">
              <label for="fecha">Día a escoger:</label>
              <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo date("Y-m-d");?>">
            </div>  
          <div class="box-footer">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>Generar</button>  
          </div>
        </form>

  </div>
</div>
   <div class="col-md-5">
    <label ><h3>Listado de usuarios</h3></label>  
  <form method="GET"  action="{{route('gastos.index')}}" >
    <div class="input-group input-group-flat">
      <input type="text" class="form-control" name="gasto" id="gasto" placeholder="Busqueda por usuario">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Buscar</button>
        <br>
      </span>
    </div>
  </form>
</div>
</div>
<br>

<div class="col-md-14">
  <div class="box box-primary">
   <div class="box-header with-border">
    <i class="fa fa-bar-chart"></i>
    <h3 class="box-title" align="text-center">Usuarios</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <!--tabla-->
  <table class="table table-hover table-bordered" id="tablagastos">
    <thead>
      <tr bgcolor="#98A8D5">
        <th class='text-center'>Usuario</th>
        <th class='text-center'>Numero de caja</th>
        <th class="text-center">Fecha</th>
        <th class='text-center'>Monto inicial</th>
        <th class="text-center">Monto final</th>
        <th class="text-center">Acción</th>
      </tr>
    </thead>
    <tbody>
      <tr></tr>
      @if (isset($caja))
      @foreach($caja as $caja)
      <tr class='text-center'>
        <td>{{$caja->usuario}}</td>
        <td>{{$caja->numero_caja}}</td>
        <td>{{$caja->created_at}}</td>
        <td>{{$caja->dinero_inicial}}</td>
        <td>{{$caja->dinero_disponible}}</td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-3" >
             <form action="{{route('reporte_usuario.diario', $caja->id)}}" method="get" target="blank">
              {{csrf_field()}}
             <button type="submit"  class="btn btn-warning btn-xs">Generar reporte</button>
             
             </form>
            </div>
        </div>
      </td>
    </tr>
    @endforeach
    @endif
    
  </tbody>
</table>
@endsection