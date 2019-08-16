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
        <h3 class="box-title">Reporte específico</h3>
      </div>
     		<form method="post"  action="/consulta_caja_usuario_especifico">
         {{csrf_field()}}
          <div class="box-body">
              <label for="fecha">Desde:</label>
              <input type="date" name="fecha_inicial" id="fecha_inicial" class="form-control" value="<?php echo date("Y-m-d");?>">
              <label for="fecha">Hasta:</label>
              <input type="date" name="fecha_final" id="fecha_final" class="form-control" value="<?php echo date("Y-m-d");?>">
            </div>  
          <div class="box-footer">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span>Generar</button>  
          </div>
        </form>

    

  </div>
</div>
<div class="col-md-5">
    <label ><h3>Listado de usuarios</h3></label>  
  <form method="GET"  action="" >
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
        <th class='text-center'>Nombre</th>
        <th class='text-center'>Apellido</th>
        <th class='text-center'>Usuario</th>
        <th class='text-center'>Fecha inicial</th>
        <th class='text-center'>Fecha final</th>
        <th class="text-center">Acción</th>
      </tr>
    </thead>
    <tbody>
      <tr></tr>
      @if (isset($usuarios))
      @foreach($usuarios as $user)
      <tr class='text-center'>
        <td>{{$user->nombre}}</td>
        <td>{{$user->apellido}}</td>
        <td>{{$user->usuario}}</td>
        <td>{{$fecha_inicial}}</td>
        <td>{{$fecha_final}}</td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-3" >
             <form action= '/reporte_usuario_especifico/<?php echo $user->id. "/" .$fecha_inicial. "/" .$fecha_final ?>' method="get" target="blank">
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

</div>
@endsection