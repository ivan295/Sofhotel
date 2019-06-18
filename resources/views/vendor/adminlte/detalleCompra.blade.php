@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<script type="text/javascript">
  function consultar_producto(){
    var dato = document.getElementById('consulta_producto').value;
    document.getElementById('id_producto').value = dato;
  }

  function consultar_factura(){
    var dato = document.getElementById('consulta_factura').value;
    document.getElementById('id_factura').value = dato;
  }
</script>

<div class="row">
  <div class="col-md-6 col-md-offset-0" > 
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Detalle Compra</h3>
      </div>
      <form method="post"  action="{{route('detalle_compra.create')}}" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <div class="form-group">
          <label>Productos</label>
          <select class="form-control" name="id_producto" id="consulta_producto" onchange="consultar_producto()" required>                    
            <option value="0">Seleccionar Producto</option>
            <?php $product = DB::table('producto')->get(); ?>
            @foreach($product as $product)
            <option value="<?php  echo $product->id ; ?>"> <?php echo $product->descripcion; ?><?php echo $product->precio_compra; ?>  </option>
            @endforeach
          </select>
        </div>
        <input type="hidden" id="id_producto" name="id_producto" required>
         <div class="form-group">
          <label>Factura Compra</label>
          <select class="form-control" name="id_factura" id="consulta_factura" onchange="consultar_factura()" required>                    
            <option value="0">Seleccionar Factura</option>
            <?php $fact = DB::table('factura_compra')->get(); ?>
            @foreach($fact as $fact)
            <option value="<?php  echo $fact->id ; ?>"> <?php echo $fact->descripcion; ?>  </option>
            @endforeach
          </select>
        </div>
        <input type="hidden" id="id_factura" name="id_factura" required>
          <label for="numerohabitacion">Cantidad</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
            <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad">
          </div>
          <label for="numerohabitacion">Total Compra</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
            <input type="text" class="form-control" name="total_compra" id="total_compra" placeholder="Monto total de la Compra">
          </div>
        </div>
      <div class="box-footer">
        <button type="submit"class="btn btn-success">Crear</button>
      </div>
    </form>
  </div>
</div>

<div class="col-md-6">
    <div class="box box-primary">
     <div class="box-header with-border">
      <i class="fa fa-picture-o"></i>
      <h3 class="box-title" align="text-center">Listado de Productos</h3></div>
      <table class="table table-hover table-bordered" id="tablaDetalleProductos">
        <thead>
            <tr>
                <td>Descripción</td>
                <td>Cantidad</td>
                <td>Precio</td>
            </tr>
        </thead>
        <tbody id="idTBody">
                <td></td>
        </tbody>
        <tfoot>
            <tr>
                <td>TOTAL</td>
                <td></td>
                <td id="totalPeso">0</td>
            </tr>
        </tfoot>
    </table>
</div>
</div>
</div>
<!-- box para mostrar tabla con datos -->
<div class="col-md-14">
  <div class="box box-primary">
   <div class="box-header with-border">
    <i class="fa fa-bar-chart"></i>

    <h3 class="box-title" align="text-center">Facturas de Compra</h3>
    <input id="txtfiltroP" class="form-control" type="text" name="" placeholder="Ingresar el Producto">
    <div class="box-tools pull-right">
    </div>
  </div>
  <!--tabla-->
  <table class="table table-hover table-bordered" id="tablagastos">
    <thead>
      <tr>
        <th class='text-center'>#</th>
        <th class='text-center'>Producto</th>
        <th class='text-center'>Factura</th>
        <th class="text-center">Cantidad</th>
        <th class="text-center">Total</th>
        <th class="text-center">Acciones</th>
      </tr>
    </thead>
    <tbody id="tablaDetalleProductos">
      @foreach($DetalleCompra as $DetalleCompra)
      <tr class='text-center'>
        <td>{{$DetalleCompra->id}}</td>
        <td>{{$DetalleCompra->Descripcion}}</td>
        <td>{{$DetalleCompra->Descripcion_fact}}</td>
        <td>{{$DetalleCompra->cantidad}}</td>
        <td>$ {{$DetalleCompra->total_compra}}</td>
        <td class="text-center">
          <div class="row">
            <div class="col-md-3 col-md-offset-2">
             <form action="" method="post">
              {{csrf_field()}}

              <button type="submit" class="btn btn-warning btn-xs">Editar</button></form>
            </div>
            <div class="col-md-6 text-left">
              <form action="{{route('detalle_compra.delete', $DetalleCompra->id)}}" method="post">
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
<script src="{{ asset('/js/GestionDetalleCompra.js') }}" defer></script>
