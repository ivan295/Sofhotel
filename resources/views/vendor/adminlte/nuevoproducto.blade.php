@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<script type="text/javascript">
  function consultar(){
    var dato = document.getElementById('consulta_proveedor').value;
    document.getElementById('id_proveedor').value = dato;
  }
</script>
<div class="row">
  <div class="col-md-5 col-md-offset-3" >
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Producto</h3>
      </div>
      <form method="post"  action="{{route('productos.create')}}" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <br>
          <label for="numerohabitacion">Descripcion</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion">
          </div>
          <label for="numerohabitacion">Precio de Venta</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
            <input type="text" class="form-control" name="precio_venta" id="precio_venta" placeholder="Precio de Venta">
          </div>
          <label for="numerohabitacion">Stock</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
            <input type="text" class="form-control" name="stock" id="stock" placeholder="Cédula">
          </div>
          <label for="numerohabitacion">Precio de Compra</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
            <input type="text" class="form-control" name="precio_compra" id="precio_compra" placeholder="Precio de Compra">
          </div>
          <div class="form-group">
          <label>Proveedor</label>
          <select class="form-control" name="id_proveedor" id="consulta_proveedor" onchange="consultar()" required>                    
            <option value="0">Seleccionar Proveedor</option>
            <?php $prov = DB::table('proveedor')->get(); ?>
            @foreach($prov as $prov)
            <option value="<?php  echo $prov->id ; ?>"> <?php echo $prov->empresa; ?>  </option>
            @endforeach
          </select>
        </div>
        <input type="hidden" id="id_proveedor" name="id_proveedor" required>
        </div>
      <div class="box-footer">
        <button type="submit"class="btn btn-success">Crear</button>
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
    <h3 class="box-title" align="text-center">Productos</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <!--tabla-->
  <table class="table table-hover table-bordered" id="tablagastos">
    <thead>
      <tr>
        <th class='text-center'>#</th>
        <th class='text-center'>Descripcion</th>
        <th class='text-center'>Precio de Venta</th>
        <th class="text-center">Stock</th>
        <th class="text-center">Precio de Compra</th>
        <th class="text-center">Proveedor</th>
        <th class="text-center">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($NuevoProducto as $NuevoProd)
      <tr class='text-center'>
        <td>{{$NuevoProd->id}}</td>
        <td>{{$NuevoProd->descripcion}}</td>
        <td>$ {{$NuevoProd->precio_venta}}</td>
        <td>{{$NuevoProd->stock}}</td>
        <td>$ {{$NuevoProd->precio_compra}}</td>
        <td>{{$NuevoProd->Empresa}}</td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-2">
             <form action="" method="post">
              {{csrf_field()}}

              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
            </div>
            <div class="col-md-6 text-left">
              <form action="{{route('productos.delete', $NuevoProd->id)}}" method="post">
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
{{ $NuevoProducto->links() }}
</div>
</div>

@endsection
