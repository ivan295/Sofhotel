@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')

<script type="text/javascript">
  function consultar(){
    var dato = document.getElementById('consulta_proveedor').value;
    document.getElementById('proveedor').value = dato;
  }
</script>
<!--alertas-->
@include('adminlte::alerts.error')
@include('adminlte::alerts.exito')
<!--@include('sweet::alert')-->
<label ><center><h3>Productos</h3></center></label>
<div class="row">
  <br>
  <div class="col-md-5">
    <form method="GET"  action="{{route('productos.index')}}" >
      <div class="input-group input-group-flat">
        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Busqueda por descripcion del producto">
        <span class="input-group-btn">

          <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Buscar</button>

        </span>
      </div>
    </form>
  </div>

  <div class="contenedor-modal">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ventana_crear"><span class="glyphicon glyphicon-plus"></span> Agregar Producto</button>
  </div>
</div>
<br>
<!-- ventana modal -->
<div class="modal fade" id="ventana_crear" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Agregar Nuevo Producto</h4>
      </div>
      <div class="modal-body">
        <!--alerta-->
        @include('adminlte::alerts.error')
        <form method="post"  action="{{route('productos.create')}}" >
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="box-body">
            <div class="col-md-6">
              <label for="descripcion_producto">Descripcion</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" required>
              </div>
            </div>
            <div class="col-md-6">
              <label for="precio_venta">Precio de Venta</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                <input type="text" class="form-control" name="precio_venta" id="precio_venta" placeholder="Precio de Venta" required>
              </div>
            </div>
            <div class="col-md-6">
              <label for="stock">Cantidad</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                <input type="text" class="form-control" name="stock" id="stock" placeholder="Cantidad" required>
              </div>
            </div>
            <div class="col-md-6">
              <label for="precio_compra">Precio de Compra</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                <input type="text" class="form-control" name="precio_compra" id="precio_compra" placeholder="Precio de Compra" required>
              </div>
            </div>
            <div class="col-md-6">
              <label>Proveedor</label>
              <div class="select-group">
                <select class="form-control selectpicker" name="id_proveedor" id="consulta_proveedor" onchange="consultar()" data-live-search="true">                 
                  <option value="0">Seleccionar Proveedor</option>
                  <?php $prov = DB::table('proveedor')->get(); ?>
                  @foreach($prov as $prov)
                  <option value="<?php  echo $prov->id ; ?>"> <?php echo $prov->empresa; ?>  </option>
                  @endforeach
                </select>
              </div>
            </div>
            <input type="hidden" id="proveedor" name="proveedor" >
          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-save"></span> Guardar</button>   
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- fin de ventana modal-->
<!-- box para mostrar tabla con datos -->
<div class="col-md-14">
  <div class="box box-primary">
   <div class="box-header with-border">
    <i class="fa fa-bar-chart"></i>
    <h3 class="box-title" align="text-center">Productos</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <!--tabla-->
  
  <table class="table table-hover table-bordered" id="tablaproductos">
    <thead>
      <tr bgcolor="#98A8D5">
        <th class='text-center'>#</th>
        <th class='text-center'>Descripcion</th>
        <th class='text-center'>Precio de Venta</th>
        <th class="text-center">Stock</th>
        <th class="text-center">Precio de Compra</th>
        <th class="text-center">Proveedor</th>
        <th class="text-center">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($NuevoProducto as $NuevoProd)
      <!--cambiar de color celda de stock al ser menor o igual a 5-->
      <?php 
      if ($NuevoProd->stock <= 5) {
        $color = 'red';
        } elseif ($NuevoProd->stock > 5) {
          $color = 'white';
        }
      ?>
      <!--fin de condicional-->
      <tr class='text-center'>
        <td>{{$NuevoProd->id}}</td>
        <td>{{$NuevoProd->descripcion}}</td>
        <td>$ {{$NuevoProd->precio_venta}}</td>
        <td style="background-color:<?php echo $color ?>;">{{$NuevoProd->stock}}</td>
        <td>$ {{$NuevoProd->precio_compra}}</td>
        <td>{{$NuevoProd->Empresa}}</td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-2">
             <form action="{{route('productos.editar', $NuevoProd->id)}}" method="post">
              {{csrf_field()}}
              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
            </div>
            <div class="col-md-6 text-left">
              <form action="{{route('productos.delete', $NuevoProd->id)}}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger btn-xs" onclick="return borrar()">Borrar</button>
              </form>
            </div>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $NuevoProducto->links() }}
</div>
</div>
<script src="{{ asset('/js/alerta_confirmacion.js') }}" defer></script>


@endsection