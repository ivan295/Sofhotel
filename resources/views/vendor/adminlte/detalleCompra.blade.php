@extends('adminlte::layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<script type="text/javascript">
  function consultar_producto() {
    var dato = document.getElementById('consulta_producto').value;
    document.getElementById('product').value = dato;
  }

  function consultar_proveedor() {
    var dato = document.getElementById('consulta_proveedor').value;
    document.getElementById('id_proveedor').value = dato;
  }
</script>

<div class="row">
  <div class="col-md-12 col-md-offset-0">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Datos de Factura</h3>
      </div>
      <form method="post" action="{{route('detalle_compra.create')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <div class="col-md-14">
            <div class="form-group">
              <label>Proveedor</label>
              <select class="form-control selectpicker" name="id_proveedor" id="consulta_proveedor" onchange="consultar_proveedor()" data-live-search="true">
                <option value="0">Seleccionar Proveedor</option>
                <?php $prov = DB::table('proveedor')->get(); ?>
                @foreach($prov as $prov)
                <option value="<?php echo $prov->id; ?>"> <?php echo $prov->empresa; ?> </option>
                @endforeach
              </select>
            </div>
            <input type="hidden" id="id_proveedor" name="id_proveedor" required>

            <div class="col-md-14">
              <label for="numerohabitacion">Descripción</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
                <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción">
              </div>
            </div>
          </div>
          <br>
          <div class="panel panel-primary">
            <div class="panel-body">
              <div class="panel-header">
                <h4 class="box-title">Detalle de factura</h4>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Producto</label>
                  <select class="form-control selectpicker" name="id_producto" id="id_producto" onchange="consultar_producto()" data-live-search="true">
                    <option value="0">Seleccionar Producto</option>
                    <?php $prod = DB::table('producto')->get(); ?>
                    @foreach($prod as $prod)
                    <option value="<?php echo $prod->id; ?>"> <?php echo $prod->descripcion; ?> </option>
                    @endforeach
                  </select>
                </div>
                <input type="hidden" id="product" name="product">
              </div>


              <div class="col-md-2">
                <label for="Cantidad">Cantidad</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
                  <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad">
                </div>
              </div>

              <div class="col-md-3">
                <label for="precio_compra">Precio de Compra</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
                  <input type="number" class="form-control" name="precio_compra" id="precio_compra" placeholder="Precio de Compra">
                </div>
              </div>

              <div class="col-md-3">
                <label for="precio_venta">Precio de Venta</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
                  <input type="number" class="form-control" name="precio_venta" id="precio_venta" placeholder="Precio de Venta">
                </div>
              </div>

              <label>-</label>
              <div class="form-group">
                <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
              </div>


              <!--tabla para enviar productos-->
              <div class="col-md-13">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                  <thead style="background-color: #98A8D5">
                    <th>Opción</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio compra</th>
                    <th>Precio venta</th>
                    <th>Subtotal</th>
                  </thead>
                  <tfoot>
                    <th>TOTAL</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                      <h4 id="total"> 0.00</h4>
                    </th>
                  </tfoot>
                  <tbody>

                  </tbody>

                </table>
              </div>
            </div>
          </div>

          <div class="col-md-3" id="boton">
            <div class="box-footer">
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="{{ asset('js/detallecompra.js') }}" defer></script>

@endsection