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

    function consultar_iva(){
    var dato = document.getElementById('consulta_iva').value;
    document.getElementById('iva').value = dato;
  }
</script>
<div class="row">
  <div class="col-md-12 col-md-offset-0" >
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Producto</h3>
      </div>
      <form method="post"  action="{{route('productos.update', $nuevoproducto->id)}}" >
        {{csrf_field()}}
      {{ method_field('PUT') }}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="box-body">
          <br>
          <div class="col-md-6">
          <label for="descripcion">Descripcion</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
            <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $nuevoproducto->descripcion; ?>">
          </div>
        </div>
        <div class="col-md-6">
          <label for="precio_venta">Precio de Venta</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
            <input type="text" class="form-control" name="precio_venta" id="precio_venta" value="<?php echo $nuevoproducto->precio_venta; ?>">
          </div>
        </div>
        <div class="col-md-6">
          <label for="stock">Stock</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-database"></i></span>
            <input type="text" class="form-control" name="stock" id="stock" value="<?php echo $nuevoproducto->stock; ?>">
          </div>
        </div>
        <div class="col-md-6">
          <label for="precio_compra">Precio de Compra</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
            <input type="text" class="form-control" name="precio_compra" id="precio_compra" value="<?php echo $nuevoproducto->precio_compra; ?>">
          </div>
        </div>
        <div class="col-md-6">
          
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
      </div>

       <div class="col-md-6">
        <div class="form-group">
              <label>IVA</label>             
              <select class="form-control" name="id_iva" id="consulta_iva" onchange="consultar_iva()" data-live-search="true">    
                  <option value="0">Seleccionar IVA</option>
                  <?php $iva = DB::table('ivas')->get(); ?>
                  @foreach($iva as $i)
                  <option value="<?php  echo $i->id ; ?>"> <?php echo round($i->valor). "%"; ?>  </option>
                  @endforeach
                </select>
              </div>
            </div>

        <input type="hidden" id="id_proveedor" name="id_proveedor" required>
        <input type="hidden" id="iva" name="iva">
        </div>
      <div class="box-footer">
        <button type="submit"class="btn btn-success">Modificar</button>
        <button type="submit" class="btn btn-danger" onclick="vendor/adminlte/nuevoproducto.php">Salir</button>
      </div>
    </form>
  </div>
</div>
</div>

@endsection
