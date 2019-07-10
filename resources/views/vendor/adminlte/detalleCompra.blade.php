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
          <div class="row">
            <div class="col-md-12">
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
            </div>
            <input type="hidden" id="id_proveedor" name="id_proveedor">
            <div class="col-md-5">
              <label for="numerohabitacion">Descripción</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
                <input type="text" class="form-control" name="cdescripcion" id="cdescripcion" placeholder="Descripción">
              </div>
            </div>
            <div class="col-md-3">
              <label for="numerohabitacion">Total a Pagar</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
                <input type="text" class="form-control" name="total_pagar" id="total_pagar" placeholder="Total a pagar">
              </div>
              <input type="hidden" class="form-control" name="id_usuario" id="id_usuario" value="{{Auth::user()->id}}">
            </div>
            <!--<label>-</label>
            <button type="input" class="btn btn-success">Crear</button>-->
          </div>

          <br>

          <div class="panel panel-primary">
            <div class="panel-body">
              <div class="panel-header">
                <h4 class="box-title">Detalle de factura</h4>
                <!-- <input type="hidden" id="id_factura" name="id_factura" value="<?php echo $Factura->id; ?>">
                <label for="">Factura : <?php echo $Factura->descripcion; ?></label> -->
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
                <input type="hidden" id="id_producto" name="product">
              </div>
              <div class="col-md-2">
                <label for="Cantidad">Cantidad</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
                  <input type="number" class="form-control" name="pcantidad" id="pcantidad" placeholder="Cantidad">
                </div>
              </div>

              <div class="col-md-3">
                <label for="precio_compra">Precio de Compra</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
                  <input type="text" class="form-control" name="pprecio_compra" id="pprecio_compra" placeholder="Precio de Compra">
                </div>
              </div>
              <input type="hidden" name="total_compra" id="total_compra">



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
                    <th>Subtotal</th>
                  </thead>
                  <tfoot>
                    <th>TOTAL</th>
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
              <button id="guardar" type="submit" class="btn btn-success">Guardar</button>
            </div>
          </div>

      </form>
    </div>
  </div>
</div>



@push('tabla')

<script>
  $(document).ready(function() {
    $('#bt_add').click(function() {
      agregar();

    });
  });
  var array_productos = [];
  var cont = 0;
  total = 0;
  subtotal = [];

  //indice=0;
  $("#boton").hide();

  function agregar() {

    idproducto = $("#id_producto").val();
    producto = $("#id_producto option:selected").text();
    cantidad = $("#pcantidad").val();
    preciocompra = $("#pprecio_compra").val();


    if (idproducto != "" && cantidad != "" && cantidad > 0 && preciocompra != "") {
      subtotal[cont] = (cantidad * preciocompra);
      total = total + subtotal[cont];
      var fila = '<tr class="selected" id="fila' + cont + '"><td> <button type="button" class="btn btn-danger" onclick="eliminar(' + cont + ');">X</button></td><td><input type="hidden" name"idproducto[]" value="' + idproducto + '">' + producto + '</td><td><input type="number" name"cantidad[]" value="' + cantidad + '" disabled></td><td><input type="number" name"preciocompra[]" value="' + preciocompra + '" disabled></td><td>' + subtotal[cont] + '</td></tr>';
      cont++;

      $("#total").html("$" + total);
      $("#total_compra").val(+total);
      //$("#sub").val(+subtotal[cont]);
      evaluar();
      $('#detalles').append(fila);
      // limpiar();
    } else {
      alert("Error al ingresar");
    }

  }

  function limpiar() {
    $("#pcantidad").val("");
    $("#pprecio_compra").val("");

  }

  function evaluar() {
    if (total > 0) {
      $("#boton").show();
    } else {
      $("#boton").hide();
    }
  }

  function eliminar(index) {
    total = total - subtotal[index];
    $("#total").html("$" + total);
    $("#fila" + index).remove();
    evaluar();
  }
</script>

@endpush
<!--<script src="{{ asset('js/detallecompra.js') }}" defer></script>-->

@endsection